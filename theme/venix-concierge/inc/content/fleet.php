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
	$copy = static function ( $english, $polish, $russian = null, $arabic = null ) {
		return venix_concierge_language_copy( $english, $polish, $russian, $arabic );
	};

	return array(
		'hero' => array(
			'eyebrow' => $copy( 'The fleet', 'Flota', 'Автопарк', 'الأسطول' ),
			'title'   => $copy( 'The right vehicle for every journey', 'Właściwy pojazd na każdą podróż', 'Подходящий автомобиль для каждой поездки', 'سيارات فاخرة مع سائق لكل رحلة' ),
			'copy'    => $copy( 'A curated luxury chauffeur fleet of Mercedes-Benz vehicles, each selected to serve different journey types, passenger groups and occasions with equal professionalism.', 'Flota Mercedes-Benz: luksusowe samochody z kierowcą, starannie dobrane do różnych rodzajów podróży, grup pasażerów i okazji — z równą profesjonalnością.', 'Тщательно подобранный автопарк Mercedes-Benz: автомобили премиум-класса с водителем для разных типов поездок, составов пассажиров и поводов — и везде с одинаково профессиональным подходом.', 'أسطول مختار بعناية من سيارات Mercedes-Benz، سيارات فاخرة مع سائق، تخدم كل منها أنواعًا مختلفة من الرحلات ومجموعات الركاب والمناسبات بالاحترافية نفسها.' ),
		),
		'notice' => array(
			'aria_label' => $copy( 'Fleet availability notice', 'Informacja o dostępności floty', 'Информация о наличии автомобилей', 'ملاحظة حول توافر الأسطول' ),
			'copy'       => $copy( 'Exact model, configuration, colour and availability may vary. Passenger and luggage capacities to be confirmed.', 'Dokładny model, konfiguracja, kolor i dostępność mogą się różnić. Pojemność pasażerska i bagażowa do potwierdzenia.', 'Точная модель, комплектация, цвет и наличие могут отличаться. Вместимость по пассажирам и багажу уточняется.', 'قد يختلف الطراز الدقيق والتجهيزات واللون والتوافر. وتؤكد سعة الركاب والأمتعة لاحقًا.' ),
			'link'       => $copy( 'Need a vehicle recommendation? Contact us', 'Potrzebują Państwo rekomendacji? Skontaktuj się', 'Нужна рекомендация по выбору автомобиля? Свяжитесь с нами', 'تحتاج إلى توصية بسيارة؟ تواصل معنا' ),
		),
		// Keyed by the vehicle's original array position (0, 1, 2, 4) so a stale saved
		// override for Sprinter at path `vehicles.4.*` still resolves to Sprinter after
		// V-Class Extra Long (formerly index 3) was removed as a Fleet-page vehicle.
		// See schema-fleet.php for the matching editor field paths.
		'vehicles' => array(
			0 => array(
				'id'        => 'sclass',
				'slot'      => 's_class',
				'name'      => 'Mercedes-Benz S-Class',
				'badge'     => $copy( 'Flagship sedan', 'Flagowy sedan', 'Флагманский седан', 'سيدان رائدة' ),
				'sub_badge' => $copy( 'Executive · VIP · Diplomatic', 'Kadra · VIP · Dyplomacja', 'Представительский · VIP · Дипломатический', 'تنفيذية · VIP · دبلوماسية' ),
				'columns'   => 'media-wide',
				'copy'      => $copy( 'The flagship choice for executive and diplomatic travel, important private occasions and VIP airport arrivals. An environment of quiet distinction and precise comfort, designed for those who expect nothing to be left to chance.', 'Flagowy wybór dla podróży przedstawicielskich i dyplomatycznych, ważnych okazji prywatnych oraz przylotów VIP. Środowisko cichej elegancji i precyzyjnego komfortu — dla tych, którzy nie pozostawiają niczego przypadkowi.', 'Флагманский выбор для деловых и дипломатических поездок, важных частных событий и VIP-встреч в аэропорту. Атмосфера сдержанной элегантности и выверенного комфорта — для тех, кто не оставляет ничего на волю случая.', 'الخيار الأول لرحلات كبار التنفيذيين والرحلات الدبلوماسية والمناسبات الخاصة المهمة واستقبال VIP في المطار. أجواء من التميز الهادئ والراحة المتقنة، لمن لا يتركون شيئًا للصدفة.' ),
				'use_cases' => array(
					$copy( 'Executive and diplomatic travel', 'Podróże przedstawicielskie i dyplomatyczne', 'Деловые и дипломатические поездки', 'رحلات كبار التنفيذيين والرحلات الدبلوماسية' ),
					$copy( 'Important private occasions', 'Ważne okazje prywatne', 'Важные частные события', 'مناسبات خاصة مهمة' ),
					$copy( '{{VIP airport arrivals and departures|services#airport}}', '{{Przyloty i wyloty VIP|services#airport}}', '{{VIP-встреча и проводы в аэропорту|services#airport}}', '{{استقبال VIP وتوديعهم في المطار|services#airport}}' ),
				),
				'cta'       => $copy( 'Request the S-Class', 'Zamów S-Class', 'Заказать S-Class', 'اطلب S-Class' ),
				'interior'  => array( 'interior_1', 'interior_2' ),
			),
			1 => array(
				'id'        => 'eclass',
				'slot'      => 'e_class',
				'name'      => 'Mercedes-Benz E-Class',
				'badge'     => $copy( 'Executive sedan', 'Sedan biznesowy', 'Бизнес-седан', 'سيدان تنفيذية' ),
				'sub_badge' => $copy( 'Corporate · Airport · Daily', 'Korporacja · Lotnisko · Codzienny', 'Корпоративный · Аэропорт · Ежедневный', 'شركات · مطار · استخدام يومي' ),
				'columns'   => 'details-wide',
				'copy'      => $copy( 'Premium business travel, corporate airport transfers and daily chauffeur requirements. Refined, discreet and dependable — a consistent professional presence for demanding schedules.', 'Transport biznesowy klasy premium, korporacyjne transfery lotniskowe i codzienna obsługa szoferska. Elegancki, dyskretny i niezawodny — stała profesjonalna obecność dla wymagających harmonogramów.', 'Деловые поездки премиум-класса, корпоративные трансферы в аэропорт и ежедневное обслуживание водителем. Респектабельный, сдержанный и надёжный — стабильное профессиональное присутствие для насыщенного графика.', 'تنقلات أعمال راقية، ونقل الشركات من المطار وإليه، واحتياجات السائق اليومية. أنيقة ومتكتمة ويعتمد عليها — حضور مهني ثابت للجداول المزدحمة.' ),
				'use_cases' => array(
					$copy( 'Corporate travel and business appointments', 'Podróże służbowe i spotkania biznesowe', 'Деловые поездки и встречи', 'رحلات الشركات ومواعيد العمل' ),
					$copy( 'Airport transfers — arrivals and departures', 'Transfery lotniskowe — przyloty i wyloty', 'Трансферы из аэропорта и в аэропорт', 'النقل من المطار وإليه — الوصول والمغادرة' ),
					$copy( '{{Daily and multi-day chauffeur hire|services#chauffeur}}', '{{Wynajem szofera na jeden dzień i dłużej|services#chauffeur}}', '{{Водитель на день и на несколько дней|services#chauffeur}}', '{{سائق خاص ليوم أو لعدة أيام|services#chauffeur}}' ),
				),
				'cta'       => $copy( 'Request the E-Class', 'Zamów E-Class', 'Заказать E-Class', 'اطلب E-Class' ),
				'interior'  => array( 'interior_1', 'interior_2' ),
			),
			2 => array(
				'id'        => 'vclass',
				'slot'      => 'v_class',
				'name'      => 'Mercedes-Benz V-Class',
				'badge'     => $copy( 'Luxury van', 'Van klasy premium', 'Минивэн премиум-класса', 'فان فاخرة' ),
				'sub_badge' => 'SHORT · LONG · XL',
				'columns'   => 'media-wide',
				'copy'      => $copy( 'Families, executive teams and small groups travelling together in comfort. The V-Class combines generous interior space with premium presentation, making it equally suited to airport transfers, event transport and multi-stop city journeys.', 'Rodziny, zespoły zarządzające i małe grupy podróżujące razem w komforcie. V-Class łączy przestronną kabinę z elegancką prezentacją — równie dobry do transferów lotniskowych, transportu na wydarzenia i wieloprzystankowych podróży po mieście.', 'Семьи, управленческие команды и небольшие группы, путешествующие вместе с комфортом. V-Class сочетает просторный салон и безупречную подачу — одинаково хорошо подходит для трансферов из аэропорта, перевозки гостей на мероприятия и поездок по городу с несколькими остановками.', 'للعائلات وفرق التنفيذيين والمجموعات الصغيرة المسافرة معًا براحة. تجمع V-Class بين مساحة داخلية رحبة ومظهر فاخر، فتناسب النقل من المطار ونقل الفعاليات والرحلات داخل المدينة بعدة محطات.' ),
				'use_cases' => array(
					$copy( 'Airport transfers for families and groups', 'Transfery lotniskowe dla rodzin i grup', 'Трансферы из аэропорта для семей и групп', 'النقل من المطار للعائلات والمجموعات' ),
					$copy( 'Executive team travel', 'Podróże zespołów zarządzających', 'Поездки управленческих команд', 'تنقل فرق التنفيذيين' ),
					$copy( '{{Event guest transportation|services#events}}', '{{Transport gości na wydarzenia|services#events}}', '{{Перевозка гостей мероприятий|services#events}}', '{{نقل ضيوف الفعاليات|services#events}}' ),
				),
				'cta'       => $copy( 'Request the V-Class', 'Zamów V-Class', 'Заказать V-Class', 'اطلب V-Class' ),
				'interior'  => array( 'interior_1', 'interior_2' ),
			),
			// V-Class Extra Long removed as a separate Fleet-page vehicle (index 3 was
			// never reused, so index 4 below still identifies Sprinter). The `vclassxl`
			// capacity record is kept in `venix_concierge_fleet_capacity_data()` for
			// backward compatibility; it simply has no Fleet-page vehicle anymore.
			4 => array(
				'id'        => 'sprinter',
				'slot'      => 'sprinter',
				'name'      => 'Mercedes-Benz Sprinter',
				'badge'     => $copy( 'Group transport', 'Transport grupowy', 'Групповой транспорт', 'نقل المجموعات' ),
				'sub_badge' => $copy( '9 · 16 · 19 passenger configurations', 'Konfiguracje 9 · 16 · 19 miejsc', 'Конфигурации на 9 · 16 · 19 мест', 'تجهيزات 9 · 16 · 19 مقعدًا' ),
				'columns'   => 'media-wide',
				'copy'      => $copy( 'Group transportation for conferences, delegations, weddings and events — available in 9, 16 and 19-seat configurations. Professional presentation, coordinated scheduling and driver dispatch. The right choice when groups need to move together with comfort and punctuality.', 'Transport grupowy na konferencje, delegacje, śluby i wydarzenia — dostępny w konfiguracji na 9, 16 i 19 miejsc. Profesjonalna prezentacja, skoordynowany harmonogram i dyspozycja kierowcy. Właściwy wybór, gdy grupy muszą podróżować razem z komfortem i punktualnością.', 'Групповые перевозки для конференций, делегаций, свадеб и мероприятий — в конфигурациях на 9, 16 и 19 мест. Безупречная подача, согласованный график и диспетчеризация водителей. Верный выбор, когда группе нужно ехать вместе — комфортно и вовремя.', 'نقل المجموعات للمؤتمرات والوفود وحفلات الزفاف والفعاليات — متاح بتجهيزات 9 و16 و19 مقعدًا. مظهر احترافي وجدولة منسقة وتوجيه للسائقين. الخيار المناسب حين تحتاج المجموعات إلى التنقل معًا براحة والتزام بالمواعيد.' ),
				'use_cases' => array(
					$copy( 'Conference and corporate event transport', 'Transport na konferencje i imprezy korporacyjne', 'Транспорт для конференций и корпоративных мероприятий', 'النقل للمؤتمرات وفعاليات الشركات' ),
					$copy( '{{Delegation and embassy group movements|services#delegations}}', '{{Przejazdy delegacji i grup ambasadowych|services#delegations}}', '{{Перевозка делегаций и групп посольств|services#delegations}}', '{{تنقلات الوفود ومجموعات السفارات|services#delegations}}' ),
					$copy( '{{Wedding guest coordination|services#weddings}}', '{{Koordynacja gości weselnych|services#weddings}}', '{{Организация перевозки свадебных гостей|services#weddings}}', '{{تنسيق نقل ضيوف حفلات الزفاف|services#weddings}}' ),
				),
				'cta'       => $copy( 'Request a Sprinter', 'Zamów Sprinter', 'Заказать Sprinter', 'اطلب Sprinter' ),
				'interior'  => array( 'interior_1', 'interior_2' ),
			),
		),
		'recommendation' => array(
			'eyebrow' => $copy( 'Not sure?', 'Nie wiedzą Państwo?', 'Сомневаетесь?', 'هل تحتار؟' ),
			'title'   => $copy( 'We will recommend the right vehicle for your journey', 'Zarekomendujemy właściwy pojazd na Państwa podróż', 'Подберём автомобиль под Вашу поездку', 'سنوصي بالسيارة المناسبة لرحلتك' ),
			'copy'    => $copy( 'Share your passenger count, luggage requirements, journey type and any special needs. Our team will suggest the most appropriate option and confirm availability.', 'Prosimy podać liczbę pasażerów, wymagania dotyczące bagażu, rodzaj podróży i wszelkie specjalne potrzeby. Nasz zespół zaproponuje najbardziej odpowiednią opcję i potwierdzi dostępność.', 'Сообщите число пассажиров, объём багажа, тип поездки и особые пожелания. Наша команда предложит наиболее подходящий вариант и подтвердит наличие.', 'أخبرنا بعدد الركاب والأمتعة ونوع الرحلة وأي احتياجات خاصة. سيقترح فريقنا الخيار الأنسب ويؤكد التوافر.' ),
			'guide'   => $copy( 'Every vehicle is chauffeur-driven: the S-Class, E-Class and V-Class suit private and business journeys, and the Sprinter is the choice when a larger group must travel together. Read more about our {{chauffeur service|services}}.', 'Wynajem S-Class, E-Class lub V-Class z kierowcą sprawdza się przy podróżach prywatnych i służbowych, a Sprinter — gdy większa grupa ma podróżować razem. Więcej o usłudze: {{wynajem samochodu z kierowcą|services}}.', 'Аренда S-Class, E-Class или V-Class с водителем подходит для частных и деловых поездок, а Sprinter — когда группе нужно ехать вместе. Подробнее об услуге: {{аренда автомобиля с водителем|services}}.', 'تأجير S-Class أو E-Class أو V-Class مع سائق يناسب الرحلات الخاصة ورحلات الأعمال، وتناسب Sprinter المجموعات الأكبر التي تسافر معًا. اطلع على المزيد عن {{تأجير سيارة مع سائق|services}}.' ),
				'button'  => $copy( 'Get a vehicle recommendation', 'Uzyskaj rekomendację pojazdu', 'Получить рекомендацию', 'احصل على توصية بسيارة' ),
			'points'  => array(
				array( $copy( 'Passengers', 'Pasażerowie', 'Пассажиры', 'عدد الركاب' ), $copy( 'How many people are travelling?', 'Ile osób podróżuje?', 'Сколько человек едет?', 'كم عدد المسافرين؟' ) ),
				array( $copy( 'Luggage', 'Bagaż', 'Багаж', 'الأمتعة' ), $copy( 'Checked bags, hand luggage, equipment?', 'Bagaż rejestrowany, podręczny, sprzęt?', 'Крупный багаж, ручная кладь, оборудование?', 'حقائب شحن أم حقائب يد أم معدات؟' ) ),
				array( $copy( 'Occasion', 'Okazja', 'Повод', 'المناسبة' ), $copy( 'Business, event, airport, private?', 'Biznes, wydarzenie, lotnisko, prywatna?', 'Деловая поездка, мероприятие, аэропорт, частная?', 'عمل أم فعالية أم مطار أم رحلة خاصة؟' ) ),
			),
		),
		// Default slot alt text keyed by `<vehicle slot>.<image>`: used only when neither a page-slot alt
		// override nor a Media Library alt exists. The hero is decorative and keeps an empty alt.
		'media_alt' => array(
			's_class.exterior'           => $copy( 'A black Mercedes-Benz S-Class on a Warsaw boulevard at golden hour.', 'Czarny Mercedes-Benz S-Class na warszawskim bulwarze o zmierzchu.', 'Чёрный Mercedes-Benz S-Class на варшавском бульваре в «золотой час».', 'سيارة Mercedes-Benz S-Class سوداء على إحدى جادات وارسو في الساعة الذهبية.' ),
			's_class.interior_1'         => $copy( 'Rear cabin — warm leather upholstery, ambient lighting, refined materials. Serene, composed.', 'Kabina tylna — ciepła skórzana tapicerka, oświetlenie ambientowe, wyrafinowane materiały. Spokojne, stonowane.', 'Задний салон: тёплая кожаная обивка, фоновая подсветка, благородные материалы. Спокойная, сдержанная атмосфера.', 'المقصورة الخلفية: تنجيد جلدي دافئ وإضاءة محيطية ومواد راقية، في أجواء هادئة.' ),
			's_class.interior_2'         => $copy( "Front cabin detail — instrumentation, steering wheel, driver's environment. Professional and precise.", 'Detal kabiny przedniej — instrumentarium, kierownica, środowisko kierowcy. Profesjonalne i precyzyjne.', 'Передняя часть салона: приборная панель, руль, рабочее место водителя. Профессионально и точно.', 'تفصيل من المقصورة الأمامية: لوحة العدادات والمقود ومقصورة السائق، بمظهر احترافي ودقيق.' ),
			'e_class.exterior'           => $copy( 'A black Mercedes-Benz E-Class in a Warsaw business district.', 'Czarny Mercedes-Benz E-Class w warszawskiej dzielnicy biznesowej.', 'Чёрный Mercedes-Benz E-Class в деловом районе Варшавы.', 'سيارة Mercedes-Benz E-Class سوداء في حي أعمال بوارسو.' ),
			'e_class.interior_1'         => $copy( 'Rear cabin detail — refined materials, discreet presentation. Suited to business travel.', 'Detal tylnej kabiny — wyrafinowane materiały, dyskretna prezentacja. Odpowiedni do podróży biznesowych.', 'Задний салон: благородные материалы, сдержанная подача. Подходит для деловых поездок.', 'تفصيل من المقصورة الخلفية: مواد راقية ومظهر هادئ يناسب رحلات الأعمال.' ),
			'e_class.interior_2'         => $copy( "Front cabin detail — instrumentation, driver's environment. Professional and precise.", 'Detal kabiny przedniej — instrumentarium, środowisko kierowcy. Profesjonalne i precyzyjne.', 'Передняя часть салона: приборная панель, рабочее место водителя. Профессионально и точно.', 'تفصيل من المقصورة الأمامية: لوحة العدادات ومقصورة السائق، بمظهر احترافي ودقيق.' ),
			'v_class.exterior'           => $copy( 'A black Mercedes-Benz V-Class at a Warsaw hotel entrance.', 'Czarny Mercedes-Benz V-Class przed wejściem do warszawskiego hotelu.', 'Чёрный Mercedes-Benz V-Class у входа в отель в Варшаве.', 'سيارة Mercedes-Benz V-Class سوداء أمام مدخل فندق في وارسو.' ),
			'v_class.interior_1'         => $copy( 'Rear seating area — individual seats, warm ambient tone, generous legroom. Comfortable for longer journeys.', 'Tylna strefa siedzeń — fotele indywidualne, ciepły ton ambientowy, duże odstępy między siedzeniami. Komfortowy na dłuższe trasy.', 'Задний ряд сидений: индивидуальные кресла, тёплая подсветка, достаточно места для ног. Комфортно в дальних поездках.', 'منطقة الجلوس الخلفية: مقاعد فردية وإضاءة دافئة ومساحة رحبة للساقين، مريحة للرحلات الطويلة.' ),
			'v_class.interior_2'         => $copy( 'Luggage area — clean, accessible, suitable for airport transfers with checked baggage.', 'Przestrzeń bagażowa — czysta, dostępna, odpowiednia do transferów lotniskowych z bagażem rejestrowanym.', 'Багажное отделение: чистое, удобное, подходит для трансферов из аэропорта с крупным багажом.', 'حيز الأمتعة: نظيف وسهل الوصول، يناسب النقل من المطار مع الحقائب الكبيرة.' ),
			'sprinter.exterior'          => $copy( 'A Mercedes-Benz Sprinter at a Warsaw conference centre for group transport.', 'Mercedes-Benz Sprinter przed centrum konferencyjnym w Warszawie.', 'Mercedes-Benz Sprinter у конференц-центра в Варшаве для групповой перевозки.', 'سيارة Mercedes-Benz Sprinter أمام مركز مؤتمرات في وارسو لنقل المجموعات.' ),
			'sprinter.interior_1'        => $copy( 'Cabin interior — coordinated seating suited to group transport.', 'Wnętrze kabiny — skoordynowane siedzenia odpowiednie do transportu grupowego.', 'Салон: рассадка, рассчитанная на групповую перевозку.', 'مقصورة الركاب: مقاعد منسقة تناسب نقل المجموعات.' ),
			'sprinter.interior_2'        => $copy( 'Cabin interior detail — clean, professional presentation for groups.', 'Detal wnętrza kabiny — czysta, profesjonalna prezentacja dla grup.', 'Деталь салона: чистая, профессиональная подача для групп.', 'تفصيل من المقصورة: مظهر نظيف واحترافي للمجموعات.' ),
		),
	);
}

