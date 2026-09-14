<?php
/**
 * Standard page.
 *
 * @package VenixConcierge
 */

get_header();
?>

<?php if ( venix_concierge_is_about_page() ) : ?>
	<?php get_template_part( 'template-parts/sections/about' ); ?>
<?php elseif ( venix_concierge_is_services_page() ) : ?>
	<?php get_template_part( 'template-parts/sections/services' ); ?>
<?php else : ?>
	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content/content', 'page' );
		endwhile;
		?>
	</main>
<?php endif; ?>

<?php
get_footer();
