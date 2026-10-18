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
	$copy = static function ( $english, $polish, $russian = null ) {
		return venix_concierge_language_copy( $english, $polish, $russian );
	};

	return array(
		'hero' => array(
			'eyebrow' => $copy( 'About Venix Concierge', 'O Venix Concierge', 'О компании Venix Concierge' ),
			'title'    => $copy( 'Luxury service, built on trust', 'Usługa klasy premium, zbudowana na zaufaniu', 'Сервис высокого уровня, построенный на доверии' ),
		),
		'story' => array(
			'eyebrow' => $copy( 'Our story', 'Nasza historia', 'Наша история' ),
			'title'    => $copy( 'A deliberate beginning', 'Świadomy początek', 'Осознанное начало' ),
			'copy'     => $copy( 'Venix Concierge began in Warsaw in 2024 with a deliberate intention: to offer private and professional clients a more seamless, precise and personal way to move through the city and beyond. We understood from the outset that premium transportation was not simply about the vehicle. It was about reliability, discretion and the confidence that every detail had been considered before the journey began.', 'Venix Concierge powstało w Warszawie w 2024 roku z jasnym zamysłem: zaoferować klientom prywatnym i profesjonalnym bardziej płynny, precyzyjny i osobisty sposób przemieszczania się po mieście i poza nim. Od początku rozumieliśmy, że transport klasy premium to nie tylko kwestia pojazdu — chodzi o niezawodność, dyskrecję i pewność, że każdy szczegół został przemyślany zanim podróż się rozpocznie.', 'Venix Concierge появилась в Варшаве в 2024 году с чёткой целью: предложить частным и деловым клиентам более удобный, точный и персональный способ передвигаться по городу и за его пределами. С самого начала мы понимали, что премиальный транспорт — это не только автомобиль. Это надёжность, конфиденциальность и уверенность в том, что каждая деталь продумана ещё до начала поездки.' ),
			'supporting_copy' => $copy( 'We are building a reputation through consistent, careful execution — one well-managed journey at a time. Our ambition is to grow into a trusted presence across Europe, carrying the same standards wherever we operate.', 'Reputację budujemy konsekwentną, staranną realizacją — każdą dobrze prowadzoną podróżą. Naszą ambicją jest stanie się zaufaną marką w całej Europie, zachowując te same standardy wszędzie, gdzie działamy.', 'Репутацию мы строим на последовательной и аккуратной работе — поездка за поездкой. Наша цель — стать надёжным именем в Европе, сохраняя одни и те же стандарты везде, где мы работаем.' ),
		),
		'pmv' => array(
			'eyebrow' => $copy( 'Our foundation', 'Nasze fundamenty', 'Наши основы' ),
			'title'    => $copy( 'Purpose, mission & vision', 'Cel, misja i wizja', 'Цель, миссия и видение' ),
			'items'    => array(
				array( $copy( 'Purpose', 'Cel', 'Цель' ), $copy( 'Bridges of connection', 'Mosty porozumienia', 'Мосты взаимопонимания' ), $copy( 'To build meaningful connections between cultures and promote the exchange of noble human values through attentive, high-quality service.', 'Budowanie znaczących połączeń między kulturami i promowanie wymiany szlachetnych ludzkich wartości poprzez uważną, wysokiej jakości obsługę.', 'Выстраивать содержательные связи между культурами и способствовать обмену подлинными человеческими ценностями через внимательный сервис высокого качества.' ) ),
				array( $copy( 'Mission', 'Misja', 'Миссия' ), $copy( 'Luxury made effortless', 'Luksus bez wysiłku', 'Высокий уровень — без лишних усилий' ), $copy( 'To remove the practical barriers that prevent clients from experiencing luxury with ease — handling the complexity so they do not have to.', 'Usunięcie praktycznych barier uniemożliwiających klientom korzystanie z luksusu z łatwością — przejęcie złożoności, by oni tego nie musieli.', 'Устранять практические препятствия, мешающие клиентам спокойно пользоваться услугами высшего уровня, — берём сложности на себя, чтобы им не пришлось.' ) ),
				array( $copy( 'Vision', 'Wizja', 'Видение' ), $copy( 'A trusted European presence', 'Zaufana obecność w Europie', 'Надёжное присутствие в Европе' ), $copy( 'To grow into one of Europe\'s most trusted luxury-service providers, maintaining rigorous international standards at every stage of that journey.', 'Stanie się jednym z najbardziej zaufanych dostawców usług luksusowych w Europie, zachowując rygorystyczne standardy na każdym etapie tej drogi.', 'Стать одним из самых надёжных поставщиков услуг премиум-класса в Европе, сохраняя строгие международные стандарты на каждом этапе пути.' ) ),
			),
		),
		'approach' => array(
			'eyebrow' => $copy( 'How we work', 'Jak pracujemy', 'Как мы работаем' ),
			'title'    => $copy( 'Our approach to every arrangement', 'Nasze podejście do każdego zlecenia', 'Наш подход к каждому заказу' ),
			'copy'     => $copy( 'Every engagement — whether a single airport transfer or a multi-day delegation programme — follows the same discipline. We listen first, then plan, communicate, and deliver.', 'Każde zlecenie — od pojedynczego transferu lotniskowego po wielodniowy program delegacji — podlega tej samej dyscyplinie. Najpierw słuchamy, potem planujemy, komunikujemy i realizujemy.', 'Каждый заказ — будь то один трансфер из аэропорта или многодневная программа для делегации — выполняется по единым принципам. Сначала мы слушаем, затем планируем, согласовываем и исполняем.' ),
			'items'    => array(
				array( '1', $copy( 'Listen carefully', 'Słuchaj uważnie', 'Слушаем внимательно' ), $copy( 'We begin with your requirements, not our assumptions. Every arrangement starts with a clear understanding of what you need.', 'Zaczynamy od Państwa wymagań, nie naszych założeń. Każde zlecenie zaczyna się od jasnego zrozumienia tego, czego potrzebują Państwo.', 'Мы начинаем с Ваших требований, а не с собственных предположений. Каждый заказ начинается с ясного понимания того, что Вам нужно.' ) ),
				array( '2', $copy( 'Plan precisely', 'Planuj precyzyjnie', 'Планируем точно' ), $copy( 'Schedules, routes and vehicle selections are prepared thoughtfully and confirmed in advance.', 'Harmonogramy, trasy i dobór pojazdów są przygotowywane starannie i potwierdzane z wyprzedzeniem.', 'Графики, маршруты и выбор автомобилей готовятся продуманно и подтверждаются заранее.' ) ),
				array( '3', $copy( 'Communicate clearly', 'Komunikuj przejrzyście', 'Общаемся ясно' ), $copy( 'Confirmations are straightforward. The next step is always visible. We do not leave clients wondering.', 'Potwierdzenia są proste. Następny krok jest zawsze widoczny. Nie pozostawiamy klientów w niepewności.', 'Подтверждения понятны. Следующий шаг всегда очевиден. Мы не оставляем клиентов в неведении.' ) ),
				array( '4', $copy( 'Protect privacy', 'Chroń prywatność', 'Бережём конфиденциальность' ), $copy( 'Discretion is not optional — it is the standard. Journey information is handled with care and confidentiality.', 'Dyskrecja nie jest opcjonalna — to standard. Informacje o podróży są traktowane z troską i poufnością.', 'Деликатность — не опция, а стандарт. Сведения о поездке мы храним и используем бережно и конфиденциально.' ) ),
				array( '5', $copy( 'Adapt calmly', 'Adaptuj spokojnie', 'Спокойно подстраиваемся' ), $copy( 'When plans change, we respond professionally and work to accommodate the revised arrangement wherever possible.', 'Gdy plany się zmieniają, reagujemy profesjonalnie i staramy się dostosować zmienione ustalenia, gdy tylko jest to możliwe.', 'Когда планы меняются, мы действуем профессионально и, где возможно, учитываем обновлённые договорённости.' ) ),
				array( '6', $copy( 'Deliver professionally', 'Realizuj profesjonalnie', 'Выполняем профессионально' ), $copy( 'Every journey is carried out with care, composure and attention to the details that matter.', 'Każda podróż jest realizowana z troską, spokojem i dbałością o szczegóły, które mają znaczenie.', 'Каждая поездка проходит с заботой, самообладанием и вниманием к важным деталям.' ) ),
			),
		),
		'values' => array(
			'eyebrow' => $copy( 'What we stand for', 'Nasze wartości', 'Наши ценности' ),
			'title'    => $copy( 'Our values in practice', 'Wartości w praktyce', 'Ценности на практике' ),
			'items'    => array(
				array( $copy( 'Value 01', 'Wartość 01', 'Ценность 01' ), $copy( 'Work together, lift each other up', 'Współpracuj, wspieraj innych', 'Работать вместе и поддерживать друг друга' ), $copy( 'Respectful, empathetic and collaborative — with clients, partners and colleagues. We treat every person as an individual, not a booking reference.', 'Z szacunkiem, empatią i we współpracy — z klientami, partnerami i współpracownikami. Każdą osobę traktujemy indywidualnie.', 'С уважением, чуткостью и в духе сотрудничества — с клиентами, партнёрами и коллегами. Для нас каждый человек — личность, а не номер заказа.' ) ),
				array( $copy( 'Value 02', 'Wartość 02', 'Ценность 02' ), $copy( 'Own it, trust yourself, inspire others', 'Bierz odpowiedzialność, inspiruj', 'Отвечать за результат, доверять себе, вдохновлять других' ), $copy( 'Clear accountability for every inquiry. Confident recommendations. Proactive problem-solving. We own the arrangement from start to finish.', 'Jasna odpowiedzialność za każde zapytanie. Pewne rekomendacje. Proaktywne rozwiązywanie problemów. Bierzemy pełną odpowiedzialność.', 'Чёткая ответственность за каждый запрос. Уверенные рекомендации. Инициативное решение проблем. Мы ведём заказ от начала до конца.' ) ),
				array( $copy( 'Value 03', 'Wartość 03', 'Ценность 03' ), $copy( 'Deliver with precision', 'Realizuj z precyzją', 'Работать точно' ), $copy( 'Accurate, reliable and consistent. High standards on every assignment, regardless of scale or complexity.', 'Dokładnie, niezawodnie i konsekwentnie. Wysokie standardy przy każdym zleceniu, niezależnie od skali i złożoności.', 'Точно, надёжно, последовательно. Высокие стандарты в каждом заказе — независимо от масштаба и сложности.' ) ),
				array( $copy( 'Value 04', 'Wartość 04', 'Ценность 04' ), $copy( 'Be clear: clarity over everything', 'Jasność ponad wszystko', 'Быть понятными: ясность прежде всего' ), $copy( 'Transparent communication, honest service descriptions, no hidden steps. Clients always know what has been arranged and what comes next.', 'Przejrzysta komunikacja, rzetelne opisy usług, żadnych ukrytych kroków. Klienci zawsze wiedzą, co zostało ustalone.', 'Открытая коммуникация, честное описание услуг, никаких скрытых шагов. Клиент всегда знает, о чём договорились и что будет дальше.' ) ),
				array( $copy( 'Value 05', 'Wartość 05', 'Ценность 05' ), $copy( 'Adapt, evolve, stay ahead', 'Adaptuj, rozwijaj się, wyprzedzaj', 'Меняться, развиваться, смотреть вперёд' ), $copy( 'Responsive when plans change. Improving continuously. Forward-looking in every aspect of our service.', 'Reagujemy, gdy plany się zmieniają. Nieustannie się doskonalimy. Patrzymy w przyszłość w każdym aspekcie naszej usługi.', 'Быстро реагируем, когда планы меняются. Постоянно совершенствуемся. Смотрим вперёд во всём, что касается нашего сервиса.' ) ),
			),
		),
		'culture' => array(
			'eyebrow' => $copy( 'International service', 'Obsługa międzynarodowa', 'Международный сервис' ),
			'title'    => $copy( 'Beyond language. Cultural understanding.', 'Więcej niż język. Zrozumienie kulturowe.', 'Больше, чем язык. Понимание культур.' ),
			'copy'     => $copy( 'International service requires more than the ability to communicate in a second language. It requires cultural awareness, respect for different protocols and expectations, and the ability to adapt professional conduct to different contexts.', 'Obsługa międzynarodowa wymaga więcej niż umiejętności komunikacji w obcym języku. Wymaga świadomości kulturowej, szacunku dla różnych protokołów i oczekiwań oraz zdolności adaptacji zachowania zawodowego do różnych kontekstów.', 'Международный сервис — это не только умение говорить на другом языке. Это знание культурных особенностей, уважение к различным протоколам и ожиданиям и умение подстраивать профессиональное поведение под любые обстоятельства.' ),
			'supporting_copy' => $copy( 'Our service is designed for clients from across the world — visitors, executives, diplomats and families — each arriving with their own standards, preferences and expectations. We approach every arrangement with the awareness that different clients may require different things, and we adapt accordingly.', 'Nasza usługa jest zaprojektowana dla klientów z całego świata — odwiedzających, dyrektorów, dyplomatów i rodzin — każdy przychodzi ze swoimi standardami, preferencjami i oczekiwaniami. Każde zlecenie realizujemy ze świadomością, że różni klienci mogą potrzebować różnych rzeczy.', 'Наш сервис рассчитан на клиентов со всего мира — гостей города, руководителей, дипломатов и семьи. У каждого свои стандарты, предпочтения и ожидания. К каждому заказу мы подходим с пониманием, что разным клиентам нужно разное, и подстраиваемся под них.' ),
			'points'   => array(
				$copy( 'Respect for different protocols', 'Szacunek dla różnych protokołów', 'Уважение к различным протоколам' ),
				$copy( 'Adaptable professional conduct', 'Elastyczne zachowanie zawodowe', 'Гибкость профессионального поведения' ),
				$copy( 'Awareness of cultural expectations', 'Świadomość oczekiwań kulturowych', 'Понимание культурных ожиданий' ),
				$copy( 'Discretion in all contexts', 'Dyskrecja we wszystkich kontekstach', 'Деликатность в любой ситуации' ),
			),
		),
		'cta' => array(
			'title' => $copy( 'Your requirements are personal. The service should be too.', 'Państwa potrzeby są indywidualne. Usługa też powinna taka być.', 'Ваши потребности индивидуальны. Сервис тоже должен быть таким.' ),
			'copy'  => $copy( 'Share your journey requirements with us. Our team will review the details and prepare a considered response.', 'Prosimy podzielić się wymaganiami dotyczącymi podróży. Nasz zespół przeanalizuje szczegóły i przygotuje przemyślaną odpowiedź.', 'Расскажите нам о Вашей поездке. Наша команда изучит детали и подготовит взвешенный ответ.' ),
			'button' => $copy( 'Discuss your journey', 'Omów swoją podróż', 'Обсудить поездку' ),
		),
		// Default slot alt text: used only when neither a page-slot alt override nor a Media Library alt exists.
		// The hero is decorative and keeps an empty alt.
		'media_alt' => array(
			'story'   => $copy( 'A black Mercedes-Benz on a Warsaw boulevard in warm evening light.', 'Czarny Mercedes-Benz na warszawskim bulwarze w ciepłym wieczornym świetle.', 'Чёрный Mercedes-Benz на варшавском бульваре в тёплом вечернем свете.' ),
			'culture' => $copy( 'International travellers arriving at Warsaw airport, greeted by a Venix Concierge representative.', 'Podróżni z zagranicy przylatujący na warszawskie lotnisko, witani przez przedstawiciela Venix Concierge.', 'Гости из разных стран прилетают в аэропорт Варшавы, их встречает представитель Venix Concierge.' ),
		),
	);
}
