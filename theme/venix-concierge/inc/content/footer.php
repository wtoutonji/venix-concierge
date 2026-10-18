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
	$copy = static function ( $english, $polish, $russian = null ) {
		return venix_concierge_language_copy( $english, $polish, $russian );
	};

	return array(
		'brand_copy'       => $copy( 'Chauffeur services, executive transportation and luxury concierge in Warsaw — precise, discreet, personal.', 'Usługi szoferskie, transport reprezentacyjny i concierge klasy premium w Warszawie — precyzyjne, dyskretne, osobiste.', 'Услуги персонального водителя, деловые трансферы и консьерж-сервис премиум-класса в Варшаве — точно, конфиденциально, лично.' ),
		'tagline'          => 'Own the moment',
		'navigation'       => $copy( 'Navigation', 'Nawigacja', 'Навигация' ),
		'services_heading' => $copy( 'Services', 'Usługi', 'Услуги' ),
		'services'         => array(
			array( 'chauffeur', $copy( 'Private transfers', 'Transfery prywatne', 'Частные трансферы' ) ),
			array( 'airport', $copy( 'Airport transfers', 'Transfery lotniskowe', 'Трансферы из аэропорта' ) ),
			array( 'events', $copy( 'Events', 'Wydarzenia', 'Мероприятия' ) ),
			array( 'delegations', $copy( 'Delegations', 'Delegacje', 'Делегации' ) ),
			array( 'protection', $copy( 'Private protection', 'Ochrona osobista', 'Личная охрана' ) ),
			array( 'concierge', $copy( 'Concierge', 'Concierge', 'Консьерж-сервис' ) ),
			array( 'weddings', $copy( 'Weddings', 'Śluby', 'Свадьбы' ) ),
		),
		'contact_heading'  => $copy( 'Contact', 'Kontakt', 'Контакты' ),
	);
}