/**
 * Passenger and luggage capacity per vehicle id.
 *
 * Single source for Home and Fleet. A value saved in Venix → Fleet Capacities
 * (option `venix_fleet_capacities`, owned by project-core) wins; otherwise the
 * null default below is used and renders as TBC / Do potw.
 *
 * @return array<string, array{passengers: int|string|null, luggage: int|string|null}>
 */
function venix_concierge_fleet_capacity_data() {
	$data = array();

	foreach ( array( 'sclass', 'eclass', 'vclass', 'vclassxl', 'sprinter' ) as $vehicle_id ) {
		$data[ $vehicle_id ] = array(
			'passengers' => null,
			'luggage'    => null,
		);
	}

	$saved = get_option( 'venix_fleet_capacities', array() );

	if ( ! is_array( $saved ) ) {
		return $data;
	}

	foreach ( $data as $vehicle_id => $capacity ) {
		foreach ( array_keys( $capacity ) as $key ) {
			$value = isset( $saved[ $vehicle_id ][ $key ] ) ? $saved[ $vehicle_id ][ $key ] : null;

			if ( is_scalar( $value ) && preg_match( '/^[0-9]{1,3}$/', (string) $value ) && (int) $value >= 1 ) {
				$data[ $vehicle_id ][ $key ] = (int) $value;
			}
		}
	}

	return $data;
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
	$unconfirmed = venix_concierge_language_copy( 'TBC', 'Do potw.', 'Уточняется', 'يؤكد لاحقًا' );
	$labels      = array(
		'passengers' => venix_concierge_language_copy( 'Passengers', 'Pasażerowie', 'Пассажиры', 'عدد الركاب' ),
		'luggage'    => venix_concierge_language_copy( 'Luggage', 'Bagaż', 'Багаж', 'الأمتعة' ),
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
