/**
 * Inquiry form enhancement: submits with fetch and reports the result in the
 * live status region. Without JS the form posts normally and the handler
 * redirects back with ?inquiry=<status>.
 */
( function () {
	'use strict';

	var form = document.querySelector( '[data-inquiry-form]' );

	if ( ! form || ! window.fetch || ! window.FormData ) {
		return;
	}

	var note = form.querySelector( '#home-form-note' );
	var button = form.querySelector( 'button[type="submit"]' );
	var messages = {
		sent: form.getAttribute( 'data-msg-sent' ),
		error: form.getAttribute( 'data-msg-error' ),
		invalid: form.getAttribute( 'data-msg-invalid' ),
		limited: form.getAttribute( 'data-msg-limited' )
	};

	function show( status ) {
		note.textContent = messages[ status ] || messages.error;
		note.classList.remove( 'is-success', 'is-error' );
		note.classList.add( 'sent' === status ? 'is-success' : 'is-error' );
		note.focus();
	}

	form.addEventListener( 'submit', function ( event ) {
		if ( ! form.checkValidity() ) {
			return;
		}

		event.preventDefault();
		button.disabled = true;
		button.textContent = form.getAttribute( 'data-msg-sending' );

		fetch( form.action, {
			method: 'POST',
			body: new FormData( form ),
			headers: { Accept: 'application/json' },
			credentials: 'same-origin'
		} )
			.then( function ( response ) {
				return response.json().catch( function () {
					return { status: 'error' };
				} );
			} )
			.then( function ( result ) {
				show( result.status );

				if ( 'sent' === result.status ) {
					form.reset();
				}
			} )
			.catch( function () {
				show( 'error' );
			} )
			.then( function () {
				button.disabled = false;
				button.textContent = form.getAttribute( 'data-msg-submit' );
			} );
	} );
}() );
