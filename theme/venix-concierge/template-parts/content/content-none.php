<?php
/**
 * Empty content state.
 *
 * @package VenixConcierge
 */

?>
<section class="no-results not-found">
	<header class="no-results__header">
		<h2 class="no-results__title"><?php esc_html_e( 'Nothing found', 'venix-concierge' ); ?></h2>
	</header>

	<div class="no-results__content">
		<?php if ( is_search() ) : ?>
			<p><?php esc_html_e( 'No results matched your search. Try different keywords.', 'venix-concierge' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'No content is available here yet.', 'venix-concierge' ); ?></p>
		<?php endif; ?>
	</div>
</section>
