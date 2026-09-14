<?php
/**
 * Fleet page composition.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_contact_url = venix_concierge_page_url( 'contact' );
$venix_concierge_vehicles    = array(
	array(
		'id'         => 'sclass',
		'name'       => 'Mercedes-Benz S-Class',
		'badge'      => 'Flagship sedan',
		'sub_badge'  => 'Executive · VIP · Diplomatic',
		'columns'    => 'media-wide',
		'copy'       => 'The flagship choice for executive and diplomatic travel, important private occasions and VIP airport arrivals. An environment of quiet distinction and precise comfort, designed for those who expect nothing to be left to chance.',
		'use_cases'  => array( 'Executive and diplomatic travel', 'Important private occasions', 'VIP airport arrivals and departures' ),
		'cta'        => 'Request the S-Class',
		'media_alt'  => 'Photography placeholder: a black Mercedes-Benz S-Class on a Warsaw boulevard at golden hour.',
		'interior'   => array(
			'Photography placeholder: S-Class rear cabin with warm leather upholstery, ambient lighting and refined materials.',
			'Photography placeholder: S-Class front cabin detail with instrumentation, steering wheel and driver’s environment.',
		),
	),
	array(
		'id'         => 'eclass',
		'name'       => 'Mercedes-Benz E-Class',
		'badge'      => 'Executive sedan',
		'sub_badge'  => 'Corporate · Airport · Daily',
		'columns'    => 'details-wide',
		'copy'       => 'Premium business travel, corporate airport transfers and daily chauffeur requirements. Refined, discreet and dependable — a consistent professional presence for demanding schedules.',
		'use_cases'  => array( 'Corporate travel and business appointments', 'Airport transfers — arrivals and departures', 'Daily and multi-day chauffeur hire' ),
		'cta'        => 'Request the E-Class',
		'media_alt'  => 'Photography placeholder: a black Mercedes-Benz E-Class in a Warsaw business district.',
	),
	array(
		'id'         => 'vclass',
		'name'       => 'Mercedes-Benz V-Class',
		'badge'      => 'Luxury van',
		'sub_badge'  => 'Families · Groups · Events',
		'columns'    => 'media-wide',
		'copy'       => 'Families, executive teams and small groups travelling together in comfort. The V-Class combines generous interior space with premium presentation, making it equally suited to airport transfers, event transport and multi-stop city journeys.',
		'use_cases'  => array( 'Airport transfers for families and groups', 'Executive team travel', 'Event guest transportation' ),
		'cta'        => 'Request the V-Class',
		'media_alt'  => 'Photography placeholder: a black Mercedes-Benz V-Class at a Warsaw hotel entrance.',
		'interior'   => array(
			'Photography placeholder: V-Class rear seating area with individual seats, warm ambient tone and generous legroom.',
			'Photography placeholder: V-Class luggage area, clean and accessible for airport transfers with checked baggage.',
		),
	),
	array(
		'id'         => 'vclassxl',
		'name'       => 'Mercedes-Benz V-Class Extra Long',
		'badge'      => 'Luxury van · Extended',
		'sub_badge'  => 'Groups · Luggage · Long routes',
		'columns'    => 'details-wide',
		'copy'       => 'The extended version of the V-Class provides additional cabin length for groups with more luggage, longer intercity journeys or when extra interior space improves comfort for the passengers.',
		'use_cases'  => array( 'Groups with substantial luggage', 'Longer intercity journeys', 'Event and delegation transport' ),
		'cta'        => 'Request the V-Class XL',
		'media_alt'  => 'Photography placeholder: a Mercedes-Benz V-Class Extra Long on a Warsaw airport road.',
	),
	array(
		'id'         => 'sprinter',
		'name'       => 'Mercedes-Benz Sprinter',
		'badge'      => 'Group transport',
		'sub_badge'  => '9 · 16 · 19 passenger configurations',
		'columns'    => 'media-wide',
		'copy'       => 'Group transportation for conferences, delegations, weddings and events — available in 9, 16 and 19-seat configurations. Professional presentation, coordinated scheduling and driver dispatch. The right choice when groups need to move together with comfort and punctuality.',
		'use_cases'  => array( 'Conference and corporate event transport', 'Delegation and embassy group movements', 'Wedding guest coordination' ),
		'cta'        => 'Request a Sprinter',
		'media_alt'  => 'Photography placeholder: a Mercedes-Benz Sprinter at a Warsaw conference centre for group transport.',
	),
);

$venix_concierge_recommendation_points = array(
	array( 'Passengers', 'How many people are travelling?' ),
	array( 'Luggage', 'Checked bags, hand luggage, equipment?' ),
	array( 'Occasion', 'Business, event, airport, private?' ),
);
?>
<main id="main-content" class="site-main venix-fleet">
	<section class="fleet-hero">
		<div class="fleet-hero__media" aria-hidden="true"></div>
		<div class="container fleet-hero__content">
			<p class="venix-eyebrow">The fleet</p>
			<h1>The right vehicle for every journey</h1>
			<p>A curated fleet of Mercedes-Benz vehicles, each selected to serve different journey types, passenger groups and occasions with equal professionalism.</p>
		</div>
	</section>

	<section class="fleet-notice" aria-label="Fleet availability notice">
		<div class="container fleet-notice__inner">
			<p>Exact model, configuration, colour and availability may vary. Passenger and luggage capacities to be confirmed.</p>
			<a href="<?php echo esc_url( $venix_concierge_contact_url ); ?>">Need a vehicle recommendation? Contact us <span class="venix-icon-directional" aria-hidden="true">→</span></a>
		</div>
	</section>

	<section class="fleet-vehicles">
		<div class="container">
			<?php foreach ( $venix_concierge_vehicles as $venix_concierge_vehicle ) : ?>
				<article id="<?php echo esc_attr( $venix_concierge_vehicle['id'] ); ?>" class="fleet-vehicle">
					<div class="fleet-vehicle__card fleet-vehicle__card--<?php echo esc_attr( $venix_concierge_vehicle['columns'] ); ?>">
						<div class="fleet-vehicle__media" role="img" aria-label="<?php echo esc_attr( $venix_concierge_vehicle['media_alt'] ); ?>"></div>
						<div class="fleet-vehicle__details">
							<div class="fleet-vehicle__badges">
								<?php get_template_part( 'template-parts/components/badge/badge', null, array( 'label' => $venix_concierge_vehicle['badge'], 'tone' => 'brand' ) ); ?>
								<span><?php echo esc_html( $venix_concierge_vehicle['sub_badge'] ); ?></span>
							</div>
							<h2><?php echo esc_html( $venix_concierge_vehicle['name'] ); ?></h2>
							<span class="fleet-rule" aria-hidden="true"></span>
							<p class="fleet-vehicle__copy"><?php echo esc_html( $venix_concierge_vehicle['copy'] ); ?></p>
							<ul>
								<?php foreach ( $venix_concierge_vehicle['use_cases'] as $venix_concierge_use_case ) : ?>
									<li><?php echo esc_html( $venix_concierge_use_case ); ?></li>
								<?php endforeach; ?>
							</ul>
							<p class="fleet-vehicle__capacity">[Confirm passenger &amp; luggage capacity]</p>
							<?php get_template_part( 'template-parts/components/button/button', null, array( 'label' => $venix_concierge_vehicle['cta'], 'url' => $venix_concierge_contact_url, 'variant' => 'primary' ) ); ?>
						</div>
					</div>
					<?php if ( ! empty( $venix_concierge_vehicle['interior'] ) ) : ?>
						<div class="fleet-vehicle__interior">
							<?php foreach ( $venix_concierge_vehicle['interior'] as $venix_concierge_interior_intent ) : ?>
								<div class="fleet-vehicle__interior-media" role="img" aria-label="<?php echo esc_attr( $venix_concierge_interior_intent ); ?>"></div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="fleet-recommendation">
		<div class="container fleet-recommendation__inner">
			<div class="fleet-recommendation__copy">
				<p class="venix-eyebrow">Not sure?</p>
				<h2>We will recommend the right vehicle for your journey</h2>
				<p>Share your passenger count, luggage requirements, journey type and any special needs. Our team will suggest the most appropriate option and confirm availability.</p>
				<?php get_template_part( 'template-parts/components/button/button', null, array( 'label' => 'Get a vehicle recommendation', 'url' => $venix_concierge_contact_url, 'variant' => 'ghost-inverse' ) ); ?>
			</div>
			<div class="fleet-recommendation__points">
				<?php foreach ( $venix_concierge_recommendation_points as $venix_concierge_point ) : ?>
					<div><h3><?php echo esc_html( $venix_concierge_point[0] ); ?></h3><p><?php echo esc_html( $venix_concierge_point[1] ); ?></p></div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</main>
