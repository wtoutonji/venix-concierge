<?php
/**
 * Asset registration and conditional loading.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get a cache-busting version for a theme asset.
 *
 * @param string $relative_path Theme-relative asset path.
 * @return string Asset modification time or theme version.
 */
function venix_concierge_asset_version( $relative_path ) {
	$file = get_theme_file_path( $relative_path );

	return file_exists( $file ) ? (string) filemtime( $file ) : wp_get_theme()->get( 'Version' );
}

/**
 * Enqueue a theme stylesheet when its source file exists.
 *
 * @param string   $handle        Stylesheet handle.
 * @param string   $relative_path Theme-relative asset path.
 * @param string[] $deps          Optional stylesheet dependencies.
 * @return void
 */
function venix_concierge_enqueue_style( $handle, $relative_path, $deps = array() ) {
	$file = get_theme_file_path( $relative_path );

	if ( ! file_exists( $file ) ) {
		return;
	}

	wp_enqueue_style(
		$handle,
		get_theme_file_uri( $relative_path ),
		$deps,
		venix_concierge_asset_version( $relative_path )
	);
}

/**
 * Enqueue a theme script when its source file exists.
 *
 * @param string   $handle        Script handle.
 * @param string   $relative_path Theme-relative asset path.
 * @param string[] $deps          Optional script dependencies.
 * @param string   $strategy      Optional loading strategy.
 * @return void
 */
function venix_concierge_enqueue_script( $handle, $relative_path, $deps = array(), $strategy = 'defer' ) {
	$file = get_theme_file_path( $relative_path );

	if ( ! file_exists( $file ) ) {
		return;
	}

	wp_enqueue_script(
		$handle,
		get_theme_file_uri( $relative_path ),
		$deps,
		venix_concierge_asset_version( $relative_path ),
		array(
			'in_footer' => true,
			'strategy'  => $strategy,
		)
	);
}

/**
 * Enqueue global theme foundations and conditional navigation behavior.
 *
 * @return void
 */
function venix_concierge_enqueue_global_assets() {
	venix_concierge_enqueue_style( 'venix-concierge-tokens', '/assets/css/tokens.css' );
	venix_concierge_enqueue_style( 'venix-concierge-base', '/assets/css/base.css', array( 'venix-concierge-tokens' ) );
	venix_concierge_enqueue_style( 'venix-concierge-layout', '/assets/css/layout.css', array( 'venix-concierge-base' ) );
	venix_concierge_enqueue_style( 'venix-concierge-header', '/assets/css/header.css', array( 'venix-concierge-layout' ) );
	venix_concierge_enqueue_style( 'venix-concierge-footer', '/assets/css/footer.css', array( 'venix-concierge-layout' ) );

	if ( is_front_page() ) {
		venix_concierge_enqueue_style( 'venix-concierge-home', '/assets/css/pages/home.css', array( 'venix-concierge-layout' ) );
		venix_concierge_enqueue_component( 'button' );
		venix_concierge_enqueue_component( 'input' );
		venix_concierge_enqueue_component( 'inquiry-form' );
		venix_concierge_enqueue_script( 'venix-concierge-reveal', '/assets/js/components/reveal.js' );
	}

	if ( venix_concierge_is_about_page() ) {
		venix_concierge_enqueue_style( 'venix-concierge-about', '/assets/css/pages/about.css', array( 'venix-concierge-layout' ) );
		venix_concierge_enqueue_component( 'button' );
	}

	if ( venix_concierge_is_services_page() ) {
		venix_concierge_enqueue_style( 'venix-concierge-services', '/assets/css/pages/services.css', array( 'venix-concierge-layout' ) );
		venix_concierge_enqueue_component( 'button' );
		venix_concierge_enqueue_component( 'badge' );
	}

	if ( venix_concierge_is_fleet_page() ) {
		venix_concierge_enqueue_style( 'venix-concierge-fleet', '/assets/css/pages/fleet.css', array( 'venix-concierge-layout' ) );
		venix_concierge_enqueue_component( 'button' );
		venix_concierge_enqueue_component( 'badge' );
	}

	if ( venix_concierge_is_contact_page() ) {
		venix_concierge_enqueue_style( 'venix-concierge-contact', '/assets/css/pages/contact.css', array( 'venix-concierge-layout' ) );
		venix_concierge_enqueue_component( 'button' );
		venix_concierge_enqueue_component( 'input' );
		venix_concierge_enqueue_component( 'inquiry-form' );
	}

	venix_concierge_enqueue_script( 'venix-concierge-menu', '/assets/js/components/mobile-menu.js' );
	venix_concierge_enqueue_style( 'venix-concierge-mobile-menu', '/assets/css/components/mobile-menu.css', array( 'venix-concierge-header' ) );
}
add_action( 'wp_enqueue_scripts', 'venix_concierge_enqueue_global_assets' );

/**
 * Load a theme component's CSS/JS only when that component is used.
 *
 * Example: venix_concierge_enqueue_component( 'carousel' );
 *
 * @param string $component Component slug.
 * @return void
 */
function venix_concierge_enqueue_component( $component ) {
	$slug = sanitize_key( $component );

	venix_concierge_enqueue_style(
		'venix-concierge-component-' . $slug,
		'/assets/css/components/' . $slug . '.css',
		array( 'venix-concierge-layout' )
	);

	venix_concierge_enqueue_script(
		'venix-concierge-component-' . $slug,
		'/assets/js/components/' . $slug . '.js'
	);
}
