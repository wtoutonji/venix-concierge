<?php
/**
 * Global fleet passenger and luggage capacities.
 *
 * One option is the single source for Home and Fleet. Values are global and
 * intentionally not duplicated per Polylang language or stored in page meta.
 * The theme reads the option in `venix_concierge_fleet_capacity_data()`.
 *
 * @package VenixConciergeCore
 */

defined( 'ABSPATH' ) || exit;

const VENIX_CONCIERGE_CORE_FLEET_CAPACITIES_OPTION = 'venix_fleet_capacities';
const VENIX_CONCIERGE_CORE_FLEET_CAPACITIES_GROUP  = 'venix_concierge_core_fleet_capacities';
const VENIX_CONCIERGE_CORE_FLEET_CAPACITIES_PAGE   = 'venix-fleet-capacities';

/**
 * Get the vehicle ids used by the theme's capacity data, with admin labels.
 *
 * @return array<string, string> Vehicle name keyed by vehicle id.
 */
function venix_concierge_core_fleet_capacity_vehicles() {
	return array(
		'sclass'   => __( 'S-Class', 'venix-concierge-core' ),
		'eclass'   => __( 'E-Class', 'venix-concierge-core' ),
		'vclass'   => __( 'V-Class', 'venix-concierge-core' ),
		'vclassxl' => __( 'V-Class Extra Long', 'venix-concierge-core' ),
		'sprinter' => __( 'Sprinter', 'venix-concierge-core' ),
	);
}

/**
 * Get the capacity fields stored for every vehicle.
 *
 * @return array<string, string> Field label keyed by field key.
 */
function venix_concierge_core_fleet_capacity_fields() {
	return array(
		'passengers' => __( 'Passengers', 'venix-concierge-core' ),
		'luggage'    => __( 'Luggage', 'venix-concierge-core' ),
	);
}

/**
 * Sanitize one capacity value.
 *
 * @param mixed $value Raw value.
 * @return int|null Whole number from 1 to 999, or null when blank or invalid.
 */
function venix_concierge_core_sanitize_fleet_capacity_value( $value ) {
	if ( ! is_scalar( $value ) ) {
		return null;
	}

	$value = trim( (string) $value );

	if ( ! preg_match( '/^[0-9]{1,3}$/', $value ) ) {
		return null;
	}

	$number = (int) $value;

	return $number >= 1 ? $number : null;
}

/**
 * Sanitize the whole capacities array before it is stored.
 *
 * @param mixed $input Submitted capacities.
 * @return array<string, array<string, int|null>> Every vehicle and field, null when blank.
 */
function venix_concierge_core_sanitize_fleet_capacities( $input ) {
	$input     = is_array( $input ) ? $input : array();
	$sanitized = array();

	foreach ( array_keys( venix_concierge_core_fleet_capacity_vehicles() ) as $vehicle_id ) {
		$vehicle = isset( $input[ $vehicle_id ] ) && is_array( $input[ $vehicle_id ] ) ? $input[ $vehicle_id ] : array();

		foreach ( array_keys( venix_concierge_core_fleet_capacity_fields() ) as $field ) {
			$sanitized[ $vehicle_id ][ $field ] = venix_concierge_core_sanitize_fleet_capacity_value(
				isset( $vehicle[ $field ] ) ? $vehicle[ $field ] : null
			);
		}
	}

	return $sanitized;
}

/**
 * Get the saved capacities for every vehicle, revalidated on read.
 *
 * @return array<string, array<string, int|null>>
 */
function venix_concierge_core_get_fleet_capacities() {
	$stored = get_option( VENIX_CONCIERGE_CORE_FLEET_CAPACITIES_OPTION, array() );

	return venix_concierge_core_sanitize_fleet_capacities( $stored );
}

/**
 * Register the capacities option.
 *
 * @return void
 */
function venix_concierge_core_register_fleet_capacities() {
	register_setting(
		VENIX_CONCIERGE_CORE_FLEET_CAPACITIES_GROUP,
		VENIX_CONCIERGE_CORE_FLEET_CAPACITIES_OPTION,
		array(
			'type'              => 'array',
			'sanitize_callback' => 'venix_concierge_core_sanitize_fleet_capacities',
			'default'           => array(),
			'show_in_rest'      => false,
		)
	);
}
add_action( 'admin_init', 'venix_concierge_core_register_fleet_capacities' );

/**
 * Add Venix → Fleet Capacities under the Venix parent menu.
 *
 * Runs after the Site Settings menu so the parent already exists.
 *
 * @return void
 */
function venix_concierge_core_register_fleet_capacities_menu() {
	add_submenu_page(
		'venix',
		__( 'Fleet Capacities', 'venix-concierge-core' ),
		__( 'Fleet Capacities', 'venix-concierge-core' ),
		'manage_options',
		VENIX_CONCIERGE_CORE_FLEET_CAPACITIES_PAGE,
		'venix_concierge_core_render_fleet_capacities_page'
	);
}
add_action( 'admin_menu', 'venix_concierge_core_register_fleet_capacities_menu', 20 );

/**
 * Render the Fleet Capacities screen.
 *
 * @return void
 */
function venix_concierge_core_render_fleet_capacities_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$capacities = venix_concierge_core_get_fleet_capacities();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Fleet Capacities', 'venix-concierge-core' ); ?></h1>
		<p><?php esc_html_e( 'Passenger and luggage capacity per vehicle, shared by the Home and Fleet pages and every language. Leave a field blank to show TBC (Do potw. in Polish).', 'venix-concierge-core' ); ?></p>
		<form action="options.php" method="post">
			<?php settings_fields( VENIX_CONCIERGE_CORE_FLEET_CAPACITIES_GROUP ); ?>
			<table class="form-table" role="presentation">
				<?php foreach ( venix_concierge_core_fleet_capacity_vehicles() as $vehicle_id => $vehicle_name ) : ?>
					<tr>
						<th scope="row"><?php echo esc_html( $vehicle_name ); ?></th>
						<td>
							<?php foreach ( venix_concierge_core_fleet_capacity_fields() as $field => $field_label ) : ?>
								<?php
								$input_id = 'venix_fleet_capacity_' . $vehicle_id . '_' . $field;
								$value    = $capacities[ $vehicle_id ][ $field ];
								?>
								<p>
									<label for="<?php echo esc_attr( $input_id ); ?>" style="display:inline-block;min-width:6em;"><?php echo esc_html( $field_label ); ?></label>
									<input
										type="number"
										id="<?php echo esc_attr( $input_id ); ?>"
										name="<?php echo esc_attr( VENIX_CONCIERGE_CORE_FLEET_CAPACITIES_OPTION . '[' . $vehicle_id . '][' . $field . ']' ); ?>"
										value="<?php echo esc_attr( null === $value ? '' : (string) $value ); ?>"
										min="1"
										max="999"
										step="1"
										inputmode="numeric"
										class="small-text"
									/>
								</p>
							<?php endforeach; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
