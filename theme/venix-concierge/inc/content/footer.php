<?php
/**
 * Shared footer copy and service links used on every page.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the language-specific footer content shared by all pages.
 *
 * @return array<string, mixed>
 */
function venix_concierge_footer_content() {
	$copy = static function ( $english, $polish ) {
		return venix_concierge_language_copy( $english, $polish );
	};

	return array(
		'brand_copy'       => $copy( 'Chauffeur services, executive transportation and luxury concierge in Warsaw — precise, discreet, personal.', 'Usługi szoferskie, transport reprezentacyjny i concierge klasy premium w Warszawie — precyzyjne, dyskretne, osobiste.' ),
		'tagline'          => 'Own the moment',
		'navigation'       => $copy( 'Navigation', 'Nawigacja' ),
		'services_heading' => $copy( 'Services', 'Usługi' ),
		'services'         => array(
			array( 'chauffeur', $copy( 'Private transfers', 'Transfery prywatne' ) ),
			array( 'airport', $copy( 'Airport transfers', 'Transfery lotniskowe' ) ),
			array( 'events', $copy( 'Events', 'Wydarzenia' ) ),
			array( 'delegations', $copy( 'Delegations', 'Delegacje' ) ),
			array( 'protection', $copy( 'Private protection', 'Ochrona osobista' ) ),
			array( 'concierge', 'Concierge' ),
			array( 'weddings', $copy( 'Weddings', 'Śluby' ) ),
		),
		'contact_heading'  => $copy( 'Contact', 'Kontakt' ),
	);
}
