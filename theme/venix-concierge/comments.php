<?php
/**
 * Comments template.
 *
 * @package VenixConcierge
 */

if ( post_password_required() ) {
	return;
}
?>

<section id="comments" class="comments-area container section">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$venix_concierge_comment_count = get_comments_number();

			printf(
				/* translators: %s: Number of comments. */
				esc_html( _n( '%s comment', '%s comments', $venix_concierge_comment_count, 'venix-concierge' ) ),
				esc_html( number_format_i18n( $venix_concierge_comment_count ) )
			);
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 64,
				)
			);
			?>
		</ol>

		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'venix-concierge' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
		)
	);
	?>
</section>
