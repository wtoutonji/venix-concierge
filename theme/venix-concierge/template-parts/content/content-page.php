<?php
/**
 * Generic content.
 *
 * @package VenixConcierge
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry container section' ); ?>>
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page navigation', 'venix-concierge' ) . '"><span class="page-links__title">' . esc_html__( 'Pages:', 'venix-concierge' ) . '</span>',
				'after'  => '</nav>',
			)
		);
		?>
	</div>
</article>
