<?php
/**
 * Pagination component.
 *
 * @package VenixConcierge
 *
 * @var array $args {
 *     Optional component arguments.
 *
 *     @type WP_Query $query      Query to paginate. Defaults to the global query.
 *     @type int      $mid_size   Number of page links on each side of the current
 *                                page. Default 1.
 *     @type int      $end_size   Number of page links at the list ends. Default 1.
 *     @type string   $prev_text  Previous-page link text.
 *     @type string   $next_text  Next-page link text.
 *     @type string   $aria_label Navigation landmark label.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$venix_concierge_pagination_global_query = isset( $GLOBALS['wp_query'] ) && $GLOBALS['wp_query'] instanceof WP_Query
	? $GLOBALS['wp_query']
	: null;

$venix_concierge_pagination_has_explicit_query = isset( $args['query'] ) && $args['query'] instanceof WP_Query;
$venix_concierge_pagination_query              = $venix_concierge_pagination_has_explicit_query
	? $args['query']
	: $venix_concierge_pagination_global_query;

if ( ! $venix_concierge_pagination_query instanceof WP_Query ) {
	return;
}

$venix_concierge_pagination_total = (int) $venix_concierge_pagination_query->max_num_pages;

if ( $venix_concierge_pagination_total <= 1 ) {
	return;
}

$venix_concierge_pagination_current = max( 1, (int) $venix_concierge_pagination_query->get( 'paged' ) );

if ( ! $venix_concierge_pagination_has_explicit_query ) {
	$venix_concierge_pagination_current = max(
		$venix_concierge_pagination_current,
		(int) get_query_var( 'paged' ),
		(int) get_query_var( 'page' )
	);
}

$venix_concierge_pagination_mid_size = isset( $args['mid_size'] )
	? max( 0, (int) $args['mid_size'] )
	: 1;
$venix_concierge_pagination_end_size = isset( $args['end_size'] )
	? max( 0, (int) $args['end_size'] )
	: 1;

$venix_concierge_pagination_prev_text  = isset( $args['prev_text'] ) && is_string( $args['prev_text'] )
	? trim( wp_strip_all_tags( $args['prev_text'] ) )
	: '';
$venix_concierge_pagination_next_text  = isset( $args['next_text'] ) && is_string( $args['next_text'] )
	? trim( wp_strip_all_tags( $args['next_text'] ) )
	: '';
$venix_concierge_pagination_aria_label = isset( $args['aria_label'] ) && is_string( $args['aria_label'] )
	? trim( wp_strip_all_tags( $args['aria_label'] ) )
	: '';

if ( '' === $venix_concierge_pagination_prev_text ) {
	$venix_concierge_pagination_prev_text = _x( 'Previous', 'previous pagination link', 'venix-concierge' );
}

if ( '' === $venix_concierge_pagination_next_text ) {
	$venix_concierge_pagination_next_text = _x( 'Next', 'next pagination link', 'venix-concierge' );
}

if ( '' === $venix_concierge_pagination_aria_label ) {
	$venix_concierge_pagination_aria_label = _x( 'Posts navigation', 'pagination navigation landmark label', 'venix-concierge' );
}

$venix_concierge_pagination_links = paginate_links(
	array(
		'current'   => $venix_concierge_pagination_current,
		'total'     => $venix_concierge_pagination_total,
		'mid_size'  => $venix_concierge_pagination_mid_size,
		'end_size'  => $venix_concierge_pagination_end_size,
		'prev_text' => esc_html( $venix_concierge_pagination_prev_text ),
		'next_text' => esc_html( $venix_concierge_pagination_next_text ),
		'type'      => 'array',
	)
);

if ( ! is_array( $venix_concierge_pagination_links ) || empty( $venix_concierge_pagination_links ) ) {
	return;
}
?>
<nav class="tly-pagination" aria-label="<?php echo esc_attr( $venix_concierge_pagination_aria_label ); ?>">
	<ul class="tly-pagination__list">
		<?php foreach ( $venix_concierge_pagination_links as $venix_concierge_pagination_link ) : ?>
			<li class="tly-pagination__item">
				<?php echo wp_kses_post( $venix_concierge_pagination_link ); ?>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
