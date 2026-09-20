<?php
/**
 * Read access to editor page-content overrides.
 *
 * Storage, schema, sanitization and the admin meta box live in the Venix
 * Concierge Core plugin. The theme's content arrays stay the canonical
 * fallback: an override applies only when an editor saved a non-empty value.
 * Templates read through these helpers and never call get_post_meta().
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the saved overrides for the page being viewed.
 *
 * @param string $page_key Page key the caller renders, such as `home`.
 * @param int    $post_id  Optional page ID; defaults to the queried page.
 * @return array{text: array<string, mixed>, media: array<string, int>, media_alt: array<string, string>}
 */
function venix_concierge_get_page_overrides( $page_key, $post_id = 0 ) {
	$empty = array(
		'text'      => array(),
		'media'     => array(),
		'media_alt' => array(),
	);

	if ( ! function_exists( 'venix_concierge_core_get_page_overrides' ) ) {
		return $empty;
	}

	$post_id = $post_id ? absint( $post_id ) : (int) get_queried_object_id();

	if ( ! $post_id ) {
		return $empty;
	}

	$overrides = venix_concierge_core_get_page_overrides( $post_id );

	return $page_key === $overrides['page_key'] ? $overrides : $empty;
}

/**
 * Merge saved text overrides into default content.
 *
 * Only an existing default string can be replaced, so an override can never
 * change the shape or number of items in the approved composition.
 *
 * @param array<string, mixed> $defaults  Default content.
 * @param array<string, mixed> $overrides Saved overrides.
 * @return array<string, mixed>
 */
function venix_concierge_merge_page_content( array $defaults, array $overrides ) {
	foreach ( $overrides as $key => $value ) {
		if ( ! array_key_exists( $key, $defaults ) ) {
			continue;
		}

		if ( is_array( $value ) && is_array( $defaults[ $key ] ) ) {
			$defaults[ $key ] = venix_concierge_merge_page_content( $defaults[ $key ], $value );
		} elseif ( is_string( $value ) && '' !== $value && is_string( $defaults[ $key ] ) ) {
			$defaults[ $key ] = $value;
		}
	}

	return $defaults;
}

/**
 * Get page content: the theme defaults with any saved page overrides applied.
 *
 * @param string               $page_key Page key, such as `home`.
 * @param array<string, mixed> $defaults Default content array.
 * @param int                  $post_id  Optional page ID; defaults to the queried page.
 * @return array<string, mixed>
 */
function venix_concierge_get_page_content( $page_key, array $defaults, $post_id = 0 ) {
	$overrides = venix_concierge_get_page_overrides( $page_key, $post_id );

	return empty( $overrides['text'] ) ? $defaults : venix_concierge_merge_page_content( $defaults, $overrides['text'] );
}

/**
 * Get one content value, falling back to the default when there is no override.
 *
 * @param string          $page_key Page key, such as `home`.
 * @param string|string[] $path     Dot-separated key path (`hero.title`) or list of keys.
 * @param string          $default  Value returned when no override is saved.
 * @param int             $post_id  Optional page ID; defaults to the queried page.
 * @return string
 */
function venix_concierge_get_page_value( $page_key, $path, $default = '', $post_id = 0 ) {
	$path  = is_array( $path ) ? $path : explode( '.', (string) $path );
	$value = venix_concierge_get_page_overrides( $page_key, $post_id )['text'];

	foreach ( $path as $key ) {
		if ( ! is_array( $value ) || ! array_key_exists( $key, $value ) ) {
			return $default;
		}

		$value = $value[ $key ];
	}

	return is_string( $value ) && '' !== $value ? $value : $default;
}

/**
 * Get the page-level Media Library override for a semantic media slot.
 *
 * @param string $slot Slot key, such as `home.hero`.
 * @return int Attachment ID, or 0 when the current page has no override.
 */
function venix_concierge_get_page_media_id( $slot ) {
	$page_key = strtok( (string) $slot, '.' );
	$media    = venix_concierge_get_page_overrides( (string) $page_key )['media'];

	return isset( $media[ $slot ] ) ? absint( $media[ $slot ] ) : 0;
}

/**
 * Get the page-level contextual alt text override for a semantic media slot.
 *
 * Polylang pages own separate meta, so each language can carry its own wording
 * for the same Media Library attachment.
 *
 * @param string $slot Slot key, such as `home.hero`.
 * @return string Alt text, or an empty string when the current page has no override.
 */
function venix_concierge_get_page_media_alt( $slot ) {
	$page_key = strtok( (string) $slot, '.' );
	$alts     = venix_concierge_get_page_overrides( (string) $page_key )['media_alt'];

	return isset( $alts[ $slot ] ) ? (string) $alts[ $slot ] : '';
}

/**
 * Supply the editor with the default page text as field placeholders.
 *
 * @param array<string, mixed> $defaults Defaults collected so far.
 * @param string               $page_key Page key.
 * @return array<string, mixed>
 */
function venix_concierge_page_content_editor_defaults( $defaults, $page_key ) {
	$providers = array(
		'home'     => 'venix_concierge_home_content',
		'about'    => 'venix_concierge_about_content',
		'services' => 'venix_concierge_services_content',
		'fleet'    => 'venix_concierge_fleet_content',
		'contact'  => 'venix_concierge_contact_content',
	);

	return isset( $providers[ $page_key ] ) && is_callable( $providers[ $page_key ] ) ? call_user_func( $providers[ $page_key ] ) : $defaults;
}
add_filter( 'venix_concierge_core_page_content_defaults', 'venix_concierge_page_content_editor_defaults', 10, 2 );
