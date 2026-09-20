<?php
/**
 * Editable field schema for the Home page.
 *
 * Paths mirror the theme's `venix_concierge_home_content()` array so an
 * override can only replace an existing text value. Layout, classes, icons,
 * anchors, numbering and the shared inquiry form fields are deliberately absent.
 *
 * @package VenixConciergeCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Build a section from labelled groups.
 *
 * @param string                                          $id          Section ID.
 * @param string                                          $label       Section label.
 * @param array<int, array<string, mixed>>                $groups      Groups.
 * @param string                                          $description Optional helper text.
 * @return array<string, mixed>
 */
function venix_concierge_core_page_content_section( $id, $label, array $groups, $description = '' ) {
	return array(
		'id'          => $id,
		'label'       => $label,
		'description' => $description,
		'groups'      => $groups,
	);
}

/**
 * Build a field group.
 *
 * @param string  $label  Group label, empty for an unlabelled group.
 * @param array[] $fields Field definitions.
 * @return array{label: string, fields: array[]}
 */
function venix_concierge_core_page_content_group( $label, array $fields ) {
	return array(
		'label'  => $label,
		'fields' => $fields,
	);
}

/**
 * Get the Home page schema.
 *
 * @return array<string, mixed>
 */
function venix_concierge_core_home_page_content_schema() {
	$f = 'venix_concierge_core_page_content_field';
	$g = 'venix_concierge_core_page_content_group';
	$s = 'venix_concierge_core_page_content_section';

	$service_names = array(
		__( 'Chauffeur-driven transfers & private hire', 'venix-concierge-core' ),
		__( 'Airport transfers', 'venix-concierge-core' ),
		__( 'Business & private events', 'venix-concierge-core' ),
		__( 'Delegations & diplomatic transfers', 'venix-concierge-core' ),
	);
	$vehicle_names = array(
		__( 'E-Class', 'venix-concierge-core' ),
		__( 'V-Class', 'venix-concierge-core' ),
		__( 'V-Class Extra Long', 'venix-concierge-core' ),
		__( 'Sprinter', 'venix-concierge-core' ),
	);
	$extra_names   = array(
		__( 'Private protection', 'venix-concierge-core' ),
		__( 'Private flights', 'venix-concierge-core' ),
		__( 'Embassy services', 'venix-concierge-core' ),
		__( 'Concierge services', 'venix-concierge-core' ),
		__( 'Weddings', 'venix-concierge-core' ),
	);
	$audience_names = array(
		__( 'Private travellers', 'venix-concierge-core' ),
		__( 'Executives', 'venix-concierge-core' ),
		__( 'Companies', 'venix-concierge-core' ),
		__( 'Embassies', 'venix-concierge-core' ),
		__( 'Delegations', 'venix-concierge-core' ),
		__( 'Event organisers', 'venix-concierge-core' ),
		__( 'Hotels & hospitality', 'venix-concierge-core' ),
		__( 'Wedding planners', 'venix-concierge-core' ),
		__( 'International guests', 'venix-concierge-core' ),
	);

	$service_groups = array(
		$g(
			'',
			array(
				$f( array( 'services', 'eyebrow' ), __( 'Small heading above the title', 'venix-concierge-core' ) ),
				$f( array( 'services', 'title' ), __( 'Heading', 'venix-concierge-core' ) ),
				$f( array( 'services', 'link' ), __( 'Link text on every card', 'venix-concierge-core' ) ),
			)
		),
	);
	foreach ( $service_names as $i => $name ) {
		$service_groups[] = $g(
			$name,
			array(
				$f( array( 'cards', $i, 0 ), __( 'Heading', 'venix-concierge-core' ) ),
				$f( array( 'cards', $i, 1 ), __( 'Description', 'venix-concierge-core' ), 'textarea' ),
				$f( array( 'cards', $i, 2 ), __( 'Who it is for', 'venix-concierge-core' ) ),
			)
		);
	}

	$promise_groups = array(
		$g(
			'',
			array(
				$f( array( 'promise', 'title' ), __( 'Heading', 'venix-concierge-core' ) ),
				$f( array( 'promise', 'copy' ), __( 'Intro text', 'venix-concierge-core' ), 'textarea' ),
			)
		),
	);
	for ( $i = 0; $i < 6; $i++ ) {
		$promise_groups[] = $g(
			/* translators: %d: item number. */
			sprintf( __( 'Detail %d', 'venix-concierge-core' ), $i + 1 ),
			array(
				$f( array( 'promise', 'items', $i, 0 ), __( 'Heading', 'venix-concierge-core' ) ),
				$f( array( 'promise', 'items', $i, 1 ), __( 'Text', 'venix-concierge-core' ) ),
			)
		);
	}

	$fleet_groups = array(
		$g(
			'',
			array(
				$f( array( 'fleet', 'eyebrow' ), __( 'Small heading above the title', 'venix-concierge-core' ) ),
				$f( array( 'fleet', 'title' ), __( 'Heading', 'venix-concierge-core' ) ),
				$f( array( 'fleet', 'copy' ), __( 'Intro text', 'venix-concierge-core' ), 'textarea' ),
				$f( array( 'fleet', 'note' ), __( 'Note about models', 'venix-concierge-core' ) ),
			)
		),
		$g(
			__( 'S-Class (featured vehicle)', 'venix-concierge-core' ),
			array(
				$f( array( 'fleet', 'featured', 0 ), __( 'Category label', 'venix-concierge-core' ) ),
				$f( array( 'fleet', 'featured', 1 ), __( 'Short descriptor', 'venix-concierge-core' ) ),
				$f( array( 'fleet', 'featured', 2 ), __( 'Vehicle name', 'venix-concierge-core' ) ),
				$f( array( 'fleet', 'featured', 3 ), __( 'Description', 'venix-concierge-core' ), 'textarea' ),
				$f( array( 'fleet', 'featured', 4 ), __( 'Button text', 'venix-concierge-core' ) ),
			)
		),
	);
	foreach ( $vehicle_names as $i => $name ) {
		$fleet_groups[] = $g(
			$name,
			array(
				$f( array( 'fleet', 'vehicles', $i, 0 ), __( 'Category label', 'venix-concierge-core' ) ),
				$f( array( 'fleet', 'vehicles', $i, 1 ), __( 'Vehicle name', 'venix-concierge-core' ) ),
				$f( array( 'fleet', 'vehicles', $i, 2 ), __( 'Description', 'venix-concierge-core' ), 'textarea' ),
				$f( array( 'fleet', 'vehicles', $i, 3 ), __( 'Link text', 'venix-concierge-core' ) ),
			)
		);
	}
	$fleet_groups[] = $g(
		__( 'Help choosing a vehicle', 'venix-concierge-core' ),
		array(
			$f( array( 'fleet', 'helper_title' ), __( 'Heading', 'venix-concierge-core' ) ),
			$f( array( 'fleet', 'helper_copy' ), __( 'Text', 'venix-concierge-core' ), 'textarea' ),
			$f( array( 'fleet', 'helper_cta' ), __( 'Link text', 'venix-concierge-core' ) ),
		)
	);

	$why_groups = array(
		$g(
			'',
			array(
				$f( array( 'why', 'eyebrow' ), __( 'Small heading above the title', 'venix-concierge-core' ) ),
				$f( array( 'why', 'title' ), __( 'Heading', 'venix-concierge-core' ) ),
			)
		),
	);
	for ( $i = 0; $i < 6; $i++ ) {
		$why_groups[] = $g(
			/* translators: %d: item number. */
			sprintf( __( 'Standard %d', 'venix-concierge-core' ), $i + 1 ),
			array(
				$f( array( 'pillars', $i, 0 ), __( 'Heading', 'venix-concierge-core' ) ),
				$f( array( 'pillars', $i, 1 ), __( 'Text', 'venix-concierge-core' ) ),
			)
		);
	}

	$point_fields = array();
	for ( $i = 0; $i < 6; $i++ ) {
		$point_fields[] = $f(
			array( 'events', 'points', $i ),
			/* translators: %d: list item number. */
			sprintf( __( 'List item %d', 'venix-concierge-core' ), $i + 1 )
		);
	}

	$process_groups = array(
		$g(
			'',
			array(
				$f( array( 'process_heading', 'eyebrow' ), __( 'Small heading above the title', 'venix-concierge-core' ) ),
				$f( array( 'process_heading', 'title' ), __( 'Heading', 'venix-concierge-core' ) ),
			)
		),
	);
	for ( $i = 0; $i < 4; $i++ ) {
		$process_groups[] = $g(
			/* translators: %d: step number. */
			sprintf( __( 'Step %d', 'venix-concierge-core' ), $i + 1 ),
			array(
				$f( array( 'process', $i, 1 ), __( 'Heading', 'venix-concierge-core' ) ),
				$f( array( 'process', $i, 2 ), __( 'Text', 'venix-concierge-core' ) ),
			)
		);
	}

	$extras_groups = array(
		$g(
			'',
			array(
				$f( array( 'extras_heading', 'eyebrow' ), __( 'Small heading above the title', 'venix-concierge-core' ) ),
				$f( array( 'extras_heading', 'title' ), __( 'Heading', 'venix-concierge-core' ) ),
				$f( array( 'extras_heading', 'link' ), __( 'Link text on every card', 'venix-concierge-core' ) ),
				$f( array( 'extras_heading', 'disclaimer' ), __( 'Notice below the cards', 'venix-concierge-core' ), 'textarea' ),
			)
		),
	);
	foreach ( $extra_names as $i => $name ) {
		$extras_groups[] = $g(
			$name,
			array(
				$f( array( 'extras', $i, 0 ), __( 'Heading', 'venix-concierge-core' ) ),
				$f( array( 'extras', $i, 1 ), __( 'Text', 'venix-concierge-core' ), 'textarea' ),
			)
		);
	}

	$audience_groups = array(
		$g(
			'',
			array(
				$f( array( 'audience', 'eyebrow' ), __( 'Small heading above the title', 'venix-concierge-core' ) ),
				$f( array( 'audience', 'title' ), __( 'Heading', 'venix-concierge-core' ) ),
				$f( array( 'audience', 'cta' ), __( 'Button text', 'venix-concierge-core' ) ),
			)
		),
	);
	foreach ( $audience_names as $i => $name ) {
		$audience_groups[] = $g(
			$name,
			array(
				$f( array( 'audience', 'items', $i, 0 ), __( 'Heading', 'venix-concierge-core' ) ),
				$f( array( 'audience', 'items', $i, 1 ), __( 'Text', 'venix-concierge-core' ), 'textarea' ),
			)
		);
	}

	return array(
		'label'    => __( 'Home', 'venix-concierge-core' ),
		'sections' => array(
			$s(
				'hero',
				__( 'Hero', 'venix-concierge-core' ),
				array(
					$g(
						'',
						array(
							$f( array( 'hero', 'eyebrow' ), __( 'Small heading above the title', 'venix-concierge-core' ) ),
							$f( array( 'hero', 'title' ), __( 'Heading', 'venix-concierge-core' ) ),
							$f( array( 'hero', 'lead' ), __( 'Intro text', 'venix-concierge-core' ), 'textarea' ),
							$f( array( 'hero', 'primary' ), __( 'Main button text', 'venix-concierge-core' ) ),
							$f( array( 'hero', 'secondary' ), __( 'Second button text', 'venix-concierge-core' ) ),
							$f( array( 'hero', 'caption' ), __( 'Line below the buttons', 'venix-concierge-core' ) ),
						)
					),
				)
			),
			$s(
				'intro',
				__( 'Introduction', 'venix-concierge-core' ),
				array(
					$g(
						'',
						array(
							$f( array( 'intro', 'eyebrow' ), __( 'Small heading above the title', 'venix-concierge-core' ) ),
							$f( array( 'intro', 'title' ), __( 'Heading', 'venix-concierge-core' ) ),
							$f( array( 'intro', 'copy' ), __( 'Paragraph', 'venix-concierge-core' ), 'textarea' ),
							$f( array( 'intro', 'closing' ), __( 'Closing line', 'venix-concierge-core' ), 'textarea' ),
							$f( array( 'intro', 'cta' ), __( 'Link text', 'venix-concierge-core' ) ),
						)
					),
				)
			),
			$s( 'services', __( 'Main Services', 'venix-concierge-core' ), $service_groups ),
			$s(
				'quote',
				__( 'Quote', 'venix-concierge-core' ),
				array(
					$g( '', array( $f( array( 'quote' ), __( 'Quote text', 'venix-concierge-core' ), 'textarea' ) ) ),
				)
			),
			$s( 'promise', __( 'Brand Promise', 'venix-concierge-core' ), $promise_groups ),
			$s( 'fleet', __( 'Fleet', 'venix-concierge-core' ), $fleet_groups ),
			$s( 'why', __( 'Why Venix', 'venix-concierge-core' ), $why_groups ),
			$s(
				'events',
				__( 'Events', 'venix-concierge-core' ),
				array(
					$g(
						'',
						array(
							$f( array( 'events', 'eyebrow' ), __( 'Small heading above the title', 'venix-concierge-core' ) ),
							$f( array( 'events', 'title' ), __( 'Heading', 'venix-concierge-core' ) ),
							$f( array( 'events', 'copy' ), __( 'Paragraph', 'venix-concierge-core' ), 'textarea' ),
							$f( array( 'events', 'cta' ), __( 'Button text', 'venix-concierge-core' ) ),
						)
					),
					$g( __( 'Bullet list', 'venix-concierge-core' ), $point_fields ),
				)
			),
			$s( 'process', __( 'How It Works', 'venix-concierge-core' ), $process_groups ),
			$s( 'extras', __( 'Other Services', 'venix-concierge-core' ), $extras_groups ),
			$s( 'audience', __( 'Who We Serve', 'venix-concierge-core' ), $audience_groups ),
			$s(
				'testimonial',
				__( 'Testimonial', 'venix-concierge-core' ),
				array(
					$g(
						'',
						array(
							$f( array( 'testimonial', 'quote' ), __( 'Testimonial text', 'venix-concierge-core' ), 'textarea' ),
							$f( array( 'testimonial', 'attribution' ), __( 'Client name and role', 'venix-concierge-core' ) ),
						)
					),
				)
			),
			$s(
				'form',
				__( 'Inquiry', 'venix-concierge-core' ),
				array(
					$g(
						'',
						array(
							$f( array( 'form', 'eyebrow' ), __( 'Small heading above the title', 'venix-concierge-core' ) ),
							$f( array( 'form', 'title' ), __( 'Heading', 'venix-concierge-core' ) ),
							$f( array( 'form', 'lead' ), __( 'Intro text', 'venix-concierge-core' ), 'textarea' ),
							$f( array( 'form', 'contact_note' ), __( 'Line below the intro', 'venix-concierge-core' ) ),
						)
					),
				),
				__( 'Only the wording around the form is editable. The form fields themselves are fixed and shared across the site.', 'venix-concierge-core' )
			),
		),
		'media'    => array(
			'home.hero'                    => __( 'Hero background', 'venix-concierge-core' ),
			'home.about'                   => __( 'Introduction image', 'venix-concierge-core' ),
			'home.services.chauffeur'      => __( 'Main services: Chauffeur-driven transfers & private hire', 'venix-concierge-core' ),
			'home.services.airport'        => __( 'Main services: Airport transfers', 'venix-concierge-core' ),
			'home.services.events'         => __( 'Main services: Business & private events', 'venix-concierge-core' ),
			'home.services.delegations'    => __( 'Main services: Delegations & diplomatic transfers', 'venix-concierge-core' ),
			'home.promise'                 => __( 'Brand promise image', 'venix-concierge-core' ),
			'home.fleet.s_class'           => __( 'Fleet: S-Class', 'venix-concierge-core' ),
			'home.fleet.e_class'           => __( 'Fleet: E-Class', 'venix-concierge-core' ),
			'home.fleet.v_class'           => __( 'Fleet: V-Class', 'venix-concierge-core' ),
			'home.fleet.v_class_extra_long' => __( 'Fleet: V-Class Extra Long', 'venix-concierge-core' ),
			'home.fleet.sprinter'          => __( 'Fleet: Sprinter', 'venix-concierge-core' ),
			'home.events'                  => __( 'Events image', 'venix-concierge-core' ),
		),
	);
}
