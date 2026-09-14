# Dialog

## Purpose

Render a reusable modal-dialog primitive using the native HTML `<dialog>` element. Dialog provides server-rendered content, accessible naming, a native close control, and the smallest JavaScript enhancement needed to call `showModal()` from external triggers.

Dialog is not a marketing-popup system and contains no timing, targeting, persistence, analytics, or lead-capture logic.

## Category and lifecycle

* Category: Interactive
* Status: Experimental
* Introduced: Teelya 1.1.0

The API is available for controlled v1.1 use and may be refined before the component becomes Stable.

## Native dialog behavior

`<dialog>` is the native element. Teelya opens it with `showModal()`, which requests modal top-layer behavior. The browser owns modal state, focus containment, Escape dismissal, backdrop behavior, and dialog return values.

Teelya intentionally supports modal operation only. It does not expose the non-modal `show()` API.

The component renders nothing when its required ID or title is invalid, or when `content` is not a string.

## PHP API

```php
get_template_part(
	'template-parts/components/dialog/dialog',
	null,
	array(
		'id'          => 'contact-dialog',
		'title'       => __( 'Contact us', 'venix-concierge' ),
		'content'     => '<p>' . esc_html__( 'Dialog content.', 'venix-concierge' ) . '</p>',
		'close_label' => __( 'Close dialog', 'venix-concierge' ),
	)
);
```

| Argument | Type | Required | Default | Description |
| --- | --- | --- | --- | --- |
| `id` | `string` | Yes | None | Stable unique ID that already conforms to `sanitize_key()`. |
| `title` | `string` | Yes | None | Visible plain-text dialog title. HTML is stripped. |
| `content` | `string` | Yes | None | Formatted content rendered through the documented Dialog HTML allowlist. An empty string is allowed. |
| `close_label` | `string` | No | Translated `Close dialog` | Visible plain-text label for the native close button. |

Caller-provided user-visible strings must use the caller's appropriate text domain.

## ID contract

The caller must provide a stable, page-unique lowercase ID composed according to WordPress `sanitize_key()` behavior, for example `contact-dialog`. Invalid or missing IDs cause the component to render nothing rather than silently changing the trigger target.

The title receives the derived ID `<dialog-id>-title`. The caller must not render the same Dialog ID more than once on a page. Teelya does not generate random IDs because external triggers require a predictable reference.

## Trigger contract

Use a real button whose only purpose is opening the modal:

```html
<button
	type="button"
	hidden
	data-tly-dialog-open="contact-dialog"
>
	Contact us
</button>
```

The `hidden` attribute is required. Dialog JavaScript reveals the button only after confirming that the native modal API exists and the referenced Teelya Dialog is valid. Multiple triggers may reference the same Dialog ID.

Do not use an empty or hash-only link as a button substitute. If opening the modal is an essential workflow, provide a normal link to an equivalent standalone destination alongside the enhanced trigger.

## Markup and accessible naming

```html
<dialog
	id="contact-dialog"
	class="tly-dialog"
	aria-labelledby="contact-dialog-title"
	data-tly-dialog
>
	<div class="tly-dialog__header">
		<h2 id="contact-dialog-title" class="tly-dialog__title">Contact us</h2>
		<form class="tly-dialog__close-form" method="dialog">
			<button class="tly-dialog__close" type="submit" value="close">
				Close dialog
			</button>
		</form>
	</div>
	<div class="tly-dialog__content">
		<p>Dialog content.</p>
	</div>
</dialog>
```

The visible `<h2>` supplies the accessible name through `aria-labelledby`. The title is required, so the component does not expose a titleless or `aria-label` mode.

## Close behavior

The visible close button is a native `form method="dialog"` submission. It closes only its containing Dialog and sets the native return value to `close`. No close-button JavaScript is required.

Escape dismissal remains native. Backdrop clicks intentionally do not close the Dialog.

## Content-processing contract

Dialog renders `content` through `wp_kses()` using WordPress's post-content allowlist plus a small set of standard form elements and attributes for `<form>`, `<input>`, `<select>`, `<option>`, and `<optgroup>`. This supports ordinary project forms without allowing raw, unsanitized output.

The component does not invoke `the_content`, `do_blocks()`, shortcodes, automatic paragraphs, or embed discovery. Projects requiring those transformations must prepare content before passing it to the component.

