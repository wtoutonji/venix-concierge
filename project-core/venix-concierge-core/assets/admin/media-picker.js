/**
 * Shared native Media Library picker for admin image fields.
 *
 * Used by the Venix Page Content meta box and the Venix Site Settings logo
 * fields. Each field stores only the attachment ID in a hidden input.
 */
( function () {
	'use strict';

	function setState( root, attachment ) {
		var input = root.querySelector( '[data-venix-pc-media-input]' );
		var preview = root.querySelector( '[data-venix-pc-media-preview]' );
		var empty = root.querySelector( '[data-venix-pc-media-empty]' );
		var filename = root.querySelector( '[data-venix-pc-media-filename]' );
		var select = root.querySelector( '[data-venix-pc-media-select]' );
		var remove = root.querySelector( '[data-venix-pc-media-remove]' );
		var has = !! attachment;

		input.value = has ? String( attachment.id ) : '';
		preview.textContent = '';

		if ( has ) {
			var sizes = attachment.sizes || {};
			var source = sizes.medium || sizes.thumbnail || sizes.full || { url: attachment.url };
			var img = document.createElement( 'img' );

			img.src = source.url;
			img.alt = '';
			preview.appendChild( img );
			filename.textContent = attachment.filename || attachment.title || '';
		}

		empty.hidden = has;
		filename.hidden = ! has;
		remove.hidden = ! has;
		select.textContent = has ? select.getAttribute( 'data-label-replace' ) : select.getAttribute( 'data-label-select' );
	}

	function init( root ) {
		var select = root.querySelector( '[data-venix-pc-media-select]' );
		var remove = root.querySelector( '[data-venix-pc-media-remove]' );
		var frame = null;

		select.addEventListener( 'click', function () {
			if ( ! window.wp || ! window.wp.media ) {
				return;
			}

			if ( ! frame ) {
				frame = window.wp.media( {
					title: select.getAttribute( 'data-frame-title' ),
					button: { text: select.getAttribute( 'data-frame-button' ) },
					library: { type: 'image' },
					multiple: false
				} );

				frame.on( 'open', function () {
					// The Library state opens on "Upload files" by default; start on existing media.
					frame.content.mode( 'browse' );

					var id = parseInt( root.querySelector( '[data-venix-pc-media-input]' ).value, 10 );

					if ( id ) {
						frame.state().get( 'selection' ).add( window.wp.media.attachment( id ) );
					}
				} );

				frame.on( 'select', function () {
					var attachment = frame.state().get( 'selection' ).first();

					if ( attachment ) {
						setState( root, attachment.toJSON() );
					}
				} );
			}

			frame.open();
		} );

		remove.addEventListener( 'click', function () {
			setState( root, null );
		} );
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		document.querySelectorAll( '[data-venix-pc-media]' ).forEach( init );
	} );
}() );
