<?php
/**
 * Idempotent local bootstrap for the Venix Concierge Polylang page entities.
 *
 * Run only from the LocalWP Site Shell:
 * wp eval-file "D:\Wordpress Projects\Projects\venix-concierge\scripts\setup-polylang-site.php"
 */

if ( ! defined( 'ABSPATH' ) ) {
	fwrite( STDERR, "Run this file with wp eval-file from a loaded WordPress site.\n" );
	exit( 1 );
}

/** Abort before mutation with a precise setup prerequisite. */
function venix_concierge_setup_fail( $message ) {
	global $venix_concierge_setup_created_pages;

	if ( ! empty( $venix_concierge_setup_created_pages ) ) {
		foreach ( array_unique( $venix_concierge_setup_created_pages ) as $page_id ) {
			wp_delete_post( (int) $page_id, true );
		}
	}

	fwrite( STDERR, 'BLOCKED: ' . $message . "\n" );
	exit( 1 );
}

$venix_concierge_setup_created_pages = array();

foreach ( array( 'pll_languages_list', 'pll_default_language', 'pll_set_post_language', 'pll_save_post_translations', 'pll_get_post_translations', 'pll_get_post' ) as $function ) {
	if ( ! function_exists( $function ) ) {
		venix_concierge_setup_fail( "Polylang Pro API {$function} is unavailable. Activate Polylang Pro first." );
	}
}

$languages = pll_languages_list(
	array(
		'fields' => null,
	)
);
$by_slug   = array();

foreach ( $languages as $language ) {
	if ( is_object( $language ) && ! empty( $language->slug ) ) {
		$by_slug[ $language->slug ] = $language;
	}
}

foreach ( array( 'en' => 'en_US', 'pl' => 'pl_PL' ) as $slug => $locale ) {
	if ( empty( $by_slug[ $slug ] ) ) {
		venix_concierge_setup_fail( "Required Polylang language '{$slug}' does not exist." );
	}

	if ( $locale !== $by_slug[ $slug ]->locale ) {
		venix_concierge_setup_fail( "Language '{$slug}' must use locale '{$locale}'; found '{$by_slug[ $slug ]->locale}'." );
	}
}

if ( 'en' !== pll_default_language( 'slug' ) ) {
	venix_concierge_setup_fail( 'English (en) must be the default Polylang language.' );
}

if ( '' === (string) get_option( 'permalink_structure' ) ) {
	venix_concierge_setup_fail( 'Pretty permalinks are disabled.' );
}

if ( ! function_exists( 'PLL' ) ) {
	venix_concierge_setup_fail( 'Polylang Pro runtime function PLL() is unavailable. Activate Polylang Pro first.' );
}

$polylang = PLL();

if ( ! is_object( $polylang ) || ! isset( $polylang->options ) || ! is_object( $polylang->options ) || ! method_exists( $polylang->options, 'get' ) ) {
	venix_concierge_setup_fail( 'Polylang Pro runtime options API is unavailable. Activate a compatible Polylang Pro version first.' );
}

$force_lang = $polylang->options->get( 'force_lang' );
$rewrite    = $polylang->options->get( 'rewrite' );

if ( empty( $force_lang ) || empty( $rewrite ) ) {
	venix_concierge_setup_fail( 'Polylang URL modifications must use a rewritten language URL mode for shared slugs.' );
}

/** Locate an existing page only when title, slug, and assigned language all match. */
function venix_concierge_setup_find_page( $title, $slug, $language ) {
	$pages = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'any',
			'name'           => $slug,
			'posts_per_page' => -1,
			'fields'         => 'all',
			'lang'           => $language,
		)
	);

	foreach ( $pages as $page ) {
		if ( $title === $page->post_title && $language === pll_get_post_language( $page->ID, 'slug' ) ) {
			return $page->ID;
		}
	}

	return 0;
}

