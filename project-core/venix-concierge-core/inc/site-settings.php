<?php
/**
 * Global company, contact and social settings.
 *
 * One option array is the single source for site-wide company data. Values are
 * global and intentionally not duplicated per Polylang language.
 *
 * @package VenixConciergeCore
 */

defined( 'ABSPATH' ) || exit;

const VENIX_CONCIERGE_CORE_SITE_SETTINGS_OPTION = 'venix_site_settings';
const VENIX_CONCIERGE_CORE_SITE_SETTINGS_GROUP  = 'venix_concierge_core_site_settings';
const VENIX_CONCIERGE_CORE_SITE_SETTINGS_PAGE   = 'venix-site-settings';

/**
 * Get the whitelisted setting fields.
 *
 * @return array<string, array{label: string, type: string}> Field definitions keyed by setting key.
 */
function venix_concierge_core_site_setting_fields() {
	return array(
		'company_name' => array(
			'label' => __( 'Company Name', 'venix-concierge-core' ),
			'type'  => 'text',
		),
		'legal_name'   => array(
			'label' => __( 'Legal Name', 'venix-concierge-core' ),
			'type'  => 'text',
		),
		'address'      => array(
			'label' => __( 'Address', 'venix-concierge-core' ),
			'type'  => 'text',
		),
		'phone'        => array(
			'label' => __( 'Phone', 'venix-concierge-core' ),
			'type'  => 'tel',
		),
		'whatsapp'     => array(
			'label' => __( 'WhatsApp', 'venix-concierge-core' ),
			'type'  => 'text',
		),
		'email'        => array(
			'label' => __( 'Email', 'venix-concierge-core' ),
			'type'  => 'email',
		),
		'instagram'    => array(
			'label' => __( 'Instagram', 'venix-concierge-core' ),
			'type'  => 'url',
		),
		'facebook'     => array(
			'label' => __( 'Facebook', 'venix-concierge-core' ),
			'type'  => 'url',
		),
	);
}

/**
 * Sanitize a single setting value by its field type.
 *
 * @param string $key   Whitelisted setting key.
 * @param mixed  $value Raw value.
 * @return string Sanitized value.
 */
function venix_concierge_core_sanitize_site_setting( $key, $value ) {
	$fields = venix_concierge_core_site_setting_fields();

	if ( ! isset( $fields[ $key ] ) || ! is_scalar( $value ) ) {
		return '';
	}

	$value = trim( (string) $value );

	switch ( $fields[ $key ]['type'] ) {
		case 'email':
			return sanitize_email( $value );
		case 'url':
			return esc_url_raw( $value, array( 'http', 'https' ) );
		case 'tel':
			return trim( preg_replace( '/[^0-9+\-\s().\/]/', '', sanitize_text_field( $value ) ) );
		default:
			return sanitize_text_field( $value );
	}
}

/**
 * Sanitize the whole settings array before it is stored.
 *
 * @param mixed $input Submitted settings.
 * @return array<string, string> Sanitized settings limited to whitelisted keys.
 */
function venix_concierge_core_sanitize_site_settings( $input ) {
	$input     = is_array( $input ) ? $input : array();
	$sanitized = array();

	foreach ( array_keys( venix_concierge_core_site_setting_fields() ) as $key ) {
		$sanitized[ $key ] = venix_concierge_core_sanitize_site_setting(
			$key,
			isset( $input[ $key ] ) ? $input[ $key ] : ''
		);
	}

	return $sanitized;
}

/**
 * Get every whitelisted setting, empty when unset.
 *
 * @return array<string, string> Settings keyed by setting key.
 */
function venix_concierge_core_get_site_settings() {
	$stored   = get_option( VENIX_CONCIERGE_CORE_SITE_SETTINGS_OPTION, array() );
	$stored   = is_array( $stored ) ? $stored : array();
	$settings = array();

	foreach ( array_keys( venix_concierge_core_site_setting_fields() ) as $key ) {
		$settings[ $key ] = isset( $stored[ $key ] ) && is_string( $stored[ $key ] ) ? $stored[ $key ] : '';
	}

	return $settings;
}

/**
 * Get one whitelisted setting.
 *
 * @param string $key     Setting key.
 * @param string $default Value returned when the key is unknown or empty.
 * @return string
 */
function venix_concierge_core_get_site_setting( $key, $default = '' ) {
	$settings = venix_concierge_core_get_site_settings();

	return isset( $settings[ $key ] ) && '' !== $settings[ $key ] ? $settings[ $key ] : $default;
}

