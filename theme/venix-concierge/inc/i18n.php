<?php
/**
 * Small server-side language helpers.
 *
 * Polylang owns locale selection and translated entities. This file owns only
 * compact reusable theme strings and safe fallbacks while Polylang is absent.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the active language slug with an English fallback.
 *
 * @return string
 */
function venix_concierge_current_language() {
	if ( function_exists( 'pll_current_language' ) ) {
		$language = pll_current_language( 'slug' );

		if ( in_array( $language, array( 'en', 'pl' ), true ) ) {
			return $language;
		}
	}

	return 'en';
}

/**
 * Select approved server-side copy for the current language.
 *
 * @param string $english Approved English source.
 * @param string $polish  Approved Polish source.
 * @return string
 */
function venix_concierge_language_copy( $english, $polish ) {
	return 'pl' === venix_concierge_current_language() ? $polish : $english;
}

/**
 * Get the compact shell labels used by fallback navigation.
 *
 * @return array<string, string>
 */
function venix_concierge_shell_labels() {
	$polish = 'pl' === venix_concierge_current_language();

	return array(
		'home'           => $polish ? 'Strona główna' : 'Home',
		'about'          => $polish ? 'O nas' : 'About',
		'services'       => $polish ? 'Usługi' : 'Services',
		'other_services' => $polish ? 'Inne usługi' : 'Other services',
		'fleet'          => $polish ? 'Flota' : 'Fleet',
		'contact'        => $polish ? 'Kontakt' : 'Contact',
		'navigation'     => $polish ? 'Nawigacja' : 'Navigation',
		'request'        => $polish ? 'Zamów szofera' : 'Request a chauffeur',
	);
}
