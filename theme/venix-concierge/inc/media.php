<?php
/**
 * Media Library image slots and rendering helpers.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the attachment IDs assigned to the site's editorial photography slots.
 *
 * Replace a zero value with the relevant Media Library attachment ID. The filter
 * permits a future settings or page-data owner without changing template markup.
 *
 * @return array<string, int>
 */
function venix_concierge_media_slots() {
	$slots = array_fill_keys(
		array(
			'home.hero', 'home.about', 'home.services.chauffeur', 'home.services.airport',
			'home.services.events', 'home.services.delegations', 'home.promise',
			'home.fleet.s_class', 'home.fleet.e_class', 'home.fleet.v_class',
			'home.fleet.v_class_extra_long', 'home.fleet.sprinter', 'home.events',
			'about.hero', 'about.story', 'about.culture',
			'services.hero', 'services.chauffeur', 'services.airport', 'services.events',
			'services.delegations', 'services.protection', 'services.flights',
			'services.embassy', 'services.concierge', 'services.weddings',
			'fleet.hero', 'fleet.s_class.exterior', 'fleet.s_class.interior_1',
			'fleet.s_class.interior_2', 'fleet.e_class.exterior', 'fleet.v_class.exterior',
			'fleet.v_class.interior_1', 'fleet.v_class.interior_2',
			'fleet.v_class_extra_long.exterior', 'fleet.sprinter.exterior', 'contact.hero',
		),
		0
	);

	return apply_filters( 'venix_concierge_media_slots', $slots );
}

/**
 * Gets an attachment ID for a stable semantic photography slot.
 *
 * A Media Library image chosen on the current page (Venix Page Content) wins
 * over the default slot value; without one the default applies unchanged.
 *
 * @param string $slot Slot key.
 * @return int
 */
function venix_concierge_media_attachment_id( $slot ) {
	$override = venix_concierge_get_page_media_id( $slot );

	if ( $override > 0 ) {
		return $override;
	}

	$slots = venix_concierge_media_slots();

	return isset( $slots[ $slot ] ) ? absint( $slots[ $slot ] ) : 0;
}

/**
 * Resolves the alt text for a rendered image.
 *
 * Precedence: page-slot override, then the Media Library alt text of the
 * attachment, then the default slot alt text. An empty result is a decorative image.
 *
 * @param int    $attachment_id Attachment ID.
 * @param string $override      Page-slot alt text override.
 * @param string $default       Default slot alt text.
 * @return string
 */
function venix_concierge_media_alt( $attachment_id, $override = '', $default = '' ) {
	$override = trim( (string) $override );

	if ( '' !== $override ) {
		return $override;
	}

	$library = trim( (string) get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) );

	return '' !== $library ? $library : trim( (string) $default );
}

/**
 * Renders a responsive Media Library image or a non-verbal empty media surface.
 *
 * `alt` is the default slot alt text; `alt_override` is the page-slot override.
 * Neither is used blindly: see venix_concierge_media_alt() for the precedence.
 *
 * @param int   $attachment_id Attachment ID.
 * @param array $args Rendering arguments.
 * @return void
 */
function venix_concierge_render_media( $attachment_id, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'size'           => 'large',
			'class'          => '',
			'alt'            => '',
			'alt_override'   => '',
			'sizes'          => '100vw',
			'loading'        => 'lazy',
			'fetchpriority'  => 'auto',
			'wrapper'        => 'div',
		)
	);

	$wrapper = tag_escape( $args['wrapper'] );
	$class   = trim( $args['class'] );
	$classes = $class ? $class . ' venix-media-slot' : 'venix-media-slot';

	echo '<' . $wrapper . ' class="' . esc_attr( $classes ) . '">';

	if ( $attachment_id > 0 ) {
		echo wp_get_attachment_image(
			$attachment_id,
			$args['size'],
			false,
			array(
				'class'         => 'venix-media-slot__image',
				'alt'           => venix_concierge_media_alt( $attachment_id, $args['alt_override'], $args['alt'] ),
				'sizes'         => $args['sizes'],
				'loading'       => $args['loading'],
				'fetchpriority' => $args['fetchpriority'],
			)
		);
	}

	echo '</' . $wrapper . '>';
}

/**
 * Renders a semantic media slot with page-level image and alt text overrides.
 *
 * The slot key is the single identity: the attachment resolves through
 * venix_concierge_media_attachment_id() and the alt override through the same page meta.
 *
 * @param string $slot Slot key, such as `home.about`.
 * @param array  $args Rendering arguments for venix_concierge_render_media().
 * @return void
 */
function venix_concierge_render_media_slot( $slot, $args = array() ) {
	$args['alt_override'] = venix_concierge_get_page_media_alt( $slot );

	venix_concierge_render_media( venix_concierge_media_attachment_id( $slot ), $args );
}
