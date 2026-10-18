<?php
/**
 * Idempotent Rank Math metadata deployment for Venix Concierge (EN, PL, RU).
 *
 * Dry-run by default. Pages are matched by Polylang language + shared page-family
 * slug (never by database ID). Only post meta, three targeted option keys,
 * attachment alt meta and menu-item URL meta are written; no post is updated, so
 * post_modified never changes. Safe to run repeatedly.
 *
 *   wp eval-file scripts/apply-seo-metadata.php           (report only)
 *   wp eval-file scripts/apply-seo-metadata.php apply     (write changes)
 */

if ( ! defined( 'ABSPATH' ) ) {
	fwrite( STDERR, "Run this file with wp eval-file from a loaded WordPress site.\n" );
	exit( 1 );
}

$venix_seo_args  = isset( $args ) && is_array( $args ) ? $args : array();
$venix_seo_apply = in_array( 'apply', $venix_seo_args, true );

/**
 * Print one report line and count it; call with no arguments to read the counters.
 *
 * Counters live in a static because eval-file runs this script in function scope.
 */
function venix_seo_say( $kind = null, $message = '' ) {
	static $log = array(
		'changed'  => 0,
		'ok'       => 0,
		'problems' => 0,
	);

	if ( null === $kind ) {
		return $log;
	}
	if ( 'CHANGE' === $kind || 'WOULD' === $kind ) {
		++$log['changed'];
	} elseif ( 'OK' === $kind ) {
		++$log['ok'];
	} else {
		++$log['problems'];
	}
	echo str_pad( $kind, 8 ) . $message . "\n";
}

/** Set one post meta value only when it differs. */
function venix_seo_set_meta( $post_id, $key, $value, $label, $apply ) {
	$current = get_post_meta( $post_id, $key, true );

	if ( $current === $value || ( is_array( $value ) && $current == $value ) ) {
		venix_seo_say( 'OK', "$label $key already correct" );
		return;
	}
	if ( $apply ) {
		update_post_meta( $post_id, $key, $value );
		venix_seo_say( 'CHANGE', "$label $key updated" );
		return;
	}
	venix_seo_say( 'WOULD', "$label $key: " . wp_json_encode( $current, JSON_UNESCAPED_UNICODE ) . ' -> ' . wp_json_encode( $value, JSON_UNESCAPED_UNICODE ) );
}

/** Find the single published page for a language + slug, or null after reporting why. */
function venix_seo_find_page( $lang, $slug ) {
	$found = get_posts(
		array(
			'post_type'        => 'page',
			'post_status'      => 'publish',
			'name'             => $slug,
			'lang'             => $lang,
			'numberposts'      => 5,
			'suppress_filters' => false,
		)
	);
	$found = array_values(
		array_filter(
			$found,
			static function ( $post ) use ( $lang ) {
				return pll_get_post_language( $post->ID ) === $lang;
			}
		)
	);

	if ( 1 !== count( $found ) ) {
		venix_seo_say( 'PROBLEM', "[$lang/$slug] expected 1 published page, found " . count( $found ) . '; skipped' );
		return null;
	}

	return $found[0];
}

foreach ( array( 'pll_get_post_language', 'pll_get_post_translations' ) as $venix_seo_function ) {
	if ( ! function_exists( $venix_seo_function ) ) {
		fwrite( STDERR, "BLOCKED: Polylang API $venix_seo_function unavailable.\n" );
		exit( 1 );
	}
}
if ( ! defined( 'RANK_MATH_VERSION' ) ) {
	fwrite( STDERR, "BLOCKED: Rank Math is not active.\n" );
	exit( 1 );
}

$venix_seo_data = require __DIR__ . '/seo/rank-math-seo-data.php';

global $wpdb;
$venix_seo_modified_before = $wpdb->get_col( "SELECT CONCAT(ID,'|',post_modified) FROM {$wpdb->posts} WHERE post_type='page' ORDER BY ID" );

echo ( $venix_seo_apply ? 'MODE: APPLY' : 'MODE: DRY-RUN (no changes; pass "apply" to write)' ) . ' | home=' . home_url() . "\n\n";

// 1. Page metadata, matched by language + family slug.
$venix_seo_en_ids = array();
foreach ( $venix_seo_data['pages'] as $venix_seo_lang => $venix_seo_families ) {
	foreach ( $venix_seo_families as $venix_seo_slug => $venix_seo_values ) {
		$venix_seo_page = venix_seo_find_page( $venix_seo_lang, $venix_seo_slug );
		if ( ! $venix_seo_page ) {
			continue;
		}
		$venix_seo_label = "[$venix_seo_lang/$venix_seo_slug #{$venix_seo_page->ID}]";
		venix_seo_set_meta( $venix_seo_page->ID, 'rank_math_title', $venix_seo_values['title'], $venix_seo_label, $venix_seo_apply );
		venix_seo_set_meta( $venix_seo_page->ID, 'rank_math_description', $venix_seo_values['description'], $venix_seo_label, $venix_seo_apply );
		venix_seo_set_meta( $venix_seo_page->ID, 'rank_math_focus_keyword', $venix_seo_values['focus_keyword'], $venix_seo_label, $venix_seo_apply );

		if ( 'en' === $venix_seo_lang ) {
			$venix_seo_en_ids[ $venix_seo_slug ] = $venix_seo_page->ID;
		} elseif ( isset( $venix_seo_en_ids[ $venix_seo_slug ] ) ) {
			$venix_seo_translations = pll_get_post_translations( $venix_seo_en_ids[ $venix_seo_slug ] );
			if ( empty( $venix_seo_translations[ $venix_seo_lang ] ) || (int) $venix_seo_translations[ $venix_seo_lang ] !== (int) $venix_seo_page->ID ) {
				venix_seo_say( 'PROBLEM', "$venix_seo_label is not the Polylang $venix_seo_lang translation of EN $venix_seo_slug; check the translation group" );
			}
		}
	}
}

