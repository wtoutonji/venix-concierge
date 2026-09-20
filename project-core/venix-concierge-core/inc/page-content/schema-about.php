<?php
/**
 * Editable field schema for the About page.
 *
 * Paths mirror the theme's `venix_concierge_about_content()` array so an
 * override can only replace an existing text value. Layout, classes, the
 * decorative rule, step numbers, "Value 0X" ordinals, card counts/order and the
 * button destination are deliberately absent.
 *
 * @package VenixConciergeCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get the About page schema.
 *
 * @return array<string, mixed>
 */
function venix_concierge_core_about_page_content_schema() {
	$f = 'venix_concierge_core_page_content_field';
	$g = 'venix_concierge_core_page_content_group';
	$s = 'venix_concierge_core_page_content_section';

	$eyebrow = __( 'Small heading above the title', 'venix-concierge-core' );
	$heading = __( 'Heading', 'venix-concierge-core' );

	$foundation_names = array(
		__( 'Purpose', 'venix-concierge-core' ),
		__( 'Mission', 'venix-concierge-core' ),
		__( 'Vision', 'venix-concierge-core' ),
	);
	$foundation_groups = array(
		$g(
			'',
			array(
				$f( array( 'pmv', 'eyebrow' ), $eyebrow ),
				$f( array( 'pmv', 'title' ), $heading ),
			)
		),
	);
	foreach ( $foundation_names as $i => $name ) {
		$foundation_groups[] = $g(
			$name,
			array(
				$f( array( 'pmv', 'items', $i, 0 ), __( 'Label', 'venix-concierge-core' ) ),
				$f( array( 'pmv', 'items', $i, 1 ), $heading ),
				$f( array( 'pmv', 'items', $i, 2 ), __( 'Description', 'venix-concierge-core' ), 'textarea' ),
			)
		);
	}

	$approach_groups = array(
		$g(
			'',
			array(
				$f( array( 'approach', 'eyebrow' ), $eyebrow ),
				$f( array( 'approach', 'title' ), $heading ),
				$f( array( 'approach', 'copy' ), __( 'Intro text', 'venix-concierge-core' ), 'textarea' ),
			)
		),
	);
	for ( $i = 0; $i < 6; $i++ ) {
		$approach_groups[] = $g(
			/* translators: %d: step number. */
			sprintf( __( 'Step %d', 'venix-concierge-core' ), $i + 1 ),
			array(
				$f( array( 'approach', 'items', $i, 1 ), $heading ),
				$f( array( 'approach', 'items', $i, 2 ), __( 'Description', 'venix-concierge-core' ), 'textarea' ),
			)
		);
	}

	$value_groups = array(
		$g(
			'',
			array(
				$f( array( 'values', 'eyebrow' ), $eyebrow ),
				$f( array( 'values', 'title' ), $heading ),
			)
		),
	);
	for ( $i = 0; $i < 5; $i++ ) {
		$value_groups[] = $g(
			/* translators: %d: value number. */
			sprintf( __( 'Value %d', 'venix-concierge-core' ), $i + 1 ),
			array(
				$f( array( 'values', 'items', $i, 1 ), $heading ),
				$f( array( 'values', 'items', $i, 2 ), __( 'Description', 'venix-concierge-core' ), 'textarea' ),
			)
		);
	}

	$culture_points = array();
	for ( $i = 0; $i < 4; $i++ ) {
		$culture_points[] = $f(
			array( 'culture', 'points', $i ),
			/* translators: %d: list item number. */
			sprintf( __( 'List item %d', 'venix-concierge-core' ), $i + 1 )
		);
	}

	return array(
		'label'    => __( 'About', 'venix-concierge-core' ),
		'sections' => array(
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
				)
			),
			$s(
				'story',
				__( 'Our Story', 'venix-concierge-core' ),
				array(
					$g(
						'',
						array(
							$f( array( 'story', 'eyebrow' ), $eyebrow ),
							$f( array( 'story', 'title' ), $heading ),
							$f( array( 'story', 'copy' ), __( 'Main paragraph', 'venix-concierge-core' ), 'textarea' ),
							$f( array( 'story', 'supporting_copy' ), __( 'Second paragraph', 'venix-concierge-core' ), 'textarea' ),
						)
					),
				)
			),
			$s( 'foundation', __( 'Purpose / Mission / Vision', 'venix-concierge-core' ), $foundation_groups ),
			$s( 'approach', __( 'How We Work', 'venix-concierge-core' ), $approach_groups ),
			$s( 'values', __( 'Values', 'venix-concierge-core' ), $value_groups ),
			$s(
				'culture',
				__( 'International Service', 'venix-concierge-core' ),
				array(
					$g(
						'',
						array(
							$f( array( 'culture', 'eyebrow' ), $eyebrow ),
							$f( array( 'culture', 'title' ), $heading ),
							$f( array( 'culture', 'copy' ), __( 'Main paragraph', 'venix-concierge-core' ), 'textarea' ),
							$f( array( 'culture', 'supporting_copy' ), __( 'Second paragraph', 'venix-concierge-core' ), 'textarea' ),
						)
					),
					$g( __( 'Bullet list', 'venix-concierge-core' ), $culture_points ),
				)
			),
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
		),
		'media'    => array(
			'about.hero'    => __( 'Hero background', 'venix-concierge-core' ),
			'about.story'   => __( 'Our Story image', 'venix-concierge-core' ),
			'about.culture' => __( 'International Service image', 'venix-concierge-core' ),
		),
	);
}
