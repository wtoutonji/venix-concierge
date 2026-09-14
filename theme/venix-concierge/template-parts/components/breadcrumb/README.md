# Breadcrumb

## Purpose

Render a server-generated breadcrumb trail for common WordPress request contexts without owning content models or business logic.

## Category and lifecycle

* Category: Structural
* Status: Experimental

The API is available for controlled v1.1 use and may be refined before the component becomes Stable.

## Markup

The component renders a labelled `<nav>` containing an ordered list. The final item is plain text with `aria-current="page"`; it is never rendered as a link. Trails with fewer than two valid items render nothing.

## Arguments

| Argument | Type | Default | Description |
| --- | --- | --- | --- |
| `items` | `array[]` | `venix_concierge_get_breadcrumb_items()` | Ordered items with a required `label` and optional `url`. The last item's URL is ignored. |
| `aria_label` | `string` | Translated `Breadcrumb` | Accessible navigation landmark label. |

## Usage

Use the current WordPress request context:

```php
get_template_part( 'template-parts/components/breadcrumb/breadcrumb' );
```

Provide an explicit trail:

```php
get_template_part(
	'template-parts/components/breadcrumb/breadcrumb',
	null,
	array(
		'items' => array(
			array(
				'label' => __( 'Home', 'venix-concierge' ),
				'url'   => home_url( '/' ),
			),
			array(
				'label' => __( 'Current section', 'venix-concierge' ),
			),
		),
	)
);
```

Projects may adjust an automatically generated trail without changing the component:

```php
add_filter(
	'venix_concierge_breadcrumb_items',
	function ( $items ) {
		return $items;
	}
);
```

## Accessibility

* Native navigation and list semantics communicate structure without redundant ARIA roles.
* The translated `aria-label` gives the navigation landmark an accessible name.
* The current item is not interactive and uses `aria-current="page"`.
* Links retain native keyboard and focus behavior.
* Visual separators must remain decorative if a derived project adds them.

## Assets

Breadcrumb has no component CSS or JavaScript. It adds no frontend requests, has no motion, and works without JavaScript. The `tly-breadcrumb` classes provide stable styling hooks for derived themes; any downstream stylesheet must follow Teelya's conditional component-loading rules and design-token hierarchy.

## Dependencies

* WordPress template and conditional APIs
* Teelya's `inc/template-tags.php`
* No other Teelya component
* No third-party dependency

## Supported contexts

The default item builder supports:

* posts index;
* hierarchical pages;
* singular posts and public custom post types with archives;
* category, tag, and custom taxonomy archives;
* post type archives;
* author archives;
* year, month, and day archives;
* search results;
* 404 requests;
* paginated variants of those contexts.

The site front page intentionally renders no breadcrumb. Generic custom contexts can supply `items` directly or use the `venix_concierge_breadcrumb_items` filter.

## Examples

```text
Home > Parent page > Current page
Home > Products > Current product
Home > Search results for: query
```

Separators are illustrative only and are not part of the semantic text output.

## Known limitations

* WordPress core does not define a primary taxonomy term, so singular posts do not infer a category trail.
* Plugin-specific virtual endpoints may need explicit items or a filtered trail.
* The component intentionally provides no visual separator or layout CSS.
