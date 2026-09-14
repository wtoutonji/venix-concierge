<?php
/**
 * Dialog component.
 *
 * @package VenixConcierge
 *
 * @var array $args {
 *     Component arguments.
 *
 *     @type string $id          Required stable dialog ID.
 *     @type string $title       Required visible dialog title.
 *     @type string $content     Required formatted dialog content.
 *     @type string $close_label Optional visible close-button label.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_dialog_id = isset( $args['id'] ) && is_string( $args['id'] )
	? trim( $args['id'] )
	: '';

if ( '' === $venix_concierge_dialog_id || sanitize_key( $venix_concierge_dialog_id ) !== $venix_concierge_dialog_id ) {
	return;
}

$venix_concierge_dialog_title   = isset( $args['title'] ) && is_string( $args['title'] )
	? trim( wp_strip_all_tags( $args['title'] ) )
	: '';
$venix_concierge_dialog_content = isset( $args['content'] ) && is_string( $args['content'] )
	? $args['content']
	: null;

if ( '' === $venix_concierge_dialog_title || null === $venix_concierge_dialog_content ) {
	return;
}

$venix_concierge_dialog_close_label = isset( $args['close_label'] ) && is_string( $args['close_label'] )
	? trim( wp_strip_all_tags( $args['close_label'] ) )
	: '';

if ( '' === $venix_concierge_dialog_close_label ) {
	$venix_concierge_dialog_close_label = _x( 'Close dialog', 'dialog close button label', 'venix-concierge' );
}

$venix_concierge_dialog_title_id = $venix_concierge_dialog_id . '-title';

$venix_concierge_dialog_allowed_html = wp_kses_allowed_html( 'post' );

$venix_concierge_dialog_allowed_html['form'] = array(
	'accept-charset' => true,
	'action'         => true,
	'aria-*'         => true,
	'autocomplete'   => true,
	'class'          => true,
	'data-*'         => true,
	'enctype'        => true,
	'id'             => true,
	'method'         => true,
	'name'           => true,
	'novalidate'     => true,
	'target'         => true,
);

$venix_concierge_dialog_allowed_html['input'] = array(
	'accept'       => true,
	'alt'          => true,
	'aria-*'       => true,
	'autocomplete' => true,
	'checked'      => true,
	'class'        => true,
	'data-*'       => true,
	'disabled'     => true,
	'form'         => true,
	'formaction'   => true,
	'height'       => true,
	'id'           => true,
	'inputmode'    => true,
	'max'          => true,
	'maxlength'    => true,
	'min'          => true,
	'minlength'    => true,
	'multiple'     => true,
	'name'         => true,
	'pattern'      => true,
	'placeholder'  => true,
	'readonly'     => true,
	'required'     => true,
	'size'         => true,
	'src'          => true,
	'step'         => true,
	'type'         => true,
	'value'        => true,
	'width'        => true,
);

$venix_concierge_dialog_allowed_html['select'] = array(
	'aria-*'       => true,
	'autocomplete' => true,
	'class'        => true,
	'data-*'       => true,
	'disabled'     => true,
	'form'         => true,
	'id'           => true,
	'multiple'     => true,
	'name'         => true,
	'required'     => true,
	'size'         => true,
);

$venix_concierge_dialog_allowed_html['option'] = array(
	'class'    => true,
	'disabled' => true,
	'label'    => true,
	'selected' => true,
	'value'    => true,
);

$venix_concierge_dialog_allowed_html['optgroup'] = array(
	'class'    => true,
	'disabled' => true,
	'label'    => true,
);

venix_concierge_enqueue_component( 'dialog' );
?>
<dialog
	id="<?php echo esc_attr( $venix_concierge_dialog_id ); ?>"
	class="tly-dialog"
	aria-labelledby="<?php echo esc_attr( $venix_concierge_dialog_title_id ); ?>"
	data-tly-dialog
>
	<div class="tly-dialog__header">
		<h2 id="<?php echo esc_attr( $venix_concierge_dialog_title_id ); ?>" class="tly-dialog__title">
			<?php echo esc_html( $venix_concierge_dialog_title ); ?>
		</h2>
		<form class="tly-dialog__close-form" method="dialog">
			<button class="tly-dialog__close" type="submit" value="close">
				<?php echo esc_html( $venix_concierge_dialog_close_label ); ?>
			</button>
		</form>
	</div>
	<div class="tly-dialog__content">
		<?php echo wp_kses( $venix_concierge_dialog_content, $venix_concierge_dialog_allowed_html ); ?>
	</div>
</dialog>