/**
 * Register the option and its Settings API fields.
 *
 * @return void
 */
function venix_concierge_core_register_site_settings() {
	register_setting(
		VENIX_CONCIERGE_CORE_SITE_SETTINGS_GROUP,
		VENIX_CONCIERGE_CORE_SITE_SETTINGS_OPTION,
		array(
			'type'              => 'array',
			'sanitize_callback' => 'venix_concierge_core_sanitize_site_settings',
			'default'           => array(),
			'show_in_rest'      => false,
		)
	);

	add_settings_section( 'venix_site_settings_main', '', '__return_false', VENIX_CONCIERGE_CORE_SITE_SETTINGS_PAGE );

	foreach ( venix_concierge_core_site_setting_fields() as $key => $field ) {
		add_settings_field(
			'venix_site_setting_' . $key,
			$field['label'],
			'venix_concierge_core_render_site_setting_field',
			VENIX_CONCIERGE_CORE_SITE_SETTINGS_PAGE,
			'venix_site_settings_main',
			array(
				'key'       => $key,
				'type'      => $field['type'],
				'label_for' => 'venix_site_setting_' . $key,
			)
		);
	}
}
add_action( 'admin_init', 'venix_concierge_core_register_site_settings' );

/**
 * Render one settings input.
 *
 * @param array<string, string> $args Field arguments.
 * @return void
 */
function venix_concierge_core_render_site_setting_field( $args ) {
	printf(
		'<input type="%1$s" id="%2$s" name="%3$s[%4$s]" value="%5$s" class="regular-text" />',
		esc_attr( $args['type'] ),
		esc_attr( $args['label_for'] ),
		esc_attr( VENIX_CONCIERGE_CORE_SITE_SETTINGS_OPTION ),
		esc_attr( $args['key'] ),
		esc_attr( venix_concierge_core_get_site_setting( $args['key'] ) )
	);
}

/**
 * Add Venix → Site Settings, reusing an existing Venix parent when present.
 *
 * @return void
 */
function venix_concierge_core_register_site_settings_menu() {
	global $menu;

	$parent_exists = false;

	foreach ( (array) $menu as $item ) {
		if ( isset( $item[2] ) && 'venix' === $item[2] ) {
			$parent_exists = true;
			break;
		}
	}

	if ( ! $parent_exists ) {
		add_menu_page(
			__( 'Venix', 'venix-concierge-core' ),
			__( 'Venix', 'venix-concierge-core' ),
			'manage_options',
			'venix',
			'venix_concierge_core_render_site_settings_page',
			'dashicons-star-filled',
			58
		);
	}

	// A slug equal to the parent renames the parent's own entry instead of adding a duplicate.
	add_submenu_page(
		'venix',
		__( 'Site Settings', 'venix-concierge-core' ),
		__( 'Site Settings', 'venix-concierge-core' ),
		'manage_options',
		$parent_exists ? VENIX_CONCIERGE_CORE_SITE_SETTINGS_PAGE : 'venix',
		'venix_concierge_core_render_site_settings_page'
	);
}
add_action( 'admin_menu', 'venix_concierge_core_register_site_settings_menu' );

/**
 * Render the Site Settings screen.
 *
 * @return void
 */
function venix_concierge_core_render_site_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Site Settings', 'venix-concierge-core' ); ?></h1>
		<p><?php esc_html_e( 'Company, contact and social details shared across the whole site and every language. Empty fields are not shown publicly.', 'venix-concierge-core' ); ?></p>
		<form action="options.php" method="post">
			<?php
			settings_fields( VENIX_CONCIERGE_CORE_SITE_SETTINGS_GROUP );
			do_settings_sections( VENIX_CONCIERGE_CORE_SITE_SETTINGS_PAGE );
			submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Render [venix_setting key="..."] for whitelisted keys only.
 *
 * @param array<string, string>|string $atts Shortcode attributes.
 * @return string Escaped output, empty for unknown or empty keys.
 */
function venix_concierge_core_site_setting_shortcode( $atts ) {
	$atts   = shortcode_atts( array( 'key' => '' ), (array) $atts, 'venix_setting' );
	$key    = sanitize_key( $atts['key'] );
	$fields = venix_concierge_core_site_setting_fields();

	if ( ! isset( $fields[ $key ] ) ) {
		return '';
	}

	$value = venix_concierge_core_get_site_setting( $key );

	return 'url' === $fields[ $key ]['type'] ? esc_url( $value ) : esc_html( $value );
}
add_shortcode( 'venix_setting', 'venix_concierge_core_site_setting_shortcode' );
