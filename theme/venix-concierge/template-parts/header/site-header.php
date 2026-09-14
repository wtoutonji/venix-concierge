<?php
/** Shared production header. @package VenixConcierge */
$venix_concierge_contact_url = venix_concierge_page_url( 'contact' );
?>
<header class="site-header" data-site-header>
	<div class="container site-header__inner">
		<?php if ( has_custom_logo() ) : ?>
			<div class="site-header__brand"><?php the_custom_logo(); ?></div>
		<?php else : ?>
			<a class="site-header__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Venix Concierge home', 'venix-concierge' ); ?>"><span>VENIX <small>CONCIERGE</small></span></a>
		<?php endif; ?>
		<button class="mobile-menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation-panel" data-menu-toggle><span class="screen-reader-text" data-menu-toggle-label><?php esc_html_e( 'Open menu', 'venix-concierge' ); ?></span><span aria-hidden="true" data-menu-toggle-icon></span></button>
		<div id="primary-navigation-panel" class="site-header__panel" data-navigation-panel>
			<nav class="site-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'venix-concierge' ); ?>">
				<?php if ( has_nav_menu( 'primary' ) ) { wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => false ) ); } else { ?>
				<ul><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'venix-concierge' ); ?></a></li><li><a href="<?php echo esc_url( venix_concierge_page_url( 'about' ) ); ?>"><?php esc_html_e( 'About', 'venix-concierge' ); ?></a></li><li class="menu-item-has-children"><a href="<?php echo esc_url( venix_concierge_page_url( 'services' ) ); ?>"><?php esc_html_e( 'Services', 'venix-concierge' ); ?></a><ul class="sub-menu"><li><a href="<?php echo esc_url( venix_concierge_page_url( 'services', 'chauffeur' ) ); ?>"><?php esc_html_e( 'Chauffeur & Private Transfers', 'venix-concierge' ); ?></a></li><li><a href="<?php echo esc_url( venix_concierge_page_url( 'services', 'airport' ) ); ?>"><?php esc_html_e( 'Airport Transfers', 'venix-concierge' ); ?></a></li><li><a href="<?php echo esc_url( venix_concierge_page_url( 'services', 'events' ) ); ?>"><?php esc_html_e( 'Business & Private Events', 'venix-concierge' ); ?></a></li><li><a href="<?php echo esc_url( venix_concierge_page_url( 'services', 'delegations' ) ); ?>"><?php esc_html_e( 'Delegations & Diplomatic', 'venix-concierge' ); ?></a></li></ul></li><li class="menu-item-has-children"><a href="<?php echo esc_url( venix_concierge_page_url( 'services' ) ); ?>"><?php esc_html_e( 'Other services', 'venix-concierge' ); ?></a><ul class="sub-menu"><li><a href="<?php echo esc_url( venix_concierge_page_url( 'services', 'protection' ) ); ?>"><?php esc_html_e( 'Private Protection', 'venix-concierge' ); ?></a></li><li><a href="<?php echo esc_url( venix_concierge_page_url( 'services', 'flights' ) ); ?>"><?php esc_html_e( 'Private Flights', 'venix-concierge' ); ?></a></li><li><a href="<?php echo esc_url( venix_concierge_page_url( 'services', 'embassy' ) ); ?>"><?php esc_html_e( 'Embassy Services', 'venix-concierge' ); ?></a></li><li><a href="<?php echo esc_url( venix_concierge_page_url( 'services', 'concierge' ) ); ?>"><?php esc_html_e( 'Concierge Services', 'venix-concierge' ); ?></a></li><li><a href="<?php echo esc_url( venix_concierge_page_url( 'services', 'weddings' ) ); ?>"><?php esc_html_e( 'Weddings', 'venix-concierge' ); ?></a></li></ul></li><li><a href="<?php echo esc_url( venix_concierge_page_url( 'fleet' ) ); ?>"><?php esc_html_e( 'Fleet', 'venix-concierge' ); ?></a></li><li><a href="<?php echo esc_url( $venix_concierge_contact_url ); ?>"><?php esc_html_e( 'Contact', 'venix-concierge' ); ?></a></li></ul>
				<?php } ?>
			</nav><div class="site-header__actions"><?php venix_concierge_render_language_switcher(); ?><a class="site-header__cta" href="<?php echo esc_url( $venix_concierge_contact_url ); ?>"><?php esc_html_e( 'Request a chauffeur', 'venix-concierge' ); ?></a></div>
		</div>
	</div>
</header>
