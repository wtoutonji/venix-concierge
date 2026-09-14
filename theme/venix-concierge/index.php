<?php
/**
 * Fallback template.
 *
 * @package VenixConcierge
 */

get_header();
?>

<main id="primary" class="site-main container section">
	<header class="fallback-header">
		<h1 class="fallback-title"><?php esc_html_e( 'Latest content', 'venix-concierge' ); ?></h1>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="post-list">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', 'summary' );
			endwhile;
			?>
		</div>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
	<?php endif; ?>
</main>

<?php
get_footer();
