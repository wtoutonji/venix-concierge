<?php
/**
 * Theme setup.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register theme supports, navigation locations and editor integration.
 *
 * @return void
 */
function venix_concierge_setup() {
	load_theme_textdomain( 'venix-concierge', get_theme_file_path( '/languages' ) );

	/**
	 * Filters the custom logo support arguments.
	 *
	 * Client projects may extend these arguments without changing the neutral
	 * inherited defaults.
	 *
	 * @since 1.0.1
	 *
	 * @param array $custom_logo_args Custom logo support arguments.
	 */
	$custom_logo_args = apply_filters(
		'venix_concierge_custom_logo_args',
		array(
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', $custom_logo_args );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Navigation', 'venix-concierge' ),
			'footer'  => __( 'Footer Navigation', 'venix-concierge' ),
			'legal'   => __( 'Legal Navigation', 'venix-concierge' ),
		)
	);
}
add_action( 'after_setup_theme', 'venix_concierge_setup' );
