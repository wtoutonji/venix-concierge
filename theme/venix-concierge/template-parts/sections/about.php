<?php
/**
 * About page body.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_pmv = array(
	array( 'Purpose', 'Bridges of connection', 'To build meaningful connections between cultures and promote the exchange of noble human values through attentive, high-quality service.' ),
	array( 'Mission', 'Luxury made effortless', 'To remove the practical barriers that prevent clients from experiencing luxury with ease — handling the complexity so they do not have to.' ),
	array( 'Vision', 'A trusted European presence', 'To grow into one of Europe\'s most trusted luxury-service providers, maintaining rigorous international standards at every stage of that journey.' ),
);
$venix_concierge_approach = array(
	array( '1', 'Listen carefully', 'We begin with your requirements, not our assumptions. Every arrangement starts with a clear understanding of what you need.' ),
	array( '2', 'Plan precisely', 'Schedules, routes and vehicle selections are prepared thoughtfully and confirmed in advance.' ),
	array( '3', 'Communicate clearly', 'Confirmations are straightforward. The next step is always visible. We do not leave clients wondering.' ),
	array( '4', 'Protect privacy', 'Discretion is not optional — it is the standard. Journey information is handled with care and confidentiality.' ),
	array( '5', 'Adapt calmly', 'When plans change, we respond professionally and work to accommodate the revised arrangement wherever possible.' ),
	array( '6', 'Deliver professionally', 'Every journey is carried out with care, composure and attention to the details that matter.' ),
);
$venix_concierge_values = array(
	array( 'Value 01', 'Work together, lift each other up', 'Respectful, empathetic and collaborative — with clients, partners and colleagues. We treat every person as an individual, not a booking reference.' ),
	array( 'Value 02', 'Own it, trust yourself, inspire others', 'Clear accountability for every inquiry. Confident recommendations. Proactive problem-solving. We own the arrangement from start to finish.' ),
	array( 'Value 03', 'Deliver with precision', 'Accurate, reliable and consistent. High standards on every assignment, regardless of scale or complexity.' ),
	array( 'Value 04', 'Be clear: clarity over everything', 'Transparent communication, honest service descriptions, no hidden steps. Clients always know what has been arranged and what comes next.' ),
	array( 'Value 05', 'Adapt, evolve, stay ahead', 'Responsive when plans change. Improving continuously. Forward-looking in every aspect of our service.' ),
);
$venix_concierge_culture_points = array(
	'Respect for different protocols',
	'Adaptable professional conduct',
	'Awareness of cultural expectations',
	'Discretion in all contexts',
);
?>
<main id="primary" class="site-main venix-about">
	<section class="about-hero">
		<div class="about-hero__media" aria-hidden="true"></div>
		<div class="container about-hero__content">
			<p class="venix-eyebrow">About Venix Concierge</p>
			<h1>Luxury service, built on trust</h1>
		</div>
	</section>

	<section class="section about-story">
		<div class="container about-split about-story__grid">
			<div class="about-copy">
				<p class="venix-eyebrow">Our story</p>
				<h2>A deliberate beginning</h2>
				<span class="about-rule" aria-hidden="true"></span>
				<p>Venix Concierge began in Warsaw in 2024 with a deliberate intention: to offer private and professional clients a more seamless, precise and personal way to move through the city and beyond. We understood from the outset that premium transportation was not simply about the vehicle. It was about reliability, discretion and the confidence that every detail had been considered before the journey began.</p>
				<p class="about-copy__muted">We are building a reputation through consistent, careful execution — one well-managed journey at a time. Our ambition is to grow into a trusted presence across Europe, carrying the same standards wherever we operate.</p>
			</div>
			<div class="about-media about-media--portrait" role="img" aria-label="Photography placeholder: a black Mercedes-Benz on a Warsaw boulevard in warm evening light."><span aria-hidden="true"></span></div>
		</div>
	</section>

	<section class="section about-foundation">
		<div class="container">
			<header class="about-section-heading">
				<p class="venix-eyebrow">Our foundation</p>
				<h2>Purpose, mission &amp; vision</h2>
			</header>
			<div class="about-pmv-grid">
				<?php foreach ( $venix_concierge_pmv as $venix_concierge_item ) : ?>
					<article class="about-pmv-card">
						<p class="venix-eyebrow"><?php echo esc_html( $venix_concierge_item[0] ); ?></p>
						<h3><?php echo esc_html( $venix_concierge_item[1] ); ?></h3>
						<p><?php echo esc_html( $venix_concierge_item[2] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section about-approach">
		<div class="container about-approach__grid">
			<div class="about-approach__intro">
				<p class="venix-eyebrow">How we work</p>
				<h2>Our approach to every arrangement</h2>
				<p>Every engagement — whether a single airport transfer or a multi-day delegation programme — follows the same discipline. We listen first, then plan, communicate, and deliver.</p>
			</div>
			<ol class="about-approach__list">
				<?php foreach ( $venix_concierge_approach as $venix_concierge_item ) : ?>
					<li><span aria-hidden="true"><?php echo esc_html( $venix_concierge_item[0] ); ?></span><div><h3><?php echo esc_html( $venix_concierge_item[1] ); ?></h3><p><?php echo esc_html( $venix_concierge_item[2] ); ?></p></div></li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<section class="section about-values">
		<div class="container">
			<header class="about-section-heading">
				<p class="venix-eyebrow">What we stand for</p>
				<h2>Our values in practice</h2>
			</header>
			<div class="about-values__grid">
				<?php foreach ( $venix_concierge_values as $venix_concierge_item ) : ?>
					<article><p class="venix-eyebrow"><?php echo esc_html( $venix_concierge_item[0] ); ?></p><h3><?php echo esc_html( $venix_concierge_item[1] ); ?></h3><p><?php echo esc_html( $venix_concierge_item[2] ); ?></p></article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section about-culture">
		<div class="container about-split about-culture__grid">
			<div class="about-media about-media--landscape" role="img" aria-label="Photography placeholder: international travellers arriving at Warsaw airport, greeted by a Venix Concierge representative."></div>
			<div class="about-copy">
				<p class="venix-eyebrow">International service</p>
				<h2>Beyond language. Cultural understanding.</h2>
				<span class="about-rule" aria-hidden="true"></span>
				<p>International service requires more than the ability to communicate in a second language. It requires cultural awareness, respect for different protocols and expectations, and the ability to adapt professional conduct to different contexts.</p>
				<p class="about-copy__muted">Our service is designed for clients from across the world — visitors, executives, diplomats and families — each arriving with their own standards, preferences and expectations. We approach every arrangement with the awareness that different clients may require different things, and we adapt accordingly.</p>
				<ul class="about-culture__points"><?php foreach ( $venix_concierge_culture_points as $venix_concierge_point ) : ?><li><?php echo esc_html( $venix_concierge_point ); ?></li><?php endforeach; ?></ul>
			</div>
		</div>
	</section>

	<section class="section about-cta">
		<div class="container about-cta__content">
			<h2>Your requirements are personal. The service should be too.</h2>
			<p>Share your journey requirements with us. Our team will review the details and prepare a considered response.</p>
			<?php get_template_part( 'template-parts/components/button/button', null, array( 'label' => 'Discuss your journey', 'url' => venix_concierge_page_url( 'contact' ), 'variant' => 'gold' ) ); ?>
		</div>
	</section>
</main>
