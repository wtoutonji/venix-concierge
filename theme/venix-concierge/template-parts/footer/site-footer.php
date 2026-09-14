<?php
/**
 * Main site footer.
 *
 * @package VenixConcierge
 */

?>
<footer class="site-footer">
	<div class="container site-footer__inner">
		<div>
			<strong><?php echo esc_html( get_bloginfo( 'name' ) ); ?></strong>
		</div>

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav aria-label="<?php esc_attr_e( 'Footer navigation', 'venix-concierge' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
		<?php endif; ?>

		<?php if ( has_nav_menu( 'legal' ) ) : ?>
			<nav class="site-footer__legal" aria-label="<?php esc_attr_e( 'Legal navigation', 'venix-concierge' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'legal',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
		<?php endif; ?>

		<p class="site-footer__copyright">
			&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
		</p>
	</div>
</footer>
