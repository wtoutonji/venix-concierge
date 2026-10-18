<?php
/**
 * Audited Rank Math page metadata (2026-10-18), keyed by language then page family.
 *
 * Page families match the shared canonical slug used by every language
 * (home, about, services, fleet, contact). EN values are the approved handoff
 * records. PL values are pending human approval; see docs/SEO-AUDIT-2026-10-18.md.
 */

return array(
	'pages'                => array(
		'en' => array(
			'home'     => array(
				'title'         => 'Venix Concierge | Chauffeur Service in Warsaw',
				'description'   => 'Private chauffeur services, executive transportation and airport transfers in Warsaw. Venix Concierge — every journey, handled with precision.',
				'focus_keyword' => 'chauffeur service Warsaw',
			),
			'about'    => array(
				'title'         => 'About Venix Concierge | Luxury Chauffeur Service Warsaw',
				'description'   => 'Venix Concierge — a Warsaw-based chauffeur and concierge company operating since 2024. Built on precision, privacy and personal care.',
				'focus_keyword' => 'Venix Concierge',
			),
			'services' => array(
				'title'         => 'Chauffeur and Private Transfer Services in Warsaw | Venix Concierge',
				'description'   => 'Private transfers, airport chauffeur, event transportation, diplomatic transfers, concierge services and weddings in Warsaw. Venix Concierge.',
				'focus_keyword' => 'private transfer services Warsaw',
			),
			'fleet'    => array(
				'title'         => 'Luxury Chauffeur Fleet in Warsaw | Venix Concierge',
				'description'   => 'Explore the Venix Concierge fleet — Mercedes-Benz S-Class, E-Class, V-Class and Sprinter, each matched to the journey, the passengers and the occasion.',
				'focus_keyword' => 'luxury chauffeur fleet Warsaw',
			),
			'contact'  => array(
				'title'         => 'Request a Chauffeur in Warsaw | Venix Concierge',
				'description'   => 'Contact Venix Concierge to arrange a private chauffeur, airport transfer, event transportation or delegation service in Warsaw.',
				'focus_keyword' => 'request a chauffeur Warsaw',
			),
		),
		'pl' => array(
			'home'     => array(
				'title'         => 'Venix Concierge | Szofer i transfery VIP w Warszawie',
				'description'   => 'Prywatny szofer, transport biznesowy i transfery lotniskowe w Warszawie. Venix Concierge — każda podróż dopracowana z precyzją.',
				'focus_keyword' => 'szofer Warszawa',
			),
			'about'    => array(
				'title'         => 'O Venix Concierge | Szofer i concierge w Warszawie',
				'description'   => 'Venix Concierge – warszawska firma oferująca usługi szofera i concierge, działająca od 2024 roku. Precyzja, dyskrecja i osobista troska.',
				'focus_keyword' => 'Venix Concierge',
			),
			'services' => array(
				'title'         => 'Transfery z szoferem w Warszawie – usługi | Venix Concierge',
				'description'   => 'Transfery prywatne i lotniskowe, transport na wydarzenia i dla delegacji, usługi concierge oraz śluby w Warszawie. Venix Concierge.',
				'focus_keyword' => 'transfery z szoferem Warszawa',
			),
			'fleet'    => array(
				'title'         => 'Flota Mercedes-Benz z szoferem w Warszawie | Venix Concierge',
				'description'   => 'Poznaj flotę Venix Concierge — Mercedes-Benz Klasa S, Klasa E, Klasa V i Sprinter, dobrane do podróży, liczby pasażerów i okazji.',
				'focus_keyword' => 'Mercedes z kierowcą Warszawa',
			),
			'contact'  => array(
				'title'         => 'Zamów szofera w Warszawie – kontakt | Venix Concierge',
				'description'   => 'Prosimy o kontakt w sprawie szofera, transferu lotniskowego, transportu na wydarzenie lub obsługi delegacji w Warszawie. Venix Concierge.',
				'focus_keyword' => 'zamów szofera Warszawa',
			),
		),
		'ru' => array(
			'home'     => array(
				'title'         => 'Персональный водитель в Варшаве | Venix Concierge',
				'description'   => 'Персональный водитель, VIP-трансфер и консьерж-сервис в Варшаве: деловые поездки, трансфер из аэропорта, транспорт для делегаций и мероприятий.',
				'focus_keyword' => 'персональный водитель Варшава',
			),
			'about'    => array(
				'title'         => 'О компании Venix Concierge | Премиальный сервис в Варшаве',
				'description'   => 'Venix Concierge — варшавская компания, основанная в 2024 году: персональный водитель, деловые трансферы и консьерж-сервис. Точность и конфиденциальность.',
				'focus_keyword' => 'Venix Concierge Варшава',
			),
			'services' => array(
				'title'         => 'Услуги водителя и VIP-трансферы в Варшаве | Venix Concierge',
				'description'   => 'Трансфер из аэропорта, персональный водитель, транспорт для делегаций и мероприятий, консьерж-сервис и свадьбы в Варшаве. Venix Concierge.',
				'focus_keyword' => 'VIP трансфер Варшава',
			),
			'fleet'    => array(
				'title'         => 'Автопарк Mercedes-Benz в Варшаве | Venix Concierge',
				'description'   => 'S-Class, E-Class, V-Class и Sprinter для деловых поездок, трансферов из аэропорта, мероприятий и групп. Подберём автомобиль под Вашу задачу.',
				'focus_keyword' => 'аренда Mercedes с водителем Варшава',
			),
			'contact'  => array(
				'title'         => 'Контакты и заказ трансфера в Варшаве | Venix Concierge',
				'description'   => 'Оставьте запрос на трансфер, персонального водителя или консьерж-сервис в Варшаве. Подготовим индивидуальное предложение под Ваши задачи.',
				'focus_keyword' => 'заказать трансфер Варшава',
			),
		),
	),
	// Pages that must not be indexed (matched by language + slug, only if present).
	'noindex'              => array(
		array(
			'lang' => 'en',
			'slug' => 'sample-page',
		),
	),
	// Rank Math global options: only these keys are merged; all others stay untouched.
	'titles_options'       => array(
		'title_separator'              => '|',
		'pt_page_default_rich_snippet' => 'off',
		'knowledgegraph_type'          => 'company',
	),
	// Exact-string data fixes (portable across environments).
	'attachment_alt_fixes' => array(
		'Venix Concierge Venix Concierge Mercedes-Benz V-Class with open rear luggage area, showcasing spacious premium group transport in Warsaw.' => 'Venix Concierge Mercedes-Benz V-Class with open rear luggage area, showcasing spacious premium group transport in Warsaw.',
	),
	'menu_url_fixes'       => array(
		'/services' => '/services/',
	),
);
