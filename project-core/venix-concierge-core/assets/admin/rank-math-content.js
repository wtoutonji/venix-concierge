/**
 * Adds the page's editorial content to Rank Math's content analysis.
 *
 * Uses Rank Math's public `rank_math_content` filter. The content is supplied
 * by the theme at page-load time (see inc/rank-math-analysis.php) and is only
 * used by the analyzer; it is never saved into post_content.
 */
( function ( wp, win ) {
	'use strict';

	if ( ! wp || ! wp.hooks || 'string' !== typeof win.venixRankMathContent ) {
		return;
	}

	wp.hooks.addFilter( 'rank_math_content', 'venix-concierge/editorial-content', function ( content ) {
		return ( content ? content + '\n' : '' ) + win.venixRankMathContent;
	} );
}( window.wp, window ) );
