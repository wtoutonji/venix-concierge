<?php
/**
 * Approved Home launch copy.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the language-specific Home content data.
 *
 * @return array<string, mixed>
 */
function venix_concierge_home_content() {
	$language = venix_concierge_current_language();
	$copy     = static function ( $english, $polish ) use ( $language ) {
		return 'pl' === $language ? $polish : $english;
	};

	return array(
		'hero' => array(
			'eyebrow' => $copy( 'Warsaw, Poland · Chauffeur & Concierge', 'Warszawa · Szofer i concierge' ),
			'title'    => $copy( 'Every journey, handled with precision', 'Każda podróż, dopracowana z precyzją' ),
			'lead'     => $copy( 'Private chauffeur services, executive transportation and coordinated mobility for events and delegations — in Warsaw and beyond.', 'Prywatne usługi szoferskie, transport dla kadry zarządzającej oraz skoordynowana mobilność dla wydarzeń i delegacji — w Warszawie i poza nią.' ),
			'primary'  => $copy( 'Request a chauffeur', 'Zamów szofera' ),
			'secondary'=> $copy( 'Explore the fleet', 'Poznaj flotę' ),
			'caption'  => $copy( 'Operating since 2024 · Private · Corporate · Diplomatic', 'Działamy od 2024 · Klienci prywatni · Firmy · Dyplomacja' ),
		),
		'intro' => array(
			'eyebrow' => 'Venix Concierge · Warsaw',
			'title'    => $copy( 'More than transportation. A service shaped around you.', 'Więcej niż transport. Usługa zbudowana wokół Państwa.' ),
			'copy'     => $copy( 'Venix Concierge is a Warsaw-based chauffeur and concierge company, coordinating private journeys, executive transportation, airport transfers and the movement of delegations and events with precision, discretion and personal attention.', 'Venix Concierge to warszawska firma szoferska i concierge, działająca od 2024 roku. Koordynujemy podróże prywatne, transport dla kadry zarządzającej, transfery lotniskowe oraz obsługę delegacji i wydarzeń — z precyzją, dyskrecją i osobistą uwagą na każdym etapie.' ),
			'closing'  => $copy( 'We handle the details so you can focus on what matters.', 'Zajmujemy się szczegółami, aby mogli Państwo skupić się na tym, co ważne.' ),
			'cta'      => $copy( 'Begin your arrangement', 'Rozpocznij ustalenia' ),
		),
		'services' => array(
			'eyebrow' => $copy( 'What we arrange', 'Co organizujemy' ),
			'title'    => $copy( 'Main services', 'Usługi główne' ),
			'link'     => $copy( 'Make an enquiry', 'Wyślij zapytanie' ),
		),
		'cards' => array(
			array( $copy( 'Chauffeur-driven transfers & private hire', 'Transfery z szoferem i wynajem prywatny' ), $copy( 'A professional chauffeur and premium vehicle, arranged around your itinerary — hourly, full-day, city-to-city, or custom.', 'Profesjonalny szofer i pojazd klasy premium, dopasowane do Państwa planu — na godziny, cały dzień, między miastami lub na zamówienie.' ), $copy( 'Private clients · Executives', 'Klienci prywatni · Kadra zarządzająca' ), $copy( 'Request a private transfer', 'Zamów transfer prywatny' ) ),
			array( $copy( 'Airport transfers', 'Transfery lotniskowe' ), $copy( "Composed arrivals and departures at Warsaw's airports, with the vehicle matched to passengers and luggage. Groups and multi-vehicle arrangements available.", 'Spokojne przyloty i wyloty na warszawskich lotniskach, z pojazdem dobranym do liczby pasażerów i bagażu. Obsługa grup i wielu pojazdów możliwa.' ), $copy( 'Travellers · Families · Groups', 'Podróżni · Rodziny · Grupy' ), $copy( 'Arrange an airport transfer', 'Umów transfer lotniskowy' ) ),
			array( $copy( 'Business & private events', 'Wydarzenia biznesowe i prywatne' ), $copy( 'Coordinated guest movement for conferences, galas and private celebrations — multiple vehicles, single point of contact, precise timing.', 'Skoordynowany transport gości na konferencje, gale i uroczystości — wiele pojazdów, jeden punkt kontaktu, precyzyjne terminy.' ), $copy( 'Organisers · Companies · Hosts', 'Organizatorzy · Firmy · Gospodarze' ), $copy( 'Plan event transportation', 'Zaplanuj transport na wydarzenie' ) ),
			array( $copy( 'Delegations & diplomatic transfers', 'Delegacje i transfery dyplomatyczne' ), $copy( 'Discreet, punctual transportation for embassies, delegations and official guests, coordinated with your appointed team.', 'Dyskretny, punktualny transport dla ambasad, delegacji i gości oficjalnych, koordynowany z wyznaczonym zespołem.' ), $copy( 'Embassies · Delegations · Officials', 'Ambasady · Delegacje · Goście oficjalni' ), $copy( 'Discuss a delegation', 'Omów potrzeby delegacji' ) ),
		),
		'pillars' => array(
			array( $copy( 'Precision in every detail', 'Precyzja w każdym szczególe' ), $copy( 'From pickup to destination, each journey is carefully coordinated.', 'Od odbioru po cel — każdy przejazd starannie skoordynowany.' ) ),
			array( $copy( 'Discretion you can rely on', 'Dyskrecja, na której można polegać' ), $copy( 'Privacy and professional conduct are central to every service.', 'Prywatność i profesjonalizm są podstawą każdej usługi.' ) ),
			array( $copy( 'Clear communication', 'Jasna komunikacja' ), $copy( 'Straightforward information and a clearly managed inquiry process.', 'Przejrzyste informacje i czytelny proces zapytania.' ) ),
			array( $copy( 'Service that adapts', 'Usługa, która się dostosowuje' ), $copy( 'When requirements change, the team responds calmly and works to accommodate the new plan.', 'Gdy plany się zmieniają, zespół reaguje spokojnie.' ) ),
			array( $copy( 'A personal approach', 'Indywidualne podejście' ), $copy( 'Every request is handled according to the client\'s individual needs.', 'Każde zapytanie prowadzimy zgodnie z indywidualnymi potrzebami.' ) ),
			array( $copy( 'International understanding', 'Międzynarodowe zrozumienie' ), $copy( 'Designed for clients from different cultures, industries and backgrounds.', 'Usługa dla klientów z różnych kultur i środowisk.' ) ),
		),
		'why' => array(
			'eyebrow' => $copy( 'Why Venix Concierge', 'Dlaczego Venix Concierge' ),
			'title'    => $copy( 'The standards behind the service', 'Standardy, które za nami stoją' ),
		),
		'process_heading' => array(
			'eyebrow' => $copy( 'How it works', 'Jak to działa' ),
			'title'    => $copy( 'From request to arrival', 'Od zapytania do przyjazdu' ),
		),
		'extras_heading' => array(
			'eyebrow'    => $copy( 'Beyond the journey', 'Poza samą podróżą' ),
			'title'      => $copy( 'Other services', 'Inne usługi' ),
			'link'       => $copy( 'Inquire', 'Zapytaj' ),
			'disclaimer' => $copy( 'Selected specialist services are coordinated through authorised partners and are subject to assessment, availability, licensing requirements and applicable regulations. [Confirm service partner arrangements]', 'Wybrane usługi specjalistyczne koordynujemy z autoryzowanymi partnerami; podlegają one ocenie, dostępności, wymogom licencyjnym i obowiązującym przepisom. [Do potwierdzenia: ustalenia partnerskie]' ),
		),
		'process' => array(
			array( '01', $copy( 'Share your requirements', 'Przekaż wymagania' ), $copy( 'Provide the journey, date, passengers, vehicle preference and any special requirements.', 'Prosimy o trasę, datę, liczbę pasażerów, preferencje pojazdu i wymagania specjalne.' ) ),
			array( '02', $copy( 'Receive a tailored proposal', 'Otrzymaj dopasowaną propozycję' ), $copy( 'We review the request and prepare an appropriate service recommendation.', 'Analizujemy zapytanie i przygotowujemy rekomendację.' ) ),
			array( '03', $copy( 'Confirm the arrangement', 'Potwierdź ustalenia' ), $copy( 'Once approved, every journey detail is confirmed in writing.', 'Po akceptacji wszystkie szczegóły zostają potwierdzone na piśmie.' ) ),
			array( '04', $copy( 'Travel with confidence', 'Podróżuj z pewnością' ), $copy( 'The service is carried out with professional care, discretion and attention to detail.', 'Usługę realizujemy z profesjonalną starannością i dyskrecją.' ) ),
		),
		'extras' => array(
			array( $copy( 'Private protection', 'Ochrona osobista' ), $copy( 'Coordination of professional security arrangements through authorised providers.', 'Koordynacja ochrony przez autoryzowane podmioty.' ) ),
			array( $copy( 'Private flights', 'Loty prywatne' ), $copy( 'Charter inquiry assistance and seamless ground-to-air coordination.', 'Wsparcie przy czarterze i transport naziemny.' ) ),
			array( $copy( 'Embassy services', 'Obsługa ambasad' ), $copy( 'Transportation and scheduling support for official visitors and embassy guests.', 'Transport i logistyka dla gości oficjalnych i ambasad.' ) ),
			array( $copy( 'Concierge services', 'Usługi concierge' ), $copy( 'Personal arrangements surrounding your visit — reservations, itineraries, special requests.', 'Osobiste ustalenia wokół Państwa wizyty.' ) ),
			array( $copy( 'Weddings', 'Śluby i wesela' ), $copy( 'Elegant, precisely timed transportation for couples, families and guests.', 'Eleganckie, punktualne przejazdy dla pary młodej i gości.' ) ),
		),
		'fleet' => array(
			'eyebrow' => $copy( 'The fleet', 'Flota' ),
			'title'    => $copy( 'Matched to the journey', 'Dobrana do podróży' ),
			'copy'     => $copy( 'The right vehicle is not simply a matter of size — it should match the journey, the passengers and the occasion.', 'Właściwy pojazd to nie tylko kwestia wielkości — powinien odpowiadać podróży, pasażerom i okazji.' ),
			'note'     => $copy( 'Model, configuration and colour may vary.', 'Model, konfiguracja i kolor mogą się różnić.' ),
			'featured_id' => 'sclass',
			'vehicle_ids' => array( 'eclass', 'vclass', 'vclassxl', 'sprinter' ),
			'featured' => array( $copy( 'Flagship sedan', 'Flagowy sedan' ), 'Executive · VIP', 'Mercedes-Benz S-Class', $copy( 'The flagship choice for executive and diplomatic travel, important private occasions and VIP airport arrivals. An environment of quiet distinction and precise comfort.', 'Flagowy wybór dla podróży przedstawicielskich i dyplomatycznych, ważnych okazji prywatnych oraz przylotów VIP. Środowisko cichej elegancji i precyzyjnego komfortu.' ), $copy( 'Request the S-Class', 'Zamów S-Klasa' ) ),
			'vehicles' => array(
				array( $copy( 'Executive sedan', 'Sedan biznesowy' ), 'Mercedes-Benz E-Class', $copy( 'Premium business travel, corporate airport transfers and daily chauffeur requirements. Refined, discreet and dependable.', 'Transport biznesowy klasy premium, korporacyjne transfery lotniskowe i codzienna obsługa szoferska. Elegancki, dyskretny i niezawodny.' ), $copy( 'Request the E-Class', 'Zamów E-Klasa' ) ),
				array( $copy( 'Luxury van', 'Van klasy premium' ), 'Mercedes-Benz V-Class', $copy( 'Families, executive teams and small groups travelling together — airport transfers, city journeys and event transport.', 'Rodziny, zespoły i mniejsze grupy podróżujące razem — transfery lotniskowe, przejazdy miejskie i transport na wydarzenia.' ), $copy( 'Request the V-Class', 'Zamów V-Klasa' ) ),
				array( $copy( 'Luxury van · Extended', 'Van premium · Przedłużony' ), 'Mercedes-Benz V-Class Extra Long', $copy( 'Extended cabin for additional luggage or longer journeys, with the same refined comfort as the standard V-Class.', 'Przedłużona kabina na dodatkowy bagaż lub dłuższe trasy, z tym samym wyrafinowanym komfortem co standardowy V-Class.' ), $copy( 'Request the V-Class XL', 'Zamów V-Klasa XL' ) ),
				array( $copy( '9 · 16 · 19 seats', '9 · 16 · 19 miejsc' ), 'Mercedes-Benz Sprinter', $copy( 'Group transportation for conferences, delegations, weddings and events — available in 9, 16 and 19-seat configurations.', 'Transport grupowy na konferencje, delegacje, śluby i wydarzenia — dostępny w konfiguracji na 9, 16 i 19 miejsc.' ), $copy( 'Discuss group transport', 'Omów transport grupowy' ) ),
			),
			'helper_title' => $copy( 'Not sure which vehicle is right?', 'Nie wiedzą Państwo, który pojazd będzie odpowiedni?' ),
			'helper_copy'  => $copy( 'Tell us about your journey, passengers and luggage. We will recommend the appropriate arrangement.', 'Prosimy podać liczbę pasażerów, bagaż i trasę — nasz zespół zarekomenduje właściwy pojazd.' ),
			'helper_cta'   => $copy( 'Ask for a recommendation', 'Otrzymaj rekomendację' ),
		),
		'events' => array(
			'eyebrow' => $copy( 'Events & delegations', 'Wydarzenia i delegacje' ),
			'title'   => $copy( 'When every arrival matters, coordination becomes part of the experience', 'Gdy liczy się każdy przyjazd, koordynacja staje się częścią doświadczenia' ),
			'copy'    => $copy( 'For conferences, official visits, weddings and multi-day programmes, we plan and manage the movement of guests, executives and delegations — with one responsible point of contact.', 'Przy konferencjach, wizytach oficjalnych, ślubach i programach wielodniowych planujemy i prowadzimy przejazdy gości, kadry i delegacji — z jednym odpowiedzialnym punktem kontaktu.' ),
			'points'  => array(
				$copy( 'Airport & hotel transfers', 'Transfery lotniskowe i hotelowe' ),
				$copy( 'Guest schedules & pickups', 'Harmonogramy i odbiory gości' ),
				$copy( 'Conference transportation', 'Transport konferencyjny' ),
				$copy( 'Embassy & delegation movements', 'Przejazdy ambasad i delegacji' ),
				$copy( 'Multi-vehicle coordination', 'Koordynacja wielu pojazdów' ),
				$copy( 'On-site coordination, when arranged', 'Koordynacja na miejscu — po uzgodnieniu' ),
			),
			'cta' => $copy( 'Discuss your requirements', 'Omów swoje potrzeby' ),
		),
		'audience' => array(
			'eyebrow' => $copy( 'Who we serve', 'Komu służymy' ),
			'title'   => $copy( 'A service shaped for those who expect more', 'Usługa stworzona dla wymagających' ),
			'items'   => array(
				array( $copy( 'Private travellers', 'Klienci prywatni' ), $copy( 'Individuals seeking refined, discreet transportation for private and leisure journeys.', 'Osoby poszukujące eleganckiego, dyskretnego transportu prywatnego.' ) ),
				array( $copy( 'Executives', 'Kadra zarządzająca' ), $copy( 'Senior leaders who require precise, private travel arrangements and personal attention.', 'Liderzy wymagający precyzyjnych, prywatnych ustaleń podróżniczych.' ) ),
				array( $copy( 'Companies', 'Firmy' ), $copy( 'Corporate teams, travel managers and executive assistants coordinating business travel.', 'Firmy, menedżerowie podróży i asystenci koordynujący transport służbowy.' ) ),
				array( $copy( 'Embassies', 'Ambasady' ), $copy( 'Diplomatic missions and consular staff requiring discreet, protocol-aware transportation.', 'Misje dyplomatyczne i personel konsularny wymagający dyskretnego transportu.' ) ),
				array( $copy( 'Delegations', 'Delegacje' ), $copy( 'Official groups, government representatives and international organisations visiting Warsaw.', 'Grupy oficjalne, przedstawiciele rządowi i organizacje międzynarodowe w Warszawie.' ) ),
				array( $copy( 'Event organisers', 'Organizatorzy wydarzeń' ), $copy( 'Conference, gala and celebration coordinators managing multi-vehicle guest transport.', 'Organizatorzy konferencji, gal i uroczystości zarządzający transportem gości.' ) ),
				array( $copy( 'Hotels & hospitality', 'Hotele i branża hotelarska' ), $copy( 'Hospitality partners and their distinguished guests requiring seamless arrival arrangements.', 'Partnerzy hotelarscy i ich wymagający goście oczekujący płynnych transferów.' ) ),
				array( $copy( 'Wedding planners', 'Organizatorzy ślubów' ), $copy( 'Couples, families and celebration coordinators arranging elegant occasion transport.', 'Pary, rodziny i koordynatorzy uroczystości organizujący elegancki transport.' ) ),
				array( $copy( 'International guests', 'Goście z zagranicy' ), $copy( 'Visitors arriving in Warsaw from across the world who need a trusted, local partner.', 'Goście przybywający do Warszawy z całego świata szukający zaufanego partnera.' ) ),
			),
			'cta' => $copy( 'Request a Chauffeur', 'Zamów szofera' ),
		),
		'testimonial' => array(
			'quote'       => $copy( '[Approved client testimonial to be supplied. No fabricated quotations are used in this prototype.]', '[Miejsce na zatwierdzoną opinię klienta. W prototypie nie stosujemy fikcyjnych cytatów.]' ),
			'attribution' => $copy( '[Client name & role — with permission]', '[Imię i rola klienta — za zgodą]' ),
		),
		'quote' => $copy( 'When every detail is considered, the journey becomes the experience.', 'Gdy każdy szczegół jest przemyślany, podróż staje się przeżyciem.' ),
		'promise' => array(
			'title' => $copy( 'You enjoy the moment. We handle the details.', 'Chwila należy do Państwa. Szczegóły do nas.' ),
			'copy'  => $copy( 'Behind every composed arrival is quiet, careful work — so the journey itself asks nothing of you. We coordinate the planning, the timing, the vehicle, the route, and the communication, so your focus stays where it should.', 'Za każdym spokojnym przyjazdem stoi cicha, staranna praca — tak, aby sama podróż nie wymagała od Państwa niczego. Koordynujemy planowanie, terminarz, pojazd, trasę i komunikację, by Państwa uwaga mogła pozostać tam, gdzie powinna.' ),
			'items' => array(
				array( $copy( 'Planning & timing', 'Planowanie i harmonogram' ), $copy( 'Schedules built around your day.', 'Harmonogramy budowane wokół Państwa dnia.' ) ),
				array( $copy( 'Route & flight details', 'Trasa i dane lotu' ), $copy( 'Journey information checked in advance.', 'Informacje weryfikowane z wyprzedzeniem.' ) ),
				array( $copy( 'Vehicle preparation', 'Przygotowanie pojazdu' ), $copy( 'Every vehicle presented professionally.', 'Każdy pojazd przygotowany profesjonalnie.' ) ),
				array( $copy( 'Privacy at every stage', 'Prywatność na każdym etapie' ), $copy( 'Discreet conduct and confidential handling.', 'Dyskretne zachowanie i poufność.' ) ),
				array( $copy( 'Clear confirmations', 'Jasne potwierdzenia' ), $copy( 'You always know what has been arranged.', 'Zawsze wiedzą Państwo, co ustalono.' ) ),
				array( $copy( 'Calm adaptation', 'Spokojna reakcja' ), $copy( 'When plans change, we work to adapt.', 'Gdy plany się zmieniają, dostosowujemy się.' ) ),
			),
		),
		'form' => array(
			'eyebrow' => $copy( 'Begin the arrangement', 'Rozpocznij ustalenia' ),
			'title'   => $copy( 'Tell us where you need to be. We handle the rest.', 'Prosimy powiedzieć, gdzie mają Państwo być. Resztą zajmiemy się my.' ),
			'lead'    => $copy( 'Share your route, schedule and requirements. Our team will review the details and reply with a tailored proposal through your preferred method of contact.', 'Prosimy o przekazanie trasy, terminu i wymagań. Nasz zespół przeanalizuje szczegóły i odpowie dopasowaną propozycją wybraną przez Państwa drogą kontaktu.' ),
			'contact_note' => $copy( 'Warsaw, Poland · [Confirm operating area]', 'Warszawa · [Do potwierdzenia: obszar działania]' ),
			'fields' => array(
				array( 'home-name', $copy( 'Full Name', 'Imię i nazwisko' ), 'text', 'full_name', true, 'name' ),
				array( 'home-email', $copy( 'Email Address', 'Adres e-mail' ), 'email', 'email', true, 'email' ),
				array( 'home-phone', $copy( 'Phone / WhatsApp', 'Telefon / WhatsApp' ), 'tel', 'phone', true, 'tel' ),
				array( 'home-date', $copy( 'Pickup Date', 'Data odbioru' ), 'date', 'pickup_date', true, '' ),
				array( 'home-passengers', $copy( 'Passengers', 'Pasażerowie' ), 'number', 'passengers', false, '' ),
				array( 'home-from', $copy( 'Pickup Location', 'Miejsce odbioru' ), 'text', 'pickup_location', true, '' ),
				array( 'home-to', $copy( 'Destination', 'Cel podróży' ), 'text', 'destination', false, '' ),
			),
			'optional_suffix' => $copy( '(optional)', '(opcjonalnie)' ),
			'service_label' => $copy( 'Required Service', 'Rodzaj usługi' ),
			'service' => array(
				$copy( 'Select a service…', 'Proszę wybrać usługę…' ),
				$copy( 'Private transfer / chauffeur hire', 'Transfer prywatny / wynajem szofera' ),
				$copy( 'Airport transfer', 'Transfer lotniskowy' ),
				$copy( 'Event transportation', 'Transport na wydarzenie' ),
				$copy( 'Delegation / diplomatic transfer', 'Delegacja / transfer dyplomatyczny' ),
				$copy( 'Wedding transportation', 'Transport ślubny' ),
				$copy( 'Concierge assistance', 'Usługi concierge' ),
				$copy( 'Other / custom quotation', 'Inne / indywidualna wycena' ),
			),
			'message_label' => $copy( 'Message or Special Requirements (optional)', 'Wiadomość lub wymagania specjalne (opcjonalnie)' ),
			'consent'       => $copy( 'I confirm I have read and agree to the Privacy Policy and consent to Venix Concierge processing my details to respond to this inquiry.', 'Potwierdzam, że zapoznałem/am się z Polityką prywatności i wyrażam zgodę na przetwarzanie moich danych przez Venix Concierge w celu udzielenia odpowiedzi na to zapytanie.' ),
			'status'        => $copy( 'Prototype — form submissions are simulated.', 'Prototyp — wysyłka formularza jest symulowana.' ),
			'submit_placeholder' => 'Form setup pending',
		),
		'footer' => array(
			'brand_copy' => $copy( 'Chauffeur services, executive transportation and luxury concierge in Warsaw — precise, discreet, personal.', 'Usługi szoferskie, transport reprezentacyjny i concierge klasy premium w Warszawie — precyzyjne, dyskretne, osobiste.' ),
			'tagline'    => 'Own the moment',
			'navigation' => $copy( 'Navigation', 'Nawigacja' ),
			'services_heading' => $copy( 'Services', 'Usługi' ),
			'services' => array(
				array( 'chauffeur', $copy( 'Private transfers', 'Transfery prywatne' ) ),
				array( 'airport', $copy( 'Airport transfers', 'Transfery lotniskowe' ) ),
				array( 'events', $copy( 'Events', 'Wydarzenia' ) ),
				array( 'delegations', $copy( 'Delegations', 'Delegacje' ) ),
				array( 'protection', $copy( 'Private protection', 'Ochrona osobista' ) ),
				array( 'concierge', 'Concierge' ),
				array( 'weddings', $copy( 'Weddings', 'Śluby' ) ),
			),
			'contact_heading' => $copy( 'Contact', 'Kontakt' ),
			'contact_copy'    => $copy( 'Warsaw · [Confirm hours]', 'Warszawa · [Godziny do potwierdzenia]' ),
		),
	);
}
