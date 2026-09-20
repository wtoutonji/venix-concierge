<?php
/**
 * Read-only access to the global company, contact and social settings.
 *
 * Storage, sanitization, the admin screen and the shortcode live in the
 * Venix Concierge Core plugin. Templates read only through these helpers so
 * they never call get_option() for site-wide company data.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get every global site setting, empty when unset or when the core plugin is inactive.
 *
 * @return array<string, string>
 */
function venix_concierge_get_site_settings() {
	if ( function_exists( 'venix_concierge_core_get_site_settings' ) ) {
		return venix_concierge_core_get_site_settings();
	}

	return array_fill_keys( array( 'company_name', 'legal_name', 'address', 'phone', 'whatsapp', 'email', 'instagram', 'facebook' ), '' );
}

/**
 * Get one global site setting.
 *
 * @param string $key     Setting key.
 * @param string $default Value returned when the key is unknown or empty.
 * @return string
 */
function venix_concierge_get_site_setting( $key, $default = '' ) {
	$settings = venix_concierge_get_site_settings();

	return isset( $settings[ $key ] ) && '' !== $settings[ $key ] ? $settings[ $key ] : $default;
}

/**
 * Render the Media Library logo chosen in Venix → Site Settings.
 *
 * Reuses core's `custom-logo-link` / `custom-logo` classes so the existing logo
 * geometry rules apply unchanged. Returns an empty string when no valid Media
 * Library logo is selected (or the core plugin is inactive), so callers fall
 * back to the theme logo.
 *
 * @param string $context Either 'header' or 'footer'; the footer falls back to the primary logo.
 * @return string Escaped markup, or an empty string.
 */
function venix_concierge_get_settings_logo_html( $context = 'header' ) {
	$getter = 'footer' === $context ? 'venix_concierge_core_get_footer_logo_id' : 'venix_concierge_core_get_logo_id';

	if ( ! function_exists( $getter ) || ! function_exists( 'venix_concierge_core_get_logo_alt' ) ) {
		return '';
	}

	$attachment_id = $getter();

	if ( ! $attachment_id ) {
		return '';
	}

	$image = wp_get_attachment_image(
		$attachment_id,
		'full',
		false,
		array(
			'class'    => 'custom-logo',
			'alt'      => venix_concierge_core_get_logo_alt( $attachment_id ),
			'loading'  => 'header' === $context ? 'eager' : 'lazy',
			'decoding' => 'async',
		)
	);

	if ( '' === $image ) {
		return '';
	}

	return sprintf(
		'<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>',
		esc_url( venix_concierge_page_url( 'home' ) ),
		$image
	);
}

/**
 * Build a safe link URL for a contact or social setting.
 *
 * @param string $key One of phone, whatsapp, email, instagram or facebook.
 * @return string Escaped URL, or an empty string when the value is missing or unusable.
 */
function venix_concierge_get_site_setting_url( $key ) {
	$value = venix_concierge_get_site_setting( $key );

	if ( '' === $value ) {
		return '';
	}

	switch ( $key ) {
		case 'phone':
			$digits = preg_replace( '/\D+/', '', $value );

			return '' === $digits ? '' : esc_url( 'tel:' . ( str_starts_with( $value, '+' ) ? '+' : '' ) . $digits );
		case 'email':
			return is_email( $value ) ? esc_url( 'mailto:' . $value ) : '';
		case 'whatsapp':
			return venix_concierge_get_whatsapp_url( $value );
		case 'instagram':
		case 'facebook':
			return esc_url( $value, array( 'http', 'https' ) );
	}

	return '';
}

/**
 * Normalize a WhatsApp number or WhatsApp URL into a wa.me link.
 *
 * @param string $value Stored WhatsApp value.
 * @return string Escaped URL, or an empty string when the value is unusable.
 */
function venix_concierge_get_whatsapp_url( $value ) {
	if ( preg_match( '#^https?://#i', $value ) ) {
		$host = strtolower( (string) wp_parse_url( $value, PHP_URL_HOST ) );

		return in_array( $host, array( 'wa.me', 'wa.link', 'api.whatsapp.com', 'whatsapp.com', 'www.whatsapp.com' ), true ) ? esc_url( $value, array( 'https', 'http' ) ) : '';
	}

	$digits = ltrim( preg_replace( '/\D+/', '', $value ), '0' );

	return strlen( $digits ) < 7 ? '' : esc_url( 'https://wa.me/' . $digits );
}

/**
 * Get the footer contact rows that have a value; empty settings yield no row.
 *
 * @return array<int, array{type: string, text: string, url: string}>
 */
function venix_concierge_get_footer_contact_items() {
	$items    = array();
	$address  = venix_concierge_get_site_setting( 'address' );
	$phone    = venix_concierge_get_site_setting( 'phone' );
	$whatsapp = venix_concierge_get_site_setting( 'whatsapp' );
	$email    = venix_concierge_get_site_setting( 'email' );

	if ( '' !== $address ) {
		$items[] = array(
			'type' => 'address',
			'text' => $address,
			'url'  => '',
		);
	}

	if ( '' !== $phone ) {
		$items[] = array(
			'type' => 'phone',
			'text' => $phone,
			'url'  => venix_concierge_get_site_setting_url( 'phone' ),
		);
	}

	if ( '' !== $whatsapp ) {
		$items[] = array(
			'type' => 'whatsapp',
			'text' => preg_match( '#^https?://#i', $whatsapp ) ? 'WhatsApp' : 'WhatsApp · ' . $whatsapp,
			'url'  => venix_concierge_get_site_setting_url( 'whatsapp' ),
		);
	}

	if ( '' !== $email ) {
		$items[] = array(
			'type' => 'email',
			'text' => $email,
			'url'  => venix_concierge_get_site_setting_url( 'email' ),
		);
	}

	return $items;
}

/**
 * Get the Contact page detail rows in display order; empty settings yield no row.
 *
 * Values come only from the global Site Settings. For WhatsApp, `text` is the
 * stored number, or an empty string when the setting is a bare link.
 *
 * @return array<int, array{type: string, text: string, url: string}>
 */
function venix_concierge_get_contact_detail_items() {
	$items = array();

	foreach ( array( 'phone', 'whatsapp', 'email', 'address' ) as $type ) {
		$value = venix_concierge_get_site_setting( $type );

		if ( '' === $value ) {
			continue;
		}

		$items[] = array(
			'type' => $type,
			'text' => 'whatsapp' === $type && preg_match( '#^https?://#i', $value ) ? '' : $value,
			'url'  => 'address' === $type ? '' : venix_concierge_get_site_setting_url( $type ),
		);
	}

	return $items;
}
