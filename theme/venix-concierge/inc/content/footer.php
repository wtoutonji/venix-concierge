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
	$copy = static function ( $english, $polish, $russian = null, $arabic = null ) {
		return venix_concierge_language_copy( $english, $polish, $russian, $arabic );
	};

	return array(
		'brand_copy'       => $copy( 'Chauffeur services, executive transportation and luxury concierge in Warsaw — precise, discreet, personal.', 'Usługi szoferskie, transport reprezentacyjny i concierge klasy premium w Warszawie — precyzyjne, dyskretne, osobiste.', 'Услуги персонального водителя, деловые трансферы и консьерж-сервис премиум-класса в Варшаве — точно, конфиденциально, лично.', 'خدمات السائق الخاص والنقل التنفيذي وخدمات كونسيرج راقية في وارسو — بدقة وكتمان ولمسة شخصية.' ),
		'tagline'          => 'Own the moment',
		'navigation'       => $copy( 'Navigation', 'Nawigacja', 'Навигация', 'التنقل' ),
		'services_heading' => $copy( 'Services', 'Usługi', 'Услуги', 'الخدمات' ),
		'services'         => array(
			array( 'chauffeur', $copy( 'Private transfers', 'Transfery prywatne', 'Частные трансферы', 'النقل الخاص' ) ),
			array( 'airport', $copy( 'Airport transfers', 'Transfery lotniskowe', 'Трансферы из аэропорта', 'النقل من المطار وإليه' ) ),
			array( 'events', $copy( 'Events', 'Wydarzenia', 'Мероприятия', 'الفعاليات' ) ),
			array( 'delegations', $copy( 'Delegations', 'Delegacje', 'Делегации', 'الوفود' ) ),
			array( 'protection', $copy( 'Private protection', 'Ochrona osobista', 'Личная охрана', 'الحماية الشخصية' ) ),
			array( 'concierge', $copy( 'Concierge', 'Concierge', 'Консьерж-сервис', 'الكونسيرج' ) ),
			array( 'weddings', $copy( 'Weddings', 'Śluby', 'Свадьбы', 'حفلات الزفاف' ) ),
		),
		'contact_heading'  => $copy( 'Contact', 'Kontakt', 'Контакты', 'تواصل معنا' ),
	);
}
