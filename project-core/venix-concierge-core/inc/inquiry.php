<?php
/**
 * Inquiry form submission: validates the shared Home/Contact form and relays it
 * to the Odoo CRM webhook as a JSON lead.
 *
 * The webhook URL is never output to the frontend. Override it with the
 * VENIX_CONCIERGE_ODOO_WEBHOOK_URL constant (wp-config.php) or the
 * `venix_concierge_core_odoo_webhook_url` option.
 *
 * @package VenixConciergeCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default Odoo webhook endpoint that creates a lead from the payload.
 *
 * @return string
 */
function venix_concierge_core_default_odoo_webhook_url() {
	return 'https://crm.venixconcierge.com/web/hook/1b11c50b-d921-48a7-91da-42a3cabd1f13';
}

/**
 * Resolve the Odoo webhook URL: constant, then option, then the default.
 *
 * @return string
 */
function venix_concierge_core_get_odoo_webhook_url() {
	if ( defined( 'VENIX_CONCIERGE_ODOO_WEBHOOK_URL' ) && VENIX_CONCIERGE_ODOO_WEBHOOK_URL ) {
		$url = (string) VENIX_CONCIERGE_ODOO_WEBHOOK_URL;
	} else {
		$url = (string) get_option( 'venix_concierge_core_odoo_webhook_url', '' );
	}

	return esc_url_raw( '' !== $url ? $url : venix_concierge_core_default_odoo_webhook_url() );
}

/**
 * Canonical English service names, keyed by the form's select value (1-based).
 *
 * Keep in the same order as the `form.service` options in the theme's Home
 * content (index 0 is the "Select a service" placeholder). Sent to Odoo in
 * English regardless of the visitor's language.
 *
 * @return array<int, string>
 */
function venix_concierge_core_inquiry_services() {
	return array(
		1 => 'Private transfer / chauffeur hire',
		2 => 'Airport transfer',
		3 => 'Event transportation',
		4 => 'Delegation / diplomatic transfer',
		5 => 'Wedding transportation',
		6 => 'Concierge assistance',
		7 => 'Other / custom quotation',
	);
}

/**
 * Create a signed timestamp token to detect instant bot submissions.
 *
 * @return string "timestamp.signature".
 */
function venix_concierge_core_inquiry_token() {
	$time = (string) time();

	return $time . '.' . hash_hmac( 'sha256', $time, wp_salt( 'nonce' ) );
}

/**
 * Check the signed timestamp token and the minimum fill time.
 *
 * @param string $token Submitted token.
 * @return bool
 */
function venix_concierge_core_inquiry_token_is_valid( $token ) {
	$parts = explode( '.', (string) $token );

	if ( 2 !== count( $parts ) || ! ctype_digit( $parts[0] ) ) {
		return false;
	}

	if ( ! hash_equals( hash_hmac( 'sha256', $parts[0], wp_salt( 'nonce' ) ), $parts[1] ) ) {
		return false;
	}

	return ( time() - (int) $parts[0] ) >= 3;
}

/**
 * Per-IP rate limit. Returns true when the visitor is over the limit.
 *
 * @return bool
 */
function venix_concierge_core_inquiry_is_rate_limited() {
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key = 'venix_inq_' . md5( $ip );
	$hit = (int) get_transient( $key );

	if ( $hit >= 5 ) {
		return true;
	}

	set_transient( $key, $hit + 1, 10 * MINUTE_IN_SECONDS );

	return false;
}

/**
 * Validate and sanitize the posted form.
 *
 * @return array<string, mixed>|null Sanitized fields, or null when invalid.
 */
