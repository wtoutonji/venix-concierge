<?php
/**
 * Venix card component.
 *
 * @package VenixConcierge
 *
 * @var array $args Component arguments: content, title, eyebrow, tone, elevated, rule.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_card_content = isset( $args['content'] ) && is_string( $args['content'] ) ? $args['content'] : '';
$venix_concierge_card_title   = isset( $args['title'] ) && is_string( $args['title'] ) ? trim( wp_strip_all_tags( $args['title'] ) ) : '';
$venix_concierge_card_eyebrow = isset( $args['eyebrow'] ) && is_string( $args['eyebrow'] ) ? trim( wp_strip_all_tags( $args['eyebrow'] ) ) : '';
$venix_concierge_card_tone    = isset( $args['tone'] ) && is_string( $args['tone'] ) ? $args['tone'] : 'surface';

if ( ( '' === $venix_concierge_card_content && '' === $venix_concierge_card_title && '' === $venix_concierge_card_eyebrow && ( ! isset( $args['rule'] ) || true !== $args['rule'] ) ) || ! in_array( $venix_concierge_card_tone, array( 'surface', 'warm', 'inverse' ), true ) ) {
	return;
}

venix_concierge_enqueue_component( 'card' );
$venix_concierge_card_classes = 'venix-card venix-card--' . $venix_concierge_card_tone;

if ( isset( $args['elevated'] ) && true === $args['elevated'] ) {
	$venix_concierge_card_classes .= ' venix-card--elevated';
}
?>
<article class="<?php echo esc_attr( $venix_concierge_card_classes ); ?>">
	<div class="venix-card__body">
		<?php if ( isset( $args['rule'] ) && true === $args['rule'] ) : ?><div class="venix-card__rule" aria-hidden="true"></div><?php endif; ?>
		<?php if ( '' !== $venix_concierge_card_eyebrow ) : ?><p class="venix-card__eyebrow"><?php echo esc_html( $venix_concierge_card_eyebrow ); ?></p><?php endif; ?>
		<?php if ( '' !== $venix_concierge_card_title ) : ?><h3 class="venix-card__title"><?php echo esc_html( $venix_concierge_card_title ); ?></h3><?php endif; ?>
		<?php if ( '' !== $venix_concierge_card_content ) : ?><div class="venix-card__content"><?php echo wp_kses_post( $venix_concierge_card_content ); ?></div><?php endif; ?>
	</div>
</article>
