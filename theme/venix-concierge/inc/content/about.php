<?php
/**
 * Approved About page copy.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gets the approved copy for the About page in the current language.
 *
 * @return array<string, mixed>
 */
function venix_concierge_about_content() {
	$copy = static function ( $english, $polish ) {
		return venix_concierge_language_copy( $english, $polish );
	};

	return array(
		'hero' => array(
			'eyebrow' => $copy( 'About Venix Concierge', 'O Venix Concierge' ),
			'title'    => $copy( 'Luxury service, built on trust', 'Usługa klasy premium, zbudowana na zaufaniu' ),
		),
		'story' => array(
			'eyebrow' => $copy( 'Our story', 'Nasza historia' ),
			'title'    => $copy( 'A deliberate beginning', 'Świadomy początek' ),
			'copy'     => $copy( 'Venix Concierge began in Warsaw in 2024 with a deliberate intention: to offer private and professional clients a more seamless, precise and personal way to move through the city and beyond. We understood from the outset that premium transportation was not simply about the vehicle. It was about reliability, discretion and the confidence that every detail had been considered before the journey began.', 'Venix Concierge powstało w Warszawie w 2024 roku z jasnym zamysłem: zaoferować klientom prywatnym i profesjonalnym bardziej płynny, precyzyjny i osobisty sposób przemieszczania się po mieście i poza nim. Od początku rozumieliśmy, że transport klasy premium to nie tylko kwestia pojazdu — chodzi o niezawodność, dyskrecję i pewność, że każdy szczegół został przemyślany zanim podróż się rozpocznie.' ),
			'supporting_copy' => $copy( 'We are building a reputation through consistent, careful execution — one well-managed journey at a time. Our ambition is to grow into a trusted presence across Europe, carrying the same standards wherever we operate.', 'Reputację budujemy konsekwentną, staranną realizacją — każdą dobrze prowadzoną podróżą. Naszą ambicją jest stanie się zaufaną marką w całej Europie, zachowując te same standardy wszędzie, gdzie działamy.' ),
		),
		'pmv' => array(
			'eyebrow' => $copy( 'Our foundation', 'Nasze fundamenty' ),
			'title'    => $copy( 'Purpose, mission & vision', 'Cel, misja i wizja' ),
			'items'    => array(
				array( $copy( 'Purpose', 'Cel' ), $copy( 'Bridges of connection', 'Mosty porozumienia' ), $copy( 'To build meaningful connections between cultures and promote the exchange of noble human values through attentive, high-quality service.', 'Budowanie znaczących połączeń między kulturami i promowanie wymiany szlachetnych ludzkich wartości poprzez uważną, wysokiej jakości obsługę.' ) ),
				array( $copy( 'Mission', 'Misja' ), $copy( 'Luxury made effortless', 'Luksus bez wysiłku' ), $copy( 'To remove the practical barriers that prevent clients from experiencing luxury with ease — handling the complexity so they do not have to.', 'Usunięcie praktycznych barier uniemożliwiających klientom korzystanie z luksusu z łatwością — przejęcie złożoności, by oni tego nie musieli.' ) ),
				array( $copy( 'Vision', 'Wizja' ), $copy( 'A trusted European presence', 'Zaufana obecność w Europie' ), $copy( 'To grow into one of Europe\'s most trusted luxury-service providers, maintaining rigorous international standards at every stage of that journey.', 'Stanie się jednym z najbardziej zaufanych dostawców usług luksusowych w Europie, zachowując rygorystyczne standardy na każdym etapie tej drogi.' ) ),
			),
		),
		'approach' => array(
			'eyebrow' => $copy( 'How we work', 'Jak pracujemy' ),
			'title'    => $copy( 'Our approach to every arrangement', 'Nasze podejście do każdego zlecenia' ),
			'copy'     => $copy( 'Every engagement — whether a single airport transfer or a multi-day delegation programme — follows the same discipline. We listen first, then plan, communicate, and deliver.', 'Każde zlecenie — od pojedynczego transferu lotniskowego po wielodniowy program delegacji — podlega tej samej dyscyplinie. Najpierw słuchamy, potem planujemy, komunikujemy i realizujemy.' ),
			'items'    => array(
				array( '1', $copy( 'Listen carefully', 'Słuchaj uważnie' ), $copy( 'We begin with your requirements, not our assumptions. Every arrangement starts with a clear understanding of what you need.', 'Zaczynamy od Państwa wymagań, nie naszych założeń. Każde zlecenie zaczyna się od jasnego zrozumienia tego, czego potrzebują Państwo.' ) ),
				array( '2', $copy( 'Plan precisely', 'Planuj precyzyjnie' ), $copy( 'Schedules, routes and vehicle selections are prepared thoughtfully and confirmed in advance.', 'Harmonogramy, trasy i dobór pojazdów są przygotowywane starannie i potwierdzane z wyprzedzeniem.' ) ),
				array( '3', $copy( 'Communicate clearly', 'Komunikuj przejrzyście' ), $copy( 'Confirmations are straightforward. The next step is always visible. We do not leave clients wondering.', 'Potwierdzenia są proste. Następny krok jest zawsze widoczny. Nie pozostawiamy klientów w niepewności.' ) ),
				array( '4', $copy( 'Protect privacy', 'Chroń prywatność' ), $copy( 'Discretion is not optional — it is the standard. Journey information is handled with care and confidentiality.', 'Dyskrecja nie jest opcjonalna — to standard. Informacje o podróży są traktowane z troską i poufnością.' ) ),
				array( '5', $copy( 'Adapt calmly', 'Adaptuj spokojnie' ), $copy( 'When plans change, we respond professionally and work to accommodate the revised arrangement wherever possible.', 'Gdy plany się zmieniają, reagujemy profesjonalnie i staramy się dostosować zmienione ustalenia, gdy tylko jest to możliwe.' ) ),
				array( '6', $copy( 'Deliver professionally', 'Realizuj profesjonalnie' ), $copy( 'Every journey is carried out with care, composure and attention to the details that matter.', 'Każda podróż jest realizowana z troską, spokojem i dbałością o szczegóły, które mają znaczenie.' ) ),
			),
		),
		'values' => array(
			'eyebrow' => $copy( 'What we stand for', 'Nasze wartości' ),
			'title'    => $copy( 'Our values in practice', 'Wartości w praktyce' ),
			'items'    => array(
				array( $copy( 'Value 01', 'Wartość 01' ), $copy( 'Work together, lift each other up', 'Współpracuj, wspieraj innych' ), $copy( 'Respectful, empathetic and collaborative — with clients, partners and colleagues. We treat every person as an individual, not a booking reference.', 'Z szacunkiem, empatią i we współpracy — z klientami, partnerami i współpracownikami. Każdą osobę traktujemy indywidualnie.' ) ),
				array( $copy( 'Value 02', 'Wartość 02' ), $copy( 'Own it, trust yourself, inspire others', 'Bierz odpowiedzialność, inspiruj' ), $copy( 'Clear accountability for every inquiry. Confident recommendations. Proactive problem-solving. We own the arrangement from start to finish.', 'Jasna odpowiedzialność za każde zapytanie. Pewne rekomendacje. Proaktywne rozwiązywanie problemów. Bierzemy pełną odpowiedzialność.' ) ),
				array( $copy( 'Value 03', 'Wartość 03' ), $copy( 'Deliver with precision', 'Realizuj z precyzją' ), $copy( 'Accurate, reliable and consistent. High standards on every assignment, regardless of scale or complexity.', 'Dokładnie, niezawodnie i konsekwentnie. Wysokie standardy przy każdym zleceniu, niezależnie od skali i złożoności.' ) ),
				array( $copy( 'Value 04', 'Wartość 04' ), $copy( 'Be clear: clarity over everything', 'Jasność ponad wszystko' ), $copy( 'Transparent communication, honest service descriptions, no hidden steps. Clients always know what has been arranged and what comes next.', 'Przejrzysta komunikacja, rzetelne opisy usług, żadnych ukrytych kroków. Klienci zawsze wiedzą, co zostało ustalone.' ) ),
				array( $copy( 'Value 05', 'Wartość 05' ), $copy( 'Adapt, evolve, stay ahead', 'Adaptuj, rozwijaj się, wyprzedzaj' ), $copy( 'Responsive when plans change. Improving continuously. Forward-looking in every aspect of our service.', 'Reagujemy, gdy plany się zmieniają. Nieustannie się doskonalimy. Patrzymy w przyszłość w każdym aspekcie naszej usługi.' ) ),
			),
		),
		'culture' => array(
			'eyebrow' => $copy( 'International service', 'Obsługa międzynarodowa' ),
			'title'    => $copy( 'Beyond language. Cultural understanding.', 'Więcej niż język. Zrozumienie kulturowe.' ),
			'copy'     => $copy( 'International service requires more than the ability to communicate in a second language. It requires cultural awareness, respect for different protocols and expectations, and the ability to adapt professional conduct to different contexts.', 'Obsługa międzynarodowa wymaga więcej niż umiejętności komunikacji w obcym języku. Wymaga świadomości kulturowej, szacunku dla różnych protokołów i oczekiwań oraz zdolności adaptacji zachowania zawodowego do różnych kontekstów.' ),
			'supporting_copy' => $copy( 'Our service is designed for clients from across the world — visitors, executives, diplomats and families — each arriving with their own standards, preferences and expectations. We approach every arrangement with the awareness that different clients may require different things, and we adapt accordingly.', 'Nasza usługa jest zaprojektowana dla klientów z całego świata — odwiedzających, dyrektorów, dyplomatów i rodzin — każdy przychodzi ze swoimi standardami, preferencjami i oczekiwaniami. Każde zlecenie realizujemy ze świadomością, że różni klienci mogą potrzebować różnych rzeczy.' ),
			'points'   => array(
				$copy( 'Respect for different protocols', 'Szacunek dla różnych protokołów' ),
				$copy( 'Adaptable professional conduct', 'Elastyczne zachowanie zawodowe' ),
				$copy( 'Awareness of cultural expectations', 'Świadomość oczekiwań kulturowych' ),
				$copy( 'Discretion in all contexts', 'Dyskrecja we wszystkich kontekstach' ),
			),
		),
		'cta' => array(
			'title' => $copy( 'Your requirements are personal. The service should be too.', 'Państwa potrzeby są indywidualne. Usługa też powinna taka być.' ),
			'copy'  => $copy( 'Share your journey requirements with us. Our team will review the details and prepare a considered response.', 'Prosimy podzielić się wymaganiami dotyczącymi podróży. Nasz zespół przeanalizuje szczegóły i przygotuje przemyślaną odpowiedź.' ),
			'button' => $copy( 'Discuss your journey', 'Omów swoją podróż' ),
		),
		// Default slot alt text: used only when neither a page-slot alt override nor a Media Library alt exists.
		// The hero is decorative and keeps an empty alt.
		'media_alt' => array(
			'story'   => $copy( 'A black Mercedes-Benz on a Warsaw boulevard in warm evening light.', 'Czarny Mercedes-Benz na warszawskim bulwarze w ciepłym wieczornym świetle.' ),
			'culture' => $copy( 'International travellers arriving at Warsaw airport, greeted by a Venix Concierge representative.', 'Podróżni z zagranicy przylatujący na warszawskie lotnisko, witani przez przedstawiciela Venix Concierge.' ),
		),
	);
}
