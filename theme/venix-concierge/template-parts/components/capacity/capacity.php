<?php
/**
 * Venix vehicle capacity component.
 *
 * Shared by Home and Fleet. Values come from venix_concierge_vehicle_capacity().
 *
 * @package VenixConcierge
 *
 * @var array $args Component arguments: vehicle (fleet vehicle id).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_capacity_vehicle = isset( $args['vehicle'] ) && is_string( $args['vehicle'] ) ? $args['vehicle'] : '';

if ( '' === $venix_concierge_capacity_vehicle ) {
	return;
}

$venix_concierge_capacity_icons = array(
	'passengers' => '<circle cx="12" cy="8" r="3.6"></circle><path d="M4.8 20.2c.6-3.8 3.6-6 7.2-6s6.6 2.2 7.2 6"></path>',
	'luggage'    => '<rect x="4.5" y="7.5" width="15" height="12" rx="2"></rect><path d="M9 7.5V5.2C9 4.5 9.5 4 10.2 4h3.6c.7 0 1.2.5 1.2 1.2v2.3M9.5 11v5.5M14.5 11v5.5M8 20v1.2M16 20v1.2"></path>',
);

venix_concierge_enqueue_component( 'capacity' );
?>
<div class="venix-capacity">
	<?php foreach ( venix_concierge_vehicle_capacity( $venix_concierge_capacity_vehicle ) as $venix_concierge_capacity_item ) : ?>
		<span class="venix-capacity__item venix-capacity__item--<?php echo esc_attr( $venix_concierge_capacity_item['key'] ); ?>">
			<svg class="venix-capacity__icon" aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"><?php echo $venix_concierge_capacity_icons[ $venix_concierge_capacity_item['key'] ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG markup defined above. ?></svg>
			<span class="screen-reader-text"><?php echo esc_html( $venix_concierge_capacity_item['label'] ); ?>: </span>
			<span class="venix-capacity__value<?php echo $venix_concierge_capacity_item['confirmed'] ? '' : ' venix-capacity__value--tbc'; ?>"><?php echo esc_html( $venix_concierge_capacity_item['value'] ); ?></span>
		</span>
	<?php endforeach; ?>
</div>
