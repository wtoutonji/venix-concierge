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
 * @param string $slot Slot key.
 * @return int
 */
function venix_concierge_media_attachment_id( $slot ) {
	$slots = venix_concierge_media_slots();

	return isset( $slots[ $slot ] ) ? absint( $slots[ $slot ] ) : 0;
}

/**
 * Renders a responsive Media Library image or a non-verbal empty media surface.
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
				'alt'           => $args['alt'],
				'sizes'         => $args['sizes'],
				'loading'       => $args['loading'],
				'fetchpriority' => $args['fetchpriority'],
			)
		);
	}

	echo '</' . $wrapper . '>';
}
