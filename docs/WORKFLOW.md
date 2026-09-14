# Design -> WordPress Workflow

## 1. Configure the project and collect input

Configure `PROJECT-ENV.md`, complete `PROJECT-BRIEF.md`, and place approved
Design System, `.dc.html` pages, content, assets and references under `handoff/`.

## 2. Establish the design foundation

Before page implementation:
- read the approved Design System `README.md`, `COMPLETION-REPORT.md`, and migration map when present;
- map canonical tokens/components into the client `theme.json` and WordPress presets;
- create semantic aliases only where useful beyond WordPress presets;
- implement/reuse shared layout primitives and shared components;
- do not derive duplicate tokens from individual pages.

The Design System package is not runtime source: do not ship its complete
`styles.css`, previews, UI kits, reports, internal artifacts or JSX references.

## 3. Audit each DC page

For each approved `.dc.html`:
- read `docs/DC-HANDOFF.md`;
- inspect the complete page once;
- identify ordered sections and shared component instances;
- classify content as global, editable page content, repeatable content, commerce/system data or business logic;
- identify media slots and crop/frame intent;
- identify interactions and their production owner;
- identify DC-only runtime/support constructs that must not survive;
- identify unresolved placeholders/prototype notes;
- create/update `handoff/generated/<page>-implementation-map.md`.

## 4. Build the content/data model

Before templates, define:
- pages;
- Gutenberg vs fixed fields/settings;
- CPTs/taxonomies only where durable repeatable entities justify them;
- menu locations;
- global settings;
- multilingual ownership;
- commerce/plugin data sources when relevant.

Do not hardcode client-editable content into PHP merely because it appears in a
`.dc.html` file.

## 5. Implement shared components first

Reuse the Design System component contract. For a missing shared component:
- create semantic PHP/template-part markup;
- assign stable project classes;
- use Design System tokens/presets;
- load assets only when used;
- document the component contract.

Do not create a page-specific duplicate of an existing shared component.

## 6. Implement page composition

Use the implementation map and relevant source region:
- map DC sections to PHP template parts/components;
- replace `sc-for`/prototype arrays with the correct WordPress/project data source;
- replace language state with the configured multilingual solution;
- replace image slots/placeholders with Media Library output;
- map inline/hover/focus styles to scoped CSS and canonical tokens;
- replace viewport JavaScript layout branches with CSS where practical;
- use minimal accessible vanilla JS only for genuine interaction;
- never ship the DC support/runtime layer.

## 7. Integrate WordPress and plugins

Use WordPress APIs for menus, media, pages, queries, translations, escaping,
sanitization and options. For forms, WooCommerce and other plugin-owned flows,
keep the system/plugin as source of truth and style its real output.

## 8. Validate continuously

Run the repository validation script after meaningful changes. Test representative
desktop/tablet/mobile widths, keyboard navigation, reduced motion, empty states,
long/multilingual content, missing images and performance-sensitive media.

Use the implementation map to avoid repeatedly rereading the complete DC file
for narrow follow-up fixes.

## 9. Local -> staging -> production

Never use the AI agent to make uncontrolled production edits. The expected
pipeline is local Git working tree -> review -> commit -> staging -> QA -> production.
