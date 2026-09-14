<?php
/**
 * Posts index.
 *
 * @package VenixConcierge
 */

$venix_concierge_posts_page_id    = (int) get_option( 'page_for_posts' );
$venix_concierge_posts_page_title = $venix_concierge_posts_page_id ? get_the_title( $venix_concierge_posts_page_id ) : '';
$venix_concierge_posts_page_title = $venix_concierge_posts_page_title ? $venix_concierge_posts_page_title : __( 'Latest posts', 'venix-concierge' );

get_header();
?>

<main id="primary" class="site-main container section">
	<header class="posts-header">
		<h1 class="posts-title"><?php echo esc_html( $venix_concierge_posts_page_title ); ?></h1>
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
