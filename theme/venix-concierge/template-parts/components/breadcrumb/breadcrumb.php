<?php
/**
 * Breadcrumb component.
 *
 * @package VenixConcierge
 *
 * @var array $args {
 *     Optional component arguments.
 *
 *     @type array[] $items      Breadcrumb items. Each item requires a label
 *                               and may include a URL. Defaults to the current
 *                               WordPress request trail.
 *     @type string  $aria_label Navigation landmark label.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_breadcrumb_items = isset( $args['items'] ) && is_array( $args['items'] )
	? $args['items']
	: venix_concierge_get_breadcrumb_items();

$venix_concierge_breadcrumb_aria_label = isset( $args['aria_label'] ) && is_string( $args['aria_label'] )
	? $args['aria_label']
	: _x( 'Breadcrumb', 'navigation landmark label', 'venix-concierge' );

$venix_concierge_breadcrumb_aria_label = trim( $venix_concierge_breadcrumb_aria_label );

if ( '' === $venix_concierge_breadcrumb_aria_label ) {
	$venix_concierge_breadcrumb_aria_label = _x( 'Breadcrumb', 'navigation landmark label', 'venix-concierge' );
}

if ( ! is_array( $venix_concierge_breadcrumb_items ) ) {
	$venix_concierge_breadcrumb_items = array();
}

$venix_concierge_breadcrumb_items = array_values(
	array_filter(
		$venix_concierge_breadcrumb_items,
		static function ( $item ) {
			return is_array( $item ) && isset( $item['label'] ) && '' !== trim( (string) $item['label'] );
		}
	)
);

if ( count( $venix_concierge_breadcrumb_items ) < 2 ) {
	return;
}
?>
<nav class="tly-breadcrumb" aria-label="<?php echo esc_attr( $venix_concierge_breadcrumb_aria_label ); ?>">
	<ol class="tly-breadcrumb__list">
		<?php foreach ( $venix_concierge_breadcrumb_items as $venix_concierge_breadcrumb_index => $venix_concierge_breadcrumb_item ) : ?>
			<?php $venix_concierge_breadcrumb_is_current = array_key_last( $venix_concierge_breadcrumb_items ) === $venix_concierge_breadcrumb_index; ?>
			<li class="tly-breadcrumb__item">
				<?php if ( ! $venix_concierge_breadcrumb_is_current && ! empty( $venix_concierge_breadcrumb_item['url'] ) ) : ?>
					<a class="tly-breadcrumb__link" href="<?php echo esc_url( $venix_concierge_breadcrumb_item['url'] ); ?>">
						<?php echo esc_html( $venix_concierge_breadcrumb_item['label'] ); ?>
					</a>
				<?php elseif ( $venix_concierge_breadcrumb_is_current ) : ?>
					<span class="tly-breadcrumb__current" aria-current="page">
						<?php echo esc_html( $venix_concierge_breadcrumb_item['label'] ); ?>
					</span>
				<?php else : ?>
					<span class="tly-breadcrumb__label">
						<?php echo esc_html( $venix_concierge_breadcrumb_item['label'] ); ?>
					</span>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ol>
</nav>
