<?php
/**
 * Fleet page composition.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_contact_url   = venix_concierge_page_url( 'contact' );
$venix_concierge_fleet_content = venix_concierge_fleet_content();
$venix_concierge_vehicles      = $venix_concierge_fleet_content['vehicles'];
?>
<main id="main-content" class="site-main venix-fleet">
	<section class="fleet-hero">
		<?php venix_concierge_render_media( venix_concierge_media_attachment_id( 'fleet.hero' ), array( 'class' => 'fleet-hero__media', 'alt' => '', 'sizes' => '100vw', 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?>
		<div class="container fleet-hero__content">
			<p class="venix-eyebrow"><?php echo esc_html( $venix_concierge_fleet_content['hero']['eyebrow'] ); ?></p>
			<h1><?php echo esc_html( $venix_concierge_fleet_content['hero']['title'] ); ?></h1>
			<p><?php echo esc_html( $venix_concierge_fleet_content['hero']['copy'] ); ?></p>
		</div>
	</section>

	<section class="fleet-notice" aria-label="<?php echo esc_attr( $venix_concierge_fleet_content['notice']['aria_label'] ); ?>">
		<div class="container fleet-notice__inner">
			<p><?php echo esc_html( $venix_concierge_fleet_content['notice']['copy'] ); ?></p>
			<a href="<?php echo esc_url( $venix_concierge_contact_url ); ?>"><?php echo esc_html( $venix_concierge_fleet_content['notice']['link'] ); ?> <span class="venix-icon-directional" aria-hidden="true">→</span></a>
		</div>
	</section>

	<section class="fleet-vehicles">
		<div class="container">
			<?php foreach ( $venix_concierge_vehicles as $venix_concierge_vehicle ) : ?>
				<article id="<?php echo esc_attr( $venix_concierge_vehicle['id'] ); ?>" class="fleet-vehicle">
					<div class="fleet-vehicle__card fleet-vehicle__card--<?php echo esc_attr( $venix_concierge_vehicle['columns'] ); ?>">
						<?php venix_concierge_render_media( venix_concierge_media_attachment_id( 'fleet.' . str_replace( 'vclassxl', 'v_class_extra_long', str_replace( 'class', '_class', $venix_concierge_vehicle['id'] ) ) . '.exterior' ), array( 'class' => 'fleet-vehicle__media', 'alt' => str_replace( 'Alt: ', '', $venix_concierge_vehicle['media_alt'] ), 'sizes' => '(min-width: 769px) 55vw, 100vw' ) ); ?>
						<div class="fleet-vehicle__details">
							<div class="fleet-vehicle__badges">
								<?php get_template_part( 'template-parts/components/badge/badge', null, array( 'label' => $venix_concierge_vehicle['badge'], 'tone' => 'solid' ) ); ?>
								<span class="fleet-vehicle__meta"><?php echo esc_html( $venix_concierge_vehicle['sub_badge'] ); ?></span>
							</div>
							<div class="fleet-vehicle__title">
								<h2><?php echo esc_html( $venix_concierge_vehicle['name'] ); ?></h2>
								<span class="fleet-rule" aria-hidden="true"></span>
							</div>
							<p class="fleet-vehicle__copy"><?php echo esc_html( $venix_concierge_vehicle['copy'] ); ?></p>
							<ul>
								<?php foreach ( $venix_concierge_vehicle['use_cases'] as $venix_concierge_use_case ) : ?>
									<li><?php echo esc_html( $venix_concierge_use_case ); ?></li>
								<?php endforeach; ?>
							</ul>
							<p class="fleet-vehicle__capacity"><?php echo esc_html( $venix_concierge_fleet_content['capacity_placeholder'] ); ?></p>
							<?php get_template_part( 'template-parts/components/button/button', null, array( 'label' => $venix_concierge_vehicle['cta'], 'url' => $venix_concierge_contact_url, 'variant' => 'primary' ) ); ?>
						</div>
					</div>
					<?php if ( ! empty( $venix_concierge_vehicle['interior'] ) ) : ?>
						<div class="fleet-vehicle__interior">
							<?php foreach ( $venix_concierge_vehicle['interior'] as $venix_concierge_interior_index => $venix_concierge_interior_intent ) : ?>
								<?php venix_concierge_render_media( venix_concierge_media_attachment_id( 'fleet.' . str_replace( 'class', '_class', $venix_concierge_vehicle['id'] ) . '.interior_' . ( $venix_concierge_interior_index + 1 ) ), array( 'class' => 'fleet-vehicle__interior-media', 'alt' => $venix_concierge_interior_intent, 'sizes' => '(min-width: 769px) 45vw, 100vw' ) ); ?>
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
				<p class="venix-eyebrow"><span><?php echo esc_html( $venix_concierge_fleet_content['recommendation']['eyebrow'] ); ?></span></p>
				<h2><?php echo esc_html( $venix_concierge_fleet_content['recommendation']['title'] ); ?></h2>
				<p><?php echo esc_html( $venix_concierge_fleet_content['recommendation']['copy'] ); ?></p>
				<?php get_template_part( 'template-parts/components/button/button', null, array( 'label' => $venix_concierge_fleet_content['recommendation']['button'], 'url' => $venix_concierge_contact_url, 'variant' => 'ghost-inverse' ) ); ?>
			</div>
			<div class="fleet-recommendation__points">
				<?php foreach ( $venix_concierge_fleet_content['recommendation']['points'] as $venix_concierge_point ) : ?>
					<div><h3><?php echo esc_html( $venix_concierge_point[0] ); ?></h3><p><?php echo esc_html( $venix_concierge_point[1] ); ?></p></div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</main>
