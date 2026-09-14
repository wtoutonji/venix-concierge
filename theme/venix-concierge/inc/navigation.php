<?php
/**
 * Navigation helpers.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Return a production page URL, with a safe home fallback until the page exists. */
function venix_concierge_page_url( $slug, $anchor = '' ) {
	$page = get_page_by_path( $slug );
	$url  = $page ? get_permalink( $page ) : home_url( '/' );

	return $anchor ? $url . '#' . rawurlencode( $anchor ) : $url;
}

/** Render Polylang's switcher when Polylang is active. */
function venix_concierge_render_language_switcher() {
	if ( ! function_exists( 'pll_the_languages' ) ) {
		return;
	}

	$languages = pll_the_languages(
		array(
			'raw' => 1,
		)
	);
	if ( empty( $languages ) || ! is_array( $languages ) ) {
		return;
	}
	echo '<nav class="venix-language-switcher" aria-label="' . esc_attr__( 'Language', 'venix-concierge' ) . '">';
	foreach ( $languages as $language ) {
		printf( '<a href="%1$s" lang="%2$s"%3$s>%4$s</a>', esc_url( $language['url'] ), esc_attr( ! empty( $language['hreflang'] ) ? $language['hreflang'] : $language['slug'] ), ! empty( $language['current_lang'] ) ? ' aria-current="true"' : '', esc_html( strtoupper( $language['slug'] ) ) );
	}
	echo '</nav>';
}
