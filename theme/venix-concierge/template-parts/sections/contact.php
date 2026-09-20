<?php
/** Contact page body. @package VenixConcierge */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$venix_concierge_contact_content = venix_concierge_get_page_content( 'contact', venix_concierge_contact_content() );
$venix_concierge_contact_items   = venix_concierge_get_contact_detail_items();
$venix_concierge_contact_icons   = array(
	'phone' => '<svg class="contact-details__icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.2a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.8.7a2 2 0 0 1 1.7 2z"/></svg>',
	'whatsapp' => '<svg class="contact-details__icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"><path d="M21 11.5a8.4 8.4 0 0 1-9 8.4 8.6 8.6 0 0 1-3.8-.9L3 21l2-5a8.4 8.4 0 1 1 16-4.5z"/></svg>',
	'email' => '<svg class="contact-details__icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><rect x="2.5" y="5" width="19" height="14" rx="1.5"/><path d="m3 6.5 9 6.5 9-6.5"/></svg>',
	'address' => '<svg class="contact-details__icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"><path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 1 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>',
);
?>
<main id="primary" class="site-main venix-contact">
	<section class="contact-hero"><?php venix_concierge_render_media_slot( 'contact.hero', array( 'class' => 'contact-hero__media', 'alt' => '', 'sizes' => '100vw', 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?><div class="contact-hero__scrim" aria-hidden="true"></div><div class="container contact-hero__content"><p class="venix-eyebrow"><?php echo esc_html( $venix_concierge_contact_content['hero']['eyebrow'] ); ?></p><h1><?php echo esc_html( $venix_concierge_contact_content['hero']['title'] ); ?></h1></div></section>
	<section id="form" class="contact-main"><div class="container contact-main__grid">
		<aside class="contact-info"><p class="venix-eyebrow"><?php echo esc_html( $venix_concierge_contact_content['info']['eyebrow'] ); ?></p><h2><?php echo esc_html( $venix_concierge_contact_content['info']['title'] ); ?></h2><span class="contact-rule" aria-hidden="true"></span><p><?php echo esc_html( $venix_concierge_contact_content['info']['copy'] ); ?></p>
			<?php if ( $venix_concierge_contact_items ) : ?><ul class="contact-details" aria-label="<?php echo esc_attr( $venix_concierge_contact_content['info']['details_label'] ); ?>"><?php foreach ( $venix_concierge_contact_items as $venix_concierge_item ) : ?><li><?php echo $venix_concierge_contact_icons[ $venix_concierge_item['type'] ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG markup. ?><?php $venix_concierge_item_label = $venix_concierge_contact_content['info']['detail_labels'][ $venix_concierge_item['type'] ]; ?><?php if ( '' !== $venix_concierge_item['url'] ) : ?><a href="<?php echo esc_url( $venix_concierge_item['url'] ); ?>"><?php else : ?><span><?php endif; ?><?php if ( 'whatsapp' === $venix_concierge_item['type'] ) : ?><?php echo esc_html( $venix_concierge_item_label . ( '' !== $venix_concierge_item['text'] ? ' · ' . $venix_concierge_item['text'] : '' ) ); ?><?php else : ?><span class="screen-reader-text"><?php echo esc_html( $venix_concierge_item_label ); ?>: </span><?php echo esc_html( $venix_concierge_item['text'] ); ?><?php endif; ?><?php echo '' !== $venix_concierge_item['url'] ? '</a>' : '</span>'; ?></li><?php endforeach; ?></ul><?php endif; ?>
			<div class="contact-next"><h3><?php echo esc_html( $venix_concierge_contact_content['info']['next_title'] ); ?></h3><ol><?php foreach ( $venix_concierge_contact_content['info']['next_steps'] as $venix_concierge_step ) : ?><li><?php echo esc_html( $venix_concierge_step ); ?></li><?php endforeach; ?></ol></div>
		</aside>
		<div class="contact-form-wrap"><?php get_template_part( 'template-parts/components/inquiry-form/inquiry-form', null, array( 'form' => venix_concierge_home_content()['form'] ) ); ?></div>
	</div></section>
	<section class="contact-location"><div class="container"><div class="contact-location__map" role="img" aria-label="<?php echo esc_attr( $venix_concierge_contact_content['location']['aria_label'] ); ?>"></div></div></section>
</main>
