<?php
/**
 * Post summary for list contexts.
 *
 * @package VenixConcierge
 */

$venix_concierge_post_title = get_the_title();
$venix_concierge_post_title = $venix_concierge_post_title ? $venix_concierge_post_title : __( 'Untitled', 'venix-concierge' );
$venix_concierge_permalink  = get_permalink();

/* translators: %s: Post title. */
$venix_concierge_media_label = sprintf( __( 'Read: %s', 'venix-concierge' ), $venix_concierge_post_title );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-summary' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a
			class="post-summary__media"
			href="<?php echo esc_url( $venix_concierge_permalink ); ?>"
			aria-label="<?php echo esc_attr( $venix_concierge_media_label ); ?>"
		>
			<?php the_post_thumbnail( 'medium_large' ); ?>
		</a>
	<?php endif; ?>

	<div class="post-summary__content">
		<h2 class="post-summary__title">
			<a href="<?php echo esc_url( $venix_concierge_permalink ); ?>"><?php echo esc_html( $venix_concierge_post_title ); ?></a>
		</h2>
		<?php the_excerpt(); ?>
	</div>
</article>
