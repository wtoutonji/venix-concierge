<?php
/**
 * Structured page content overrides.
 *
 * Editors can override approved page text and Media Library images from a
 * "Venix Page Content" meta box. Everything is stored as ONE meta array per
 * page (`_venix_page_content`) and is limited to an explicit per-page schema.
 * The theme keeps its own content arrays as the canonical fallback: only
 * fields an editor has actually filled in are stored and applied.
 *
 * Polylang keeps translated pages as separate entities, so each language's
 * page owns its own meta. The key is removed from Polylang's meta copy/sync.
 *
 * Global company data stays in Venix → Site Settings and is never stored here.
 *
 * @package VenixConciergeCore
 */

defined( 'ABSPATH' ) || exit;

const VENIX_CONCIERGE_CORE_PAGE_CONTENT_META_KEY = '_venix_page_content';
const VENIX_CONCIERGE_CORE_PAGE_CONTENT_FIELD    = 'venix_page_content';
const VENIX_CONCIERGE_CORE_PAGE_CONTENT_NONCE    = 'venix_page_content_nonce';
const VENIX_CONCIERGE_CORE_PAGE_CONTENT_ACTION   = 'venix_concierge_core_save_page_content';
const VENIX_CONCIERGE_CORE_PAGE_CONTENT_RESET    = 'venix_page_content_reset';

require_once __DIR__ . '/page-content/schema-home.php';
require_once __DIR__ . '/page-content/schema-about.php';
require_once __DIR__ . '/page-content/schema-services.php';
require_once __DIR__ . '/page-content/schema-fleet.php';
require_once __DIR__ . '/page-content/schema-contact.php';

/**
 * Build one text-like field definition.
 *
 * @param string[] $path  Key path inside the theme's content array.
 * @param string   $label Editor-facing label.
 * @param string   $type  One of text, textarea or url.
 * @return array{path: string[], label: string, type: string}
 */
function venix_concierge_core_page_content_field( array $path, $label, $type = 'text' ) {
	return array(
		'path'  => $path,
		'label' => $label,
		'type'  => $type,
	);
}

/**
 * Get every registered page schema keyed by page key.
 *
 * A schema is array{ label: string, sections: list<section>, media: array<string, string> }
 * where a section is array{ id: string, label: string, description?: string, groups: list<group> }
 * and a group is array{ label: string, fields: list<field> }. `media` maps a
 * semantic media slot to its editor-facing label.
 *
 * @return array<string, array<string, mixed>>
 */
function venix_concierge_core_page_content_schemas() {
	static $schemas = null;

	if ( null === $schemas ) {
		$schemas = apply_filters(
			'venix_concierge_core_page_content_schemas',
			array(
				'home'     => venix_concierge_core_home_page_content_schema(),
				'about'    => venix_concierge_core_about_page_content_schema(),
				'services' => venix_concierge_core_services_page_content_schema(),
				'fleet'    => venix_concierge_core_fleet_page_content_schema(),
				'contact'  => venix_concierge_core_contact_page_content_schema(),
			)
		);
	}

	return $schemas;
}

/**
 * Get one page schema.
 *
 * @param string $page_key Page key.
 * @return array<string, mixed>|null
 */
function venix_concierge_core_get_page_content_schema( $page_key ) {
	$schemas = venix_concierge_core_page_content_schemas();

	return isset( $schemas[ $page_key ] ) ? $schemas[ $page_key ] : null;
}

/**
 * Flatten a schema's text fields into a list.
 *
 * @param array<string, mixed> $schema Page schema.
 * @return array<int, array{path: string[], label: string, type: string}>
 */
function venix_concierge_core_page_content_schema_fields( array $schema ) {
	$fields = array();

	foreach ( isset( $schema['sections'] ) ? $schema['sections'] : array() as $section ) {
		foreach ( $section['groups'] as $group ) {
			foreach ( $group['fields'] as $field ) {
				$fields[] = $field;
			}
		}
	}

	return $fields;
}

/**
 * Read a value from a nested array by key path.
 *
 * @param mixed    $data Source array.
 * @param string[] $path Key path.
 * @return mixed|null Null when the path does not exist.
 */
function venix_concierge_core_array_get( $data, array $path ) {
	foreach ( $path as $key ) {
		if ( ! is_array( $data ) || ! array_key_exists( $key, $data ) ) {
			return null;
		}

		$data = $data[ $key ];
	}

	return $data;
}

