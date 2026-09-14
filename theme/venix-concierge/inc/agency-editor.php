<?php
/**
 * Agency client editor adaptations.
 *
 * This file is intentionally owned by the Agency starter rather than copied
 * from Hybrid during runtime synchronization.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Narrow an incoming block policy without broadening an upstream restriction.
 *
 * @param bool|string[] $incoming Incoming WordPress or plugin block policy.
 * @param string[]      $approved Project-approved block names.
 * @return bool|string[] Narrowed block policy.
 */
function venix_concierge_narrow_allowed_blocks( $incoming, $approved ) {
	if ( false === $incoming ) {
		return false;
	}

	$approved = array_values( array_unique( array_filter( $approved, 'is_string' ) ) );

	if ( true === $incoming ) {
		return $approved;
	}

	return array_values( array_intersect( $incoming, $approved ) );
}
