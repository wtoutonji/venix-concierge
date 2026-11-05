<?php
/**
 * Venix inquiry form component.
 *
 * Shared by the Home and Contact pages so both render one form structure.
 * Posts to admin-post.php (action `venix_inquiry`), handled by the project-core
 * plugin, which relays the lead to the CRM. inquiry-form.js enhances it with fetch.
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

// Result of a no-JS submission, passed back by the handler redirect.
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only status flag, compared against an allowlist.
$venix_concierge_inquiry_result = isset( $_GET['inquiry'] ) ? sanitize_key( wp_unslash( $_GET['inquiry'] ) ) : '';
$venix_concierge_inquiry_result = in_array( $venix_concierge_inquiry_result, array( 'sent', 'invalid', 'error', 'limited' ), true ) ? $venix_concierge_inquiry_result : '';
$venix_concierge_inquiry_map    = array(
	'sent'    => 'success',
	'invalid' => 'invalid',
	'error'   => 'error',
	'limited' => 'limited',
);
$venix_concierge_inquiry_note   = $venix_concierge_inquiry_result ? $venix_concierge_inquiry_form[ $venix_concierge_inquiry_map[ $venix_concierge_inquiry_result ] ] : $venix_concierge_inquiry_form['status'];
$venix_concierge_inquiry_token  = function_exists( 'venix_concierge_core_inquiry_token' ) ? venix_concierge_core_inquiry_token() : '';
?>
<form class="home-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" aria-describedby="home-form-note" data-inquiry-form
	data-msg-sending="<?php echo esc_attr( $venix_concierge_inquiry_form['sending'] ); ?>"
	data-msg-submit="<?php echo esc_attr( $venix_concierge_inquiry_form['submit'] ); ?>"
	data-msg-sent="<?php echo esc_attr( $venix_concierge_inquiry_form['success'] ); ?>"
	data-msg-error="<?php echo esc_attr( $venix_concierge_inquiry_form['error'] ); ?>"
	data-msg-invalid="<?php echo esc_attr( $venix_concierge_inquiry_form['invalid'] ); ?>"
	data-msg-limited="<?php echo esc_attr( $venix_concierge_inquiry_form['limited'] ); ?>">
	<input type="hidden" name="action" value="venix_inquiry">
	<input type="hidden" name="lang" value="<?php echo esc_attr( venix_concierge_current_language() ); ?>">
	<input type="hidden" name="vtoken" value="<?php echo esc_attr( $venix_concierge_inquiry_token ); ?>">
	<div class="home-form__hp" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
	<div class="home-form__grid">
		<?php foreach ( $venix_concierge_inquiry_form['fields'] as $venix_concierge_inquiry_field ) : ?>
			<p class="venix-field"><label class="venix-field__label" for="<?php echo esc_attr( $venix_concierge_inquiry_field[0] ); ?>"><?php echo esc_html( $venix_concierge_inquiry_field[1] ); ?><?php echo $venix_concierge_inquiry_field[4] ? ' <span class="venix-field__required">*</span>' : ' <span class="venix-field__optional">' . esc_html( $venix_concierge_inquiry_form['optional_suffix'] ) . '</span>'; ?></label><input class="venix-field__control" id="<?php echo esc_attr( $venix_concierge_inquiry_field[0] ); ?>" name="<?php echo esc_attr( $venix_concierge_inquiry_field[3] ); ?>" type="<?php echo esc_attr( $venix_concierge_inquiry_field[2] ); ?>"<?php echo $venix_concierge_inquiry_field[4] ? ' required aria-invalid="false"' : ''; ?><?php echo 'number' === $venix_concierge_inquiry_field[2] ? ' min="1" max="99"' : ''; ?><?php echo $venix_concierge_inquiry_field[5] ? ' autocomplete="' . esc_attr( $venix_concierge_inquiry_field[5] ) . '"' : ''; ?>></p>
			<?php if ( 'home-phone' === $venix_concierge_inquiry_field[0] ) : ?>
				<p class="venix-field"><label class="venix-field__label" for="home-service"><?php echo esc_html( $venix_concierge_inquiry_form['service_label'] ); ?> <span class="venix-field__required">*</span></label><span class="venix-field__select-wrap"><select class="venix-field__control venix-field__control--select" id="home-service" name="service" required aria-invalid="false"><?php foreach ( $venix_concierge_inquiry_form['service'] as $venix_concierge_inquiry_index => $venix_concierge_inquiry_option ) : ?><option value="<?php echo 0 === $venix_concierge_inquiry_index ? '' : esc_attr( (string) $venix_concierge_inquiry_index ); ?>"><?php echo esc_html( $venix_concierge_inquiry_option ); ?></option><?php endforeach; ?></select></span></p>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<p class="venix-field"><label class="venix-field__label" for="home-message"><?php echo esc_html( $venix_concierge_inquiry_form['message_label'] ); ?></label><textarea class="venix-field__control venix-field__control--textarea" id="home-message" name="message" rows="4" maxlength="3000"></textarea></p>
	<p><label><input type="checkbox" name="consent" value="1" required> <?php echo esc_html( $venix_concierge_inquiry_form['consent'] ); ?></label></p>
	<div class="home-form__footer"><p id="home-form-note" class="venix-field__hint<?php echo $venix_concierge_inquiry_result ? ' is-' . esc_attr( 'sent' === $venix_concierge_inquiry_result ? 'success' : 'error' ) : ''; ?>" role="status" aria-live="polite" tabindex="-1"><?php echo esc_html( $venix_concierge_inquiry_note ); ?></p><button class="venix-button venix-button--primary" type="submit"><?php echo esc_html( $venix_concierge_inquiry_form['submit'] ); ?></button></div>
</form>
