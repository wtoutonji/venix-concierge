<?php
/**
 * Media Library image slots and rendering helpers.
 *
 * @package VenixConcierge
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the attachment IDs assigned to the site's editorial photography slots.
 *
 * Replace a zero value with the relevant Media Library attachment ID. The filter
 * permits a future settings or page-data owner without changing template markup.
 *
 * @return array<string, int>
 */
function venix_concierge_media_slots() {
	$slots = array_fill_keys(
		array(
			'home.hero', 'home.about', 'home.services.chauffeur', 'home.services.airport',
			'home.services.events', 'home.services.delegations', 'home.promise',
			'home.fleet.s_class', 'home.fleet.e_class', 'home.fleet.v_class',
			'home.fleet.sprinter', 'home.events',
			'about.hero', 'about.story', 'about.culture',
			'services.hero', 'services.chauffeur', 'services.airport', 'services.events',
			'services.delegations', 'services.protection', 'services.flights',
			'services.embassy', 'services.concierge', 'services.weddings',
			'fleet.hero', 'fleet.s_class.exterior', 'fleet.s_class.interior_1',
			'fleet.s_class.interior_2', 'fleet.e_class.exterior', 'fleet.e_class.interior_1',
			'fleet.e_class.interior_2', 'fleet.v_class.exterior',
			'fleet.v_class.interior_1', 'fleet.v_class.interior_2',
			'fleet.sprinter.exterior', 'fleet.sprinter.interior_1', 'fleet.sprinter.interior_2',
			'contact.hero',
		),
		0
	);

	return apply_filters( 'venix_concierge_media_slots', $slots );
}

/**
 * Gets an attachment ID for a stable semantic photography slot.
 *
 * A Media Library image chosen on the current page (Venix Page Content) wins
 * over the default slot value; without one the default applies unchanged.
 *
 * @param string $slot Slot key.
 * @return int
 */
function venix_concierge_media_attachment_id( $slot ) {
	$override = venix_concierge_get_page_media_id( $slot );

	if ( $override > 0 ) {
		return $override;
	}

	$slots = venix_concierge_media_slots();

	return isset( $slots[ $slot ] ) ? absint( $slots[ $slot ] ) : 0;
}

/**
 * Resolves the alt text for a rendered image.
 *
 * Precedence: page-slot override, then the Media Library alt text of the
 * attachment, then the default slot alt text. An empty result is a decorative image.
 *
 * @param int    $attachment_id Attachment ID.
 * @param string $override      Page-slot alt text override.
 * @param string $default       Default slot alt text.
 * @return string
 */
function venix_concierge_media_alt( $attachment_id, $override = '', $default = '' ) {
	$override = trim( (string) $override );

	if ( '' !== $override ) {
		return $override;
	}

	$library = trim( (string) get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) );

	return '' !== $library ? $library : trim( (string) $default );
}

/**
 * Renders a responsive Media Library image or a non-verbal empty media surface.
 *
 * `alt` is the default slot alt text; `alt_override` is the page-slot override.
 * Neither is used blindly: see venix_concierge_media_alt() for the precedence.
 *
 * @param int   $attachment_id Attachment ID.
 * @param array $args Rendering arguments.
 * @return void
 */
function venix_concierge_render_media( $attachment_id, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'size'           => 'large',
			'class'          => '',
			'alt'            => '',
			'alt_override'   => '',
			'sizes'          => '100vw',
			'loading'        => 'lazy',
			'fetchpriority'  => 'auto',
			'wrapper'        => 'div',
			'after'          => null,
		)
	);

	$wrapper = tag_escape( $args['wrapper'] );
	$class   = trim( $args['class'] );
	$classes = $class ? $class . ' venix-media-slot' : 'venix-media-slot';

	echo '<' . $wrapper . ' class="' . esc_attr( $classes ) . '">';

	if ( $attachment_id > 0 ) {
		echo wp_get_attachment_image(
			$attachment_id,
			$args['size'],
			false,
			array(
				'class'         => 'venix-media-slot__image',
				'alt'           => venix_concierge_media_alt( $attachment_id, $args['alt_override'], $args['alt'] ),
				'sizes'         => $args['sizes'],
				'loading'       => $args['loading'],
				'fetchpriority' => $args['fetchpriority'],
			)
		);
	}

	if ( is_callable( $args['after'] ) ) {
		call_user_func( $args['after'] );
	}

	echo '</' . $wrapper . '>';
}

