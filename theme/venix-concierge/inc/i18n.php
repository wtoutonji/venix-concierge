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

		if ( in_array( $language, array( 'en', 'pl', 'ru' ), true ) ) {
			return $language;
		}
	}

	return 'en';
}

/**
 * Select approved server-side copy for the current language.
 *
 * Russian is a transcreation of the approved English source, not a literal
 * translation. A caller that omits the Russian copy deliberately shows the
 * English source rather than Polish text on a /ru/ page.
 *
 * @param string      $english Approved English source.
 * @param string      $polish  Approved Polish source.
 * @param string|null $russian Approved Russian transcreation.
 * @return string
 */
function venix_concierge_language_copy( $english, $polish, $russian = null ) {
	$language = venix_concierge_current_language();

	if ( 'pl' === $language ) {
		return $polish;
	}

	return 'ru' === $language && null !== $russian ? $russian : $english;
}

/**
 * Get the compact shell labels used by fallback navigation.
 *
 * @return array<string, string>
 */
function venix_concierge_shell_labels() {
	return array(
		'home'           => venix_concierge_language_copy( 'Home', 'Strona główna', 'Главная' ),
		'about'          => venix_concierge_language_copy( 'About', 'O nas', 'О компании' ),
		'services'       => venix_concierge_language_copy( 'Services', 'Usługi', 'Услуги' ),
		'other_services' => venix_concierge_language_copy( 'Other services', 'Inne usługi', 'Дополнительные услуги' ),
		'fleet'          => venix_concierge_language_copy( 'Fleet', 'Flota', 'Автопарк' ),
		'contact'        => venix_concierge_language_copy( 'Contact', 'Kontakt', 'Контакты' ),
		'navigation'     => venix_concierge_language_copy( 'Navigation', 'Nawigacja', 'Навигация' ),
		'request'        => venix_concierge_language_copy( 'Request a chauffeur', 'Zamów szofera', 'Заказать водителя' ),
	);
}
