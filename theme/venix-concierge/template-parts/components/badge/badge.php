<?php
/**
 * Venix badge component.
 *
 * @package VenixConcierge
 *
 * @var array $args Component arguments: label, tone, dot.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_badge_label = isset( $args['label'] ) && is_string( $args['label'] ) ? trim( wp_strip_all_tags( $args['label'] ) ) : '';
$venix_concierge_badge_tone  = isset( $args['tone'] ) && is_string( $args['tone'] ) ? $args['tone'] : 'brand';
$venix_concierge_badge_dot   = isset( $args['dot'] ) && true === $args['dot'];

if ( '' === $venix_concierge_badge_label || ! in_array( $venix_concierge_badge_tone, array( 'brand', 'outline', 'gold', 'solid', 'dark', 'muted', 'warm', 'inverse' ), true ) ) {
	return;
}

venix_concierge_enqueue_component( 'badge' );
?>
<span class="venix-badge venix-badge--<?php echo esc_attr( $venix_concierge_badge_tone ); ?>">
	<?php if ( $venix_concierge_badge_dot ) : ?>
		<span class="venix-badge__dot" aria-hidden="true"></span>
	<?php endif; ?>
	<?php echo esc_html( $venix_concierge_badge_label ); ?>
</span>
