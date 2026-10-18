<?php
/**
 * Project-specific integrations. Keep presentation out of this plugin.
 *
 * @package VenixConciergeCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Drop the WebSite SearchAction from Rank Math's JSON-LD graph.
 *
 * The site has no search functionality, so the sitelinks search box action
 * would advertise a feature that does not exist.
 *
 * @param array<string, mixed> $data JSON-LD entities keyed by type.
 * @return array<string, mixed>
 */
function venix_concierge_core_remove_search_action( $data ) {
	if ( isset( $data['WebSite'] ) && is_array( $data['WebSite'] ) ) {
		unset( $data['WebSite']['potentialAction'] );
	}

	return $data;
}
add_filter( 'rank_math/json_ld', 'venix_concierge_core_remove_search_action', 99 );