/**
 * Write a value into a nested array by key path, creating levels as needed.
 *
 * @param array    $data  Target array.
 * @param string[] $path  Key path.
 * @param mixed    $value Value to store.
 * @return array
 */
function venix_concierge_core_array_set( array $data, array $path, $value ) {
	$key = array_shift( $path );

	if ( empty( $path ) ) {
		$data[ $key ] = $value;

		return $data;
	}

	$child        = isset( $data[ $key ] ) && is_array( $data[ $key ] ) ? $data[ $key ] : array();
	$data[ $key ] = venix_concierge_core_array_set( $child, $path, $value );

	return $data;
}

/**
 * Resolve the page key a page belongs to, or an empty string when unsupported.
 *
 * Home is the static front page or any Polylang translation of it. About,
 * Services, Fleet and Contact are the pages whose slug (or a Polylang
 * translation's slug) equals the page key, matching the theme's page roles.
 *
 * @param int $post_id Page ID.
 * @return string
 */
function venix_concierge_core_get_page_content_key( $post_id ) {
	static $resolved = array();

	$post_id = absint( $post_id );

	if ( isset( $resolved[ $post_id ] ) ) {
		return $resolved[ $post_id ];
	}

	$resolved[ $post_id ] = '';

	if ( ! $post_id || 'page' !== get_post_type( $post_id ) ) {
		return '';
	}

	$key = venix_concierge_core_is_home_page( $post_id ) ? 'home' : venix_concierge_core_get_slug_page_key( $post_id );
	$key = apply_filters( 'venix_concierge_core_page_content_key', $key, $post_id );

	$resolved[ $post_id ] = null !== venix_concierge_core_get_page_content_schema( $key ) ? (string) $key : '';

	return $resolved[ $post_id ];
}

/**
 * Check whether a page is the static front page or a Polylang translation of it.
 *
 * @param int $post_id Page ID.
 * @return bool
 */
function venix_concierge_core_is_home_page( $post_id ) {
	$front_id = (int) get_option( 'page_on_front' );

	if ( ! $front_id ) {
		return false;
	}

	$ids = array( $front_id );

	if ( function_exists( 'pll_get_post_translations' ) ) {
		$ids = array_merge( $ids, array_values( (array) pll_get_post_translations( $front_id ) ) );

		// Polylang can swap page_on_front for the current language, so also match the reverse direction.
		if ( in_array( $front_id, array_map( 'intval', array_values( (array) pll_get_post_translations( $post_id ) ) ), true ) ) {
			$ids[] = $post_id;
		}
	}

	return in_array( $post_id, array_map( 'intval', $ids ), true );
}

/**
 * Map a page (or one of its Polylang translations) to a slug-based page key.
 *
 * @param int $post_id Page ID.
 * @return string Page key, or an empty string when no slug-based schema applies.
 */
function venix_concierge_core_get_slug_page_key( $post_id ) {
	$slug_keys = array( 'about', 'services', 'fleet', 'contact' );
	$ids       = array( $post_id );

	if ( function_exists( 'pll_get_post_translations' ) ) {
		$ids = array_merge( $ids, array_map( 'intval', array_values( (array) pll_get_post_translations( $post_id ) ) ) );
	}

	foreach ( array_unique( $ids ) as $id ) {
		$slug = (string) get_post_field( 'post_name', $id );

		if ( in_array( $slug, $slug_keys, true ) ) {
			return $slug;
		}
	}

	return '';
}

/**
 * Check that a value is a usable Media Library image ID.
 *
 * @param mixed $attachment_id Attachment ID.
 * @return int Attachment ID, or 0 when it is missing or not an image.
 */
function venix_concierge_core_valid_image_id( $attachment_id ) {
	$attachment_id = absint( $attachment_id );

	return $attachment_id && wp_attachment_is_image( $attachment_id ) ? $attachment_id : 0;
}

/**
 * Sanitize one text-like value by field type.
 *
 * @param string $type  Field type.
 * @param mixed  $value Raw value.
 * @return string
 */
function venix_concierge_core_sanitize_page_content_value( $type, $value ) {
	if ( ! is_scalar( $value ) ) {
		return '';
	}

	$value = (string) $value;

	switch ( $type ) {
		case 'textarea':
			return trim( sanitize_textarea_field( $value ) );
		case 'url':
			return esc_url_raw( trim( $value ), array( 'http', 'https' ) );
		default:
			return trim( sanitize_text_field( $value ) );
	}
}

