# Components

Create small reusable theme UI components here.

Do not build a giant widget library preemptively.

Add a component only when it has complete semantic PHP markup, an accessible
interaction model where needed, scoped assets, and a documented stable
contract. Do not keep placeholder component assets in the client theme.

Components with motion must explicitly respect `prefers-reduced-motion: reduce`. Reduce or remove only motion that may cause discomfort or is unnecessary; do not indiscriminately disable all animation across the theme.

## Venix foundation contracts

- `button/button.php`: `label` with optional `url`; variants are `primary`,
  `ghost`, `gold`, `text`, and `ghost-inverse`; sizes are `sm`, `md`, and `lg`.
- `badge/badge.php`: `label`, optional gold `dot`, and the approved badge tones.
- `card/card.php`: `content`, optional title/eyebrow/rule, `surface`, `warm`,
  or `inverse` tone, and optional `elevated` state.
- `input/input.php`: labelled text, email, telephone, textarea, or select
  control with optional hint, invalid state, and required state.

Render via `get_template_part()` with an argument array. Each component
enqueues only its own stylesheet when rendered.