// 2. Noindex pages: merge into existing robots, never drop other directives.
foreach ( $venix_seo_data['noindex'] as $venix_seo_target ) {
	$venix_seo_found = get_posts(
		array(
			'post_type'        => 'page',
			'post_status'      => 'any',
			'name'             => $venix_seo_target['slug'],
			'lang'             => $venix_seo_target['lang'],
			'numberposts'      => 1,
			'suppress_filters' => false,
		)
	);
	$venix_seo_label = "[{$venix_seo_target['lang']}/{$venix_seo_target['slug']}]";
	if ( ! $venix_seo_found ) {
		venix_seo_say( 'OK', "$venix_seo_label not present; nothing to noindex" );
		continue;
	}
	$venix_seo_robots = get_post_meta( $venix_seo_found[0]->ID, 'rank_math_robots', true );
	$venix_seo_robots = is_array( $venix_seo_robots ) ? $venix_seo_robots : array();
	$venix_seo_robots = array_values( array_unique( array_merge( $venix_seo_robots, array( 'noindex' ) ) ) );
	venix_seo_set_meta( $venix_seo_found[0]->ID, 'rank_math_robots', $venix_seo_robots, "$venix_seo_label #{$venix_seo_found[0]->ID}", $venix_seo_apply );
}

// 3. Rank Math global titles options: merge only the intended keys.
$venix_seo_titles = get_option( 'rank-math-options-titles' );
if ( ! is_array( $venix_seo_titles ) ) {
	venix_seo_say( 'PROBLEM', 'rank-math-options-titles is missing; make sure Rank Math has been activated once, then rerun' );
} else {
	$venix_seo_new = array_merge( $venix_seo_titles, $venix_seo_data['titles_options'] );
	if ( $venix_seo_new === $venix_seo_titles ) {
		venix_seo_say( 'OK', 'Rank Math titles options already correct' );
	} elseif ( $venix_seo_apply ) {
		update_option( 'rank-math-options-titles', $venix_seo_new );
		venix_seo_say( 'CHANGE', 'Rank Math titles options updated: ' . implode( ', ', array_keys( $venix_seo_data['titles_options'] ) ) );
	} else {
		foreach ( $venix_seo_data['titles_options'] as $venix_seo_key => $venix_seo_value ) {
			if ( ( $venix_seo_titles[ $venix_seo_key ] ?? null ) !== $venix_seo_value ) {
				venix_seo_say( 'WOULD', "titles option $venix_seo_key: " . wp_json_encode( $venix_seo_titles[ $venix_seo_key ] ?? null ) . ' -> ' . wp_json_encode( $venix_seo_value ) );
			}
		}
	}
}

// 4. Exact-match attachment alt fixes.
foreach ( $venix_seo_data['attachment_alt_fixes'] as $venix_seo_from => $venix_seo_to ) {
	$venix_seo_ids = $wpdb->get_col( $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attachment_image_alt' AND meta_value = %s", $venix_seo_from ) );
	if ( ! $venix_seo_ids ) {
		venix_seo_say( 'OK', 'attachment alt fix not needed' );
	}
	foreach ( $venix_seo_ids as $venix_seo_id ) {
		venix_seo_set_meta( (int) $venix_seo_id, '_wp_attachment_image_alt', $venix_seo_to, "[attachment #$venix_seo_id]", $venix_seo_apply );
	}
}

// 5. Exact-match custom menu URL fixes.
foreach ( $venix_seo_data['menu_url_fixes'] as $venix_seo_from => $venix_seo_to ) {
	$venix_seo_ids = $wpdb->get_col( $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_menu_item_url' AND meta_value = %s", $venix_seo_from ) );
	if ( ! $venix_seo_ids ) {
		venix_seo_say( 'OK', "no menu item with url $venix_seo_from" );
	}
	foreach ( $venix_seo_ids as $venix_seo_id ) {
		venix_seo_set_meta( (int) $venix_seo_id, '_menu_item_url', $venix_seo_to, "[menu item #$venix_seo_id]", $venix_seo_apply );
	}
}

// 6. Sitemap cache and post_modified guard.
$venix_seo_log = venix_seo_say();
if ( $venix_seo_apply && $venix_seo_log['changed'] && class_exists( '\RankMath\Sitemap\Cache' ) ) {
	\RankMath\Sitemap\Cache::invalidate_storage();
}
$venix_seo_modified_after = $wpdb->get_col( "SELECT CONCAT(ID,'|',post_modified) FROM {$wpdb->posts} WHERE post_type='page' ORDER BY ID" );
$venix_seo_guard          = $venix_seo_modified_before === $venix_seo_modified_after;

echo "\nSUMMARY: {$venix_seo_log['changed']} " . ( $venix_seo_apply ? 'changed' : 'would change' ) . ", {$venix_seo_log['ok']} already correct, {$venix_seo_log['problems']} problems. post_modified " . ( $venix_seo_guard ? 'unchanged' : 'CHANGED (investigate)' ) . ".\n";
if ( $venix_seo_log['problems'] || ! $venix_seo_guard ) {
	exit( 1 );
}
