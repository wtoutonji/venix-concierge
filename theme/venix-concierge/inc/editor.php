<?php
/**
 * Block editor integration.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Expose a client-level block curation policy without restricting blocks by default.
 *
 * @since 1.0.0
 * @since 1.0.1 Preserves the incoming WordPress block policy by default.
 *
 * @param bool|string[]           $allowed_block_types Allowed block types from WordPress.
 * @param WP_Block_Editor_Context $editor_context     Current block editor context.
 * @return bool|string[] Filtered block policy.
 */
function venix_concierge_allowed_blocks( $allowed_block_types, $editor_context ) {
	$post_type = null;

	if ( ! empty( $editor_context->post ) ) {
		$post_type = get_post_type( $editor_context->post );
		$post_type = $post_type ? $post_type : null;
	}

	/**
	 * Filters the allowed block types for a specific editor context.
	 *
	 * VenixConcierge preserves the incoming WordPress policy by default. Client projects
	 * may return an allowlist for a targeted post type or editor context.
	 *
	 * @since 1.0.1
	 *
	 * @param bool|string[]          $allowed_block_types Allowed block types from WordPress.
	 * @param WP_Block_Editor_Context $editor_context     Current block editor context.
	 * @param string|null             $post_type          Current post type, when available.
	 */
	return apply_filters( 'venix_concierge_allowed_block_types', $allowed_block_types, $editor_context, $post_type );
}
add_filter( 'allowed_block_types_all', 'venix_concierge_allowed_blocks', 10, 2 );
