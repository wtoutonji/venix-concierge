<?php
/** Shared footer with a Home-only four-column presentation. @package VenixConcierge */
$venix_concierge_is_home = is_front_page();
$venix_concierge_footer_content = array();
if ( $venix_concierge_is_home ) {
	$venix_concierge_footer_content = venix_concierge_home_content()['footer'];
} elseif ( venix_concierge_is_about_page() ) {
	$venix_concierge_footer_content = venix_concierge_about_content()['footer'];
} elseif ( venix_concierge_is_services_page() ) {
	$venix_concierge_footer_content = venix_concierge_services_content()['footer'];
} elseif ( venix_concierge_is_fleet_page() ) {
	$venix_concierge_footer_content = venix_concierge_fleet_content()['footer'];
} elseif ( venix_concierge_is_contact_page() ) {
	$venix_concierge_footer_content = venix_concierge_contact_content()['footer'];
}
$venix_concierge_services = $venix_concierge_is_home ? $venix_concierge_footer_content['services'] : array(
	array( 'chauffeur', 'Private transfers' ), array( 'airport', 'Airport transfers' ), array( 'events', 'Events' ), array( 'delegations', 'Delegations' ), array( 'protection', 'Private protection' ), array( 'concierge', 'Concierge' ), array( 'weddings', 'Weddings' ),
);
$venix_concierge_footer_brand = $venix_concierge_footer_content['brand_copy'] ?? __( 'Chauffeur services, executive transportation and luxury concierge in Warsaw.', 'venix-concierge' );
$venix_concierge_footer_tagline = $venix_concierge_footer_content['tagline'] ?? __( 'Own the moment', 'venix-concierge' );
$venix_concierge_footer_navigation = $venix_concierge_footer_content['navigation'] ?? __( 'Navigation', 'venix-concierge' );
$venix_concierge_footer_contact_heading = $venix_concierge_footer_content['contact_heading'] ?? __( 'Contact', 'venix-concierge' );
$venix_concierge_footer_location = $venix_concierge_footer_content['location'] ?? __( 'Warsaw, Poland', 'venix-concierge' );
$venix_concierge_footer_placeholder = $venix_concierge_footer_content['contact_placeholder'] ?? __( 'Contact details to be confirmed.', 'venix-concierge' );
?>
<footer class="site-footer <?php echo $venix_concierge_is_home ? 'site-footer--home' : ''; ?>"><div class="container site-footer__inner">
	<div class="site-footer__brand"><strong>VENIX <small>CONCIERGE</small></strong><p><?php echo esc_html( $venix_concierge_footer_brand ); ?></p><span><?php echo esc_html( $venix_concierge_footer_tagline ); ?></span></div>
	<?php if ( $venix_concierge_is_home ) : ?>
		<div class="site-footer__column"><h2><?php echo esc_html( $venix_concierge_footer_navigation ); ?></h2><?php if ( has_nav_menu( 'footer' ) ) { wp_nav_menu( array( 'theme_location' => 'footer', 'container' => 'nav', 'container_aria_label' => $venix_concierge_footer_navigation, 'fallback_cb' => false ) ); } ?></div>
		<div class="site-footer__column"><h2><?php echo esc_html( $venix_concierge_footer_content['services_heading'] ); ?></h2><nav aria-label="<?php echo esc_attr( $venix_concierge_footer_content['services_heading'] ); ?>"><ul><?php foreach ( $venix_concierge_services as $venix_concierge_service ) : ?><li><a href="<?php echo esc_url( venix_concierge_page_url( 'services', $venix_concierge_service[0] ) ); ?>"><?php echo esc_html( $venix_concierge_service[1] ); ?></a></li><?php endforeach; ?></ul></nav></div>
		<div class="site-footer__column"><h2><?php echo esc_html( $venix_concierge_footer_content['contact_heading'] ); ?></h2><p><?php echo esc_html( $venix_concierge_footer_content['contact_copy'] ); ?></p></div>
	<?php else : ?>
		<div class="site-footer__column"><h2><?php echo esc_html( $venix_concierge_footer_navigation ); ?></h2><?php if ( has_nav_menu( 'footer' ) ) { wp_nav_menu( array( 'theme_location' => 'footer', 'container' => 'nav', 'container_aria_label' => $venix_concierge_footer_navigation, 'fallback_cb' => false ) ); } ?></div>
		<div class="site-footer__column"><h2><?php echo esc_html( $venix_concierge_footer_contact_heading ); ?></h2><p><?php echo esc_html( $venix_concierge_footer_location ); ?><br><?php echo esc_html( $venix_concierge_footer_placeholder ); ?></p></div>
	<?php endif; ?>
	<div class="site-footer__bottom"><p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></p><?php if ( has_nav_menu( 'legal' ) ) { wp_nav_menu( array( 'theme_location' => 'legal', 'container' => 'nav', 'container_aria_label' => __( 'Legal navigation', 'venix-concierge' ), 'fallback_cb' => false ) ); } ?></div>
</div></footer>
