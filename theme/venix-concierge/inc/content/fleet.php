<?php
/**
 * Approved Fleet page copy and shared vehicle capacity.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function venix_concierge_fleet_content() {
	$copy = static function ( $english, $polish ) {
		return venix_concierge_language_copy( $english, $polish );
	};

	return array(
		'hero' => array(
			'eyebrow' => $copy( 'The fleet', 'Flota' ),
			'title'   => $copy( 'The right vehicle for every journey', 'Właściwy pojazd na każdą podróż' ),
			'copy'    => $copy( 'A curated fleet of Mercedes-Benz vehicles, each selected to serve different journey types, passenger groups and occasions with equal professionalism.', 'Starannie dobrana flota Mercedes-Benz, każdy pojazd wybrany do obsługi różnych rodzajów podróży, grup pasażerów i okazji z równą profesjonalnością.' ),
		),
		'notice' => array(
			'aria_label' => $copy( 'Fleet availability notice', 'Informacja o dostępności floty' ),
			'copy'       => $copy( 'Exact model, configuration, colour and availability may vary. Passenger and luggage capacities to be confirmed.', 'Dokładny model, konfiguracja, kolor i dostępność mogą się różnić. Pojemność pasażerska i bagażowa do potwierdzenia.' ),
			'link'       => $copy( 'Need a vehicle recommendation? Contact us', 'Potrzebują Państwo rekomendacji? Skontaktuj się' ),
		),
		'vehicles' => array(
			array(
				'id'        => 'sclass',
				'name'      => 'Mercedes-Benz S-Class',
				'badge'     => $copy( 'Flagship sedan', 'Flagowy sedan' ),
				'sub_badge' => $copy( 'Executive · VIP · Diplomatic', 'Kadra · VIP · Dyplomacja' ),
				'columns'   => 'media-wide',
				'copy'      => $copy( 'The flagship choice for executive and diplomatic travel, important private occasions and VIP airport arrivals. An environment of quiet distinction and precise comfort, designed for those who expect nothing to be left to chance.', 'Flagowy wybór dla podróży przedstawicielskich i dyplomatycznych, ważnych okazji prywatnych oraz przylotów VIP. Środowisko cichej elegancji i precyzyjnego komfortu — dla tych, którzy nie pozostawiają niczego przypadkowi.' ),
				'use_cases' => array(
					$copy( 'Executive and diplomatic travel', 'Podróże przedstawicielskie i dyplomatyczne' ),
					$copy( 'Important private occasions', 'Ważne okazje prywatne' ),
					$copy( 'VIP airport arrivals and departures', 'Przyloty i wyloty VIP' ),
				),
				'cta'       => $copy( 'Request the S-Class', 'Zamów S-Klasa' ),
				'media_alt' => $copy( 'Alt: A black Mercedes-Benz S-Class on a Warsaw boulevard at golden hour.', 'Alt: Czarny Mercedes-Benz S-Class na warszawskim bulwarze o zmierzchu.' ),
				'interior'  => array(
					$copy( 'Rear cabin — warm leather upholstery, ambient lighting, refined materials. Serene, composed.', 'Kabina tylna — ciepła skórzana tapicerka, oświetlenie ambientowe, wyrafinowane materiały. Spokojne, stonowane.' ),
					$copy( "Front cabin detail — instrumentation, steering wheel, driver's environment. Professional and precise.", 'Detal kabiny przedniej — instrumentarium, kierownica, środowisko kierowcy. Profesjonalne i precyzyjne.' ),
				),
			),
			array(
				'id'        => 'eclass',
				'name'      => 'Mercedes-Benz E-Class',
				'badge'     => $copy( 'Executive sedan', 'Sedan biznesowy' ),
				'sub_badge' => $copy( 'Corporate · Airport · Daily', 'Korporacja · Lotnisko · Codzienny' ),
				'columns'   => 'details-wide',
				'copy'      => $copy( 'Premium business travel, corporate airport transfers and daily chauffeur requirements. Refined, discreet and dependable — a consistent professional presence for demanding schedules.', 'Transport biznesowy klasy premium, korporacyjne transfery lotniskowe i codzienna obsługa szoferska. Elegancki, dyskretny i niezawodny — stała profesjonalna obecność dla wymagających harmonogramów.' ),
				'use_cases' => array(
					$copy( 'Corporate travel and business appointments', 'Podróże służbowe i spotkania biznesowe' ),
					$copy( 'Airport transfers — arrivals and departures', 'Transfery lotniskowe — przyloty i wyloty' ),
					$copy( 'Daily and multi-day chauffeur hire', 'Wynajem szofera na jeden dzień i dłużej' ),
				),
				'cta'       => $copy( 'Request the E-Class', 'Zamów E-Klasa' ),
				'media_alt' => $copy( 'Alt: A black Mercedes-Benz E-Class in a Warsaw business district.', 'Alt: Czarny Mercedes-Benz E-Class w warszawskiej dzielnicy biznesowej.' ),
			),
			array(
				'id'        => 'vclass',
				'name'      => 'Mercedes-Benz V-Class',
				'badge'     => $copy( 'Luxury van', 'Van klasy premium' ),
				'sub_badge' => $copy( 'Families · Groups · Events', 'Rodziny · Grupy · Wydarzenia' ),
				'columns'   => 'media-wide',
				'copy'      => $copy( 'Families, executive teams and small groups travelling together in comfort. The V-Class combines generous interior space with premium presentation, making it equally suited to airport transfers, event transport and multi-stop city journeys.', 'Rodziny, zespoły zarządzające i małe grupy podróżujące razem w komforcie. V-Class łączy przestronną kabinę z elegancką prezentacją — równie dobry do transferów lotniskowych, transportu na wydarzenia i wieloprzystankowych podróży po mieście.' ),
				'use_cases' => array(
					$copy( 'Airport transfers for families and groups', 'Transfery lotniskowe dla rodzin i grup' ),
					$copy( 'Executive team travel', 'Podróże zespołów zarządzających' ),
					$copy( 'Event guest transportation', 'Transport gości na wydarzenia' ),
				),
				'cta'       => $copy( 'Request the V-Class', 'Zamów V-Klasa' ),
				'media_alt' => $copy( 'Alt: A black Mercedes-Benz V-Class at a Warsaw hotel entrance.', 'Alt: Czarny Mercedes-Benz V-Class przed wejściem do warszawskiego hotelu.' ),
				'interior'  => array(
					$copy( 'Rear seating area — individual seats, warm ambient tone, generous legroom. Comfortable for longer journeys.', 'Tylna strefa siedzeń — fotele indywidualne, ciepły ton ambientowy, duże odstępy między siedzeniami. Komfortowy na dłuższe trasy.' ),
					$copy( 'Luggage area — clean, accessible, suitable for airport transfers with checked baggage.', 'Przestrzeń bagażowa — czysta, dostępna, odpowiednia do transferów lotniskowych z bagażem rejestrowanym.' ),
				),
			),
			array(
				'id'        => 'vclassxl',
				'name'      => 'Mercedes-Benz V-Class Extra Long',
				'badge'     => $copy( 'Luxury van · Extended', 'Van premium · Przedłużony' ),
				'sub_badge' => $copy( 'Groups · Luggage · Long routes', 'Grupy · Bagaż · Długie trasy' ),
				'columns'   => 'details-wide',
				'copy'      => $copy( 'The extended version of the V-Class provides additional cabin length for groups with more luggage, longer intercity journeys or when extra interior space improves comfort for the passengers.', 'Wersja przedłużona V-Class zapewnia większą przestrzeń kabiny dla grup z większą ilością bagażu, dłuższych tras między miastami lub gdy dodatkowa przestrzeń wewnętrzna poprawia komfort pasażerów.' ),
				'use_cases' => array(
					$copy( 'Groups with substantial luggage', 'Grupy z dużą ilością bagażu' ),
					$copy( 'Longer intercity journeys', 'Dłuższe trasy między miastami' ),
					$copy( 'Event and delegation transport', 'Transport na wydarzenia i delegacje' ),
				),
				'cta'       => $copy( 'Request the V-Class XL', 'Zamów V-Klasa XL' ),
				'media_alt' => $copy( 'Alt: A Mercedes-Benz V-Class Extra Long on a Warsaw airport road.', 'Alt: Mercedes-Benz V-Class Extra Long na drodze lotniskowej w Warszawie.' ),
			),
			array(
				'id'        => 'sprinter',
				'name'      => 'Mercedes-Benz Sprinter',
				'badge'     => $copy( 'Group transport', 'Transport grupowy' ),
				'sub_badge' => $copy( '9 · 16 · 19 passenger configurations', 'Konfiguracje 9 · 16 · 19 miejsc' ),
				'columns'   => 'media-wide',
				'copy'      => $copy( 'Group transportation for conferences, delegations, weddings and events — available in 9, 16 and 19-seat configurations. Professional presentation, coordinated scheduling and driver dispatch. The right choice when groups need to move together with comfort and punctuality.', 'Transport grupowy na konferencje, delegacje, śluby i wydarzenia — dostępny w konfiguracji na 9, 16 i 19 miejsc. Profesjonalna prezentacja, skoordynowany harmonogram i dyspozycja kierowcy. Właściwy wybór, gdy grupy muszą podróżować razem z komfortem i punktualnością.' ),
				'use_cases' => array(
					$copy( 'Conference and corporate event transport', 'Transport na konferencje i imprezy korporacyjne' ),
					$copy( 'Delegation and embassy group movements', 'Przejazdy delegacji i grup ambasadowych' ),
					$copy( 'Wedding guest coordination', 'Koordynacja gości weselnych' ),
				),
				'cta'       => $copy( 'Request a Sprinter', 'Zamów Sprinter' ),
				'media_alt' => $copy( 'Alt: A Mercedes-Benz Sprinter at a Warsaw conference centre for group transport.', 'Alt: Mercedes-Benz Sprinter przed centrum konferencyjnym w Warszawie.' ),
			),
		),
		'recommendation' => array(
			'eyebrow' => $copy( 'Not sure?', 'Nie wiedzą Państwo?' ),
			'title'   => $copy( 'We will recommend the right vehicle for your journey', 'Zarekomendujemy właściwy pojazd na Państwa podróż' ),
			'copy'    => $copy( 'Share your passenger count, luggage requirements, journey type and any special needs. Our team will suggest the most appropriate option and confirm availability.', 'Prosimy podać liczbę pasażerów, wymagania dotyczące bagażu, rodzaj podróży i wszelkie specjalne potrzeby. Nasz zespół zaproponuje najbardziej odpowiednią opcję i potwierdzi dostępność.' ),
			'button'  => $copy( 'Get a vehicle recommendation', 'Uzyskaj rekomendację pojazdu' ),
			'points'  => array(
				array( $copy( 'Passengers', 'Pasażerowie' ), $copy( 'How many people are travelling?', 'Ile osób podróżuje?' ) ),
				array( $copy( 'Luggage', 'Bagaż' ), $copy( 'Checked bags, hand luggage, equipment?', 'Bagaż rejestrowany, podręczny, sprzęt?' ) ),
				array( $copy( 'Occasion', 'Okazja' ), $copy( 'Business, event, airport, private?', 'Biznes, wydarzenie, lotnisko, prywatna?' ) ),
			),
		),
		'footer' => array(
			'brand_copy'          => $copy( 'Chauffeur services, executive transportation and luxury concierge in Warsaw.', 'Usługi szoferskie, transport reprezentacyjny i concierge w Warszawie.' ),
			'tagline'             => 'Own the moment',
			'navigation'          => $copy( 'Navigation', 'Nawigacja' ),
			'contact_heading'     => $copy( 'Contact', 'Kontakt' ),
			'location'            => $copy( 'Warsaw, Poland', 'Warszawa' ),
			'contact_placeholder' => '[Insert verified phone]',
		),
	);
}

/**
 * Confirmed passenger and luggage capacity per vehicle id.
 *
 * Single source for Home and Fleet. Capacities are still unconfirmed client
 * data: keep null until confirmed, then set a number or short string, for
 * example 'passengers' => 3. Null, empty or non-scalar values render as TBC.
 *
 * @return array<string, array{passengers: int|string|null, luggage: int|string|null}>
 */
