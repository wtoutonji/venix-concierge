# Venix Design Foundation Map

## Sources reviewed

`README.md`, `COMPLETION-REPORT.md`, `MIGRATION-MAP.md`, `styles.css`, all
eight `tokens/*.css` files, `index.js`, and the Button, Card, Badge, and Input
reference contracts/specimens under `components/core/`.

## WordPress mappings

- Palette presets map the 14 approved primitive colours: brand burgundy/deep
  wine/merlot/ink, gold, ivory/champagne/taupe, blush 50/100/200, white, black,
  and danger. Their `--wp--preset--color--*` variables are the production
  primitive source.
- Font-family presets `cinzel`, `montserrat`, and `noto-sans-arabic` use the
  supplied local variable fonts. Font-size presets `xs` through `6-xl` map the
  approved 11–90px scale. Layout maps reading/content to 640px and wide to
  1280px; the retained `tly` wide primitive maps to the approved 1440px width.
- Spacing presets map the entire 4px scale plus 100px/60px section rhythm and
  48px/24px gutters. Shadow presets map subtle, card, and modal shadows.
- WordPress has no useful native presets for roles, radii, motion, tracking,
  or breakpoints, so those remain minimal CSS contracts.

## Semantic and responsive layer

`assets/css/tokens.css` defines `--venix-*` semantic aliases from WordPress
presets, with only approved radii, transition values, breakpoint values, and
inverse-border alpha retained as production-only contracts. The existing
`tly-*` runtime aliases remain intact and now resolve to the Venix foundation.

Breakpoints are preserved as 480, 768, 1024, 1280, and 1440px. The global
foundation uses 768px for the approved compact gutter/section transition.
The inherited mobile header still uses its 860px structural breakpoint; it is
documented as an existing runtime interaction and was not expanded.

## Fonts, components, and behaviour

- Production local fonts: `assets/fonts/Cinzel-VariableFont_wght.woff2`
  (400–900), `Montserrat-VariableFont_wght.woff2` (100–900), and
  `NotoSansArabic-VariableFont_wdth,wght.woff2` (100–900).
- Production components: `template-parts/components/{button,badge,card,input}`
  with scoped styles in `assets/css/components/`. Card extends the inherited
  `card.css` contract.
- `base.css` applies typography, surfaces, links, focus, selection, Arabic/RTL
  type rules, and directional-icon mirroring. Reduced motion is behavioural in
  the inherited reset (`scroll-behavior`) and component transitions are concise;
  no canonical durations are mutated.

## Deferred and intentionally unmapped

No production icon set, photography, font licensing documentation, Polish UI
kit/copy, or `.dc.html` page design was supplied. No replacement was invented.
Design-system previews, UI kits, reports, JSX, and internal package files are
not runtime assets. Font licensing remains a project documentation gap.

## Changed files

`theme.json`; foundation CSS; scoped Button/Badge/Card/Input CSS and template
parts; the three local WOFF2 font files; and this map. Inherited runtime CSS
now resolves colour roles through Venix semantic aliases and 16/24/32px gaps
through the matching `4`/`6`/`8` Venix spacing presets. No Design System source
file, Agency Framework, or Hybrid Starter file was modified.
