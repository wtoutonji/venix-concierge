# Design Handoff

Approved Design System files and self-contained `.dc.html` page designs belong
under `handoff/` with approved content, assets and references.

## Two-source contract

The handoff has two complementary authorities:

**Design System** defines the visual language and shared component system:
colors, typography, spacing, layout/container presets, radii, shadows,
breakpoints and shared components.

**`.dc.html` pages** define page composition: section order, actual content
placement, component instances, media placement, responsive composition,
page-specific treatment, states and interaction intent.

Implementation flow:

`approved Design System -> README/completion report/migration map -> canonical tokens/components -> client theme.json -> WordPress preset variables -> semantic aliases -> shared production components`

then:

`approved .dc.html -> implementation map -> PHP/WordPress composition -> scoped page/section CSS -> minimal progressive JS`

Do not infer a second token system from `.dc.html`. Map its styling back to the
approved Design System whenever a canonical token/component exists.

The Design System package is handoff source only. Never ship its full `styles.css`,
previews, UI kits, reports, internal artifacts or JSX reference components in
the WordPress runtime. JSX is allowed only as reference material under
`handoff/design-system/`; `.dc.html` remains the only page-design handoff and
is allowed only under `handoff/pages/`.

Before implementing any `.dc.html`, read `docs/DC-HANDOFF.md`.
