# Generated Client Architecture

This is an independent client implementation derived from a pinned Teelya
runtime baseline.

## Ownership

- PHP templates own structural presentation.
- Gutenberg owns appropriate editable content inside that structure.
- Client `theme.json` owns brand/design presets and editor configuration.
- The theme owns presentation and progressively enhanced UI behavior.
- Project Core owns durable content models and non-commerce business logic.
- Store Core, when generated, owns durable WooCommerce behavior.

Do not create structural `templates/*.html` files. Do not move permanent CPTs,
schemas, integrations or commerce rules into the theme.

Stable inherited `tly-*` CSS primitive contracts remain namespaced to Teelya.
Client-owned PHP symbols, hooks, text domains and asset handles are recorded in
`project.json`.
