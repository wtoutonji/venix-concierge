<?php
/**
 * Idempotent local bootstrap for the Venix Concierge Polylang page entities (EN, PL, RU and AR).
 *
 * Arabic (ar, locale `ar`, RTL) is created as a Polylang language when missing;
 * its pages, translation groups, inherited media, per-page Arabic alt text and the
 * Primary AR / Footer AR menus come from scripts/arabic-site-data.php. Nothing is
 * keyed by database ID, and already-correct data is left untouched so existing
 * pages keep their post_modified dates.
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

$arabic = require __DIR__ . '/arabic-site-data.php';

// Arabic is the only language this script may create (the others must already exist).
if ( empty( $by_slug['ar'] ) ) {
	if ( ! function_exists( 'PLL' ) || ! is_object( PLL()->model ) || ! isset( PLL()->model->languages ) || ! method_exists( PLL()->model->languages, 'add' ) ) {
		venix_concierge_setup_fail( 'Polylang Pro language API is unavailable, so the Arabic language cannot be created.' );
	}

	$added = PLL()->model->languages->add( $arabic['language'] );

	if ( is_wp_error( $added ) ) {
		venix_concierge_setup_fail( 'Could not create the Arabic language: ' . $added->get_error_message() );
	}

	echo "CREATED: Polylang language ar (locale ar, RTL).\n";

	$by_slug['ar'] = PLL()->model->languages->get( 'ar' );

	if ( empty( $by_slug['ar'] ) ) {
		venix_concierge_setup_fail( 'Polylang did not return the Arabic language after creating it.' );
	}
}

foreach ( array( 'en' => 'en_US', 'pl' => 'pl_PL', 'ru' => 'ru_RU', 'ar' => 'ar' ) as $slug => $locale ) {
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
	} elseif ( 'publish' !== get_post_status( $page_id ) ) {
		// Only publish a page that is not already published. Rewriting an
		// already-published page would falsely change its post_modified date.
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
	foreach ( array( 'en', 'pl', 'ru', 'ar' ) as $language ) {
		$actual_slug = get_post_field( 'post_name', $translations[ $language ] );

		if ( $role !== $actual_slug ) {
			venix_concierge_setup_fail( "Shared slug failure for {$role} {$language}: expected '{$role}', found '{$actual_slug}'." );
		}
	}
}

$roles = array(
	'home'     => array( 'en' => array( 'Home', 'home' ), 'pl' => array( 'Strona główna', 'home' ), 'ru' => array( 'Главная', 'home' ), 'ar' => array( $arabic['titles']['home'], 'home' ) ),
	'about'    => array( 'en' => array( 'About', 'about' ), 'pl' => array( 'O nas', 'about' ), 'ru' => array( 'О компании', 'about' ), 'ar' => array( $arabic['titles']['about'], 'about' ) ),
	'services' => array( 'en' => array( 'Services', 'services' ), 'pl' => array( 'Usługi', 'services' ), 'ru' => array( 'Услуги', 'services' ), 'ar' => array( $arabic['titles']['services'], 'services' ) ),
	'fleet'    => array( 'en' => array( 'Fleet', 'fleet' ), 'pl' => array( 'Flota', 'fleet' ), 'ru' => array( 'Автопарк', 'fleet' ), 'ar' => array( $arabic['titles']['fleet'], 'fleet' ) ),
	'contact'  => array( 'en' => array( 'Contact', 'contact' ), 'pl' => array( 'Kontakt', 'contact' ), 'ru' => array( 'Контакты', 'contact' ), 'ar' => array( $arabic['titles']['contact'], 'contact' ) ),
);
$records = array();

foreach ( $roles as $role => $translations ) {
	$records[ $role ] = array();

	foreach ( $translations as $language => $page ) {
		$records[ $role ][ $language ] = venix_concierge_setup_page( $page[0], $page[1], $language );
	}

	// Only write the group when it differs, so an already-linked family is not touched.
	$current = array_map( 'intval', (array) pll_get_post_translations( $records[ $role ]['en'] ) );

	if ( array_intersect_key( $current, $records[ $role ] ) !== $records[ $role ] ) {
		pll_save_post_translations( $records[ $role ] );
	}

	$actual = pll_get_post_translations( $records[ $role ]['en'] );

	foreach ( array( 'en', 'pl', 'ru', 'ar' ) as $language ) {
		if ( ! isset( $actual[ $language ] ) || (int) $actual[ $language ] !== $records[ $role ][ $language ] ) {
			venix_concierge_setup_fail( "Polylang did not save the {$role} EN/PL/RU/AR translation relationship." );
		}
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

foreach ( array( 'pl', 'ru', 'ar' ) as $language ) {
	if ( $records['home'][ $language ] !== (int) pll_get_post( (int) get_option( 'page_on_front' ), $language ) ) {
		venix_concierge_setup_fail( "Polylang did not resolve the {$language} Home page from the English static front page." );
	}
}

/**
 * Inherit the English page's media and give the Arabic page its own contextual alt text.
 *
 * Writes `_venix_page_content` only when the value differs and never calls
 * wp_update_post(), so post_modified does not move.
 */
