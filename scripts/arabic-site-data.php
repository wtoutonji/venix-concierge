<?php
/**
 * Arabic (ar) site data used by scripts/setup-polylang-site.php.
 *
 * Environment-independent: page families and menu targets are resolved by
 * Polylang language + shared slug, and image attachments are inherited from the
 * English page of each family, so no database or attachment ID is stored here.
 *
 * Arabic copy is Modern Standard Arabic written for the Venix Concierge voice
 * (premium, restrained, discreet). Alt text describes the actual image first,
 * makes no service claim and never names a vehicle the fleet does not contain.
 */

return array(
	'language'   => array(
		'slug'       => 'ar',
		'locale'     => 'ar',
		'name'       => 'العربية',
		'rtl'        => true,
		'flag'       => 'arab',
		'term_group' => 3,
	),
	'titles'     => array(
		'home'     => 'الرئيسية',
		'about'    => 'من نحن',
		'services' => 'الخدمات',
		'fleet'    => 'الأسطول',
		'contact'  => 'تواصل معنا',
	),
	// Per-page contextual alt text keyed by page family, then by the media slot.
	'media_alt'  => array(
		'home'     => array(
			'home.about'                => 'سائق من Venix Concierge داخل مقصورة سيارة Mercedes-Benz في وارسو.',
			'home.services.chauffeur'   => 'سائقو Venix Concierge بجوار سيارة Mercedes-Benz S-Class في المطار.',
			'home.services.airport'     => 'سائقو Venix Concierge بجوار سيارة سيدان وطائرة خاصة على أرضية مطار في وارسو.',
			'home.services.events'      => 'سائقو Venix Concierge وسيارات Mercedes-Benz جاهزة لرحلات الأعمال والرحلات الدبلوماسية في وارسو.',
			'home.services.delegations' => 'عدة سيارات من Venix Concierge تتحرك معًا لنقل الضيوف الرسميين والوفود بتنسيق في وارسو.',
			'home.promise'              => 'مقصورة سيارة من Venix Concierge مجهزة كمكتب متنقل لرحلات الأعمال المريحة.',
			'home.fleet.s_class'        => 'سيارة Venix Concierge من طراز Mercedes-Benz S-Class مع سائق في وارسو.',
			'home.fleet.e_class'        => 'سيارة Venix Concierge من طراز Mercedes-Benz E-Class، سيدان تنفيذية مع سائق في وارسو.',
			'home.fleet.v_class'        => 'سيارة Venix Concierge من طراز Mercedes-Benz V-Class في وارسو.',
			'home.fleet.sprinter'       => 'سيارة Venix Concierge من طراز Mercedes-Benz Sprinter لنقل المجموعات في وارسو.',
			'home.events'               => 'أسطول Venix Concierge من السيارات الفاخرة في وارسو لنقل الفعاليات والوفود.',
		),
		'about'    => array(
			'about.story'   => 'سيارات Mercedes-Benz من Venix Concierge في وارسو للرحلات التنفيذية والخاصة مع سائق.',
			'about.culture' => 'سائق من Venix Concierge يستقبل ضيفًا عند صالة كبار الزوار في وارسو بجوار سيارة Mercedes-Benz.',
		),
		'services' => array(
			'services.chauffeur'   => 'سائق من Venix Concierge وسيارة Mercedes-Benz للرحلات الخاصة ورحلات الأعمال في وارسو.',
			'services.airport'     => 'سيارات Mercedes-Benz من Venix Concierge عند صالة كبار الزوار في مطار وارسو.',
			'services.events'      => 'سائقو Venix Concierge وسيارات Mercedes-Benz جاهزة لنقل ضيوف الفعالية في وارسو.',
			'services.delegations' => 'سيارات Mercedes-Benz من Venix Concierge لنقل الوفود الدبلوماسية والزيارات الرسمية في وارسو.',
			'services.protection'  => 'عنصر أمن يقف بجوار سيارة Mercedes-Benz أمام فندق في وارسو.',
			'services.flights'     => 'سيارات Mercedes-Benz على أرضية المطار بجوار طائرة خاصة.',
			'services.embassy'     => 'فريق ضيافة يستقبل الضيوف في فعالية بإحدى السفارات في وارسو.',
			'services.concierge'   => 'موظف كونسيرج في فندق يرحّب بضيف في وارسو.',
			'services.weddings'    => 'سيارة زفاف فاخرة مزيّنة بالزهور في وارسو.',
		),
		'fleet'    => array(
			'fleet.s_class.exterior'   => 'سيارة Venix Concierge من طراز Mercedes-Benz S-Class مع سائق في وارسو.',
			'fleet.s_class.interior_1' => 'مقصورة Mercedes-Benz S-Class: مقاعد جلدية وشاشات لركاب المقعد الخلفي.',
			'fleet.s_class.interior_2' => 'مقصورة S-Class: مقاعد جلدية وزجاجات مياه للركاب.',
			'fleet.e_class.exterior'   => 'سيارة Venix Concierge من طراز Mercedes-Benz E-Class، سيدان تنفيذية مع سائق في وارسو.',
			'fleet.e_class.interior_1' => 'مقصورة Mercedes-Benz E-Class: تنجيد جلدي فاتح وإضاءة محيطية.',
			'fleet.e_class.interior_2' => 'سيارة Mercedes-Benz E-Class في وارسو لرحلات الأعمال والرحلات الخاصة.',
			'fleet.v_class.exterior'   => 'سيارة Venix Concierge من طراز Mercedes-Benz V-Class في وارسو للنقل من المطار ورحلات المجموعات.',
			'fleet.v_class.interior_1' => 'مقصورة Mercedes-Benz V-Class: مقاعد جلدية وإضاءة محيطية.',
			'fleet.v_class.interior_2' => 'سيارة Mercedes-Benz V-Class مع حيز أمتعة خلفي مفتوح.',
			'fleet.sprinter.exterior'  => 'سيارة Venix Concierge من طراز Mercedes-Benz Sprinter لنقل المجموعات في وارسو.',
			'fleet.sprinter.interior_1' => 'مقصورة Mercedes-Benz Sprinter: مقاعد جلدية فردية وإضاءة سقف محيطية.',
			'fleet.sprinter.interior_2' => 'مقصورة Mercedes-Benz Sprinter: قمرة السائق وثلاجة مفتوحة بين المقاعد.',
		),
		'contact'  => array(),
	),
	// Menus. `page` items resolve to the Arabic page of that family; `custom` items use a relative /ar/ URL.
	'menus'      => array(
		'primary' => array(
			'name'  => 'Primary AR',
			'items' => array(
				array( 'page', 'home', 'الرئيسية' ),
				array( 'page', 'about', 'من نحن' ),
				array( 'page', 'services', 'الخدمات', array(
					array( 'custom', '/ar/services/#chauffeur', 'سائق خاص ونقل خاص' ),
					array( 'custom', '/ar/services/#airport', 'النقل من المطار وإليه' ),
					array( 'custom', '/ar/services/#events', 'فعاليات الأعمال والمناسبات الخاصة' ),
					array( 'custom', '/ar/services/#delegations', 'الوفود والنقل الدبلوماسي' ),
				) ),
				array( 'custom', '/ar/services/', 'خدمات أخرى', array(
					array( 'custom', '/ar/services/#protection', 'الحماية الشخصية' ),
					array( 'custom', '/ar/services/#embassy', 'خدمات السفارات' ),
					array( 'custom', '/ar/services/#flights', 'الطيران الخاص' ),
					array( 'custom', '/ar/services/#concierge', 'خدمات الكونسيرج' ),
					array( 'custom', '/ar/services/#weddings', 'حفلات الزفاف' ),
				) ),
				array( 'page', 'fleet', 'الأسطول' ),
				array( 'page', 'contact', 'تواصل معنا' ),
			),
		),
		'footer'  => array(
			'name'  => 'Footer AR',
			'items' => array(
				array( 'page', 'home', 'الرئيسية' ),
				array( 'page', 'about', 'من نحن' ),
				array( 'page', 'services', 'الخدمات' ),
				array( 'page', 'fleet', 'الأسطول' ),
				array( 'page', 'contact', 'تواصل معنا' ),
			),
		),
	),
);
