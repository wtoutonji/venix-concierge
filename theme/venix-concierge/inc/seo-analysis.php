<?php
/**
 * Editorial content for SEO content analysis (admin only).
 *
 * The page copy lives in theme content arrays and Venix page-content overrides,
 * not in post_content, so an SEO analyzer would see an empty page. This file
 * renders the page's own section template for the page being edited and reduces
 * it to the editorial HTML a visitor can read (headings, paragraphs, lists,
 * links, image alt text). Nothing here runs on public requests and nothing is
 * stored or output on the frontend. The Venix Concierge Core plugin passes the
 * result to Rank Math through its supported `rank_math_content` editor filter.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render a page's section template in the context of a specific page and language.
 *
 * @param int    $post_id  Page ID.
 * @param string $page_key Page key (`home`, `about`, `services`, `fleet`, `contact`).
 * @return string Rendered section HTML, or an empty string when it cannot be rendered.
 */
function venix_concierge_render_page_for_analysis( $post_id, $page_key ) {
	global $wp_query, $wp_the_query, $post;

	$part = get_theme_file_path( 'template-parts/sections/' . $page_key . '.php' );

	if ( ! is_readable( $part ) ) {
		return '';
	}

	$saved_query  = array( $wp_query, $wp_the_query, $post );
	$styles       = wp_styles();
	$scripts      = wp_scripts();
	$saved_queue  = array( $styles->queue, $scripts->queue );
	$saved_lang   = null;
	$switched     = false;
	$polylang     = function_exists( 'PLL' ) ? PLL() : null;
	$post_lang    = function_exists( 'pll_get_post_language' ) ? pll_get_post_language( $post_id, 'slug' ) : '';
	$html         = '';

	// Polylang owns the language: render in the language of the page being edited.
	if ( $polylang && isset( $polylang->model ) && $post_lang ) {
		$saved_lang       = isset( $polylang->curlang ) ? $polylang->curlang : null;
		$polylang->curlang = $polylang->model->get_language( $post_lang );
		$switched          = true;
	}

	try {
		$query         = new WP_Query(
			array(
				'page_id'     => $post_id,
				'post_type'   => 'page',
				'post_status' => 'any',
				'lang'        => '',
			)
		);
		$wp_query      = $query; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$wp_the_query  = $query; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$post          = get_post( $post_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		setup_postdata( $post );

		ob_start();
		include $part;
		$html = (string) ob_get_clean();
	} catch ( Throwable $error ) {
		if ( ob_get_level() ) {
			ob_end_clean();
		}
		$html = '';
	}

	list( $wp_query, $wp_the_query, $post ) = $saved_query; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	wp_reset_postdata();

	if ( $switched ) {
		$polylang->curlang = $saved_lang;
	}

	// Rendering must not leave frontend assets queued on an admin screen.
	list( $styles->queue, $scripts->queue ) = $saved_queue;

	return $html;
}

/**
 * Reduce rendered page HTML to editorial content.
 *
 * Keeps headings, paragraphs, lists, links and images (with alt text). Drops
 * forms, navigation, buttons' wrappers, badges, decorative and hidden elements,
 * media wrappers, scripts and styles, so the analyzer reads what a visitor reads.
 *
 * @param string $html Rendered section HTML.
 * @return string Editorial HTML.
 */
function venix_concierge_extract_editorial_html( $html ) {
	if ( '' === trim( $html ) ) {
		return '';
	}

	$document = new DOMDocument();
	$previous = libxml_use_internal_errors( true );
	$document->loadHTML( '<?xml encoding="utf-8"?><body>' . $html . '</body>' );
	libxml_clear_errors();
	libxml_use_internal_errors( $previous );

	$xpath = new DOMXPath( $document );
	$drop  = array(
		'//script|//style|//noscript|//template|//svg|//form|//nav|//video|//iframe|//select|//textarea|//input|//button',
		'//*[@hidden or @aria-hidden="true" or @inert]',
		'//*[contains(concat(" ", normalize-space(@class), " "), " venix-badge ") or contains(@class, "badge")]',
		'//*[contains(@class, "screen-reader-text") or contains(@class, "skip-link")]',
	);

	foreach ( $drop as $expression ) {
		foreach ( iterator_to_array( $xpath->query( $expression ) ) as $node ) {
			if ( $node->parentNode ) {
				$node->parentNode->removeChild( $node );
			}
		}
	}

	$keep = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'ul', 'ol', 'li', 'a', 'img', 'strong', 'em' );
	$out  = '';
	$walk = static function ( DOMNode $node ) use ( &$walk, &$out, $keep ) {
		foreach ( $node->childNodes as $child ) {
			if ( XML_TEXT_NODE === $child->nodeType ) {
				$text = trim( preg_replace( '/\s+/u', ' ', $child->textContent ) );
				if ( '' !== $text ) {
					$out .= ' ' . esc_html( $text );
				}
				continue;
			}

			if ( XML_ELEMENT_NODE !== $child->nodeType ) {
				continue;
			}

			$tag = strtolower( $child->nodeName );

			if ( 'img' === $tag ) {
				$alt = trim( (string) $child->getAttribute( 'alt' ) );
				if ( '' !== $alt ) {
					$out .= '<img src="' . esc_url( $child->getAttribute( 'src' ) ) . '" alt="' . esc_attr( $alt ) . '">';
				}
				continue;
			}

			if ( ! in_array( $tag, $keep, true ) ) {
				$walk( $child );
				continue;
			}

			$attributes = '';
			if ( 'a' === $tag ) {
				$href = trim( (string) $child->getAttribute( 'href' ) );
				if ( '' === $href ) {
					$walk( $child );
					continue;
				}
				$attributes = ' href="' . esc_url( $href ) . '"';
			}

			$out .= '<' . $tag . $attributes . '>';
			$walk( $child );
			$out .= '</' . $tag . '>' . "\n";
		}
	};

	$body = $document->getElementsByTagName( 'body' )->item( 0 );

	if ( $body ) {
		$walk( $body );
	}

	return trim( preg_replace( '/[ \t]+/', ' ', $out ) );
}

/**
 * Get the editorial HTML of a page for SEO content analysis.
 *
 * @param string $content Existing value from earlier filters.
 * @param int    $post_id Page ID being edited.
 * @param string $page_key Page key from Venix Concierge Core.
 * @return string
 */
function venix_concierge_seo_analysis_content( $content, $post_id, $page_key ) {
	$rendered = venix_concierge_render_page_for_analysis( (int) $post_id, (string) $page_key );

	return venix_concierge_extract_editorial_html( $rendered );
}
add_filter( 'venix_concierge_core_seo_analysis_content', 'venix_concierge_seo_analysis_content', 10, 3 );
