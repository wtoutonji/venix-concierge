<?php
/**
 * Reusable template helpers.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display the current post's published date as semantic time markup.
 *
 * @return void
 */
function venix_concierge_posted_on() {
	printf(
		'<time class="entry-date" datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);
}

/**
 * Add a breadcrumb item when it has a usable label.
 *
 * @param array  $items Breadcrumb items collected so far.
 * @param string $label Item label.
 * @param string $url   Optional item URL.
 * @return array Updated breadcrumb items.
 */
function venix_concierge_add_breadcrumb_item( $items, $label, $url = '' ) {
	$label = trim( wp_strip_all_tags( (string) $label ) );

	if ( '' === $label ) {
		$label = _x( 'Untitled', 'breadcrumb item fallback', 'venix-concierge' );
	}

	$items[] = array(
		'label' => $label,
		'url'   => (string) $url,
	);

	return $items;
}

/**
 * Get hierarchical post ancestors as breadcrumb items.
 *
 * @param int $post_id Post ID.
 * @return array Breadcrumb items ordered from the highest ancestor.
 */
function venix_concierge_get_breadcrumb_post_ancestors( $post_id ) {
	$items     = array();
	$ancestors = array_reverse( get_post_ancestors( $post_id ) );

	foreach ( $ancestors as $ancestor_id ) {
		$items = venix_concierge_add_breadcrumb_item(
			$items,
			get_the_title( $ancestor_id ),
			get_permalink( $ancestor_id )
		);
	}

	return $items;
}

/**
 * Get hierarchical term ancestors as breadcrumb items.
 *
 * @param WP_Term $term Current term.
 * @return array Breadcrumb items ordered from the highest ancestor.
 */
function venix_concierge_get_breadcrumb_term_ancestors( $term ) {
	$items     = array();
	$ancestors = array_reverse( get_ancestors( $term->term_id, $term->taxonomy, 'taxonomy' ) );

	foreach ( $ancestors as $ancestor_id ) {
		$ancestor = get_term( $ancestor_id, $term->taxonomy );

		if ( ! $ancestor instanceof WP_Term ) {
			continue;
		}

		$ancestor_url = get_term_link( $ancestor );

		$items = venix_concierge_add_breadcrumb_item(
			$items,
			$ancestor->name,
			is_wp_error( $ancestor_url ) ? '' : $ancestor_url
		);
	}

	return $items;
}

/**
 * Add the configured posts index to breadcrumb items when available.
 *
 * @param array $items Breadcrumb items collected so far.
 * @return array Updated breadcrumb items.
 */
function venix_concierge_add_breadcrumb_posts_page( $items ) {
	$posts_page_id = (int) get_option( 'page_for_posts' );

	if ( $posts_page_id > 0 ) {
		$items = venix_concierge_add_breadcrumb_item(
			$items,
			get_the_title( $posts_page_id ),
			get_permalink( $posts_page_id )
		);
	}

	return $items;
}

/**
 * Add the relevant post type archive to breadcrumb items.
 *
 * @param array  $items    Breadcrumb items collected so far.
 * @param string $post_type Post type name.
 * @return array Updated breadcrumb items.
 */
function venix_concierge_add_breadcrumb_post_type_archive( $items, $post_type ) {
	$post_type_object = get_post_type_object( $post_type );

	if ( ! $post_type_object || ! $post_type_object->has_archive ) {
		return $items;
	}

	$archive_url = get_post_type_archive_link( $post_type );

	if ( ! $archive_url ) {
		return $items;
	}

	return venix_concierge_add_breadcrumb_item( $items, $post_type_object->labels->name, $archive_url );
}

/**
 * Get the default breadcrumb items for the current WordPress request.
 *
 * Supports the posts index, hierarchical pages, singular posts and public
 * post types, taxonomy archives, author and date archives, search, and 404
 * requests. The site front page returns no items because a one-item trail
 * does not improve orientation.
 *
 * @return array[] Breadcrumb items containing a label and optional URL.
 */
function venix_concierge_get_breadcrumb_items() {
	$items = array();

	if ( is_front_page() ) {
		/**
		 * Filters the breadcrumb items for the current request.
		 *
		 * @param array[] $items Breadcrumb items.
		 */
		return apply_filters( 'venix_concierge_breadcrumb_items', $items );
	}

	$items = venix_concierge_add_breadcrumb_item(
		$items,
		_x( 'Home', 'breadcrumb link label', 'venix-concierge' ),
		home_url( '/' )
	);

	if ( is_home() ) {
		$posts_page_id = (int) get_option( 'page_for_posts' );
		$label         = $posts_page_id > 0
			? get_the_title( $posts_page_id )
			: _x( 'Posts', 'breadcrumb item label', 'venix-concierge' );
		$items         = venix_concierge_add_breadcrumb_item( $items, $label );
	} elseif ( is_singular() ) {
		$post_id   = get_queried_object_id();
		$post_type = get_post_type( $post_id );

		if ( is_page() ) {
			$items = array_merge( $items, venix_concierge_get_breadcrumb_post_ancestors( $post_id ) );
		} elseif ( 'post' === $post_type ) {
			$items = venix_concierge_add_breadcrumb_posts_page( $items );
		} elseif ( $post_type ) {
			$items = venix_concierge_add_breadcrumb_post_type_archive( $items, $post_type );
		}

		$items = venix_concierge_add_breadcrumb_item( $items, get_the_title( $post_id ) );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$term = get_queried_object();

		if ( $term instanceof WP_Term ) {
			$taxonomy = get_taxonomy( $term->taxonomy );

			if ( $taxonomy && $taxonomy->hierarchical ) {
				$items = array_merge( $items, venix_concierge_get_breadcrumb_term_ancestors( $term ) );
			}

			$items = venix_concierge_add_breadcrumb_item( $items, $term->name );
		}
	} elseif ( is_post_type_archive() ) {
		$post_type = get_query_var( 'post_type' );
		$post_type = is_array( $post_type ) ? reset( $post_type ) : $post_type;
		$object    = $post_type ? get_post_type_object( $post_type ) : null;
		$label     = $object ? $object->labels->name : get_the_archive_title();
		$items     = venix_concierge_add_breadcrumb_item( $items, $label );
	} elseif ( is_author() ) {
		$author = get_queried_object();
		$name   = $author instanceof WP_User ? $author->display_name : '';

		/* translators: %s: Author display name. */
		$items = venix_concierge_add_breadcrumb_item( $items, sprintf( __( 'Posts by %s', 'venix-concierge' ), $name ) );
	} elseif ( is_date() ) {
		$year  = (int) get_query_var( 'year' );
		$month = (int) get_query_var( 'monthnum' );
		$day   = (int) get_query_var( 'day' );

		if ( $year > 0 ) {
			$items = venix_concierge_add_breadcrumb_item( $items, (string) $year, $month || $day ? get_year_link( $year ) : '' );
		}

		if ( $month > 0 ) {
			$month_label = wp_date( 'F', mktime( 0, 0, 0, $month, 1, $year ) );
			$items       = venix_concierge_add_breadcrumb_item( $items, $month_label, $day ? get_month_link( $year, $month ) : '' );
		}

		if ( $day > 0 ) {
			$items = venix_concierge_add_breadcrumb_item( $items, (string) $day );
		}
	} elseif ( is_search() ) {
		/* translators: %s: Search query. */
		$items = venix_concierge_add_breadcrumb_item( $items, sprintf( __( 'Search results for: %s', 'venix-concierge' ), get_search_query( false ) ) );
	} elseif ( is_404() ) {
		$items = venix_concierge_add_breadcrumb_item( $items, __( 'Page not found', 'venix-concierge' ) );
	} elseif ( is_archive() ) {
		$items = venix_concierge_add_breadcrumb_item( $items, get_the_archive_title() );
	}

	$paged = max( (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );

	if ( $paged > 1 && count( $items ) > 1 ) {
		$last_index = array_key_last( $items );

		/* translators: 1: Breadcrumb item label. 2: Page number. */
		$items[ $last_index ]['label'] = sprintf( __( '%1$s, page %2$d', 'venix-concierge' ), $items[ $last_index ]['label'], $paged );
	}

	/** This filter is documented above. */
	return apply_filters( 'venix_concierge_breadcrumb_items', $items );
}
