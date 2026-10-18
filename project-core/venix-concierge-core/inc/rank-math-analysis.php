<?php
/**
 * Rank Math content-analysis integration (admin only).
 *
 * Page copy is owned by the theme's content arrays and the Venix page-content
 * overrides, not by post_content, so Rank Math's analyzer would otherwise read
 * an empty page. On Venix page edit screens this passes the page's editorial
 * content to Rank Math through its public `rank_math_content` JavaScript filter.
 * The theme supplies the content through `venix_concierge_core_seo_analysis_content`.
 * Nothing is stored in post_content and nothing is output on the frontend.
 *
 * @package VenixConciergeCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hand the current page's editorial content to Rank Math's analyzer.
 *
 * @param string $hook_suffix Admin screen hook.
 * @return void
 */
function venix_concierge_core_enqueue_rank_math_content( $hook_suffix ) {
	if ( 'post.php' !== $hook_suffix || ! defined( 'RANK_MATH_VERSION' ) ) {
		return;
	}

	$post = get_post();

	if ( ! $post || 'page' !== $post->post_type ) {
		return;
	}

	$page_key = venix_concierge_core_get_page_content_key( $post->ID );

	if ( '' === $page_key ) {
		return;
	}

	/**
	 * Filters the editorial HTML Rank Math analyzes for a Venix page.
	 *
	 * @param string $content  Editorial HTML; empty by default.
	 * @param int    $post_id  Page being edited.
	 * @param string $page_key Page key, such as `services`.
	 */
	$content = (string) apply_filters( 'venix_concierge_core_seo_analysis_content', '', $post->ID, $page_key );

	if ( '' === trim( $content ) ) {
		return;
	}

	$file = plugin_dir_path( VENIX_CONCIERGE_CORE_FILE ) . 'assets/admin/rank-math-content.js';

	wp_enqueue_script(
		'venix-concierge-core-rank-math-content',
		plugins_url( 'assets/admin/rank-math-content.js', VENIX_CONCIERGE_CORE_FILE ),
		array( 'wp-hooks' ),
		(string) filemtime( $file ),
		array( 'in_footer' => false )
	);
	wp_add_inline_script(
		'venix-concierge-core-rank-math-content',
		'window.venixRankMathContent = ' . wp_json_encode( $content ) . ';',
		'before'
	);
}
add_action( 'admin_enqueue_scripts', 'venix_concierge_core_enqueue_rank_math_content' );
