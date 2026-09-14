# Generated client project

This is an independent client project generated from the Teelya WordPress
Agency Framework. It is not the Teelya master repository.

## Mission

Implement the approved client design, content model and functionality while
preserving the inherited Hybrid WordPress architecture. Client-specific design
and content are expected here.

## Architecture

- PHP owns structural presentation and the WordPress template hierarchy.
- Gutenberg owns appropriate editable content, not global site structure.
- The client `theme.json` is canonical for brand and editor presets.
- The theme owns presentation, CSS and progressively enhanced UI JavaScript.
- `project-core` owns durable content models and non-commerce business logic.
- `store-core`, when present, owns durable WooCommerce behavior.
- Approved page designs are self-contained `.dc.html` handoffs, not production runtime files.
- Do not create structural `templates/*.html` files or add a frontend application runtime to reproduce DC behavior.

Stable inherited `tly-*` CSS primitive contracts retain their Teelya prefix.
Client PHP symbols, hooks, text domains and asset handles follow the identity
map in `project.json`.

## Required context

Before significant implementation, read `README.md`, `PROJECT-BRIEF.md`,
`project.json`, `docs/ARCHITECTURE.md`, `docs/WORKFLOW.md`,
`docs/PERFORMANCE.md`, `docs/LOCALWP.md`, and the relevant `handoff/` files.
Read `docs/WOOCOMMERCE.md` only when that generated file exists.
When implementing approved page designs, also read `docs/DESIGN-HANDOFF.md` and
`docs/DC-HANDOFF.md`; read the Design System README, completion report and
migration map when present. It is handoff source: map canonical tokens/components
to `theme.json`, WordPress presets, semantic aliases and shared production
components; never ship its full styles, previews, reports, internals or JSX.
`.dc.html` owns page composition and JSX is reference-only under `handoff/design-system/`.

## LocalWP safety

Read `PROJECT-ENV.md`. Before any WP-CLI mutation, use its `WP_ROOT`, run
`wp option get home`, and verify the result exactly matches `LOCAL_URL`.
Never assume a LocalWP or PHP path.

## Implementation rules

- Follow WordPress Coding Standards; escape output and sanitize input.
- Use project presets and semantic aliases before adding arbitrary values.
- Prefer native HTML/CSS, then small accessible vanilla JavaScript.
- Load component assets only when their component is used.
- Keep permanent CPTs, taxonomies, schemas and business rules out of the theme.
- Block curation must preserve `false`, intersect incoming arrays, and preserve
  the incoming WooCommerce Product policy by default.

## Completion

Run `scripts/validate.ps1` and report every PASS, FAIL and SKIPPED stage. Review
`git diff --check`, responsive behavior, keyboard use, reduced motion and asset
scope before completion.

Do not modify the Teelya master or Agency Framework automatically. Record a
proven reusable discovery as an upstream candidate; backporting requires a
separate explicit task.

Use relevant client skills under `.agents/skills/`.