/**
 * Sanitize submitted page content against a page schema.
 *
 * Unknown keys are dropped and empty values are omitted, so only real edits
 * become overrides.
 *
 * @param string $page_key Page key.
 * @param mixed  $input    Raw (unslashed) submitted data.
 * @return array<string, mixed>
 */
function venix_concierge_core_sanitize_page_content( $page_key, $input ) {
	$schema = venix_concierge_core_get_page_content_schema( $page_key );
	$input  = is_array( $input ) ? $input : array();
	$clean  = array();

	if ( null === $schema ) {
		return $clean;
	}

	foreach ( venix_concierge_core_page_content_schema_fields( $schema ) as $field ) {
		$value = venix_concierge_core_array_get( $input, $field['path'] );
		$value = venix_concierge_core_sanitize_page_content_value( $field['type'], $value );

		if ( '' !== $value ) {
			$clean = venix_concierge_core_array_set( $clean, $field['path'], $value );
		}
	}

	$media_input = isset( $input['media'] ) && is_array( $input['media'] ) ? $input['media'] : array();

	foreach ( array_keys( isset( $schema['media'] ) ? $schema['media'] : array() ) as $slot ) {
		$attachment_id = isset( $media_input[ $slot ] ) ? venix_concierge_core_valid_image_id( $media_input[ $slot ] ) : 0;

		if ( $attachment_id ) {
			$clean['media'][ $slot ] = $attachment_id;
		}
	}

	// Optional contextual alt text per image slot. It is independent of the image so a
	// removed image never leaves a stale ID behind, and an empty value is simply not stored.
	$alt_input = isset( $input['media_alt'] ) && is_array( $input['media_alt'] ) ? $input['media_alt'] : array();

	foreach ( array_keys( isset( $schema['media'] ) ? $schema['media'] : array() ) as $slot ) {
		$alt = isset( $alt_input[ $slot ] ) ? venix_concierge_core_sanitize_page_content_value( 'text', $alt_input[ $slot ] ) : '';

		if ( '' !== $alt ) {
			$clean['media_alt'][ $slot ] = $alt;
		}
	}

	return $clean;
}

/**
 * Get the saved, schema-limited overrides for a page.
 *
 * @param int $post_id Page ID.
 * @return array{page_key: string, text: array<string, mixed>, media: array<string, int>, media_alt: array<string, string>}
 */
function venix_concierge_core_get_page_overrides( $post_id ) {
	$empty    = array(
		'page_key'  => '',
		'text'      => array(),
		'media'     => array(),
		'media_alt' => array(),
	);
	$page_key = venix_concierge_core_get_page_content_key( $post_id );
	$schema   = '' === $page_key ? null : venix_concierge_core_get_page_content_schema( $page_key );
	$stored   = null === $schema ? null : get_post_meta( absint( $post_id ), VENIX_CONCIERGE_CORE_PAGE_CONTENT_META_KEY, true );

	if ( ! is_array( $stored ) ) {
		return $empty;
	}

	$overrides = array(
		'page_key'  => $page_key,
		'text'      => array(),
		'media'     => array(),
		'media_alt' => array(),
	);

	foreach ( venix_concierge_core_page_content_schema_fields( $schema ) as $field ) {
		$value = venix_concierge_core_array_get( $stored, $field['path'] );

		if ( is_string( $value ) && '' !== trim( $value ) ) {
			$overrides['text'] = venix_concierge_core_array_set( $overrides['text'], $field['path'], $value );
		}
	}

	$stored_media = isset( $stored['media'] ) && is_array( $stored['media'] ) ? $stored['media'] : array();

	foreach ( array_keys( isset( $schema['media'] ) ? $schema['media'] : array() ) as $slot ) {
		$attachment_id = isset( $stored_media[ $slot ] ) ? venix_concierge_core_valid_image_id( $stored_media[ $slot ] ) : 0;

		if ( $attachment_id ) {
			$overrides['media'][ $slot ] = $attachment_id;
		}
	}

	$stored_alt = isset( $stored['media_alt'] ) && is_array( $stored['media_alt'] ) ? $stored['media_alt'] : array();

	foreach ( array_keys( isset( $schema['media'] ) ? $schema['media'] : array() ) as $slot ) {
		$alt = isset( $stored_alt[ $slot ] ) && is_string( $stored_alt[ $slot ] ) ? trim( $stored_alt[ $slot ] ) : '';

		if ( '' !== $alt ) {
			$overrides['media_alt'][ $slot ] = $alt;
		}
	}

	return $overrides;
}

