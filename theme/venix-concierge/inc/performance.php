<?php
/**
 * Performance helpers.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Remove native WordPress emoji assets when the theme policy is enabled.
 *
 * @return void
 */
function venix_concierge_disable_emojis() {
	/**
	 * Filters whether VenixConcierge removes native WordPress emoji assets.
	 *
	 * Return false in a downstream project to restore WordPress defaults.
	 *
	 * @since 1.0.1
	 *
	 * @param bool $disable_emojis Whether native emoji assets should be removed.
	 */
	$disable_emojis = apply_filters( 'venix_concierge_disable_emojis', true );

	if ( ! $disable_emojis ) {
		return;
	}

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'venix_concierge_disable_emojis' );
