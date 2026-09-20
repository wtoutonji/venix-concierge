<?php
/** Approved Contact page copy. @package VenixConcierge */
if ( ! defined( 'ABSPATH' ) ) { exit; }
function venix_concierge_contact_content() {
	$copy = static function ( $english, $polish ) { return venix_concierge_language_copy( $english, $polish ); };
	return array(
		'hero' => array( 'eyebrow' => $copy( 'Contact', 'Kontakt' ), 'title' => $copy( 'Let us arrange the details', 'Pozwól nam zająć się szczegółami' ) ),
		'info' => array(
			'eyebrow' => $copy( 'Begin the arrangement', 'Rozpocznij ustalenia' ),
			'title' => $copy( 'Share your requirements. We will handle the rest.', 'Prosimy opisać wymagania. Resztą zajmiemy się my.' ),
			'copy' => $copy( 'Provide your journey details, schedule and any special requirements. Our team will review the information and contact you through your preferred method with a considered proposal.', 'Prosimy podać szczegóły podróży, harmonogram i wszelkie specjalne wymagania. Nasz zespół przeanalizuje informacje i skontaktuje się z Państwem wybraną drogą z przemyślaną propozycją.' ),
			'details_label' => $copy( 'Contact details', 'Dane kontaktowe' ),
			'detail_labels' => array(
				'phone' => $copy( 'Phone', 'Telefon' ),
				'whatsapp' => 'WhatsApp',
				'email' => $copy( 'Email', 'E-mail' ),
				'address' => $copy( 'Address', 'Adres' ),
			),
			'next_title' => $copy( 'What happens next', 'Co się stanie dalej' ),
			'next_steps' => array(
				$copy( 'Your request is reviewed by our team — typically within one business day.', 'Zapytanie jest weryfikowane przez nasz zespół — zazwyczaj w ciągu jednego dnia roboczego.' ),
				$copy( 'We prepare a tailored proposal based on your requirements.', 'Przygotowujemy dopasowaną propozycję na podstawie Państwa wymagań.' ),
				$copy( 'Once confirmed, all details are provided and the arrangement is set.', 'Po potwierdzeniu przekazujemy wszystkie szczegóły i umawiamy zlecenie.' ),
			),
		),
		'location' => array( 'aria_label' => $copy( 'Map showing the Venix Concierge Warsaw base location.', 'Mapa przedstawiająca bazową lokalizację Venix Concierge w Warszawie.' ) ),
	);
}
