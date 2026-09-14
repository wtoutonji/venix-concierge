<?php
/**
 * Venix button component.
 *
 * @package VenixConcierge
 *
 * @var array $args Component arguments: label, url, variant, size, type.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_button_label = isset( $args['label'] ) && is_string( $args['label'] ) ? trim( wp_strip_all_tags( $args['label'] ) ) : '';
$venix_concierge_button_url   = isset( $args['url'] ) && is_string( $args['url'] ) ? $args['url'] : '';
$venix_concierge_button_type  = isset( $args['type'] ) && is_string( $args['type'] ) ? $args['type'] : 'button';
$venix_concierge_button_variant = isset( $args['variant'] ) && is_string( $args['variant'] ) ? $args['variant'] : 'primary';
$venix_concierge_button_size    = isset( $args['size'] ) && is_string( $args['size'] ) ? $args['size'] : 'md';

if ( '' === $venix_concierge_button_label || ! in_array( $venix_concierge_button_variant, array( 'primary', 'ghost', 'gold', 'text', 'ghost-inverse' ), true ) || ! in_array( $venix_concierge_button_size, array( 'sm', 'md', 'lg' ), true ) || ! in_array( $venix_concierge_button_type, array( 'button', 'submit', 'reset' ), true ) ) {
	return;
}

venix_concierge_enqueue_component( 'button' );
$venix_concierge_button_classes = 'venix-button venix-button--' . $venix_concierge_button_variant . ' venix-button--' . $venix_concierge_button_size;

if ( '' !== $venix_concierge_button_url ) :
	?>
	<a class="<?php echo esc_attr( $venix_concierge_button_classes ); ?>" href="<?php echo esc_url( $venix_concierge_button_url ); ?>"><?php echo esc_html( $venix_concierge_button_label ); ?></a>
	<?php
	return;
endif;
?>
<button class="<?php echo esc_attr( $venix_concierge_button_classes ); ?>" type="<?php echo esc_attr( $venix_concierge_button_type ); ?>"><?php echo esc_html( $venix_concierge_button_label ); ?></button>
