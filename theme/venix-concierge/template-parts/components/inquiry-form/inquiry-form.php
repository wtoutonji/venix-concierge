<?php
/**
 * Venix inquiry form component.
 *
 * Shared by the Home and Contact pages so both render one form structure.
 * Markup only: the form has no submission handler, recipient or backend.
 *
 * @package VenixConcierge
 *
 * @var array $args Component arguments: form (the `form` group of venix_concierge_home_content()).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_inquiry_form = isset( $args['form'] ) && is_array( $args['form'] ) ? $args['form'] : array();

if ( empty( $venix_concierge_inquiry_form['fields'] ) ) {
	return;
}
?>
<form class="home-form" action="#inquiry" method="post" aria-describedby="home-form-note">
	<div class="home-form__grid">
		<?php foreach ( $venix_concierge_inquiry_form['fields'] as $venix_concierge_inquiry_field ) : ?>
			<p class="venix-field"><label class="venix-field__label" for="<?php echo esc_attr( $venix_concierge_inquiry_field[0] ); ?>"><?php echo esc_html( $venix_concierge_inquiry_field[1] ); ?><?php echo $venix_concierge_inquiry_field[4] ? ' <span class="venix-field__required">*</span>' : ' <span class="venix-field__optional">' . esc_html( $venix_concierge_inquiry_form['optional_suffix'] ) . '</span>'; ?></label><input class="venix-field__control" id="<?php echo esc_attr( $venix_concierge_inquiry_field[0] ); ?>" name="<?php echo esc_attr( $venix_concierge_inquiry_field[3] ); ?>" type="<?php echo esc_attr( $venix_concierge_inquiry_field[2] ); ?>"<?php echo $venix_concierge_inquiry_field[4] ? ' required aria-invalid="false"' : ''; ?><?php echo $venix_concierge_inquiry_field[5] ? ' autocomplete="' . esc_attr( $venix_concierge_inquiry_field[5] ) . '"' : ''; ?>></p>
			<?php if ( 'home-phone' === $venix_concierge_inquiry_field[0] ) : ?>
				<p class="venix-field"><label class="venix-field__label" for="home-service"><?php echo esc_html( $venix_concierge_inquiry_form['service_label'] ); ?> <span class="venix-field__required">*</span></label><span class="venix-field__select-wrap"><select class="venix-field__control venix-field__control--select" id="home-service" required aria-invalid="false"><?php foreach ( $venix_concierge_inquiry_form['service'] as $venix_concierge_inquiry_option ) : ?><option><?php echo esc_html( $venix_concierge_inquiry_option ); ?></option><?php endforeach; ?></select></span></p>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<p class="venix-field"><label class="venix-field__label" for="home-message"><?php echo esc_html( $venix_concierge_inquiry_form['message_label'] ); ?></label><textarea class="venix-field__control venix-field__control--textarea" id="home-message" name="message" rows="4"></textarea></p>
	<p><label><input type="checkbox" required> <?php echo esc_html( $venix_concierge_inquiry_form['consent'] ); ?></label></p>
	<div class="home-form__footer"><p id="home-form-note" class="venix-field__hint"><?php echo esc_html( $venix_concierge_inquiry_form['status'] ); ?></p><button class="venix-button venix-button--primary" type="submit" disabled aria-disabled="true"><?php echo esc_html( $venix_concierge_inquiry_form['submit_placeholder'] ); ?></button></div>
</form>
