<?php
/**
 * Contact page body.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_next_steps = array(
	'Your request is reviewed by our team — typically within one business day.',
	'We prepare a tailored proposal based on your requirements.',
	'Once confirmed, all details are provided and the arrangement is set.',
);
?>
<main id="primary" class="site-main venix-contact">
	<section class="contact-hero">
		<div class="contact-hero__scrim" aria-hidden="true"></div>
		<div class="container contact-hero__content"><p class="venix-eyebrow">Contact</p><h1>Let us arrange the details</h1></div>
	</section>

	<section id="form" class="contact-main">
		<div class="container contact-main__grid">
			<aside class="contact-info">
				<p class="venix-eyebrow">Begin the arrangement</p><h2>Share your requirements. We will handle the rest.</h2><span class="contact-rule" aria-hidden="true"></span>
				<p>Provide your journey details, schedule and any special requirements. Our team will review the information and contact you through your preferred method with a considered proposal.</p>
				<ul class="contact-details" aria-label="Contact details"><li><svg class="contact-details__icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.2a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.8.7a2 2 0 0 1 1.7 2z"/></svg>[Insert verified phone number]</li><li><svg class="contact-details__icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"><path d="M21 11.5a8.4 8.4 0 0 1-9 8.4 8.6 8.6 0 0 1-3.8-.9L3 21l2-5a8.4 8.4 0 1 1 16-4.5z"/></svg>[Insert WhatsApp number]</li><li><svg class="contact-details__icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><rect x="2.5" y="5" width="19" height="14" rx="1.5"/><path d="m3 6.5 9 6.5 9-6.5"/></svg>[Insert verified email address]</li><li><svg class="contact-details__icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"><path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 1 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>Warsaw, Poland · [Confirm operating hours]</li></ul>
				<div class="contact-next"><h3>What happens next</h3><ol><?php foreach ( $venix_concierge_next_steps as $venix_concierge_step ) : ?><li><?php echo esc_html( $venix_concierge_step ); ?></li><?php endforeach; ?></ol></div>
			</aside>

			<div class="contact-form-wrap">
				<div class="contact-progress" aria-label="Inquiry progress"><span class="is-active" data-contact-progress="1">1</span><i data-contact-connector="1"></i><span data-contact-progress="2">2</span><i data-contact-connector="2"></i><span data-contact-progress="3">3</span><i data-contact-connector="3"></i><span data-contact-progress="4">4</span></div>
				<header class="contact-form-heading"><h2 data-contact-title>Your contact details</h2><p data-contact-subtitle>How should we reach you?</p></header>
				<form class="contact-form" data-contact-form novalidate>
					<div class="contact-errors" data-contact-errors role="alert" hidden><strong>Please check the following</strong><ul></ul></div>

					<fieldset data-contact-step="1"><legend class="screen-reader-text">Your contact details</legend>
						<div class="contact-fields contact-fields--two"><div class="venix-field"><label class="venix-field__label" for="contact-name">Full Name <em>*</em></label><input class="venix-field__control" id="contact-name" name="fullName" type="text" autocomplete="name" aria-describedby="contact-name-error" required><p id="contact-name-error" class="contact-field-error" data-contact-error="fullName" hidden>Please share your name so we know how to address you.</p></div><div class="venix-field"><label class="venix-field__label" for="contact-company">Company / Organisation <small>(optional)</small></label><input class="venix-field__control" id="contact-company" name="company" type="text"></div></div>
						<div class="contact-fields contact-fields--two"><div class="venix-field"><label class="venix-field__label" for="contact-email">Email Address <em>*</em></label><input class="venix-field__control" id="contact-email" name="email" type="email" autocomplete="email" aria-describedby="contact-email-error" required><p id="contact-email-error" class="contact-field-error" data-contact-error="email" hidden>Please enter a valid email address so our team can reply.</p></div><div class="venix-field"><label class="venix-field__label" for="contact-phone">Phone / WhatsApp</label><input class="venix-field__control" id="contact-phone" name="phone" type="tel" autocomplete="tel" placeholder="+48 ..."></div></div>
						<div class="venix-field"><label class="venix-field__label" for="contact-method">Preferred Contact Method</label><span class="venix-field__select-wrap"><select class="venix-field__control venix-field__control--select" id="contact-method" name="contactMethod"><option>Email</option><option>WhatsApp</option><option>Phone call</option></select></span></div>
					</fieldset>

					<fieldset data-contact-step="2" hidden><legend class="screen-reader-text">Service selection</legend>
						<div class="venix-field"><label class="venix-field__label" for="contact-service">Required Service <em>*</em></label><span class="venix-field__select-wrap"><select class="venix-field__control venix-field__control--select" id="contact-service" name="service" aria-describedby="contact-service-error" required><option value="">Select a service…</option><option>Private transfer / chauffeur hire</option><option>Airport transfer</option><option>Event transportation</option><option>Delegation / diplomatic transfer</option><option>Wedding transportation</option><option>Concierge assistance</option><option>Other / custom quotation</option></select></span><p id="contact-service-error" class="contact-field-error" data-contact-error="service" hidden>Please choose the service you require.</p></div>
						<div class="contact-fields contact-fields--two"><div class="venix-field"><label class="venix-field__label" for="contact-vehicle">Vehicle Preference</label><span class="venix-field__select-wrap"><select class="venix-field__control venix-field__control--select" id="contact-vehicle" name="vehicle"><option>No preference / recommend for me</option><option>Mercedes-Benz S-Class</option><option>Mercedes-Benz E-Class</option><option>Mercedes-Benz V-Class</option><option>Mercedes-Benz V-Class Extra Long</option><option>Mercedes-Benz Sprinter</option></select></span></div><div class="venix-field"><label class="venix-field__label" for="contact-journey">Journey Type</label><span class="venix-field__select-wrap"><select class="venix-field__control venix-field__control--select" id="contact-journey" name="journey"><option>One-way</option><option>Return</option><option>Hourly hire</option><option>Full day</option><option>Multi-day</option></select></span></div></div>
						<div class="venix-field"><label class="venix-field__label" for="contact-vehicles">Number of Vehicles Needed</label><span class="venix-field__select-wrap"><select class="venix-field__control venix-field__control--select" id="contact-vehicles" name="vehicles"><option>1</option><option>2</option><option>3</option><option>4 or more</option></select></span></div>
					</fieldset>

					<fieldset data-contact-step="3" hidden><legend class="screen-reader-text">Journey information</legend>
						<div class="contact-fields contact-fields--two"><div class="venix-field"><label class="venix-field__label" for="contact-pickup">Pickup Location <em>*</em></label><input class="venix-field__control" id="contact-pickup" name="pickup" type="text" aria-describedby="contact-pickup-error" required><p id="contact-pickup-error" class="contact-field-error" data-contact-error="pickup" hidden>Please tell us where the journey begins.</p></div><div class="venix-field"><label class="venix-field__label" for="contact-destination">Destination</label><input class="venix-field__control" id="contact-destination" name="destination" type="text"></div></div>
						<div class="contact-fields contact-fields--two"><div class="venix-field"><label class="venix-field__label" for="contact-date">Pickup Date <em>*</em></label><input class="venix-field__control" id="contact-date" name="date" type="date" aria-describedby="contact-date-error" required><p id="contact-date-error" class="contact-field-error" data-contact-error="date" hidden>Please choose a pickup date.</p></div><div class="venix-field"><label class="venix-field__label" for="contact-time">Pickup Time</label><input class="venix-field__control" id="contact-time" name="time" type="time"></div></div>
						<div class="contact-fields contact-fields--two"><div class="venix-field"><label class="venix-field__label" for="contact-passengers">Passengers</label><input class="venix-field__control" id="contact-passengers" name="passengers" type="number" min="1" max="60"></div><div class="venix-field"><label class="venix-field__label" for="contact-luggage">Luggage Items</label><input class="venix-field__control" id="contact-luggage" name="luggage" type="number" min="0"></div></div>
						<div class="venix-field"><label class="venix-field__label" for="contact-flight">Flight Number <small>(for airport transfers)</small></label><input class="venix-field__control" id="contact-flight" name="flight" type="text" placeholder="e.g. LO 123"></div>
					</fieldset>

					<fieldset data-contact-step="4" hidden><legend class="screen-reader-text">Additional requirements</legend>
						<div class="venix-field"><label class="venix-field__label" for="contact-message">Message or Special Requirements</label><textarea class="venix-field__control venix-field__control--textarea" id="contact-message" name="message" rows="5"></textarea></div>
						<fieldset class="contact-requests"><legend>Special requests</legend><div><label><input type="checkbox" name="childSeat"> Child seat required</label><label><input type="checkbox" name="accessibility"> Accessibility requirements</label><label><input type="checkbox" name="protection"> Private protection inquiry</label><label><input type="checkbox" name="concierge"> Concierge assistance</label></div></fieldset>
						<div class="contact-consent"><label><input id="contact-consent" name="consent" type="checkbox" aria-describedby="contact-consent-error" required> <span>I confirm I have read and agree to the Privacy Policy and consent to Venix Concierge processing my details to respond to this inquiry. <em>*</em></span></label><p id="contact-consent-error" class="contact-field-error" data-contact-error="consent" hidden>Please confirm consent so we may respond to your inquiry.</p></div>
						<p class="contact-status-note">Form submissions are unavailable while contact-processing details are being finalised.</p>
					</fieldset>

					<div class="contact-form__actions"><button class="venix-button venix-button--ghost venix-button--sm" type="button" data-contact-back hidden>← Back</button><span></span><button class="venix-button venix-button--primary" type="button" data-contact-next>Continue →</button><button class="venix-button venix-button--primary" type="button" data-contact-submit disabled aria-disabled="true" hidden>Send My Request</button></div>
				</form>
			</div>
		</div>
	</section>
	<section class="contact-location"><div class="container"><div class="contact-location__map" role="img" aria-label="Map location pending verified Venix Concierge operating address."></div></div></section>
</main>
