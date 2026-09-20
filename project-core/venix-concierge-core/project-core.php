<?php
/**
 * Plugin Name: Venix Concierge Core
 * Description: Durable content models and non-commerce business functionality for Venix Concierge.
 * Version: 0.1.0
 * Requires PHP: 8.1
 * Text Domain: venix-concierge-core
 *
 * @package VenixConciergeCore
 *
 * Global symbols added to this plugin must use the venix_concierge_core_ prefix.
 */

defined( 'ABSPATH' ) || exit;

define( 'VENIX_CONCIERGE_CORE_FILE', __FILE__ );

require_once __DIR__ . '/inc/post-types.php';
require_once __DIR__ . '/inc/taxonomies.php';
require_once __DIR__ . '/inc/meta.php';
require_once __DIR__ . '/inc/integrations.php';
require_once __DIR__ . '/inc/site-settings.php';
require_once __DIR__ . '/inc/page-content.php';
