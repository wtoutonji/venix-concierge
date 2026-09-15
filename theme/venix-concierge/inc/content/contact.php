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
			'details' => array( '[Insert verified phone number]', '[Insert WhatsApp number]', '[Insert verified email address]', $copy( 'Warsaw, Poland · [Confirm operating hours]', 'Warszawa · [Potwierdzić godziny pracy]' ) ),
			'next_title' => $copy( 'What happens next', 'Co się stanie dalej' ),
			'next_steps' => array(
				$copy( 'Your request is reviewed by our team — typically within one business day.', 'Zapytanie jest weryfikowane przez nasz zespół — zazwyczaj w ciągu jednego dnia roboczego.' ),
				$copy( 'We prepare a tailored proposal based on your requirements.', 'Przygotowujemy dopasowaną propozycję na podstawie Państwa wymagań.' ),
				$copy( 'Once confirmed, all details are provided and the arrangement is set.', 'Po potwierdzeniu przekazujemy wszystkie szczegóły i umawiamy zlecenie.' ),
			),
		),
		'form' => array(
			'progress' => $copy( 'Inquiry progress', 'Postęp zapytania' ),
			'summary' => $copy( 'Please check the following', 'Prosimy sprawdzić' ),
			'steps' => array(
				array( 'title' => $copy( 'Your contact details', 'Dane kontaktowe' ), 'subtitle' => $copy( 'How should we reach you?', 'Jak się z Państwem skontaktować?' ) ),
				array( 'title' => $copy( 'Service selection', 'Wybór usługi' ), 'subtitle' => $copy( 'What service do you require?', 'Jakiej usługi Państwo potrzebują?' ) ),
				array( 'title' => $copy( 'Journey information', 'Dane podróży' ), 'subtitle' => $copy( 'Where and when?', 'Gdzie i kiedy?' ) ),
				array( 'title' => $copy( 'Additional requirements', 'Wymagania dodatkowe' ), 'subtitle' => $copy( 'Anything else to note?', 'Co jeszcze należy uwzględnić?' ) ),
			),
			'labels' => array(
				'full_name' => $copy( 'Full Name', 'Imię i nazwisko' ), 'company' => $copy( 'Company / Organisation', 'Firma / Organizacja' ), 'optional' => $copy( '(optional)', '(opcjonalnie)' ), 'email' => $copy( 'Email Address', 'Adres e-mail' ), 'phone' => $copy( 'Phone / WhatsApp', 'Telefon / WhatsApp' ), 'contact_method' => $copy( 'Preferred Contact Method', 'Preferowana forma kontaktu' ), 'service' => $copy( 'Required Service', 'Rodzaj usługi' ), 'vehicle' => $copy( 'Vehicle Preference', 'Preferencja pojazdu' ), 'journey' => $copy( 'Journey Type', 'Typ podróży' ), 'vehicles' => $copy( 'Number of Vehicles Needed', 'Liczba potrzebnych pojazdów' ), 'pickup' => $copy( 'Pickup Location', 'Miejsce odbioru' ), 'destination' => $copy( 'Destination', 'Cel podróży' ), 'date' => $copy( 'Pickup Date', 'Data odbioru' ), 'time' => $copy( 'Pickup Time', 'Godzina odbioru' ), 'passengers' => $copy( 'Passengers', 'Pasażerowie' ), 'luggage' => $copy( 'Luggage Items', 'Sztuki bagażu' ), 'flight' => $copy( 'Flight Number', 'Numer lotu' ), 'flight_help' => $copy( '(for airport transfers)', '(dla transferów lotniskowych)' ), 'message' => $copy( 'Message or Special Requirements', 'Wiadomość lub wymagania specjalne' ), 'requests' => $copy( 'Special requests', 'Prośby specjalne' ),
			),
			'contact_methods' => array( $copy( 'Email', 'E-mail' ), 'WhatsApp', $copy( 'Phone call', 'Rozmowa telefoniczna' ) ),
			'services' => array( $copy( 'Select a service…', 'Proszę wybrać usługę…' ), $copy( 'Private transfer / chauffeur hire', 'Transfer prywatny / wynajem szofera' ), $copy( 'Airport transfer', 'Transfer lotniskowy' ), $copy( 'Event transportation', 'Transport na wydarzenie' ), $copy( 'Delegation / diplomatic transfer', 'Delegacja / transfer dyplomatyczny' ), $copy( 'Wedding transportation', 'Transport ślubny' ), $copy( 'Concierge assistance', 'Usługi concierge' ), $copy( 'Other / custom quotation', 'Inne / indywidualna wycena' ) ),
			'vehicles' => array( $copy( 'No preference / recommend for me', 'Brak preferencji / proszę polecić' ), 'Mercedes-Benz S-Class', 'Mercedes-Benz E-Class', 'Mercedes-Benz V-Class', 'Mercedes-Benz V-Class Extra Long', 'Mercedes-Benz Sprinter' ),
			'journeys' => array( $copy( 'One-way', 'W jedną stronę' ), $copy( 'Return', 'W obie strony' ), $copy( 'Hourly hire', 'Wynajem godzinowy' ), $copy( 'Full day', 'Cały dzień' ), $copy( 'Multi-day', 'Wiele dni' ) ),
			'vehicle_counts' => array( '1', '2', '3', $copy( '4 or more', '4 lub więcej' ) ),
			'special_requests' => array( $copy( 'Child seat required', 'Fotelik dla dziecka' ), $copy( 'Accessibility requirements', 'Wymagania dostępności' ), $copy( 'Private protection inquiry', 'Zapytanie o ochronę' ), $copy( 'Concierge assistance', 'Usługi concierge' ) ),
			'consent' => $copy( 'I confirm I have read and agree to the Privacy Policy and consent to Venix Concierge processing my details to respond to this inquiry.', 'Potwierdzam, że zapoznałem/am się z Polityką prywatności i wyrażam zgodę na przetwarzanie moich danych przez Venix Concierge.' ),
			'errors' => array( 'fullName' => $copy( 'Please share your name so we know how to address you.', 'Prosimy podać imię i nazwisko.' ), 'email' => $copy( 'Please enter a valid email address so our team can reply.', 'Prosimy podać poprawny adres e-mail.' ), 'service' => $copy( 'Please choose the service you require.', 'Prosimy wybrać rodzaj usługi.' ), 'pickup' => $copy( 'Please tell us where the journey begins.', 'Prosimy podać miejsce odbioru.' ), 'date' => $copy( 'Please choose a pickup date.', 'Prosimy wybrać datę odbioru.' ), 'consent' => $copy( 'Please confirm consent so we may respond to your inquiry.', 'Prosimy potwierdzić zgodę.' ) ),
			'back' => $copy( 'Back', 'Wróć' ), 'continue' => $copy( 'Continue', 'Kontynuuj' ), 'submit' => $copy( 'Send My Request', 'Wyślij zapytanie' ), 'status' => $copy( '[Prototype — form submissions are simulated.]', '[Prototyp — wysyłka formularzy jest symulowana.]' ),
		),
		'location' => array( 'aria_label' => $copy( 'Map showing the Venix Concierge Warsaw base location.', 'Mapa przedstawiająca bazową lokalizację Venix Concierge w Warszawie.' ) ),
		'footer' => array( 'brand_copy' => $copy( 'Chauffeur services, executive transportation and luxury concierge in Warsaw.', 'Usługi szoferskie, transport reprezentacyjny i concierge w Warszawie.' ), 'tagline' => 'Own the moment', 'navigation' => $copy( 'Navigation', 'Nawigacja' ), 'contact_heading' => $copy( 'Contact', 'Kontakt' ), 'location' => $copy( 'Warsaw, Poland', 'Warszawa' ), 'contact_placeholder' => '[Insert verified phone]' ),
	);
}