function venix_concierge_fleet_capacity_data() {
	return array(
		'sclass'   => array(
			'passengers' => null,
			'luggage'    => null,
		),
		'eclass'   => array(
			'passengers' => null,
			'luggage'    => null,
		),
		'vclass'   => array(
			'passengers' => null,
			'luggage'    => null,
		),
		'vclassxl' => array(
			'passengers' => null,
			'luggage'    => null,
		),
		'sprinter' => array(
			'passengers' => null,
			'luggage'    => null,
		),
	);
}

/**
 * Get display-ready capacity items for a vehicle.
 *
 * @param string $vehicle_id Fleet vehicle id, for example 'sclass'.
 * @return array<int, array{key: string, label: string, value: string, confirmed: bool}>
 */
function venix_concierge_vehicle_capacity( $vehicle_id ) {
	$data        = venix_concierge_fleet_capacity_data();
	$capacity    = isset( $data[ $vehicle_id ] ) && is_array( $data[ $vehicle_id ] ) ? $data[ $vehicle_id ] : array();
	$unconfirmed = venix_concierge_language_copy( 'TBC', 'Do potw.' );
	$labels      = array(
		'passengers' => venix_concierge_language_copy( 'Passengers', 'Pasażerowie' ),
		'luggage'    => venix_concierge_language_copy( 'Luggage', 'Bagaż' ),
	);
	$items       = array();

	foreach ( $labels as $key => $label ) {
		$value     = isset( $capacity[ $key ] ) && is_scalar( $capacity[ $key ] ) ? trim( (string) $capacity[ $key ] ) : '';
		$confirmed = '' !== $value;

		$items[] = array(
			'key'       => $key,
			'label'     => $label,
			'value'     => $confirmed ? $value : $unconfirmed,
			'confirmed' => $confirmed,
		);
	}

	return $items;
}
