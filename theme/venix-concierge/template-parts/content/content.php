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
		<?php the_content(); ?>
	</div>
</article>
