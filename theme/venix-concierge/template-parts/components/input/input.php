<?php
/**
 * Venix form-field component.
 *
 * @package VenixConcierge
 *
 * @var array $args Component arguments: id, name, label, type, value, placeholder, hint, invalid, required, options.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_input_id          = isset( $args['id'] ) && is_string( $args['id'] ) ? sanitize_html_class( $args['id'] ) : '';
$venix_concierge_input_name        = isset( $args['name'] ) && is_string( $args['name'] ) ? sanitize_key( $args['name'] ) : '';
$venix_concierge_input_label       = isset( $args['label'] ) && is_string( $args['label'] ) ? trim( wp_strip_all_tags( $args['label'] ) ) : '';
$venix_concierge_input_type        = isset( $args['type'] ) && is_string( $args['type'] ) ? $args['type'] : 'text';
$venix_concierge_input_hint        = isset( $args['hint'] ) && is_string( $args['hint'] ) ? trim( wp_strip_all_tags( $args['hint'] ) ) : '';
$venix_concierge_input_options     = array();

if ( '' === $venix_concierge_input_id || '' === $venix_concierge_input_name || '' === $venix_concierge_input_label || ! in_array( $venix_concierge_input_type, array( 'email', 'select', 'tel', 'text', 'textarea' ), true ) ) {
	return;
}

if ( 'select' === $venix_concierge_input_type && isset( $args['options'] ) && is_array( $args['options'] ) ) {
	foreach ( $args['options'] as $venix_concierge_input_option_value => $venix_concierge_input_option_label ) {
		if ( is_scalar( $venix_concierge_input_option_value ) && is_scalar( $venix_concierge_input_option_label ) ) {
			$venix_concierge_input_options[ (string) $venix_concierge_input_option_value ] = (string) $venix_concierge_input_option_label;
		}
	}
}

if ( 'select' === $venix_concierge_input_type && empty( $venix_concierge_input_options ) ) {
	return;
}

venix_concierge_enqueue_component( 'input' );
$venix_concierge_input_invalid     = isset( $args['invalid'] ) && true === $args['invalid'];
$venix_concierge_input_required    = isset( $args['required'] ) && true === $args['required'];
$venix_concierge_input_value       = isset( $args['value'] ) ? (string) $args['value'] : '';
$venix_concierge_input_placeholder = isset( $args['placeholder'] ) ? (string) $args['placeholder'] : '';
?>
<div class="venix-field<?php echo $venix_concierge_input_invalid ? ' venix-field--invalid' : ''; ?>">
	<label class="venix-field__label" for="<?php echo esc_attr( $venix_concierge_input_id ); ?>"><?php echo esc_html( $venix_concierge_input_label ); ?></label>
	<?php if ( 'textarea' === $venix_concierge_input_type ) : ?>
		<textarea class="venix-field__control venix-field__control--textarea" id="<?php echo esc_attr( $venix_concierge_input_id ); ?>" name="<?php echo esc_attr( $venix_concierge_input_name ); ?>" placeholder="<?php echo esc_attr( $venix_concierge_input_placeholder ); ?>"<?php echo $venix_concierge_input_invalid ? ' aria-invalid="true"' : ''; ?><?php echo $venix_concierge_input_required ? ' required' : ''; ?>><?php echo esc_textarea( $venix_concierge_input_value ); ?></textarea>
	<?php elseif ( 'select' === $venix_concierge_input_type ) : ?>
		<span class="venix-field__select-wrap">
			<select class="venix-field__control venix-field__control--select" id="<?php echo esc_attr( $venix_concierge_input_id ); ?>" name="<?php echo esc_attr( $venix_concierge_input_name ); ?>"<?php echo $venix_concierge_input_invalid ? ' aria-invalid="true"' : ''; ?><?php echo $venix_concierge_input_required ? ' required' : ''; ?>>
				<?php foreach ( $venix_concierge_input_options as $venix_concierge_input_option_value => $venix_concierge_input_option_label ) : ?>
					<option value="<?php echo esc_attr( $venix_concierge_input_option_value ); ?>"<?php selected( $venix_concierge_input_value, $venix_concierge_input_option_value ); ?>><?php echo esc_html( $venix_concierge_input_option_label ); ?></option>
				<?php endforeach; ?>
			</select>
		</span>
	<?php else : ?>
		<input class="venix-field__control" id="<?php echo esc_attr( $venix_concierge_input_id ); ?>" name="<?php echo esc_attr( $venix_concierge_input_name ); ?>" type="<?php echo esc_attr( $venix_concierge_input_type ); ?>" value="<?php echo esc_attr( $venix_concierge_input_value ); ?>" placeholder="<?php echo esc_attr( $venix_concierge_input_placeholder ); ?>"<?php echo $venix_concierge_input_invalid ? ' aria-invalid="true"' : ''; ?><?php echo $venix_concierge_input_required ? ' required' : ''; ?>>
	<?php endif; ?>
	<?php if ( '' !== $venix_concierge_input_hint ) : ?><p class="venix-field__hint"><?php echo esc_html( $venix_concierge_input_hint ); ?></p><?php endif; ?>
</div>