/**
 * Keep translated pages independent: never copy or sync this meta between languages.
 *
 * @param string[] $keys Meta keys Polylang would copy or synchronize.
 * @return string[]
 */
function venix_concierge_core_exclude_page_content_from_polylang( $keys ) {
	return array_values( array_diff( (array) $keys, array( VENIX_CONCIERGE_CORE_PAGE_CONTENT_META_KEY ) ) );
}
add_filter( 'pll_copy_post_metas', 'venix_concierge_core_exclude_page_content_from_polylang' );

/**
 * Add the meta box to supported pages.
 *
 * @param WP_Post $post Page being edited.
 * @return void
 */
function venix_concierge_core_add_page_content_meta_box( $post ) {
	if ( '' === venix_concierge_core_get_page_content_key( $post->ID ) ) {
		return;
	}

	add_meta_box(
		'venix-page-content',
		__( 'Venix Page Content', 'venix-concierge-core' ),
		'venix_concierge_core_render_page_content_meta_box',
		'page',
		'normal',
		'default',
		array( '__block_editor_compatible_meta_box' => true )
	);
}
add_action( 'add_meta_boxes_page', 'venix_concierge_core_add_page_content_meta_box' );

/**
 * Load the Media Library picker only on supported page edit screens.
 *
 * @param string $hook_suffix Admin screen hook.
 * @return void
 */
function venix_concierge_core_enqueue_page_content_assets( $hook_suffix ) {
	if ( ! in_array( $hook_suffix, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}

	$post = get_post();

	if ( ! $post || '' === venix_concierge_core_get_page_content_key( $post->ID ) ) {
		return;
	}

	wp_enqueue_media( array( 'post' => $post->ID ) );

	$dir = plugin_dir_path( VENIX_CONCIERGE_CORE_FILE );

	wp_enqueue_style(
		'venix-concierge-core-page-content',
		plugins_url( 'assets/admin/page-content.css', VENIX_CONCIERGE_CORE_FILE ),
		array(),
		(string) filemtime( $dir . 'assets/admin/page-content.css' )
	);
	wp_enqueue_script(
		'venix-concierge-core-page-content',
		plugins_url( 'assets/admin/page-content.js', VENIX_CONCIERGE_CORE_FILE ),
		array( 'media-editor' ),
		(string) filemtime( $dir . 'assets/admin/page-content.js' ),
		array( 'in_footer' => true )
	);
}
add_action( 'admin_enqueue_scripts', 'venix_concierge_core_enqueue_page_content_assets' );

/**
 * Get the theme's default content for a page, used as editor placeholders.
 *
 * @param string  $page_key Page key.
 * @param WP_Post $post     Page being edited.
 * @return array<string, mixed>
 */
function venix_concierge_core_get_page_content_defaults( $page_key, $post ) {
	$defaults = apply_filters( 'venix_concierge_core_page_content_defaults', array(), $page_key, $post );

	return is_array( $defaults ) ? $defaults : array();
}

/**
 * Render one media (image) field.
 *
 * @param string $slot          Semantic media slot.
 * @param string $label         Editor-facing label.
 * @param int    $attachment_id Saved attachment ID, or 0.
 * @param string $alt           Saved contextual alt text override, or an empty string.
 * @return void
 */
function venix_concierge_core_render_page_content_media_field( $slot, $label, $attachment_id, $alt = '' ) {
	$name     = VENIX_CONCIERGE_CORE_PAGE_CONTENT_FIELD . '[media][' . $slot . ']';
	$alt_name = VENIX_CONCIERGE_CORE_PAGE_CONTENT_FIELD . '[media_alt][' . $slot . ']';
	$alt_id   = 'venix-pc-media-alt-' . sanitize_key( str_replace( '.', '-', $slot ) );
	$has      = $attachment_id > 0;
	$filename = $has ? wp_basename( (string) get_attached_file( $attachment_id ) ) : '';
	?>
	<div class="venix-pc-media" data-venix-pc-media>
		<span class="venix-pc-media__label"><?php echo esc_html( $label ); ?></span>
		<input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $has ? (string) $attachment_id : '' ); ?>" data-venix-pc-media-input />
		<div class="venix-pc-media__preview" data-venix-pc-media-preview>
			<?php
			if ( $has ) {
				echo wp_get_attachment_image( $attachment_id, 'medium', false, array( 'loading' => 'lazy' ) );
			}
			?>
		</div>
		<p class="venix-pc-media__empty description" data-venix-pc-media-empty<?php echo $has ? ' hidden' : ''; ?>><?php esc_html_e( 'No image selected. The default is used.', 'venix-concierge-core' ); ?></p>
		<p class="venix-pc-media__filename description" data-venix-pc-media-filename<?php echo $has ? '' : ' hidden'; ?>><?php echo esc_html( $filename ); ?></p>
		<p class="venix-pc-media__actions">
			<button type="button" class="button" data-venix-pc-media-select
				data-label-select="<?php esc_attr_e( 'Select Image', 'venix-concierge-core' ); ?>"
				data-label-replace="<?php esc_attr_e( 'Replace Image', 'venix-concierge-core' ); ?>"
				data-frame-title="<?php echo esc_attr( $label ); ?>"
				data-frame-button="<?php esc_attr_e( 'Use this image', 'venix-concierge-core' ); ?>"><?php echo $has ? esc_html__( 'Replace Image', 'venix-concierge-core' ) : esc_html__( 'Select Image', 'venix-concierge-core' ); ?></button>
			<button type="button" class="button-link button-link-delete" data-venix-pc-media-remove<?php echo $has ? '' : ' hidden'; ?>><?php esc_html_e( 'Remove Image', 'venix-concierge-core' ); ?></button>
		</p>
		<p class="venix-pc-media__alt">
			<label for="<?php echo esc_attr( $alt_id ); ?>"><?php esc_html_e( 'Alt Text (optional)', 'venix-concierge-core' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $alt_id ); ?>" name="<?php echo esc_attr( $alt_name ); ?>" value="<?php echo esc_attr( $alt ); ?>" placeholder="<?php esc_attr_e( 'Media Library alt if empty', 'venix-concierge-core' ); ?>" />
		</p>
	</div>
	<?php
}