## Accessibility and keyboard behavior

* Native modal semantics and the top layer come from `showModal()`.
* The visible title names the Dialog through `aria-labelledby`.
* The explicit close button has meaningful visible text.
* The browser manages initial focus, sequential Tab containment, Shift+Tab, and Escape dismissal.
* Teelya does not add a custom focus trap, `aria-modal`, `aria-hidden`, body state, or manual tab cycling.
* The close button retains native button behavior and receives an explicit `:focus-visible` outline.
* Links, buttons, form controls, and other allowed content retain their native behavior.

No element receives `autofocus`; projects should not automatically focus destructive or surprising actions.

## Focus restoration

Native modal closing is expected to restore focus to the invoking control in supported browsers. Teelya does not maintain a parallel opener registry or force focus movement. Derived projects must runtime-test any supported browser with a demonstrated native focus-restoration defect before adding a scoped workaround.

## Progressive enhancement and no-JavaScript behavior

Dialog content exists in the server-rendered HTML, but a closed `<dialog>` is not interactively available without a successful `showModal()` call. Therefore, Teelya does not claim that modal interaction works without JavaScript.

Triggers remain hidden when JavaScript or the native Dialog API is unavailable. Essential content or workflows require an ordinary fallback link to an equivalent page or endpoint. The component does not duplicate arbitrary Dialog content into a fallback container.

## CSS and responsive behavior

The scoped stylesheet provides a neutral content-width boundary, viewport-relative maximum block size, internal overflow, logical spacing, border, radius, close-control treatment, and native `::backdrop` presentation.

Long content scrolls inside the Dialog without JavaScript measurement. There are no fixed heights, breakpoint scripts, layout observers, transitions, or animations.

## JavaScript

The deferred vanilla script:

1. verifies native `HTMLDialogElement.prototype.showModal` support;
2. finds server-rendered `button[type="button"][data-tly-dialog-open]` controls;
3. resolves each ID with `getElementById()`;
4. verifies that the target is a Teelya `<dialog>`;
5. reveals only valid triggers;
6. calls `showModal()` when a valid trigger is activated.

Missing and invalid targets remain hidden and do not throw errors. JavaScript does not construct content, manage a focus trap, handle Escape, close the Dialog, dismiss the backdrop, or maintain global modal state.

## Multiple dialogs and triggers

Multiple Dialogs may appear on a page when every ID is unique. Each trigger opens only its referenced Dialog, and multiple triggers can reference one Dialog. Asset handles ensure CSS and JavaScript are emitted only once.

Nested modal Dialogs are intentionally unsupported.

## Forms

Formatted content may contain forms and standard controls allowed by the Dialog content allowlist. The native close form is closed before the content wrapper, so it does not wrap or interfere with content forms. Dialog does not create nonces or change validation, submit behavior, WooCommerce form state, or WordPress form processing; callers remain responsible for normal form security and processing.

## Assets

Rendering at least one valid Dialog calls `venix_concierge_enqueue_component( 'dialog' )`, loading:

```text
assets/css/components/dialog.css
assets/js/components/dialog.js
```

Both assets are absent when no valid Dialog renders. Multiple instances do not duplicate requests. The script uses Teelya's existing deferred, footer-loading convention.

## Dependencies

* Native HTML `<dialog>` and Dialog API support
* WordPress escaping and internationalization functions
* Teelya's component asset loader and design tokens
* No other Teelya component
* No third-party dependency

## Popup-system boundary

Dialog does not own automatic opening, timers, scroll or exit-intent triggers, cookies, frequency caps, campaign targeting, analytics, remote content, or lead-capture business logic. Those concerns belong in a derived project or plugin.

## Known limitations

* Modal interaction requires JavaScript and native Dialog API support.
* Essential workflows require a separate fallback destination.
* Caller-provided IDs must be unique; the component cannot detect duplicate IDs across independent template-part calls without introducing global state.
* Backdrop-click dismissal and non-modal operation are not supported.
* Nested modal Dialogs are unsupported.
* Triggers inserted after `DOMContentLoaded` are not discovered; the component intentionally adds no DOM observer.
* Native focus behavior and visual presentation can vary slightly between browsers and require representative browser testing before Stable promotion.