function venix_concierge_core_inquiry_collect() {
	// phpcs:disable WordPress.Security.NonceVerification.Missing -- Signed time token + honeypot + rate limit are verified by the caller (public, cache-safe form).
	$text = static function ( $key ) {
		return isset( $_POST[ $key ] ) ? sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) : '';
	};

	$services   = venix_concierge_core_inquiry_services();
	$service_id = absint( $text( 'service' ) );
	$email      = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$date       = $text( 'pickup_date' );
	$date_obj   = DateTime::createFromFormat( '!Y-m-d', $date );
	$language   = $text( 'lang' );
	$message    = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$consent    = ! empty( $_POST['consent'] );
	// phpcs:enable

	$data = array(
		'full_name'       => $text( 'full_name' ),
		'email'           => $email,
		'phone'           => $text( 'phone' ),
		'service'         => isset( $services[ $service_id ] ) ? $services[ $service_id ] : '',
		'pickup_date'     => ( $date_obj && $date_obj->format( 'Y-m-d' ) === $date ) ? $date : '',
		'passengers'      => min( 99, absint( $text( 'passengers' ) ) ),
		'pickup_location' => $text( 'pickup_location' ),
		'destination'     => $text( 'destination' ),
		'message'         => mb_substr( $message, 0, 3000 ),
		'language'        => in_array( $language, array( 'en', 'pl', 'ru', 'ar' ), true ) ? $language : 'en',
		'consent'         => $consent,
	);

	foreach ( array( 'full_name', 'phone', 'service', 'pickup_date', 'pickup_location' ) as $required ) {
		if ( '' === $data[ $required ] ) {
			return null;
		}
	}

	if ( ! is_email( $email ) || ! $consent ) {
		return null;
	}

	return $data;
}

/**
 * Build the Odoo lead payload.
 *
 * Standard crm.lead keys (name, contact_name, email_from, phone, description)
 * map directly; the remaining keys are available to the webhook automation.
 *
 * @param array<string, mixed> $data      Sanitized form data.
 * @param string               $page_url  Page the form was submitted from.
 * @return array<string, mixed>
 */
function venix_concierge_core_inquiry_payload( array $data, $page_url ) {
	$lines = array(
		'Service: ' . $data['service'],
		'Pickup date: ' . $data['pickup_date'],
		'Pickup location: ' . $data['pickup_location'],
	);

	if ( '' !== $data['destination'] ) {
		$lines[] = 'Destination: ' . $data['destination'];
	}

	if ( $data['passengers'] > 0 ) {
		$lines[] = 'Passengers: ' . $data['passengers'];
	}

	$lines[] = 'Language: ' . $data['language'];

	if ( '' !== $data['message'] ) {
		$lines[] = '';
		$lines[] = $data['message'];
	}

	return array(
		'name'            => sprintf( 'Website inquiry - %s - %s', $data['service'], $data['full_name'] ),
		'contact_name'    => $data['full_name'],
		'email_from'      => $data['email'],
		'phone'           => $data['phone'],
		'description'     => implode( "\n", $lines ),
		'service'         => $data['service'],
		'pickup_date'     => $data['pickup_date'],
		'passengers'      => $data['passengers'],
		'pickup_location' => $data['pickup_location'],
		'destination'     => $data['destination'],
		'message'         => $data['message'],
		'language'        => $data['language'],
		'consent'         => true,
		'source'          => 'website',
		'page_url'        => $page_url,
		'submitted_at'    => gmdate( 'c' ),
	);
}

/**
 * Relay the payload to Odoo.
 *
 * @param array<string, mixed> $payload Lead payload.
 * @return bool True on a 2xx response.
 */
