# Performance Standard

Performance is an architectural requirement, not a launch-day cleanup task.

## Asset loading

- No component CSS or JS is global by default.
- Register assets centrally, enqueue them conditionally.
- Prefer block/component/template presence checks over page-ID checks where practical.
- Use `defer` for non-critical ordered scripts where safe.
- Use `async` only for independent scripts where execution order is irrelevant.
- Do not add jQuery as a theme dependency. If a plugin requires it, leave that dependency isolated to the plugin.
- Avoid frontend React runtimes for theme presentation.
- Avoid large CSS/JS frameworks unless the brief explicitly justifies them.

## UI implementation preference

1. Native HTML/CSS.
2. Small vanilla JS component.
3. Small focused library.
4. Large third-party library only when justified.

Examples:
- Accordion: `<details>/<summary>` first.
- Modal: `<dialog>` first.
- Simple horizontal gallery: CSS scroll snap first.
- Carousel: use a lightweight library only if required by the interaction.

## CSS

- Design presets and global layout sizes live canonically in `theme.json`.
- `assets/css/tokens.css` may provide semantic aliases to WordPress-generated variables and justified interaction-only tokens; it must not duplicate presets or widths.
- Keep global CSS limited to reset/base, typography, layout primitives, header/footer, and genuinely global components.
- Page and component styles belong in scoped files and load only when needed.
- No inline style attributes in production templates unless the value is truly dynamic and cannot be represented cleanly otherwise.

## Images

- Use WordPress attachment APIs and generated sizes.
- Preserve width/height attributes to reduce CLS.
- Use responsive image output (`srcset`/`sizes`) through WordPress helpers.
- Lazy-load below-the-fold images.
- Do not lazy-load the likely LCP image.
- Prefer WebP/AVIF when the hosting/image stack supports it reliably.

## Fonts

- Host fonts locally when licensing allows.
- Prefer WOFF2.
- Load only required families/weights.
- Preload only above-the-fold critical font files.
- Do not preload every font weight.

## Third-party scripts

Treat analytics, pixels, consent, embeds, maps, chat, and social scripts as performance dependencies. Load with explicit justification and consent requirements.

## Quality targets

The project should aim for stable Core Web Vitals under real mobile conditions. Never game Lighthouse by removing required functionality only for the test.
