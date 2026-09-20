<?php
/**
 * Editable field schema for the Services page.
 *
 * Paths mirror the theme's `venix_concierge_services_content()` array so an
 * override can only replace an existing text value. Service order and count,
 * benefit-list length, ids/anchors, surfaces, split direction, the sticky/centered
 * tab bar and every CTA destination are deliberately absent.
 *
 * @package VenixConciergeCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get the Services page schema.
 *
 * @return array<string, mixed>
 */
function venix_concierge_core_services_page_content_schema() {
	$f = 'venix_concierge_core_page_content_field';
	$g = 'venix_concierge_core_page_content_group';
	$s = 'venix_concierge_core_page_content_section';

	$eyebrow = __( 'Small heading above the title', 'venix-concierge-core' );
	$heading = __( 'Heading', 'venix-concierge-core' );

	// Main services: index in `main`, label, benefit count, and which optional notes the design has.
	$main_services = array(
		array( 0, __( 'Chauffeur', 'venix-concierge-core' ), 5, 'audience' ),
		array( 1, __( 'Airport', 'venix-concierge-core' ), 5, 'notice' ),
		array( 2, __( 'Events', 'venix-concierge-core' ), 6, '' ),
		array( 3, __( 'Delegations', 'venix-concierge-core' ), 5, 'notice' ),
	);

	$main_sections = array();
	foreach ( $main_services as $service ) {
		list( $i, $label, $benefit_count, $extra ) = $service;

		$fields = array(
			$f( array( 'main', $i, 'title' ), $heading ),
			$f( array( 'main', $i, 'copy' ), __( 'Description', 'venix-concierge-core' ), 'textarea' ),
		);
		if ( 'audience' === $extra ) {
			$fields[] = $f( array( 'main', $i, 'audience' ), __( 'Who it is for', 'venix-concierge-core' ) );
		}
		if ( 'notice' === $extra ) {
			$fields[] = $f( array( 'main', $i, 'notice' ), __( 'Note', 'venix-concierge-core' ), 'textarea' );
		}
		$fields[] = $f( array( 'main', $i, 'cta' ), __( 'Button text', 'venix-concierge-core' ) );

		$points = array();
		for ( $b = 0; $b < $benefit_count; $b++ ) {
			$points[] = $f(
				array( 'main', $i, 'benefits', $b ),
				/* translators: %d: list item number. */
				sprintf( __( 'Point %d', 'venix-concierge-core' ), $b + 1 )
			);
		}

		$main_sections[] = $s(
			sanitize_key( $label ),
			$label,
			array(
				$g( '', $fields ),
				$g( __( 'Supporting points', 'venix-concierge-core' ), $points ),
			)
		);
	}

	$tab_keys   = array( 'chauffeur', 'airport', 'events', 'delegations', 'protection', 'flights', 'embassy', 'concierge', 'weddings' );
	$tab_labels = array(
		__( 'Chauffeur', 'venix-concierge-core' ),
		__( 'Airport', 'venix-concierge-core' ),
		__( 'Events', 'venix-concierge-core' ),
		__( 'Delegations', 'venix-concierge-core' ),
		__( 'Protection', 'venix-concierge-core' ),
		__( 'Private Flights', 'venix-concierge-core' ),
		__( 'Embassy', 'venix-concierge-core' ),
		__( 'Concierge', 'venix-concierge-core' ),
		__( 'Weddings', 'venix-concierge-core' ),
	);
	$tab_fields = array();
	foreach ( $tab_keys as $index => $key ) {
		$tab_fields[] = $f(
			array( 'anchors', $key ),
			/* translators: %s: service name. */
			sprintf( __( 'Tab label: %s', 'venix-concierge-core' ), $tab_labels[ $index ] )
		);
	}

	$compact = array(
		array( 0, __( 'Embassy', 'venix-concierge-core' ) ),
		array( 1, __( 'Concierge', 'venix-concierge-core' ) ),
		array( 2, __( 'Weddings', 'venix-concierge-core' ) ),
	);

	$compact_sections = array();
	foreach ( $compact as $item ) {
		list( $i, $label ) = $item;

		$compact_sections[ $i ] = $s(
			'compact-' . $i,
			$label,
			array(
				$g(
					'',
					array(
						$f( array( 'compact', $i, 'title' ), $heading ),
						$f( array( 'compact', $i, 'copy' ), __( 'Description', 'venix-concierge-core' ), 'textarea' ),
						$f( array( 'compact', $i, 'cta' ), __( 'Button text', 'venix-concierge-core' ) ),
					)
				),
			)
		);
	}

	return array(
		'label'    => __( 'Services', 'venix-concierge-core' ),
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
							)
						),
						$g( __( 'Tab bar labels', 'venix-concierge-core' ), $tab_fields ),
					),
					__( 'The tab bar position and behaviour are fixed by the design; only the words can change.', 'venix-concierge-core' )
				),
				$s(
					'labels',
					__( 'Shared Labels', 'venix-concierge-core' ),
					array(
						$g(
							'',
							array(
								$f( array( 'main_badge' ), __( 'Badge on the four main services', 'venix-concierge-core' ) ),
								$f( array( 'additional', 'badge' ), __( 'Badge on Protection and Private Flights', 'venix-concierge-core' ) ),
								$f( array( 'additional', 'compact_badge' ), __( 'Short badge on Embassy, Concierge and Weddings', 'venix-concierge-core' ) ),
							)
						),
					)
				),
			),
			$main_sections,
			array(
				$s(
					'additional-intro',
					__( 'Other Services Introduction', 'venix-concierge-core' ),
					array(
						$g(
							'',
							array(
								$f( array( 'additional', 'title' ), $heading ),
								$f( array( 'additional', 'copy' ), __( 'Intro text', 'venix-concierge-core' ), 'textarea' ),
								$f( array( 'additional', 'notice' ), __( 'Notice', 'venix-concierge-core' ), 'textarea' ),
							)
						),
					)
				),
				$s(
					'protection',
					__( 'Protection', 'venix-concierge-core' ),
					array(
						$g(
							'',
							array(
								$f( array( 'protection', 'title' ), $heading ),
								$f( array( 'protection', 'copy' ), __( 'Description', 'venix-concierge-core' ), 'textarea' ),
								$f( array( 'protection', 'notice' ), __( 'Note', 'venix-concierge-core' ), 'textarea' ),
								$f( array( 'protection', 'cta' ), __( 'Button text', 'venix-concierge-core' ) ),
							)
						),
					)
				),
				$s(
					'flights',
					__( 'Private Flights', 'venix-concierge-core' ),
					array(
						$g(
							'',
							array(
								$f( array( 'flights', 'title' ), $heading ),
								$f( array( 'flights', 'copy' ), __( 'Description', 'venix-concierge-core' ), 'textarea' ),
								$f( array( 'flights', 'cta' ), __( 'Button text', 'venix-concierge-core' ) ),
							)
						),
					)
				),
			),
			$compact_sections,
			array(
				$s(
					'cta',
					__( 'Final CTA', 'venix-concierge-core' ),
					array(
						$g(
							'',
							array(
								$f( array( 'cta', 'title' ), $heading ),
								$f( array( 'cta', 'copy' ), __( 'Text', 'venix-concierge-core' ), 'textarea' ),
								$f( array( 'cta', 'button' ), __( 'Button text', 'venix-concierge-core' ) ),
							)
						),
					),
					__( 'The button always leads to the Contact page.', 'venix-concierge-core' )
				),
			)
		),
		'media'    => array(
			'services.hero'        => __( 'Hero background', 'venix-concierge-core' ),
			'services.chauffeur'   => __( 'Chauffeur image', 'venix-concierge-core' ),
			'services.airport'     => __( 'Airport image', 'venix-concierge-core' ),
			'services.events'      => __( 'Events image', 'venix-concierge-core' ),
			'services.delegations' => __( 'Delegations image', 'venix-concierge-core' ),
			'services.protection'  => __( 'Protection image', 'venix-concierge-core' ),
			'services.flights'     => __( 'Private Flights image', 'venix-concierge-core' ),
			'services.embassy'     => __( 'Embassy image', 'venix-concierge-core' ),
			'services.concierge'   => __( 'Concierge image', 'venix-concierge-core' ),
			'services.weddings'    => __( 'Weddings image', 'venix-concierge-core' ),
		),
	);
}
