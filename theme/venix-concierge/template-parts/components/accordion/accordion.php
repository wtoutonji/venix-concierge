<?php
/**
 * Accordion component.
 *
 * @package VenixConcierge
 *
 * @var array $args {
 *     Component arguments.
 *
 *     @type array[] $items Accordion items.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_accordion_items = isset( $args['items'] ) && is_array( $args['items'] )
	? $args['items']
	: array();

$venix_concierge_accordion_items = array_values(
	array_filter(
		array_map(
			static function ( $item ) {
				if ( ! is_array( $item ) || ! isset( $item['title'], $item['content'] ) || ! is_string( $item['title'] ) || ! is_string( $item['content'] ) ) {
					return null;
				}

				$title = trim( wp_strip_all_tags( $item['title'] ) );

				if ( '' === $title ) {
					return null;
				}

				return array(
					'title'   => $title,
					'content' => $item['content'],
					'open'    => isset( $item['open'] ) && true === $item['open'],
				);
			},
			$venix_concierge_accordion_items
		)
	)
);

if ( empty( $venix_concierge_accordion_items ) ) {
	return;
}

venix_concierge_enqueue_component( 'accordion' );
?>
<div class="tly-accordion">
	<?php foreach ( $venix_concierge_accordion_items as $venix_concierge_accordion_item ) : ?>
		<details
			class="tly-accordion__item"
			<?php if ( $venix_concierge_accordion_item['open'] ) : ?>
				open
			<?php endif; ?>
		>
			<summary class="tly-accordion__summary">
				<span class="tly-accordion__title"><?php echo esc_html( $venix_concierge_accordion_item['title'] ); ?></span>
			</summary>
			<div class="tly-accordion__content">
				<?php echo wp_kses_post( $venix_concierge_accordion_item['content'] ); ?>
			</div>
		</details>
	<?php endforeach; ?>
</div>
