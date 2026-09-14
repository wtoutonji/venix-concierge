# Accordion

## Purpose

Render a reusable disclosure group using native `<details>` and `<summary>` elements. Accordion provides a visually neutral presentation contract for structured project data without introducing client content, business logic, or custom state management.

## Category and lifecycle

* Category: Interactive
* Status: Experimental
* Introduced: Teelya 1.1.0

The API is available for controlled v1.1 use and may be refined before the component becomes Stable.

## Native HTML behavior

Each valid item renders as an independent `<details>` disclosure whose `<summary>` is its native control. Multiple items may remain open simultaneously. The browser owns toggling, expanded state, keyboard behavior, and focus; Teelya does not duplicate that behavior with ARIA or JavaScript.

The component renders nothing when `items` is absent, is not an array, or contains no valid items.

## API and defaults

| Argument | Type | Default | Description |
| --- | --- | --- | --- |
| `items` | `array[]` | `array()` | Ordered collection of Accordion items. Invalid items are omitted. |

No component label is accepted because the neutral wrapper is not a landmark and does not require an accessible name.

## Item schema

| Key | Type | Required | Default | Description |
| --- | --- | --- | --- | --- |
| `title` | `string` | Yes | None | Plain-text disclosure label. HTML is stripped and the value must not be empty. |
| `content` | `string` | Yes | None | Trusted formatted WordPress content rendered through `wp_kses_post()`. |
| `open` | `bool` | No | `false` | Adds the native `open` attribute when strictly `true`. |

The component does not apply `the_content` filters. Callers that need block rendering, shortcodes, embeds, or automatic paragraphs must prepare that content before passing it to this presentation component.

## Usage

```php
get_template_part(
	'template-parts/components/accordion/accordion',
	null,
	array(
		'items' => array(
			array(
				'title'   => __( 'What is included?', 'venix-concierge' ),
				'content' => '<p>' . esc_html__( 'The answer can contain safe formatted content.', 'venix-concierge' ) . '</p>',
				'open'    => true,
			),
			array(
				'title'   => __( 'Can several items remain open?', 'venix-concierge' ),
				'content' => '<p>' . esc_html__( 'Yes. Each disclosure remains independent.', 'venix-concierge' ) . '</p>',
			),
		),
	)
);
```

User-visible strings belong to the caller and must use the caller's appropriate text domain. The sample uses Teelya strings only for illustration.

## Markup

```html
<div class="tly-accordion">
	<details class="tly-accordion__item">
		<summary class="tly-accordion__summary">
			<span class="tly-accordion__title">Question</span>
		</summary>
		<div class="tly-accordion__content">
			<p>Answer</p>
		</div>
	</details>
</div>
```

The wrapper and content `<div>` elements provide stable component styling hooks. No heading level, landmark, ID, or ARIA relationship is imposed.

## Accessibility and keyboard behavior

* `<details>` and `<summary>` expose native disclosure semantics and state.
* The summary remains the native focusable control; no `role="button"` or duplicate `aria-expanded` state is added.
* Enter and Space toggle the focused summary according to browser behavior.
* Links, buttons, lists, and other allowed content inside an open answer retain their native semantics and keyboard behavior.
* The stylesheet supplies an explicit `:focus-visible` outline without removing the browser's normal fallback focus treatment.
* Content remains present and understandable if component CSS does not load.

## Focus behavior

Opening or closing an item does not move focus. Accordion does not trap focus or restore it because the native summary remains in the document and retains focus during disclosure changes.

## Reduced motion

Accordion adds no animation or transition. Its behavior does not depend on motion, so no component-specific reduced-motion override is necessary.

## Responsive behavior

The component has no fixed inline dimensions or breakpoint rules. Titles and formatted content use normal document flow and can wrap at narrow widths. Client content containing fixed-width descendants remains the caller's responsibility.

## Assets

Rendering at least one valid item calls `venix_concierge_enqueue_component( 'accordion' )`, which loads:

```text
assets/css/components/accordion.css
```

The stylesheet is not requested when the component is absent or has no valid items. No Accordion JavaScript file exists, and no script or third-party dependency is loaded.

## Dependencies

* Native HTML `<details>` and `<summary>` behavior
* WordPress escaping functions
* Teelya's component asset loader
* Teelya design tokens and global layout stylesheet
* No other Teelya component
* No third-party dependency

## Extension points

Accordion adds no Teelya-specific filters. Projects can prepare or filter their item data before calling the template part without depending on component markup internals.

## Known limitations

* The default behavior permits multiple open items. Single-open synchronization is intentionally outside this component's contract.
* Native marker appearance and disclosure behavior can vary slightly between browsers.
* The component does not apply WordPress content filters or create a Gutenberg editing interface.
* Nested Accordions are not prohibited, but derived projects must verify that the resulting interaction and content hierarchy remain understandable.