function venix_concierge_core_inquiry_send_to_odoo( array $payload ) {
	$response = wp_remote_post(
		venix_concierge_core_get_odoo_webhook_url(),
		array(
			'timeout'     => 10,
			'redirection' => 0,
			'headers'     => array( 'Content-Type' => 'application/json' ),
			'body'        => wp_json_encode( $payload ),
		)
	);

	if ( is_wp_error( $response ) ) {
		error_log( 'Venix inquiry: Odoo webhook failed: ' . $response->get_error_message() ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
		return false;
	}

	$code = (int) wp_remote_retrieve_response_code( $response );

	if ( $code < 200 || $code > 299 ) {
		error_log( 'Venix inquiry: Odoo webhook returned HTTP ' . $code ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
		return false;
	}

	return true;
}

/**
 * Email the lead to the site admin when Odoo could not take it.
 *
 * @param array<string, mixed> $payload Lead payload.
 * @return void
 */
function venix_concierge_core_inquiry_email_fallback( array $payload ) {
	$to = sanitize_email( (string) venix_concierge_core_get_site_setting( 'email', '' ) );

	if ( ! is_email( $to ) ) {
		$to = get_option( 'admin_email' );
	}

	wp_mail(
		$to,
		'[Venix] Website inquiry (CRM relay failed): ' . $payload['contact_name'],
		sprintf(
			"The CRM webhook could not be reached, so this inquiry was not created in Odoo.\n\nName: %s\nEmail: %s\nPhone: %s\n\n%s\n\nPage: %s\nSubmitted: %s",
			$payload['contact_name'],
			$payload['email_from'],
			$payload['phone'],
			$payload['description'],
			$payload['page_url'],
			$payload['submitted_at']
		),
		array( 'Reply-To: ' . $payload['email_from'] )
	);
}

/**
 * Finish the request: JSON for fetch, redirect back to #inquiry otherwise.
 *
 * @param string $status sent|invalid|error|limited.
 * @return void
 */
function venix_concierge_core_inquiry_respond( $status ) {
	$wants_json = isset( $_SERVER['HTTP_ACCEPT'] ) && false !== strpos( sanitize_text_field( wp_unslash( $_SERVER['HTTP_ACCEPT'] ) ), 'application/json' ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated

	if ( $wants_json ) {
		wp_send_json(
			array(
				'success' => 'sent' === $status,
				'status'  => $status,
			),
			'sent' === $status ? 200 : ( 'limited' === $status ? 429 : ( 'invalid' === $status ? 422 : 502 ) )
		);
	}

	$back = wp_get_referer();
	$back = $back ? $back : home_url( '/' );

	wp_safe_redirect( add_query_arg( 'inquiry', $status, remove_query_arg( 'inquiry', $back ) ) . '#inquiry' );
	exit;
}

/**
 * admin-post handler for the inquiry form.
 *
 * @return void
 */
function venix_concierge_core_handle_inquiry() {
	// phpcs:disable WordPress.Security.NonceVerification.Missing
	// Honeypot: pretend success so bots learn nothing.
	if ( ! empty( $_POST['website'] ) ) {
		venix_concierge_core_inquiry_respond( 'sent' );
	}

	$token = isset( $_POST['vtoken'] ) ? sanitize_text_field( wp_unslash( $_POST['vtoken'] ) ) : '';
	// phpcs:enable

	if ( ! venix_concierge_core_inquiry_token_is_valid( $token ) ) {
		venix_concierge_core_inquiry_respond( 'invalid' );
	}

	if ( venix_concierge_core_inquiry_is_rate_limited() ) {
		venix_concierge_core_inquiry_respond( 'limited' );
	}

	$data = venix_concierge_core_inquiry_collect();

	if ( null === $data ) {
		venix_concierge_core_inquiry_respond( 'invalid' );
	}

	$referer = wp_get_referer();
	$payload = venix_concierge_core_inquiry_payload( $data, $referer ? esc_url_raw( remove_query_arg( 'inquiry', $referer ) ) : home_url( '/' ) );

	if ( venix_concierge_core_inquiry_send_to_odoo( $payload ) ) {
		venix_concierge_core_inquiry_respond( 'sent' );
	}

	venix_concierge_core_inquiry_email_fallback( $payload );
	venix_concierge_core_inquiry_respond( 'error' );
}
add_action( 'admin_post_nopriv_venix_inquiry', 'venix_concierge_core_handle_inquiry' );
add_action( 'admin_post_venix_inquiry', 'venix_concierge_core_handle_inquiry' );
