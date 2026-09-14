<?php
/**
 * 404 template.
 *
 * @package VenixConcierge
 */

get_header();
?>

<main id="primary" class="site-main container section">
	<section class="error-404">
		<p class="eyebrow"><?php esc_html_e( '404', 'venix-concierge' ); ?></p>
		<h1><?php esc_html_e( 'Page not found', 'venix-concierge' ); ?></h1>
		<p><?php esc_html_e( 'The page you requested could not be found.', 'venix-concierge' ); ?></p>
		<?php get_search_form(); ?>
	</section>
</main>

<?php
get_footer();