/**
 * Renders a semantic media slot with page-level image and alt text overrides.
 *
 * The slot key is the single identity: the attachment resolves through
 * venix_concierge_media_attachment_id() and the alt override through the same page meta.
 *
 * @param string $slot Slot key, such as `home.about`.
 * @param array  $args Rendering arguments for venix_concierge_render_media().
 * @return void
 */
function venix_concierge_render_media_slot( $slot, $args = array() ) {
	$args['alt_override'] = venix_concierge_get_page_media_alt( $slot );

	venix_concierge_render_media( venix_concierge_media_attachment_id( $slot ), $args );
}

/**
 * Gets a validated Media Library video attachment ID for a semantic video slot.
 *
 * Re-validates at render time (not just at save time) so stored metadata is
 * never trusted blindly.
 *
 * @param string $slot Slot key, such as `home.hero_video`.
 * @return int Attachment ID, or 0 when unset or not a video.
 */
function venix_concierge_hero_video_attachment_id( $slot ) {
	$attachment_id = venix_concierge_get_page_video_media_id( $slot );

	return $attachment_id && wp_attachment_is( 'video', $attachment_id ) ? $attachment_id : 0;
}

/**
 * Renders an optional decorative Hero background video.
 *
 * Entirely optional: outputs nothing when no valid video is set for the slot.
 * The Hero Image slot supplies the poster and stays the underlying fallback in
 * the DOM, so playback failure or an unset video never loses the Hero image.
 *
 * @param string $video_slot  Semantic video slot, e.g. `home.hero_video`.
 * @param string $poster_slot Semantic image slot used as the poster, e.g. `home.hero`.
 * @param string $class       CSS class for the video element.
 * @return void
 */
function venix_concierge_render_hero_video( $video_slot, $poster_slot, $class = 'venix-hero-video' ) {
	$attachment_id = venix_concierge_hero_video_attachment_id( $video_slot );

	if ( ! $attachment_id ) {
		return;
	}

	$src  = wp_get_attachment_url( $attachment_id );
	$mime = get_post_mime_type( $attachment_id );

	if ( ! $src || ! $mime ) {
		return;
	}

	$poster_id = venix_concierge_media_attachment_id( $poster_slot );
	$poster    = $poster_id ? wp_get_attachment_image_url( $poster_id, 'full' ) : '';
	?>
	<video class="<?php echo esc_attr( $class ); ?>" autoplay muted loop playsinline preload="metadata" aria-hidden="true" tabindex="-1"<?php echo $poster ? ' poster="' . esc_url( $poster ) . '"' : ''; ?>>
		<source src="<?php echo esc_url( $src ); ?>" type="<?php echo esc_attr( $mime ); ?>" />
	</video>
	<?php
}

/**
 * Renders a page's Hero Image with its optional Hero Video layered above it.
 *
 * Every supported page Hero follows the same `{page}.hero` image slot and
 * `{page}.hero_video` video slot convention, so this is the single place that
 * wires the video into the image's existing media wrapper (as a DOM child
 * appended after the image, via `venix_concierge_render_media()`'s `after`
 * hook) rather than repeating that wiring per page template.
 *
 * @param string               $page_key Page key, e.g. `home`, `about`, `services`, `fleet`, `contact`.
 * @param array<string, mixed> $args     Arguments for venix_concierge_render_media_slot() (the Hero Image).
 *                                       An optional 'video_class' overrides the video element's CSS class.
 * @return void
 */
function venix_concierge_render_page_hero_media( $page_key, array $args = array() ) {
	$video_class = isset( $args['video_class'] ) ? $args['video_class'] : 'venix-hero-video';
	$poster_slot = $page_key . '.hero';
	$video_slot  = $page_key . '.hero_video';

	unset( $args['video_class'] );

	$args['after'] = static function () use ( $video_slot, $poster_slot, $video_class ) {
		venix_concierge_render_hero_video( $video_slot, $poster_slot, $video_class );
	};

	venix_concierge_render_media_slot( $poster_slot, $args );
}
