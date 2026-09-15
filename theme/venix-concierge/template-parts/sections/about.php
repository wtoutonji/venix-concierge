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
$venix_concierge_about_content = venix_concierge_about_content();
$venix_concierge_pmv           = $venix_concierge_about_content['pmv']['items'];
$venix_concierge_approach      = $venix_concierge_about_content['approach']['items'];
$venix_concierge_values        = $venix_concierge_about_content['values']['items'];
$venix_concierge_culture_points = $venix_concierge_about_content['culture']['points'];
?>
<main id="primary" class="site-main venix-about">
	<section class="about-hero">
		<div class="about-hero__media" aria-hidden="true"></div>
		<div class="container about-hero__content">
			<p class="venix-eyebrow"><?php echo esc_html( $venix_concierge_about_content['hero']['eyebrow'] ); ?></p>
			<h1><?php echo esc_html( $venix_concierge_about_content['hero']['title'] ); ?></h1>
		</div>
	</section>

	<section class="section about-story">
		<div class="container about-split about-story__grid">
			<div class="about-copy">
				<p class="venix-eyebrow"><?php echo esc_html( $venix_concierge_about_content['story']['eyebrow'] ); ?></p>
				<h2><?php echo esc_html( $venix_concierge_about_content['story']['title'] ); ?></h2>
				<span class="about-rule" aria-hidden="true"></span>
				<p><?php echo esc_html( $venix_concierge_about_content['story']['copy'] ); ?></p>
				<p class="about-copy__muted"><?php echo esc_html( $venix_concierge_about_content['story']['supporting_copy'] ); ?></p>
			</div>
			<div class="about-media about-media--portrait" role="img" aria-label="Photography placeholder: a black Mercedes-Benz on a Warsaw boulevard in warm evening light."><span aria-hidden="true"></span></div>
		</div>
	</section>

	<section class="section about-foundation">
		<div class="container">
			<header class="about-section-heading">
				<p class="venix-eyebrow"><?php echo esc_html( $venix_concierge_about_content['pmv']['eyebrow'] ); ?></p>
				<h2><?php echo esc_html( $venix_concierge_about_content['pmv']['title'] ); ?></h2>
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
				<p class="venix-eyebrow"><?php echo esc_html( $venix_concierge_about_content['approach']['eyebrow'] ); ?></p>
				<h2><?php echo esc_html( $venix_concierge_about_content['approach']['title'] ); ?></h2>
				<p><?php echo esc_html( $venix_concierge_about_content['approach']['copy'] ); ?></p>
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
				<p class="venix-eyebrow"><?php echo esc_html( $venix_concierge_about_content['values']['eyebrow'] ); ?></p>
				<h2><?php echo esc_html( $venix_concierge_about_content['values']['title'] ); ?></h2>
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
				<p class="venix-eyebrow"><?php echo esc_html( $venix_concierge_about_content['culture']['eyebrow'] ); ?></p>
				<h2><?php echo esc_html( $venix_concierge_about_content['culture']['title'] ); ?></h2>
				<span class="about-rule" aria-hidden="true"></span>
				<p><?php echo esc_html( $venix_concierge_about_content['culture']['copy'] ); ?></p>
				<p class="about-copy__muted"><?php echo esc_html( $venix_concierge_about_content['culture']['supporting_copy'] ); ?></p>
				<ul class="about-culture__points"><?php foreach ( $venix_concierge_culture_points as $venix_concierge_point ) : ?><li><?php echo esc_html( $venix_concierge_point ); ?></li><?php endforeach; ?></ul>
			</div>
		</div>
	</section>

	<section class="section about-cta">
		<div class="container about-cta__content">
			<h2><?php echo esc_html( $venix_concierge_about_content['cta']['title'] ); ?></h2>
			<p><?php echo esc_html( $venix_concierge_about_content['cta']['copy'] ); ?></p>
			<?php get_template_part( 'template-parts/components/button/button', null, array( 'label' => $venix_concierge_about_content['cta']['button'], 'url' => venix_concierge_page_url( 'contact' ), 'variant' => 'gold' ) ); ?>
		</div>
	</section>
</main>
