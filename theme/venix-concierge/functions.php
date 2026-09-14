<?php
/**
 * Theme bootstrap.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

( static function () {
	$include_files = array(
		'/inc/setup.php',
		'/inc/assets.php',
		'/inc/editor.php',
		'/inc/agency-editor.php',
		'/inc/performance.php',
		'/inc/template-tags.php',
		'/inc/navigation.php',
	);

	foreach ( $include_files as $include_file ) {
		require_once get_theme_file_path( $include_file );
	}
} )();

if ( class_exists( 'WooCommerce' ) ) {
	require_once get_theme_file_path( '/inc/woocommerce.php' );
}
