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

		if ( in_array( $language, array( 'en', 'pl', 'ru', 'ar' ), true ) ) {
			return $language;
		}
	}

	return 'en';
}

/**
 * Select approved server-side copy for the current language.
 *
 * Russian and Arabic are transcreations of the approved English source, not
 * literal translations. A caller that omits the Russian or Arabic copy
 * deliberately shows the English source rather than Polish text on that
 * language's pages.
 *
 * @param string      $english Approved English source.
 * @param string      $polish  Approved Polish source.
 * @param string|null $russian Approved Russian transcreation.
 * @param string|null $arabic  Approved Arabic (Modern Standard Arabic) transcreation.
 * @return string
 */
function venix_concierge_language_copy( $english, $polish, $russian = null, $arabic = null ) {
	$language = venix_concierge_current_language();

	if ( 'pl' === $language ) {
		return $polish;
	}

	if ( 'ru' === $language && null !== $russian ) {
		return $russian;
	}

	return 'ar' === $language && null !== $arabic ? $arabic : $english;
}

/**
 * Whether the current Polylang language is written right to left.
 *
 * Polylang (language setting + `language_attributes()`) owns `dir="rtl"`;
 * this only mirrors the same decision for theme code that needs it.
 *
 * @return bool
 */
function venix_concierge_is_rtl_language() {
	return 'ar' === venix_concierge_current_language() || is_rtl();
}

/**
 * Arrow character that points along the reading direction (forward).
 *
 * @return string
 */
function venix_concierge_directional_arrow() {
	return venix_concierge_is_rtl_language() ? '←' : '→';
}

/**
 * Escape text that is inherently left-to-right (phone numbers, email addresses,
 * handles) and isolate it from the surrounding right-to-left text.
 *
 * Without isolation the bidirectional algorithm reorders digit groups and
 * punctuation (for example "+48 881 699 467") inside an Arabic line. On
 * left-to-right languages the output is plain escaped text, so the existing
 * markup of those pages is unchanged.
 *
 * @param string $text Raw text.
 * @return string Escaped HTML, safe for direct output.
 */
function venix_concierge_isolate_ltr( $text ) {
	return venix_concierge_is_rtl_language() ? '<bdi dir="ltr">' . esc_html( $text ) . '</bdi>' : esc_html( $text );
}

/**
 * Escape a name or phrase and isolate it from the surrounding text direction.
 *
 * Unlike venix_concierge_isolate_ltr() this lets the browser pick the direction
 * from the content (`<bdi>`), so a Latin company name keeps its trailing full stop
 * inside an Arabic line. Left-to-right languages get plain escaped text.
 *
 * @param string $text Raw text.
 * @return string Escaped HTML, safe for direct output.
 */
function venix_concierge_isolate_text( $text ) {
	return venix_concierge_is_rtl_language() ? '<bdi>' . esc_html( $text ) . '</bdi>' : esc_html( $text );
}

/**
 * Get the compact shell labels used by fallback navigation.
 *
 * @return array<string, string>
 */
function venix_concierge_shell_labels() {
	return array(
		'home'           => venix_concierge_language_copy( 'Home', 'Strona główna', 'Главная', 'الرئيسية' ),
		'about'          => venix_concierge_language_copy( 'About', 'O nas', 'О компании', 'من نحن' ),
		'services'       => venix_concierge_language_copy( 'Services', 'Usługi', 'Услуги', 'الخدمات' ),
		'other_services' => venix_concierge_language_copy( 'Other services', 'Inne usługi', 'Дополнительные услуги', 'خدمات أخرى' ),
		'fleet'          => venix_concierge_language_copy( 'Fleet', 'Flota', 'Автопарк', 'الأسطول' ),
		'contact'        => venix_concierge_language_copy( 'Contact', 'Kontakt', 'Контакты', 'تواصل معنا' ),
		'navigation'     => venix_concierge_language_copy( 'Navigation', 'Nawigacja', 'Навигация', 'التنقل' ),
		'request'        => venix_concierge_language_copy( 'Request a chauffeur', 'Zamów szofera', 'Заказать водителя', 'اطلب سائقًا' ),
	);
}