/** Create or reuse one page and explicitly assign its language. */
function venix_concierge_setup_page( $title, $slug, $language ) {
	global $venix_concierge_setup_created_pages;

	$page_id = venix_concierge_setup_find_page( $title, $slug, $language );

	if ( ! $page_id ) {
		$page_id = wp_insert_post(
			array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'post_title'  => $title,
				// A temporary unique slug lets Polylang establish the language
				// before WordPress evaluates the intended shared slug.
				'post_name'   => $slug . '-' . $language,
			),
			true
		);

		if ( is_wp_error( $page_id ) ) {
			venix_concierge_setup_fail( "Could not create {$language} page '{$title}': {$page_id->get_error_message()}" );
		}

		$venix_concierge_setup_created_pages[] = (int) $page_id;

		pll_set_post_language( $page_id, $language );

		$updated_page_id = wp_update_post(
			array(
				'ID'        => $page_id,
				'post_name' => $slug,
			),
			true
		);

		if ( is_wp_error( $updated_page_id ) ) {
			venix_concierge_setup_fail( "Could not set shared slug '{$slug}' for {$language} page '{$title}': {$updated_page_id->get_error_message()}" );
		}
	} else {
		$updated_page_id = wp_update_post(
			array(
				'ID'          => $page_id,
				'post_status' => 'publish',
			),
			true
		);

		if ( is_wp_error( $updated_page_id ) ) {
			venix_concierge_setup_fail( "Could not publish existing {$language} page '{$title}': {$updated_page_id->get_error_message()}" );
		}
	}

	return (int) $page_id;
}

/** Verify a non-home translation pair retained its configured shared slug. */
function venix_concierge_setup_verify_shared_slug( $role, $translations ) {
	foreach ( array( 'en', 'pl' ) as $language ) {
		$actual_slug = get_post_field( 'post_name', $translations[ $language ] );

		if ( $role !== $actual_slug ) {
			venix_concierge_setup_fail( "Shared slug failure for {$role} {$language}: expected '{$role}', found '{$actual_slug}'." );
		}
	}
}

$roles = array(
	'home'     => array( 'en' => array( 'Home', 'home' ), 'pl' => array( 'Strona główna', 'home' ) ),
	'about'    => array( 'en' => array( 'About', 'about' ), 'pl' => array( 'O nas', 'about' ) ),
	'services' => array( 'en' => array( 'Services', 'services' ), 'pl' => array( 'Usługi', 'services' ) ),
	'fleet'    => array( 'en' => array( 'Fleet', 'fleet' ), 'pl' => array( 'Flota', 'fleet' ) ),
	'contact'  => array( 'en' => array( 'Contact', 'contact' ), 'pl' => array( 'Kontakt', 'contact' ) ),
);
$records = array();

foreach ( $roles as $role => $translations ) {
	$records[ $role ] = array();

	foreach ( $translations as $language => $page ) {
		$records[ $role ][ $language ] = venix_concierge_setup_page( $page[0], $page[1], $language );
	}

	pll_save_post_translations( $records[ $role ] );
	$actual = pll_get_post_translations( $records[ $role ]['en'] );

	if ( (int) $actual['en'] !== $records[ $role ]['en'] || (int) $actual['pl'] !== $records[ $role ]['pl'] ) {
		venix_concierge_setup_fail( "Polylang did not save the {$role} EN/PL translation relationship." );
	}

	if ( 'home' !== $role ) {
		venix_concierge_setup_verify_shared_slug( $role, $records[ $role ] );
	}
}

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $records['home']['en'] );
update_option( 'page_for_posts', 0 );

if ( 'page' !== get_option( 'show_on_front' ) || $records['home']['en'] !== (int) get_option( 'page_on_front' ) ) {
	venix_concierge_setup_fail( 'WordPress did not retain the English static front-page assignment.' );
}

if ( $records['home']['pl'] !== (int) pll_get_post( (int) get_option( 'page_on_front' ), 'pl' ) ) {
	venix_concierge_setup_fail( 'Polylang did not resolve the Polish Home page from the English static front page.' );
}

echo "SUCCESS: Venix page translation sets and English static front page are ready.\n";
foreach ( $records as $role => $translations ) {
	echo strtoupper( $role ) . ': en=' . $translations['en'] . ' pl=' . $translations['pl'] . "\n";
}
echo "Menus intentionally require WordPress Admin assignment; see handoff/generated/polylang-implementation-map.md.\n";
