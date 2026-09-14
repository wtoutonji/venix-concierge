# Client Design Handoff

Use only in generated client projects.

Inputs are the approved Design System, self-contained `.dc.html` pages, content,
media and references.

Workflow:
1. read the approved Design System and establish/verify `theme.json`, semantic aliases and shared components;
2. read `docs/DC-HANDOFF.md` before implementing a DC page;
3. inspect the complete relevant `.dc.html` once and create/update its concise implementation map under `handoff/generated/`;
4. classify presentation, client-editable content, structured data, global options, media, plugin/WooCommerce data and business logic;
5. map DC styling to existing Design System presets/components instead of creating duplicate literal values;
6. map sections/repetition/state/media/navigation/forms to the correct PHP/WordPress/plugin implementation;
7. prefer CSS for responsive composition and native HTML/CSS before minimal accessible vanilla JavaScript;
8. use WordPress Media Library responsive APIs rather than prototype image/runtime slots;
9. record unresolved placeholder/prototype content instead of silently shipping it;
10. validate rendered output against the approved page design.

Do not ship a DC runtime or modify the master Teelya framework while implementing a client.
