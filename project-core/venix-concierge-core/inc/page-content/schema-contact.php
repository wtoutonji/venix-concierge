<?php
/**
 * Editable field schema for the Contact page.
 *
 * Paths mirror the theme's `venix_concierge_contact_content()` array so an
 * override can only replace an existing text value.
 *
 * Deliberately absent:
 * - the shared inquiry form (structure, labels, consent, submit) — owned by the
 *   shared inquiry-form component;
 * - company name, legal name, address, phone, WhatsApp, email, Instagram and
 *   Facebook — owned only by Venix → Site Settings. The theme renders the Contact
 *   detail rows from those settings, so no `info.details` value exists to edit.
 *   Their row labels (`info.detail_labels`) are translated theme strings.
 *
 * @package VenixConciergeCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get the Contact page schema.
 *
 * @return array<string, mixed>
 */
function venix_concierge_core_contact_page_content_schema() {
	$f = 'venix_concierge_core_page_content_field';
	$g = 'venix_concierge_core_page_content_group';
	$s = 'venix_concierge_core_page_content_section';

	$eyebrow = __( 'Small heading above the title', 'venix-concierge-core' );
	$heading = __( 'Heading', 'venix-concierge-core' );

	$step_fields = array();
	for ( $i = 0; $i < 3; $i++ ) {
		$step_fields[] = $f(
			array( 'info', 'next_steps', $i ),
			/* translators: %d: step number. */
			sprintf( __( 'Step %d', 'venix-concierge-core' ), $i + 1 ),
			'textarea'
		);
	}

	return array(
		'label'    => __( 'Contact', 'venix-concierge-core' ),
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
				'information',
				__( 'Contact Information', 'venix-concierge-core' ),
				array(
					$g(
						'',
						array(
							$f( array( 'info', 'details_label' ), __( 'Screen-reader label for the contact details list', 'venix-concierge-core' ) ),
						)
					),
					$g(
						__( 'What happens next', 'venix-concierge-core' ),
						array_merge(
							array( $f( array( 'info', 'next_title' ), $heading ) ),
							$step_fields
						)
					),
				),
				__( 'Phone, WhatsApp, email, address and social links are managed in Venix → Site Settings, not here.', 'venix-concierge-core' )
			),
			$s(
				'location',
				__( 'Location', 'venix-concierge-core' ),
				array(
					$g(
						'',
						array(
							$f( array( 'location', 'aria_label' ), __( 'Map description (screen-reader label)', 'venix-concierge-core' ) ),
						)
					),
				)
			),
			$s(
				'intro',
				__( 'Inquiry Introduction', 'venix-concierge-core' ),
				array(
					$g(
						'',
						array(
							$f( array( 'info', 'eyebrow' ), $eyebrow ),
							$f( array( 'info', 'title' ), $heading ),
							$f( array( 'info', 'copy' ), __( 'Intro text', 'venix-concierge-core' ), 'textarea' ),
						)
					),
				),
				__( 'Only the wording beside the form is editable. The form fields themselves are fixed and shared across the site.', 'venix-concierge-core' )
			),
		),
		'media'    => array(
			'contact.hero' => __( 'Hero background', 'venix-concierge-core' ),
		),
	);
}
