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
	$copy = static function ( $english, $polish, $russian = null ) {
		return venix_concierge_language_copy( $english, $polish, $russian );
	};

	return array(
		'hero' => array(
			'eyebrow' => $copy( 'Warsaw, Poland · Chauffeur & Concierge', 'Warszawa · Szofer i concierge', 'Варшава · Водитель и консьерж-сервис' ),
			'title'    => $copy( 'Every journey, handled with precision', 'Każda podróż, dopracowana z precyzją', 'Каждая поездка — выверена до мелочей' ),
			'lead'     => $copy( 'Private chauffeur services, executive transportation and coordinated mobility for events and delegations — in Warsaw and beyond.', 'Prywatne usługi szoferskie, transport dla kadry zarządzającej oraz skoordynowana mobilność dla wydarzeń i delegacji — w Warszawie i poza nią.', 'Услуги персонального водителя, деловые трансферы и транспортная координация для мероприятий и делегаций — в Варшаве и за её пределами.' ),
			'primary'  => $copy( 'Request a chauffeur', 'Zamów szofera', 'Заказать водителя' ),
			'secondary'=> $copy( 'Explore the fleet', 'Poznaj flotę', 'Познакомиться с автопарком' ),
			'caption'  => $copy( 'Operating since 2024 · Private · Corporate · Diplomatic', 'Działamy od 2024 · Klienci prywatni · Firmy · Dyplomacja', 'Работаем с 2024 года · Частные клиенты · Компании · Дипломатические миссии' ),
		),
		'intro' => array(
			'eyebrow' => $copy( 'Venix Concierge · Warsaw', 'Venix Concierge · Warsaw', 'Venix Concierge · Варшава' ),
			'title'    => $copy( 'More than transportation. A service shaped around you.', 'Więcej niż transport. Usługa zbudowana wokół Państwa.', 'Больше, чем перевозка. Сервис, выстроенный вокруг Вас.' ),
			'copy'     => $copy( 'Venix Concierge is a Warsaw-based chauffeur and concierge company, coordinating private journeys, executive transportation, airport transfers and the movement of delegations and events with precision, discretion and personal attention.', 'Venix Concierge to warszawska firma szoferska i concierge, działająca od 2024 roku. Koordynujemy podróże prywatne, transport dla kadry zarządzającej, transfery lotniskowe oraz obsługę delegacji i wydarzeń — z precyzją, dyskrecją i osobistą uwagą na każdym etapie.', 'Venix Concierge — варшавская компания, предоставляющая услуги персонального водителя и консьерж-сервис. Мы организуем частные поездки, деловые трансферы, встречу и проводы в аэропортах, а также транспортное сопровождение делегаций и мероприятий — точно, конфиденциально и с личным вниманием.' ),
			'closing'  => $copy( 'We handle the details so you can focus on what matters.', 'Zajmujemy się szczegółami, aby mogli Państwo skupić się na tym, co ważne.', 'Мы берём детали на себя — чтобы Вы могли сосредоточиться на главном.' ),
			'cta'      => $copy( 'Begin your arrangement', 'Rozpocznij ustalenia', 'Оставить запрос' ),
		),
		'services' => array(
			'eyebrow' => $copy( 'What we arrange', 'Co organizujemy', 'Что мы организуем' ),
			'title'    => $copy( 'Main services', 'Usługi główne', 'Основные услуги' ),
			'link'     => $copy( 'Make an enquiry', 'Wyślij zapytanie', 'Отправить запрос' ),
		),
		'cards' => array(
			array( $copy( 'Chauffeur-driven transfers & private hire', 'Transfery z szoferem i wynajem prywatny', 'Персональный водитель и частные трансферы' ), $copy( 'A professional chauffeur and premium vehicle, arranged around your itinerary — hourly, full-day, city-to-city, or custom.', 'Profesjonalny szofer i pojazd klasy premium, dopasowane do Państwa planu — na godziny, cały dzień, między miastami lub na zamówienie.', 'Профессиональный водитель и автомобиль премиум-класса — под Ваш маршрут и график: почасово, на весь день, между городами или по индивидуальной программе.' ), $copy( 'Private clients · Executives', 'Klienci prywatni · Kadra zarządzająca', 'Частные клиенты · Руководители' ), $copy( 'Request a private transfer', 'Zamów transfer prywatny', 'Заказать частный трансфер' ) ),
			array( $copy( 'Airport transfers', 'Transfery lotniskowe', 'Трансфер из аэропорта и в аэропорт' ), $copy( "Composed arrivals and departures at Warsaw's airports, with the vehicle matched to passengers and luggage. Groups and multi-vehicle arrangements available.", 'Spokojne przyloty i wyloty na warszawskich lotniskach, z pojazdem dobranym do liczby pasażerów i bagażu. Obsługa grup i wielu pojazdów możliwa.', 'Спокойная встреча и проводы в аэропортах Варшавы; автомобиль подбирается с учётом числа пассажиров и багажа. Возможна организация трансферов для групп на нескольких автомобилях.' ), $copy( 'Travellers · Families · Groups', 'Podróżni · Rodziny · Grupy', 'Путешественники · Семьи · Группы' ), $copy( 'Arrange an airport transfer', 'Umów transfer lotniskowy', 'Заказать трансфер в аэропорт' ) ),
			array( $copy( 'Business & private events', 'Wydarzenia biznesowe i prywatne', 'Деловые и частные мероприятия' ), $copy( 'Coordinated guest movement for conferences, galas and private celebrations — multiple vehicles, single point of contact, precise timing.', 'Skoordynowany transport gości na konferencje, gale i uroczystości — wiele pojazdów, jeden punkt kontaktu, precyzyjne terminy.', 'Координация перевозки гостей на конференции, приёмы и частные торжества: несколько автомобилей, единый координатор, чёткий график.' ), $copy( 'Organisers · Companies · Hosts', 'Organizatorzy · Firmy · Gospodarze', 'Организаторы · Компании · Хозяева мероприятий' ), $copy( 'Plan event transportation', 'Zaplanuj transport na wydarzenie', 'Спланировать транспорт для мероприятия' ) ),
			array( $copy( 'Delegations & diplomatic transfers', 'Delegacje i transfery dyplomatyczne', 'Делегации и дипломатические трансферы' ), $copy( 'Discreet, punctual transportation for embassies, delegations and official guests, coordinated with your appointed team.', 'Dyskretny, punktualny transport dla ambasad, delegacji i gości oficjalnych, koordynowany z wyznaczonym zespołem.', 'Деликатная и пунктуальная перевозка сотрудников посольств, делегаций и официальных гостей — в координации с назначенной Вами командой.' ), $copy( 'Embassies · Delegations · Officials', 'Ambasady · Delegacje · Goście oficjalni', 'Посольства · Делегации · Официальные лица' ), $copy( 'Discuss a delegation', 'Omów potrzeby delegacji', 'Обсудить поездку делегации' ) ),
		),
		'pillars' => array(
			array( $copy( 'Precision in every detail', 'Precyzja w każdym szczególe', 'Точность в каждой детали' ), $copy( 'From pickup to destination, each journey is carefully coordinated.', 'Od odbioru po cel — każdy przejazd starannie skoordynowany.', 'От подачи автомобиля до пункта назначения каждая поездка продумана и скоординирована.' ) ),
			array( $copy( 'Discretion you can rely on', 'Dyskrecja, na której można polegać', 'Конфиденциальность, на которую можно положиться' ), $copy( 'Privacy and professional conduct are central to every service.', 'Prywatność i profesjonalizm są podstawą każdej usługi.', 'Неприкосновенность частной жизни и профессиональная этика — основа каждой услуги.' ) ),
			array( $copy( 'Clear communication', 'Jasna komunikacja', 'Ясная коммуникация' ), $copy( 'Straightforward information and a clearly managed inquiry process.', 'Przejrzyste informacje i czytelny proces zapytania.', 'Понятная информация и прозрачный порядок обработки запроса.' ) ),
			array( $copy( 'Service that adapts', 'Usługa, która się dostosowuje', 'Гибкость сервиса' ), $copy( 'When requirements change, the team responds calmly and works to accommodate the new plan.', 'Gdy plany się zmieniają, zespół reaguje spokojnie.', 'Если планы меняются, команда реагирует спокойно и старается учесть новые условия.' ) ),
			array( $copy( 'A personal approach', 'Indywidualne podejście', 'Персональный подход' ), $copy( 'Every request is handled according to the client\'s individual needs.', 'Każde zapytanie prowadzimy zgodnie z indywidualnymi potrzebami.', 'Каждый запрос ведётся с учётом индивидуальных потребностей клиента.' ) ),
			array( $copy( 'International understanding', 'Międzynarodowe zrozumienie', 'Понимание международной среды' ), $copy( 'Designed for clients from different cultures, industries and backgrounds.', 'Usługa dla klientów z różnych kultur i środowisk.', 'Сервис рассчитан на клиентов из разных культур, отраслей и профессиональных сред.' ) ),
		),
		'why' => array(
			'eyebrow' => $copy( 'Why Venix Concierge', 'Dlaczego Venix Concierge', 'Почему Venix Concierge' ),
			'title'    => $copy( 'The standards behind the service', 'Standardy, które za nami stoją', 'Принципы, на которых строится сервис' ),
		),
		'process_heading' => array(
			'eyebrow' => $copy( 'How it works', 'Jak to działa', 'Как это устроено' ),
			'title'    => $copy( 'From request to arrival', 'Od zapytania do przyjazdu', 'От запроса до прибытия' ),
		),
		'extras_heading' => array(
			'eyebrow'    => $copy( 'Beyond the journey', 'Poza samą podróżą', 'Больше, чем поездка' ),
			'title'      => $copy( 'Other services', 'Inne usługi', 'Дополнительные услуги' ),
			'link'       => $copy( 'Inquire', 'Zapytaj', 'Запросить' ),
			'disclaimer' => $copy( 'Selected specialist services are coordinated through authorised partners and are subject to assessment, availability, licensing requirements and applicable regulations. [Confirm service partner arrangements]', 'Wybrane usługi specjalistyczne koordynujemy z autoryzowanymi partnerami; podlegają one ocenie, dostępności, wymogom licencyjnym i obowiązującym przepisom. [Do potwierdzenia: ustalenia partnerskie]', 'Отдельные специализированные услуги организуются через уполномоченных партнёров и зависят от оценки задачи, наличия, лицензионных требований и действующего законодательства. [Требует подтверждения: условия работы с партнёрами]' ),
		),
		'process' => array(
			array( '01', $copy( 'Share your requirements', 'Przekaż wymagania', 'Расскажите о задаче' ), $copy( 'Provide the journey, date, passengers, vehicle preference and any special requirements.', 'Prosimy o trasę, datę, liczbę pasażerów, preferencje pojazdu i wymagania specjalne.', 'Укажите маршрут, дату, число пассажиров, пожелания к автомобилю и особые условия.' ) ),
			array( '02', $copy( 'Receive a tailored proposal', 'Otrzymaj dopasowaną propozycję', 'Получите индивидуальное предложение' ), $copy( 'We review the request and prepare an appropriate service recommendation.', 'Analizujemy zapytanie i przygotowujemy rekomendację.', 'Мы изучим запрос и подготовим подходящее решение.' ) ),
			array( '03', $copy( 'Confirm the arrangement', 'Potwierdź ustalenia', 'Подтвердите договорённости' ), $copy( 'Once approved, every journey detail is confirmed in writing.', 'Po akceptacji wszystkie szczegóły zostają potwierdzone na piśmie.', 'После согласования все детали поездки подтверждаются в письменном виде.' ) ),
			array( '04', $copy( 'Travel with confidence', 'Podróżuj z pewnością', 'Отправляйтесь в путь спокойно' ), $copy( 'The service is carried out with professional care, discretion and attention to detail.', 'Usługę realizujemy z profesjonalną starannością i dyskrecją.', 'Услуга выполняется с профессиональной тщательностью, конфиденциальностью и вниманием к деталям.' ) ),
		),
		'extras' => array(
			array( $copy( 'Private protection', 'Ochrona osobista', 'Личная охрана' ), $copy( 'Coordination of professional security arrangements through authorised providers.', 'Koordynacja ochrony przez autoryzowane podmioty.', 'Организация профессиональных мер безопасности через уполномоченных исполнителей.' ) ),
			array( $copy( 'Private flights', 'Loty prywatne', 'Частные авиаперелёты' ), $copy( 'Charter inquiry assistance and seamless ground-to-air coordination.', 'Wsparcie przy czarterze i transport naziemny.', 'Содействие в оформлении чартерных запросов и согласованная наземная логистика.' ) ),
			array( $copy( 'Embassy services', 'Obsługa ambasad', 'Обслуживание посольств' ), $copy( 'Transportation and scheduling support for official visitors and embassy guests.', 'Transport i logistyka dla gości oficjalnych i ambasad.', 'Транспорт и организация графика для официальных визитёров и гостей посольств.' ) ),
			array( $copy( 'Concierge services', 'Usługi concierge', 'Консьерж-сервис' ), $copy( 'Personal arrangements surrounding your visit — reservations, itineraries, special requests.', 'Osobiste ustalenia wokół Państwa wizyty.', 'Личные поручения на время визита: бронирования, программа пребывания, особые пожелания.' ) ),
			array( $copy( 'Weddings', 'Śluby i wesela', 'Свадьбы' ), $copy( 'Elegant, precisely timed transportation for couples, families and guests.', 'Eleganckie, punktualne przejazdy dla pary młodej i gości.', 'Элегантный транспорт, рассчитанный по минутам, для молодожёнов, семей и гостей.' ) ),
		),
		'fleet' => array(
			'eyebrow' => $copy( 'The fleet', 'Flota', 'Автопарк' ),
			'title'    => $copy( 'Matched to the journey', 'Dobrana do podróży', 'Автомобиль — под поездку' ),
			'copy'     => $copy( 'The right vehicle is not simply a matter of size — it should match the journey, the passengers and the occasion.', 'Właściwy pojazd to nie tylko kwestia wielkości — powinien odpowiadać podróży, pasażerom i okazji.', 'Подходящий автомобиль определяется не только размером: он должен соответствовать маршруту, пассажирам и поводу.' ),
			'note'     => $copy( 'Model, configuration and colour may vary.', 'Model, konfiguracja i kolor mogą się różnić.', 'Модель, комплектация и цвет могут отличаться.' ),
			'featured_id' => 'sclass',
			'vehicle_ids' => array( 'eclass', 'vclass', 'sprinter' ),
			'featured' => array( $copy( 'Flagship sedan', 'Flagowy sedan', 'Флагманский седан' ), $copy( 'Executive · VIP', 'Executive · VIP', 'Представительский · VIP' ), 'Mercedes-Benz S-Class', $copy( 'The flagship choice for executive and diplomatic travel, important private occasions and VIP airport arrivals. An environment of quiet distinction and precise comfort.', 'Flagowy wybór dla podróży przedstawicielskich i dyplomatycznych, ważnych okazji prywatnych oraz przylotów VIP. Środowisko cichej elegancji i precyzyjnego komfortu.', 'Флагманский выбор для деловых и дипломатических поездок, важных частных событий и VIP-встреч в аэропорту. Атмосфера сдержанной элегантности и выверенного комфорта.' ), $copy( 'Request the S-Class', 'Zamów S-Klasa', 'Заказать S-Class' ) ),
			'vehicles' => array(
				array( $copy( 'Executive sedan', 'Sedan biznesowy', 'Бизнес-седан' ), 'Mercedes-Benz E-Class', $copy( 'Premium business travel, corporate airport transfers and daily chauffeur requirements. Refined, discreet and dependable.', 'Transport biznesowy klasy premium, korporacyjne transfery lotniskowe i codzienna obsługa szoferska. Elegancki, dyskretny i niezawodny.', 'Деловые поездки премиум-класса, корпоративные трансферы в аэропорт и ежедневное обслуживание водителем. Респектабельный, сдержанный и надёжный.' ), $copy( 'Request the E-Class', 'Zamów E-Klasa', 'Заказать E-Class' ) ),
				array( 'SHORT · LONG · XL', 'Mercedes-Benz V-Class', $copy( 'Families, executive teams and small groups travelling together — airport transfers, city journeys and event transport.', 'Rodziny, zespoły i mniejsze grupy podróżujące razem — transfery lotniskowe, przejazdy miejskie i transport na wydarzenia.', 'Для семей, управленческих команд и небольших групп, путешествующих вместе: трансферы из аэропорта, поездки по городу, перевозка гостей на мероприятия.' ), $copy( 'Request the V-Class', 'Zamów V-Klasa', 'Заказать V-Class' ) ),
				array( $copy( '9 · 16 · 19 seats', '9 · 16 · 19 miejsc', '9 · 16 · 19 мест' ), 'Mercedes-Benz Sprinter', $copy( 'Group transportation for conferences, delegations, weddings and events — available in 9, 16 and 19-seat configurations.', 'Transport grupowy na konferencje, delegacje, śluby i wydarzenia — dostępny w konfiguracji na 9, 16 i 19 miejsc.', 'Групповые перевозки для конференций, делегаций, свадеб и мероприятий — в конфигурациях на 9, 16 и 19 мест.' ), $copy( 'Discuss group transport', 'Omów transport grupowy', 'Обсудить групповую перевозку' ) ),
			),
			'helper_title' => $copy( 'Not sure which vehicle is right?', 'Nie wiedzą Państwo, który pojazd będzie odpowiedni?', 'Не уверены, какой автомобиль подойдёт?' ),
			'helper_copy'  => $copy( 'Tell us about your journey, passengers and luggage. We will recommend the appropriate arrangement.', 'Prosimy podać liczbę pasażerów, bagaż i trasę — nasz zespół zarekomenduje właściwy pojazd.', 'Расскажите о поездке, пассажирах и багаже — мы порекомендуем подходящий вариант.' ),
			'helper_cta'   => $copy( 'Ask for a recommendation', 'Otrzymaj rekomendację', 'Получить рекомендацию' ),
		),
		'events' => array(
			'eyebrow' => $copy( 'Events & delegations', 'Wydarzenia i delegacje', 'Мероприятия и делегации' ),
			'title'   => $copy( 'When every arrival matters, coordination becomes part of the experience', 'Gdy liczy się każdy przyjazd, koordynacja staje się częścią doświadczenia', 'Когда важно каждое прибытие, координация становится частью впечатления' ),
			'copy'    => $copy( 'For conferences, official visits, weddings and multi-day programmes, we plan and manage the movement of guests, executives and delegations — with one responsible point of contact.', 'Przy konferencjach, wizytach oficjalnych, ślubach i programach wielodniowych planujemy i prowadzimy przejazdy gości, kadry i delegacji — z jednym odpowiedzialnym punktem kontaktu.', 'Для конференций, официальных визитов, свадеб и многодневных программ мы планируем и ведём перевозки гостей, руководителей и делегаций — с одним ответственным координатором.' ),
			'points'  => array(
				$copy( 'Airport & hotel transfers', 'Transfery lotniskowe i hotelowe', 'Трансферы между аэропортом и отелем' ),
				$copy( 'Guest schedules & pickups', 'Harmonogramy i odbiory gości', 'Графики и встреча гостей' ),
				$copy( 'Conference transportation', 'Transport konferencyjny', 'Транспорт для конференций' ),
				$copy( 'Embassy & delegation movements', 'Przejazdy ambasad i delegacji', 'Перемещения посольств и делегаций' ),
				$copy( 'Multi-vehicle coordination', 'Koordynacja wielu pojazdów', 'Координация нескольких автомобилей' ),
				$copy( 'On-site coordination, when arranged', 'Koordynacja na miejscu — po uzgodnieniu', 'Координация на месте — по договорённости' ),
			),
			'cta' => $copy( 'Discuss your requirements', 'Omów swoje potrzeby', 'Обсудить задачу' ),
		),
		'audience' => array(
			'eyebrow' => $copy( 'Who we serve', 'Komu służymy', 'Для кого наш сервис' ),
			'title'   => $copy( 'A service shaped for those who expect more', 'Usługa stworzona dla wymagających', 'Сервис для тех, кто ждёт большего' ),
			'items'   => array(
				array( $copy( 'Private travellers', 'Klienci prywatni', 'Частные клиенты' ), $copy( 'Individuals seeking refined, discreet transportation for private and leisure journeys.', 'Osoby poszukujące eleganckiego, dyskretnego transportu prywatnego.', 'Для тех, кто ценит безупречный и неброский транспорт для частных и отпускных поездок.' ) ),
				array( $copy( 'Executives', 'Kadra zarządzająca', 'Руководители' ), $copy( 'Senior leaders who require precise, private travel arrangements and personal attention.', 'Liderzy wymagający precyzyjnych, prywatnych ustaleń podróżniczych.', 'Топ-менеджеры, которым нужна точная организация поездок и персональное внимание.' ) ),
				array( $copy( 'Companies', 'Firmy', 'Компании' ), $copy( 'Corporate teams, travel managers and executive assistants coordinating business travel.', 'Firmy, menedżerowie podróży i asystenci koordynujący transport służbowy.', 'Корпоративные команды, тревел-менеджеры и ассистенты руководителей, организующие деловые поездки.' ) ),
				array( $copy( 'Embassies', 'Ambasady', 'Посольства' ), $copy( 'Diplomatic missions and consular staff requiring discreet, protocol-aware transportation.', 'Misje dyplomatyczne i personel konsularny wymagający dyskretnego transportu.', 'Дипломатические представительства и консульские сотрудники, которым нужен деликатный транспорт с учётом протокола.' ) ),
				array( $copy( 'Delegations', 'Delegacje', 'Делегации' ), $copy( 'Official groups, government representatives and international organisations visiting Warsaw.', 'Grupy oficjalne, przedstawiciele rządowi i organizacje międzynarodowe w Warszawie.', 'Официальные группы, представители государственных органов и международных организаций, приезжающие в Варшаву.' ) ),
				array( $copy( 'Event organisers', 'Organizatorzy wydarzeń', 'Организаторы мероприятий' ), $copy( 'Conference, gala and celebration coordinators managing multi-vehicle guest transport.', 'Organizatorzy konferencji, gal i uroczystości zarządzający transportem gości.', 'Координаторы конференций, приёмов и торжеств, которым необходима перевозка гостей на нескольких автомобилях.' ) ),
				array( $copy( 'Hotels & hospitality', 'Hotele i branża hotelarska', 'Отели и гостиничный бизнес' ), $copy( 'Hospitality partners and their distinguished guests requiring seamless arrival arrangements.', 'Partnerzy hotelarscy i ich wymagający goście oczekujący płynnych transferów.', 'Партнёры из гостиничной сферы и их почётные гости, для которых важен безупречный приезд.' ) ),
				array( $copy( 'Wedding planners', 'Organizatorzy ślubów', 'Свадебные организаторы' ), $copy( 'Couples, families and celebration coordinators arranging elegant occasion transport.', 'Pary, rodziny i koordynatorzy uroczystości organizujący elegancki transport.', 'Молодожёны, семьи и организаторы торжеств, выбирающие элегантный транспорт для особого дня.' ) ),
				array( $copy( 'International guests', 'Goście z zagranicy', 'Иностранные гости' ), $copy( 'Visitors arriving in Warsaw from across the world who need a trusted, local partner.', 'Goście przybywający do Warszawy z całego świata szukający zaufanego partnera.', 'Гости из разных стран, приезжающие в Варшаву и нуждающиеся в надёжном местном партнёре.' ) ),
			),
			'cta' => $copy( 'Request a Chauffeur', 'Zamów szofera', 'Заказать водителя' ),
		),
		'testimonial' => array(
			'quote'       => $copy( '[Approved client testimonial to be supplied. No fabricated quotations are used in this prototype.]', '[Miejsce na zatwierdzoną opinię klienta. W prototypie nie stosujemy fikcyjnych cytatów.]', '[Здесь будет размещён утверждённый отзыв клиента. В прототипе вымышленные цитаты не используются.]' ),
			'attribution' => $copy( '[Client name & role — with permission]', '[Imię i rola klienta — za zgodą]', '[Имя и должность клиента — с согласия]' ),
		),
		'quote' => $copy( 'When every detail is considered, the journey becomes the experience.', 'Gdy każdy szczegół jest przemyślany, podróż staje się przeżyciem.', 'Когда продумана каждая деталь, сама дорога становится событием.' ),
		'promise' => array(
			'title' => $copy( 'You enjoy the moment. We handle the details.', 'Chwila należy do Państwa. Szczegóły do nas.', 'Наслаждайтесь моментом. Детали — на нас.' ),
			'copy'  => $copy( 'Behind every composed arrival is quiet, careful work — so the journey itself asks nothing of you. We coordinate the planning, the timing, the vehicle, the route, and the communication, so your focus stays where it should.', 'Za każdym spokojnym przyjazdem stoi cicha, staranna praca — tak, aby sama podróż nie wymagała od Państwa niczego. Koordynujemy planowanie, terminarz, pojazd, trasę i komunikację, by Państwa uwaga mogła pozostać tam, gdzie powinna.', 'За каждым спокойным прибытием стоит тихая, кропотливая работа — чтобы сама поездка не требовала от Вас ничего. Мы берём на себя планирование, время, автомобиль, маршрут и связь с Вами, чтобы Ваше внимание оставалось там, где оно нужнее.' ),
			'items' => array(
				array( $copy( 'Planning & timing', 'Planowanie i harmonogram', 'Планирование и тайминг' ), $copy( 'Schedules built around your day.', 'Harmonogramy budowane wokół Państwa dnia.', 'График выстраивается вокруг Вашего дня.' ) ),
				array( $copy( 'Route & flight details', 'Trasa i dane lotu', 'Маршрут и данные рейса' ), $copy( 'Journey information checked in advance.', 'Informacje weryfikowane z wyprzedzeniem.', 'Информация о поездке проверяется заранее.' ) ),
				array( $copy( 'Vehicle preparation', 'Przygotowanie pojazdu', 'Подготовка автомобиля' ), $copy( 'Every vehicle presented professionally.', 'Każdy pojazd przygotowany profesjonalnie.', 'Каждый автомобиль подаётся в безупречном виде.' ) ),
				array( $copy( 'Privacy at every stage', 'Prywatność na każdym etapie', 'Конфиденциальность на каждом этапе' ), $copy( 'Discreet conduct and confidential handling.', 'Dyskretne zachowanie i poufność.', 'Деликатное поведение и бережное обращение с информацией.' ) ),
				array( $copy( 'Clear confirmations', 'Jasne potwierdzenia', 'Чёткие подтверждения' ), $copy( 'You always know what has been arranged.', 'Zawsze wiedzą Państwo, co ustalono.', 'Вы всегда знаете, о чём достигнута договорённость.' ) ),
				array( $copy( 'Calm adaptation', 'Spokojna reakcja', 'Спокойная реакция на изменения' ), $copy( 'When plans change, we work to adapt.', 'Gdy plany się zmieniają, dostosowujemy się.', 'Когда планы меняются, мы перестраиваемся.' ) ),
			),
		),
		'form' => array(
			'eyebrow' => $copy( 'Begin the arrangement', 'Rozpocznij ustalenia', 'Оставьте запрос' ),
			'title'   => $copy( 'Tell us where you need to be. We handle the rest.', 'Prosimy powiedzieć, gdzie mają Państwo być. Resztą zajmiemy się my.', 'Скажите, куда Вам нужно попасть. Остальное — наша забота.' ),
			'lead'    => $copy( 'Share your route, schedule and requirements. Our team will review the details and reply with a tailored proposal through your preferred method of contact.', 'Prosimy o przekazanie trasy, terminu i wymagań. Nasz zespół przeanalizuje szczegóły i odpowie dopasowaną propozycją wybraną przez Państwa drogą kontaktu.', 'Укажите маршрут, время и пожелания. Наша команда изучит детали и ответит индивидуальным предложением тем способом связи, который Вам удобен.' ),
			'contact_note' => $copy( 'Warsaw, Poland · [Confirm operating area]', 'Warszawa · [Do potwierdzenia: obszar działania]', 'Варшава, Польша · [Требует подтверждения: зона обслуживания]' ),
			'fields' => array(
				array( 'home-name', $copy( 'Full Name', 'Imię i nazwisko', 'Имя и фамилия' ), 'text', 'full_name', true, 'name' ),
				array( 'home-email', $copy( 'Email Address', 'Adres e-mail', 'Адрес электронной почты' ), 'email', 'email', true, 'email' ),
				array( 'home-phone', $copy( 'Phone / WhatsApp', 'Telefon / WhatsApp', 'Телефон / WhatsApp' ), 'tel', 'phone', true, 'tel' ),
				array( 'home-date', $copy( 'Pickup Date', 'Data odbioru', 'Дата подачи' ), 'date', 'pickup_date', true, '' ),
				array( 'home-passengers', $copy( 'Passengers', 'Pasażerowie', 'Количество пассажиров' ), 'number', 'passengers', false, '' ),
				array( 'home-from', $copy( 'Pickup Location', 'Miejsce odbioru', 'Место подачи автомобиля' ), 'text', 'pickup_location', true, '' ),
				array( 'home-to', $copy( 'Destination', 'Cel podróży', 'Пункт назначения' ), 'text', 'destination', false, '' ),
			),
			'optional_suffix' => $copy( '(optional)', '(opcjonalnie)', '(необязательно)' ),
			'service_label' => $copy( 'Required Service', 'Rodzaj usługi', 'Необходимая услуга' ),
			'service' => array(
				$copy( 'Select a service…', 'Proszę wybrać usługę…', 'Выберите услугу…' ),
				$copy( 'Private transfer / chauffeur hire', 'Transfer prywatny / wynajem szofera', 'Частный трансфер / персональный водитель' ),
				$copy( 'Airport transfer', 'Transfer lotniskowy', 'Трансфер из аэропорта / в аэропорт' ),
				$copy( 'Event transportation', 'Transport na wydarzenie', 'Транспорт для мероприятия' ),
				$copy( 'Delegation / diplomatic transfer', 'Delegacja / transfer dyplomatyczny', 'Делегация / дипломатический трансфер' ),
				$copy( 'Wedding transportation', 'Transport ślubny', 'Свадебный транспорт' ),
				$copy( 'Concierge assistance', 'Usługi concierge', 'Консьерж-сервис' ),
				$copy( 'Other / custom quotation', 'Inne / indywidualna wycena', 'Другое / индивидуальный расчёт' ),
			),
			'message_label' => $copy( 'Message or Special Requirements (optional)', 'Wiadomość lub wymagania specjalne (opcjonalnie)', 'Сообщение или особые пожелания (необязательно)' ),
			'consent'       => $copy( 'I confirm I have read and agree to the Privacy Policy and consent to Venix Concierge processing my details to respond to this inquiry.', 'Potwierdzam, że zapoznałem/am się z Polityką prywatności i wyrażam zgodę na przetwarzanie moich danych przez Venix Concierge w celu udzielenia odpowiedzi na to zapytanie.', 'Подтверждаю, что ознакомился(-лась) с Политикой конфиденциальности и даю согласие на обработку моих данных компанией Venix Concierge для ответа на этот запрос.' ),
			'status'        => $copy( 'Prototype — form submissions are simulated.', 'Prototyp — wysyłka formularza jest symulowana.', 'Прототип: отправка формы имитируется.' ),
			'submit_placeholder' => $copy( 'Form setup pending', 'Form setup pending', 'Форма в настройке' ),
		),
		// Default slot alt text: used only when neither a page-slot alt override nor a Media Library alt exists.
		'media_alt' => array(
			'about'   => $copy( 'A chauffeur beside a premium vehicle in Warsaw.', 'Szofer obok luksusowego samochodu w Warszawie.', 'Водитель рядом с автомобилем премиум-класса в Варшаве.' ),
			'promise' => $copy( 'A chauffeur adjusting cufflinks.', 'Szofer poprawiający spinki do mankietów.', 'Водитель поправляет запонки.' ),
			's_class' => $copy( 'Mercedes-Benz S-Class.', 'Mercedes-Benz Klasy S.', 'Mercedes-Benz S-Class.' ),
			'events'  => $copy( 'Event and delegation transportation in Warsaw.', 'Transport na wydarzenia i dla delegacji w Warszawie.', 'Транспорт для мероприятий и делегаций в Варшаве.' ),
		),
	);
}
