# Design System Handoff

Place the approved authored design-system package here before page implementation.

This is a development/handoff source, not production runtime. A real approved
package includes at least `styles.css`, `README.md`, `COMPLETION-REPORT.md`,
`index.js`, `tokens/` and `tokens/layout.css`. When the completion report says
`Mode: REFACTOR`, include `MIGRATION-MAP.md`.

It is authoritative for colors, typography, spacing, containers/layout,
breakpoints, radii, shadows, form controls, buttons, cards and other shared
components.

Read `README.md`, `COMPLETION-REPORT.md`, and `MIGRATION-MAP.md` when present;
then map canonical tokens/components to client `theme.json`, WordPress presets,
semantic CSS aliases only where justified, and shared production components.
Do not copy/enqueue the full package `styles.css`, `preview/`, `ui_kits/`,
reports, Claude Design internal `_` artifacts, or JSX reference components into
`theme/`, `project-core/`, or `store-core/`. Page `.dc.html` files consume this
system; they must not become a second source of design tokens.
