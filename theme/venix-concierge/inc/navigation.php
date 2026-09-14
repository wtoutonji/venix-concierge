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

/**
 * Determine whether the queried page is the canonical About page or its translation.
 *
 * @return bool
 */
function venix_concierge_is_about_page() {
	return venix_concierge_is_page_role( 'about' );
}

/**
 * Determine whether the queried page has a canonical page role or is its translation.
 *
 * @param string $slug Canonical English page slug.
 * @return bool
 */
function venix_concierge_is_page_role( $slug ) {
	if ( ! is_page() ) {
		return false;
	}

	$page_id = get_queried_object_id();

	if ( ! $page_id ) {
		return false;
	}

	if ( $slug === get_post_field( 'post_name', $page_id ) ) {
		return true;
	}

	if ( ! function_exists( 'pll_get_post_translations' ) ) {
		return false;
	}

	$translations = pll_get_post_translations( $page_id );

	if ( ! is_array( $translations ) ) {
		return false;
	}

	foreach ( $translations as $translation_id ) {
		if ( $slug === get_post_field( 'post_name', $translation_id ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Determine whether the queried page is Services or its Polylang translation.
 *
 * @return bool
 */
function venix_concierge_is_services_page() {
	return venix_concierge_is_page_role( 'services' );
}

/**
 * Determine whether the queried page is Fleet or its Polylang translation.
 *
 * @return bool
 */
function venix_concierge_is_fleet_page() {
	return venix_concierge_is_page_role( 'fleet' );
}

/** Determine whether the queried page is Contact or its Polylang translation. */
function venix_concierge_is_contact_page() {
	return venix_concierge_is_page_role( 'contact' );
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