/**
 * Render the Venix Page Content meta box.
 *
 * @param WP_Post $post Page being edited.
 * @return void
 */
function venix_concierge_core_render_page_content_meta_box( $post ) {
	$page_key = venix_concierge_core_get_page_content_key( $post->ID );
	$schema   = '' === $page_key ? null : venix_concierge_core_get_page_content_schema( $page_key );

	if ( null === $schema ) {
		return;
	}

	$overrides = venix_concierge_core_get_page_overrides( $post->ID );
	$defaults  = venix_concierge_core_get_page_content_defaults( $page_key, $post );
	$sections  = $schema['sections'];
	$media     = isset( $schema['media'] ) ? $schema['media'] : array();

	wp_nonce_field( VENIX_CONCIERGE_CORE_PAGE_CONTENT_ACTION, VENIX_CONCIERGE_CORE_PAGE_CONTENT_NONCE );
	?>
	<div class="venix-pc">
		<p class="description">
			<?php esc_html_e( 'Edit the wording and images of this page. Layout and design are fixed. Leave a text field empty to keep the standard text (shown in grey); remove an image to return to the standard image.', 'venix-concierge-core' ); ?>
		</p>
		<?php foreach ( $sections as $index => $section ) : ?>
			<details class="venix-pc__section"<?php echo 0 === $index ? ' open' : ''; ?>>
				<summary><?php echo esc_html( $section['label'] ); ?></summary>
				<div class="venix-pc__body">
					<?php if ( ! empty( $section['description'] ) ) : ?>
						<p class="description"><?php echo esc_html( $section['description'] ); ?></p>
					<?php endif; ?>
					<?php foreach ( $section['groups'] as $group ) : ?>
						<fieldset class="venix-pc__group">
							<?php if ( ! empty( $group['label'] ) ) : ?>
								<legend><?php echo esc_html( $group['label'] ); ?></legend>
							<?php endif; ?>
							<?php
							foreach ( $group['fields'] as $field ) :
								$path    = $field['path'];
								$id      = 'venix-pc-' . implode( '-', $path );
								$name    = VENIX_CONCIERGE_CORE_PAGE_CONTENT_FIELD . '[' . implode( '][', $path ) . ']';
								$saved   = venix_concierge_core_array_get( $overrides['text'], $path );
								$default = venix_concierge_core_array_get( $defaults, $path );
								$saved   = is_string( $saved ) ? $saved : '';
								$default = is_string( $default ) ? $default : '';
								?>
								<p class="venix-pc__field">
									<label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
									<?php if ( 'textarea' === $field['type'] ) : ?>
										<textarea class="widefat" rows="3" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" placeholder="<?php echo esc_attr( $default ); ?>"><?php echo esc_textarea( $saved ); ?></textarea>
									<?php else : ?>
										<input class="widefat" type="<?php echo 'url' === $field['type'] ? 'url' : 'text'; ?>" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $saved ); ?>" placeholder="<?php echo esc_attr( $default ); ?>" />
									<?php endif; ?>
								</p>
							<?php endforeach; ?>
						</fieldset>
					<?php endforeach; ?>
				</div>
			</details>
		<?php endforeach; ?>

		<?php if ( ! empty( $media ) ) : ?>
			<details class="venix-pc__section">
				<summary><?php esc_html_e( 'Images', 'venix-concierge-core' ); ?></summary>
				<div class="venix-pc__body">
					<p class="description"><?php esc_html_e( 'Choose images from the Media Library. Sizing and cropping are handled by the design.', 'venix-concierge-core' ); ?></p>
					<div class="venix-pc__media-grid">
						<?php
						foreach ( $media as $slot => $label ) {
							venix_concierge_core_render_page_content_media_field(
								$slot,
								$label,
								isset( $overrides['media'][ $slot ] ) ? (int) $overrides['media'][ $slot ] : 0,
								isset( $overrides['media_alt'][ $slot ] ) ? $overrides['media_alt'][ $slot ] : ''
							);
						}
						?>
					</div>
				</div>
			</details>
		<?php endif; ?>

		<p class="venix-pc__reset">
			<label>
				<input type="checkbox" name="<?php echo esc_attr( VENIX_CONCIERGE_CORE_PAGE_CONTENT_RESET ); ?>" value="1" />
				<?php esc_html_e( 'Reset everything on this page to the standard text and images when I click Update.', 'venix-concierge-core' ); ?>
			</label>
		</p>
	</div>
	<?php
}

