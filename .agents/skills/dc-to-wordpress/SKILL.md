# DC to WordPress

Use in generated client projects when an approved page is supplied as a
self-contained `.dc.html` file.

Read `docs/DC-HANDOFF.md` first. The DC file is a page-design specification, not
production source.

Read the approved Design System README and completion report (plus migration map
when present) before implementation. Map its canonical tokens/components through
`theme.json`, WordPress presets and justified semantic aliases; do not derive
tokens from DC literals or ship Design System styles, previews, internals or JSX.

Map:
- semantic sections -> PHP template parts/components;
- repeated Design System patterns -> existing shared components;
- inline literal styles -> canonical `theme.json` presets/semantic aliases/scoped CSS;
- `sc-for` -> PHP loops over the correct WordPress/project/plugin data;
- language `sc-if` -> configured multilingual solution/server rendering;
- UI-state `sc-if` -> native state or minimal vanilla JS;
- `image-slot`/placeholder media -> Media Library attachments + responsive WordPress image APIs;
- `style-hover`/`style-focus` -> accessible CSS states;
- event handlers -> progressive vanilla JS only when production interaction requires it;
- prototype navigation -> WordPress menus;
- prototype product data -> WooCommerce APIs;
- prototype forms -> real form/server/plugin behavior styled by the theme;
- hardcoded internal URLs -> WordPress-generated URLs.

Never copy support scripts or custom DC runtime constructs into production just
to reproduce the prototype. Preserve visual/behavioral intent while producing
lean server-rendered WordPress markup.
