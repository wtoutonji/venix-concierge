# DC Handoff Specification

Self-contained `.dc.html` files are the canonical approved page-design handoff
format for generated client projects.

A `.dc.html` file is a **design and interaction specification**, not production
source code and not a frontend runtime requirement. Never copy its custom
runtime constructs, inline prototype behavior, placeholder data, or support
scripts directly into the production theme.

## Authority order

When sources overlap, use this order:

1. framework and project architecture documentation;
2. approved Design System;
3. approved `.dc.html` page handoff;
4. existing shared project component contracts;
5. developer inference.

Use the Design System for tokens and shared component appearance. Use `.dc.html`
for page composition, content placement, responsive composition, page-specific
visual treatment, media placement, states and interaction intent.

If the `.dc.html` contains a literal value already represented by the approved
Design System, map it to the canonical preset/token/component rather than
creating a duplicate arbitrary value.

## Required workflow

Before significant page implementation:

1. read the approved Design System and ensure the client `theme.json`, semantic
   aliases, primitives and shared components reflect it;
2. read the complete relevant `.dc.html` once;
3. create or update a concise implementation map under `handoff/generated/`;
4. classify every section, repeated item, media slot, editable value, dynamic
   source, interaction and unresolved prototype note;
5. reuse existing components before creating page-specific ones;
6. implement only the relevant page/section from the map and exact source
   region, avoiding repeated full-file rediscovery;
7. validate the rendered WordPress output against the approved handoff.

The generated implementation map is a development aid, not a design authority.
If it conflicts with the Design System or `.dc.html`, correct the map.

## Construct mapping

Interpret common Claude Design/DC constructs as follows:

| DC construct | Production WordPress interpretation |
| --- | --- |
| semantic HTML sections | PHP templates/template parts/components |
| inline `style` | Design System tokens + scoped component/page CSS |
| `style-hover` | CSS `:hover`/appropriate pointer-capable state |
| `style-focus` | accessible CSS `:focus-visible` state |
| `sc-if` for language | server-rendered multilingual solution such as Polylang |
| `sc-if` for UI state | native HTML/CSS or minimal vanilla JS as appropriate |
| `sc-for` | PHP loop over WordPress/plugin/project data |
| `image-slot` | WordPress Media Library attachment and responsive image API |
| placeholder `<img>` | approved Media Library asset; preserve frame/crop intent |
| `onClick`, `onMouseEnter`, etc. | accessible progressive enhancement only if needed |
| prototype navigation arrays | WordPress menus/navigation data |
| prototype product/fleet/service arrays | correct WP/CPT/WooCommerce/project data source |
| prototype form state/submit | production form/plugin/server behavior, styled by theme |
| hardcoded internal page URLs | WordPress-generated URLs/permalinks |
| inline SVG | preserve as accessible inline SVG or reusable icon component where appropriate |
| support/runtime scripts | do not ship unless independently required by production behavior |

Do not preserve a custom DC runtime simply to make the exported file run inside
WordPress.

## Design System mapping

The approved Design System is the source of truth for:

- colors and semantic color roles;
- font families, sizes, weights, line heights and tracking;
- spacing scale;
- layout/container widths;
- radii, borders and shadows;
- breakpoints/responsive conventions;
- buttons, form controls, cards and other shared components;
- shared interaction and state styling.

Establish the WordPress design foundation before page implementation:

`Design System -> theme.json -> WordPress preset variables -> semantic aliases -> shared components -> page CSS`

Do not reverse-engineer a second design system from repeated `.dc.html` literals.
Page-local measurements or compositions not represented by the approved system
may remain component-local when they are genuinely page-specific.

## Content and data ownership

Classify DC content before implementing it:

- flexible editorial content -> Gutenberg when appropriate;
- fixed editable copy/media in a developer-controlled layout -> approved fields/settings/content model;
- repeatable durable entities -> CPT/taxonomy/structured project data when justified;
- global company/site data -> Project Core/global settings;
- commerce data -> WooCommerce/Store Core;
- menus -> WordPress navigation;
- translations -> configured multilingual plugin;
- plugin-owned workflows -> plugin remains source of truth; theme styles presentation.

Never hardcode content into PHP only because it appears literally in `.dc.html`.

## Images and media

Preserve the approved frame geometry, aspect ratio, `object-fit`,
`object-position`, overlays and composition. Replace DC placeholders with
WordPress Media Library attachments and prefer `wp_get_attachment_image()` so
WordPress supplies intrinsic dimensions, `srcset` and responsive candidates.

Use appropriate `sizes`, loading and priority behavior. A likely LCP image may
load eagerly/high priority; below-the-fold images should normally lazy-load.
Do not convert responsive editorial images into CSS backgrounds merely because
the prototype used a background if an `<img>` is more appropriate for
performance/accessibility.

## Responsive behavior

Treat DC breakpoints and responsive states as approved design intent. Prefer CSS
media/container queries and project layout primitives over JavaScript viewport
branches. Map repeated layout concepts to inherited/shared primitives instead of
copying page-specific data attributes as a new framework unless they represent a
proven reusable contract.

## Interactions and accessibility

Preserve the user-visible interaction, not the prototype implementation.
Prefer native elements first (`details`, `dialog`, links, buttons, form controls),
then small accessible vanilla JavaScript. Keep keyboard use, focus handling,
ARIA/state synchronization, reduced motion and escape/outside-click behavior
where relevant.

Do not add React or another application runtime to reproduce DC state.

## Forms and third-party systems

A prototype form describes layout, fields, validation presentation and success
states. Production submission, anti-spam, email delivery and persistence belong
to the selected production form system or server implementation. Style the
real generated markup rather than recreating plugin logic unless the project
explicitly requires custom behavior.

Use the same principle for WooCommerce and other integrations: plugin/system
owns data and business behavior; theme owns presentation.

## Prototype-only content

Bracketed notes, placeholder text, fake testimonials, sample prices, fake order
values, placeholder media and similar design-stage material must not silently
ship. Record unresolved items in the implementation map and request/consume
approved content or production data.

## Implementation-map format

Use concise Markdown under `handoff/generated/<page>-implementation-map.md`.
Recommended sections:

- source page and status;
- Design System/shared components used;
- ordered page sections;
- media slots and intended crop/frame;
- editable content/data ownership;
- loops/dynamic sources;
- interactions and production owner;
- responsive exceptions;
- unresolved prototype notes;
- implementation files once created.

Keep maps short. They exist to avoid rereading large `.dc.html` files for every
small change.

## Completion checks

Before declaring a page complete:

- section order and visual hierarchy match the approved DC handoff;
- Design System tokens/components are reused rather than duplicated;
- no DC-only runtime tags or support scripts remain in production markup;
- content is owned by the correct WordPress/project system;
- media uses WordPress-native responsive output where appropriate;
- responsive behavior matches the handoff at representative widths;
- interactions work by keyboard and respect reduced motion;
- page/component assets load only where needed;
- validation passes and the implementation map reflects the final structure.