foreach ( $records as $role => $translations ) {
	$english_meta = get_post_meta( $translations['en'], '_venix_page_content', true );
	$english_meta = is_array( $english_meta ) ? $english_meta : array();
	$arabic_meta  = get_post_meta( $translations['ar'], '_venix_page_content', true );
	$arabic_meta  = is_array( $arabic_meta ) ? $arabic_meta : array();
	$desired      = $arabic_meta;

	foreach ( array( 'media', 'media_video' ) as $group ) {
		if ( ! empty( $english_meta[ $group ] ) && is_array( $english_meta[ $group ] ) ) {
			$desired[ $group ] = $english_meta[ $group ];
		}
	}

	if ( ! empty( $arabic['media_alt'][ $role ] ) ) {
		$desired['media_alt'] = array();

		foreach ( $arabic['media_alt'][ $role ] as $slot => $alt ) {
			if ( ! empty( $desired['media'][ $slot ] ) ) {
				$desired['media_alt'][ $slot ] = $alt;
			}
		}
	}

	if ( $desired !== $arabic_meta ) {
		update_post_meta( $translations['ar'], '_venix_page_content', $desired );
		echo "UPDATED: AR {$role} (#{$translations['ar']}) media, video and Arabic alt text.\n";
	}
}

/** Create or reuse a language menu and populate it only while it is empty. */
function venix_concierge_setup_arabic_menu( $name, $items, $records ) {
	$menu = wp_get_nav_menu_object( $name );

	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $name );

		if ( is_wp_error( $menu_id ) ) {
			venix_concierge_setup_fail( "Could not create menu '{$name}': {$menu_id->get_error_message()}" );
		}

		echo "CREATED: menu {$name} (#{$menu_id}).\n";
	} else {
		$menu_id = (int) $menu->term_id;
	}

	if ( wp_get_nav_menu_items( $menu_id ) ) {
		return (int) $menu_id;
	}

	$add = static function ( $item, $parent_id ) use ( &$add, $menu_id, $records ) {
		$args = array(
			'menu-item-title'     => $item[2],
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $parent_id,
		);

		if ( 'page' === $item[0] ) {
			$args['menu-item-type']      = 'post_type';
			$args['menu-item-object']    = 'page';
			$args['menu-item-object-id'] = $records[ $item[1] ]['ar'];
		} else {
			$args['menu-item-type'] = 'custom';
			$args['menu-item-url']  = $item[1];
		}

		$item_id = wp_update_nav_menu_item( $menu_id, 0, $args );

		if ( is_wp_error( $item_id ) ) {
			venix_concierge_setup_fail( "Could not add menu item '{$item[2]}': {$item_id->get_error_message()}" );
		}

		foreach ( isset( $item[3] ) ? $item[3] : array() as $child ) {
			$add( $child, (int) $item_id );
		}
	};

	foreach ( $items as $item ) {
		$add( $item, 0 );
	}

	echo "POPULATED: menu {$name} (#{$menu_id}).\n";

	return (int) $menu_id;
}

$arabic_menu_ids = array();
$nav_menus       = $polylang->options->get( 'nav_menus' );
$nav_menus       = is_array( $nav_menus ) ? $nav_menus : array();
$theme           = get_option( 'stylesheet' );

foreach ( $arabic['menus'] as $location => $menu_data ) {
	$arabic_menu_ids[ $location ] = venix_concierge_setup_arabic_menu( $menu_data['name'], $menu_data['items'], $records );

	if ( ! isset( $nav_menus[ $theme ][ $location ]['ar'] ) || (int) $nav_menus[ $theme ][ $location ]['ar'] !== $arabic_menu_ids[ $location ] ) {
		$nav_menus[ $theme ][ $location ]['ar'] = $arabic_menu_ids[ $location ];
		$polylang->options->set( 'nav_menus', $nav_menus );
		echo "ASSIGNED: {$location} location (ar) = menu #{$arabic_menu_ids[ $location ]}.\n";
	}
}

echo "SUCCESS: Venix page translation sets and English static front page are ready.\n";
foreach ( $records as $role => $translations ) {
	echo strtoupper( $role ) . ': en=' . $translations['en'] . ' pl=' . $translations['pl'] . ' ru=' . $translations['ru'] . ' ar=' . $translations['ar'] . "\n";
}
echo 'Arabic menus: primary=' . $arabic_menu_ids['primary'] . ' footer=' . $arabic_menu_ids['footer'] . "\n";
echo "EN/PL/RU menus are managed in WordPress Admin; see handoff/generated/polylang-implementation-map.md.\n";