/**
 * Save the meta box.
 *
 * @param int     $post_id Page ID.
 * @param WP_Post $post    Page object.
 * @return void
 */
function venix_concierge_core_save_page_content( $post_id, $post ) {
	if (
		! isset( $_POST[ VENIX_CONCIERGE_CORE_PAGE_CONTENT_NONCE ] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ VENIX_CONCIERGE_CORE_PAGE_CONTENT_NONCE ] ) ), VENIX_CONCIERGE_CORE_PAGE_CONTENT_ACTION )
	) {
		return;
	}

	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
		return;
	}

	if ( 'page' !== $post->post_type || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$page_key = venix_concierge_core_get_page_content_key( $post_id );

	if ( '' === $page_key ) {
		return;
	}

	if ( ! empty( $_POST[ VENIX_CONCIERGE_CORE_PAGE_CONTENT_RESET ] ) ) {
		delete_post_meta( $post_id, VENIX_CONCIERGE_CORE_PAGE_CONTENT_META_KEY );

		return;
	}

	// Nested field data is whitelisted and sanitized field-by-field against the page schema.
	// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	$raw   = isset( $_POST[ VENIX_CONCIERGE_CORE_PAGE_CONTENT_FIELD ] ) ? wp_unslash( $_POST[ VENIX_CONCIERGE_CORE_PAGE_CONTENT_FIELD ] ) : array();
	$clean = venix_concierge_core_sanitize_page_content( $page_key, $raw );

	if ( empty( $clean ) ) {
		delete_post_meta( $post_id, VENIX_CONCIERGE_CORE_PAGE_CONTENT_META_KEY );

		return;
	}

	update_post_meta( $post_id, VENIX_CONCIERGE_CORE_PAGE_CONTENT_META_KEY, wp_slash( $clean ) );
}
add_action( 'save_post_page', 'venix_concierge_core_save_page_content', 10, 2 );
