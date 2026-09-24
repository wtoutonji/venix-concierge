<?php
/**
 * Venix social links component.
 *
 * @package VenixConcierge
 *
 * @var array $args Component arguments: instagram_url, facebook_url (optional; Site Settings are used when omitted).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_social_instagram = isset( $args['instagram_url'] ) && is_string( $args['instagram_url'] ) ? $args['instagram_url'] : venix_concierge_get_site_setting_url( 'instagram' );
$venix_concierge_social_facebook  = isset( $args['facebook_url'] ) && is_string( $args['facebook_url'] ) ? $args['facebook_url'] : venix_concierge_get_site_setting_url( 'facebook' );

if ( '' === $venix_concierge_social_instagram && '' === $venix_concierge_social_facebook ) {
	return;
}

venix_concierge_enqueue_component( 'social-links' );
?>
<div class="venix-social-links">
	<?php if ( '' !== $venix_concierge_social_instagram ) : ?>
		<a href="<?php echo esc_url( $venix_concierge_social_instagram ); ?>" class="venix-social-links__link" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Instagram', 'venix-concierge' ); ?>"><?php echo venix_concierge_get_social_icon_svg( 'instagram', 'venix-social-links__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG markup; class escaped in the helper. ?></a>
	<?php endif; ?>
	<?php if ( '' !== $venix_concierge_social_facebook ) : ?>
		<a href="<?php echo esc_url( $venix_concierge_social_facebook ); ?>" class="venix-social-links__link" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Facebook', 'venix-concierge' ); ?>"><?php echo venix_concierge_get_social_icon_svg( 'facebook', 'venix-social-links__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG markup; class escaped in the helper. ?></a>
	<?php endif; ?>
</div>
