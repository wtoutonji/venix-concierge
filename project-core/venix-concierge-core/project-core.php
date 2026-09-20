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

/**
 * Enqueue the shared native Media Library picker used by admin image fields.
 *
 * Shared by the Venix Page Content meta box and the Venix Site Settings logo
 * fields, keyed by the generic `data-venix-pc-media` markup contract.
 *
 * @return void
 */
function venix_concierge_core_enqueue_media_picker_assets() {
	$dir = plugin_dir_path( VENIX_CONCIERGE_CORE_FILE );

	wp_enqueue_style(
		'venix-concierge-core-media-picker',
		plugins_url( 'assets/admin/media-picker.css', VENIX_CONCIERGE_CORE_FILE ),
		array(),
		(string) filemtime( $dir . 'assets/admin/media-picker.css' )
	);
	wp_enqueue_script(
		'venix-concierge-core-media-picker',
		plugins_url( 'assets/admin/media-picker.js', VENIX_CONCIERGE_CORE_FILE ),
		array( 'media-editor' ),
		(string) filemtime( $dir . 'assets/admin/media-picker.js' ),
		array( 'in_footer' => true )
	);
}

/**
 * Render one shared Media Library picker field.
 *
 * Markup contract for `assets/admin/media-picker.js`. Stores only the
 * attachment ID in a hidden input; callers render any additional fields
 * (e.g. alt text) around this.
 *
 * @param string               $name          Hidden input name.
 * @param string               $label         Field label.
 * @param int                  $attachment_id Saved attachment ID, or 0.
 * @param array<string, mixed> $args          Optional overrides: select_label, replace_label,
 *                                             remove_label, empty_label, preview_size, after
 *                                             (callable, echoes extra markup inside the field).
 * @return void
 */
function venix_concierge_core_render_media_picker_field( $name, $label, $attachment_id, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'select_label'  => __( 'Select Image', 'venix-concierge-core' ),
			'replace_label' => __( 'Replace Image', 'venix-concierge-core' ),
			'remove_label'  => __( 'Remove Image', 'venix-concierge-core' ),
			'empty_label'   => __( 'No image selected. The default is used.', 'venix-concierge-core' ),
			'preview_size'  => 'medium',
			'show_label'    => true,
			'after'         => null,
		)
	);

	$has      = $attachment_id > 0;
	$filename = $has ? wp_basename( (string) get_attached_file( $attachment_id ) ) : '';
	?>
	<div class="venix-pc-media" data-venix-pc-media>
		<?php if ( $args['show_label'] ) : ?>
			<span class="venix-pc-media__label"><?php echo esc_html( $label ); ?></span>
		<?php endif; ?>
		<input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $has ? (string) $attachment_id : '' ); ?>" data-venix-pc-media-input />
		<div class="venix-pc-media__preview" data-venix-pc-media-preview>
			<?php
			if ( $has ) {
				echo wp_get_attachment_image( $attachment_id, $args['preview_size'], false, array( 'loading' => 'lazy' ) );
			}
			?>
		</div>
		<p class="venix-pc-media__empty description" data-venix-pc-media-empty<?php echo $has ? ' hidden' : ''; ?>><?php echo esc_html( $args['empty_label'] ); ?></p>
		<p class="venix-pc-media__filename description" data-venix-pc-media-filename<?php echo $has ? '' : ' hidden'; ?>><?php echo esc_html( $filename ); ?></p>
		<p class="venix-pc-media__actions">
			<button type="button" class="button" data-venix-pc-media-select
				data-label-select="<?php echo esc_attr( $args['select_label'] ); ?>"
				data-label-replace="<?php echo esc_attr( $args['replace_label'] ); ?>"
				data-frame-title="<?php echo esc_attr( $label ); ?>"
				data-frame-button="<?php esc_attr_e( 'Use this image', 'venix-concierge-core' ); ?>"><?php echo $has ? esc_html( $args['replace_label'] ) : esc_html( $args['select_label'] ); ?></button>
			<button type="button" class="button-link button-link-delete" data-venix-pc-media-remove<?php echo $has ? '' : ' hidden'; ?>><?php echo esc_html( $args['remove_label'] ); ?></button>
		</p>
		<?php if ( is_callable( $args['after'] ) ) { call_user_func( $args['after'] ); } ?>
	</div>
	<?php
}

require_once __DIR__ . '/inc/post-types.php';
require_once __DIR__ . '/inc/taxonomies.php';
require_once __DIR__ . '/inc/meta.php';
require_once __DIR__ . '/inc/integrations.php';
require_once __DIR__ . '/inc/site-settings.php';
require_once __DIR__ . '/inc/page-content.php';
