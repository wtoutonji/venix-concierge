<?php
/**
 * Main site header.
 *
 * Replace markup with project design while preserving WordPress-managed data.
 *
 * @package VenixConcierge
 */

$venix_concierge_has_primary_navigation = has_nav_menu( 'primary' );
$venix_concierge_has_language_switcher  = has_action( 'venix_concierge_header_language_switcher' );
$venix_concierge_has_header_cta         = has_action( 'venix_concierge_header_cta' );
$venix_concierge_has_header_panel       = $venix_concierge_has_primary_navigation || $venix_concierge_has_language_switcher || $venix_concierge_has_header_cta;
?>
<header class="site-header" data-site-header>
	<div class="container site-header__inner">
		<div class="site-header__brand">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				printf(
					'<a href="%1$s" class="site-title">%2$s</a>',
					esc_url( home_url( '/' ) ),
					esc_html( get_bloginfo( 'name' ) )
				);
			}
			?>
		</div>

		<?php if ( $venix_concierge_has_header_panel ) : ?>
			<button
				class="mobile-menu-toggle"
				type="button"
				aria-expanded="false"
				aria-controls="primary-navigation-panel"
				data-open-label="<?php esc_attr_e( 'Open menu', 'venix-concierge' ); ?>"
				data-close-label="<?php esc_attr_e( 'Close menu', 'venix-concierge' ); ?>"
				data-menu-toggle
				hidden
			>
				<span class="screen-reader-text" data-menu-toggle-label><?php esc_html_e( 'Open menu', 'venix-concierge' ); ?></span>
				<span aria-hidden="true" data-menu-toggle-icon>âک°</span>
			</button>

			<div id="primary-navigation-panel" class="site-header__panel" data-navigation-panel>
				<?php if ( $venix_concierge_has_primary_navigation ) : ?>
					<nav class="site-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'venix-concierge' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'container'      => false,
								'fallback_cb'    => false,
							)
						);
						?>
					</nav>
				<?php endif; ?>

				<?php if ( $venix_concierge_has_language_switcher || $venix_concierge_has_header_cta ) : ?>
					<div class="site-header__actions" data-header-actions>
						<?php if ( $venix_concierge_has_language_switcher ) : ?>
							<div class="site-header__language-switcher">
								<?php
								/**
								 * Render a client-provided language switcher.
								 *
								 * @since 1.0.1
								 */
								do_action( 'venix_concierge_header_language_switcher' );
								?>
							</div>
						<?php endif; ?>

						<?php if ( $venix_concierge_has_header_cta ) : ?>
							<div class="site-header__cta">
								<?php
								/**
								 * Render client-provided header calls to action.
								 *
								 * @since 1.0.1
								 */
								do_action( 'venix_concierge_header_cta' );
								?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</header>
