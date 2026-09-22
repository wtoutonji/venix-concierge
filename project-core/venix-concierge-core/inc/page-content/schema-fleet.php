<?php
/**
 * Editable field schema for the Fleet page.
 *
 * Paths mirror the theme's `venix_concierge_fleet_content()` array so an
 * override can only replace an existing text value. Vehicle count/order, ids,
 * card column variants and CTA destinations are deliberately absent.
 *
 * Passenger and luggage capacity is NOT part of this schema: it is owned solely
 * by the global `venix_fleet_capacities` option (Venix → Fleet Capacities),
 * read by `venix_concierge_fleet_capacity_data()` in the theme and rendered by
 * the shared capacity component.
 *
 * @package VenixConciergeCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get the Fleet page schema.
 *
 * @return array<string, mixed>
 */
function venix_concierge_core_fleet_page_content_schema() {
	$f = 'venix_concierge_core_page_content_field';
	$g = 'venix_concierge_core_page_content_group';
	$s = 'venix_concierge_core_page_content_section';

	$eyebrow = __( 'Small heading above the title', 'venix-concierge-core' );
	$heading = __( 'Heading', 'venix-concierge-core' );

	// Each tuple's third value is the vehicle's original position in the theme's
	// `vehicles` array (see inc/content/fleet.php). Index 3 (V-Class Extra Long) is
	// retired, not reassigned, so a previously saved Sprinter override at
	// `vehicles.4.*` keeps resolving to Sprinter instead of silently vanishing or
	// landing on the wrong vehicle.
	$vehicles = array(
		array( __( 'S-Class', 'venix-concierge-core' ), 's_class', 0 ),
		array( __( 'E-Class', 'venix-concierge-core' ), 'e_class', 1 ),
		array( __( 'V-Class', 'venix-concierge-core' ), 'v_class', 2 ),
		array( __( 'Sprinter', 'venix-concierge-core' ), 'sprinter', 4 ),
	);

	$vehicle_sections = array();
	foreach ( $vehicles as $vehicle ) {
		$i      = $vehicle[2];
		$points = array();
		for ( $u = 0; $u < 3; $u++ ) {
			$points[] = $f(
				array( 'vehicles', $i, 'use_cases', $u ),
				/* translators: %d: list item number. */
				sprintf( __( 'Point %d', 'venix-concierge-core' ), $u + 1 )
			);
		}

		$vehicle_sections[] = $s(
			$vehicle[1],
			$vehicle[0],
			array(
				$g(
					'',
					array(
						$f( array( 'vehicles', $i, 'name' ), __( 'Vehicle name', 'venix-concierge-core' ) ),
						$f( array( 'vehicles', $i, 'badge' ), __( 'Category badge', 'venix-concierge-core' ) ),
						$f( array( 'vehicles', $i, 'sub_badge' ), __( 'Line next to the badge', 'venix-concierge-core' ) ),
						$f( array( 'vehicles', $i, 'copy' ), __( 'Description', 'venix-concierge-core' ), 'textarea' ),
						$f( array( 'vehicles', $i, 'cta' ), __( 'Button text', 'venix-concierge-core' ) ),
					)
				),
				$g( __( 'Suitable for', 'venix-concierge-core' ), $points ),
			),
			__( 'Passenger and luggage capacity is edited in Venix → Fleet Capacities, not here.', 'venix-concierge-core' )
		);
	}

	$recommendation_groups = array(
		$g(
			'',
			array(
				$f( array( 'recommendation', 'eyebrow' ), $eyebrow ),
				$f( array( 'recommendation', 'title' ), $heading ),
				$f( array( 'recommendation', 'copy' ), __( 'Text', 'venix-concierge-core' ), 'textarea' ),
				$f( array( 'recommendation', 'button' ), __( 'Button text', 'venix-concierge-core' ) ),
			)
		),
	);
	for ( $i = 0; $i < 3; $i++ ) {
		$recommendation_groups[] = $g(
			/* translators: %d: item number. */
			sprintf( __( 'Question %d', 'venix-concierge-core' ), $i + 1 ),
			array(
				$f( array( 'recommendation', 'points', $i, 0 ), $heading ),
				$f( array( 'recommendation', 'points', $i, 1 ), __( 'Text', 'venix-concierge-core' ) ),
			)
		);
	}

	return array(
		'label'    => __( 'Fleet', 'venix-concierge-core' ),
		'sections' => array_merge(
			array(
				$s(
					'hero',
					__( 'Hero', 'venix-concierge-core' ),
					array(
						$g(
							'',
							array(
								$f( array( 'hero', 'eyebrow' ), $eyebrow ),
								$f( array( 'hero', 'title' ), $heading ),
								$f( array( 'hero', 'copy' ), __( 'Intro text', 'venix-concierge-core' ), 'textarea' ),
							)
						),
					)
				),
				$s(
					'disclaimer',
					__( 'Disclaimer', 'venix-concierge-core' ),
					array(
						$g(
							'',
							array(
								$f( array( 'notice', 'copy' ), __( 'Notice text', 'venix-concierge-core' ), 'textarea' ),
								$f( array( 'notice', 'link' ), __( 'Link text', 'venix-concierge-core' ) ),
								$f( array( 'notice', 'aria_label' ), __( 'Screen-reader label for the notice', 'venix-concierge-core' ) ),
							)
						),
					)
				),
			),
			$vehicle_sections,
			array(
				$s( 'recommendation', __( 'Recommendation', 'venix-concierge-core' ), $recommendation_groups ),
			)
		),
		'media'    => array(
			'fleet.hero'                => __( 'Hero background', 'venix-concierge-core' ),
			'fleet.s_class.exterior'    => __( 'S-Class: main image', 'venix-concierge-core' ),
			'fleet.s_class.interior_1'  => __( 'S-Class: secondary image 1', 'venix-concierge-core' ),
			'fleet.s_class.interior_2'  => __( 'S-Class: secondary image 2', 'venix-concierge-core' ),
			'fleet.e_class.exterior'    => __( 'E-Class: main image', 'venix-concierge-core' ),
			'fleet.e_class.interior_1'  => __( 'E-Class: secondary image 1', 'venix-concierge-core' ),
			'fleet.e_class.interior_2'  => __( 'E-Class: secondary image 2', 'venix-concierge-core' ),
			'fleet.v_class.exterior'    => __( 'V-Class: main image', 'venix-concierge-core' ),
			'fleet.v_class.interior_1'  => __( 'V-Class: secondary image 1', 'venix-concierge-core' ),
			'fleet.v_class.interior_2'  => __( 'V-Class: secondary image 2', 'venix-concierge-core' ),
			'fleet.sprinter.exterior'   => __( 'Sprinter: main image', 'venix-concierge-core' ),
			'fleet.sprinter.interior_1' => __( 'Sprinter: secondary image 1', 'venix-concierge-core' ),
			'fleet.sprinter.interior_2' => __( 'Sprinter: secondary image 2', 'venix-concierge-core' ),
		),
	);
}
