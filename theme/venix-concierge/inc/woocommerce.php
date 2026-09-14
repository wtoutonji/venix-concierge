<?php
/**
 * WooCommerce presentation integration.
 *
 * This file is intentionally lightweight. Store business logic belongs in
 * a project/store plugin, not the theme.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register optional WooCommerce presentation supports.
 *
 * @return void
 */
function venix_concierge_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'venix_concierge_woocommerce_setup' );
