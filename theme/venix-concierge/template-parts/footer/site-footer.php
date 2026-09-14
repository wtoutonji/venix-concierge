<?php
/** Shared footer with a Home-only four-column presentation. @package VenixConcierge */
$venix_concierge_is_home = is_front_page();
$venix_concierge_services = array(
	array( 'chauffeur', 'Private transfers' ),
	array( 'airport', 'Airport transfers' ),
	array( 'events', 'Events' ),
	array( 'delegations', 'Delegations' ),
	array( 'protection', 'Private protection' ),
	array( 'concierge', 'Concierge' ),
	array( 'weddings', 'Weddings' ),
);
?>
<footer class="site-footer <?php echo $venix_concierge_is_home ? 'site-footer--home' : ''; ?>">
	<div class="container site-footer__inner">
		<div class="site-footer__brand"><strong>VENIX <small>CONCIERGE</small></strong><p><?php esc_html_e( 'Chauffeur services, executive transportation and luxury concierge in Warsaw.', 'venix-concierge' ); ?></p><span><?php esc_html_e( 'Own the moment', 'venix-concierge' ); ?></span></div>
		<?php if ( $venix_concierge_is_home ) : ?>
			<div class="site-footer__column"><h2><?php esc_html_e( 'Navigation', 'venix-concierge' ); ?></h2><?php if ( has_nav_menu( 'footer' ) ) { wp_nav_menu( array( 'theme_location' => 'footer', 'container' => 'nav', 'container_aria_label' => __( 'Footer navigation', 'venix-concierge' ), 'fallback_cb' => false ) ); } ?></div>
			<div class="site-footer__column"><h2><?php esc_html_e( 'Services', 'venix-concierge' ); ?></h2><nav aria-label="<?php esc_attr_e( 'Services', 'venix-concierge' ); ?>"><ul><?php foreach ( $venix_concierge_services as $venix_concierge_service ) : ?><li><a href="<?php echo esc_url( venix_concierge_page_url( 'services', $venix_concierge_service[0] ) ); ?>"><?php echo esc_html( $venix_concierge_service[1] ); ?></a></li><?php endforeach; ?></ul></nav></div>
			<div class="site-footer__column"><h2><?php esc_html_e( 'Contact', 'venix-concierge' ); ?></h2><p><?php esc_html_e( 'Warsaw, Poland', 'venix-concierge' ); ?><br><?php esc_html_e( 'Contact details to be confirmed.', 'venix-concierge' ); ?></p></div>
		<?php else : ?>
			<div class="site-footer__column"><h2><?php esc_html_e( 'Navigation', 'venix-concierge' ); ?></h2><?php if ( has_nav_menu( 'footer' ) ) { wp_nav_menu( array( 'theme_location' => 'footer', 'container' => 'nav', 'container_aria_label' => __( 'Footer navigation', 'venix-concierge' ), 'fallback_cb' => false ) ); } ?></div>
			<div class="site-footer__column"><h2><?php esc_html_e( 'Contact', 'venix-concierge' ); ?></h2><p><?php esc_html_e( 'Warsaw, Poland', 'venix-concierge' ); ?><br><?php esc_html_e( 'Contact details to be confirmed.', 'venix-concierge' ); ?></p></div>
		<?php endif; ?>
		<div class="site-footer__bottom"><p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></p><?php if ( has_nav_menu( 'legal' ) ) { wp_nav_menu( array( 'theme_location' => 'legal', 'container' => 'nav', 'container_aria_label' => __( 'Legal navigation', 'venix-concierge' ), 'fallback_cb' => false ) ); } ?></div>
	</div>
</footer>
