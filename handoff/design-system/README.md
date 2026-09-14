# Venix Concierge — Design System

Teelya Design System Skill: `v0.0.4` · Package contract: Teelya standardized · Refactored architecture, brand identity unchanged.

Audit and migration record: `MIGRATION-MAP.md` · Package verification: `COMPLETION-REPORT.md`

## 1. Overview

**Venix Concierge** is a premium luxury lifestyle management and concierge service provider based in Poland — luxury chauffeur transportation, private air travel, hotel bookings, yacht charters, VIP event access, personal shopping, and 24/7 concierge support for high-net-worth clients.

**Brand Archetype:** Ruler
**Tagline:** OWN THE MOMENT (PL: TWÓJ MOMENT)
**Brand Essence:** Exclusive lifestyle management and personalized service for discerning individuals who expect excellence, discretion, and unforgettable experiences.
**Brand Values:** Exclusivity · Precision · Discretion · Control · Experience

## 2. Sources

Client-supplied source material actually present in this package:

| Source | File |
|---|---|
| Brand guideline sheet | `uploads/Brand_Guideline.png`, `assets/brand-guideline.png` |
| Horizontal logo (burgundy, with tagline) | `uploads/logo1.png` → `assets/logo-horizontal.png` |
| Vertical logo (icon + wordmark) | `uploads/logo2.png` → `assets/logo-vertical.png` |
| White logo variants | `uploads/logo3.png`, `uploads/logo4.png` → `assets/logo-horizontal-white.png`, `assets/logo-vertical-white.png` |
| Arabic font file | `uploads/NotoSansArabic-VariableFont_wdth,wght.ttf` → `fonts/` |

Colors, typography, casing, tone, imagery direction and logo rules all derive from the supplied brand guideline. See `COMPLETION-REPORT.md` for what was missing and what was substituted.

## 3. Capabilities

| Capability | Status |
|---|---|
| Multilingual (EN / PL / AR) | Supported — EN and AR implemented; PL copy tokens documented, no PL kit |
| RTL | Supported — Arabic RTL UI kit + RTL base rules |
| Dark mode | Not Required — the system uses fixed light and deep-wine inverse surfaces, not a user-toggled theme |
| E-commerce | Not Required |
| Motion | Supported — motion tokens + reduced-motion handling |
| Print | Supported — print-oriented UI kit variant |

## 4. Content fundamentals

**Tone & voice** — Formal, authoritative, never casual. First-person plural as the brand ("We take care of everything"), second person for the client ("You can focus on what truly matters"). Sparse copy; short declarative headlines. **No emoji, ever. No exclamation marks.**

**Casing** — Headlines ALL CAPS; subheads Title Case or ALL CAPS; body sentence case; tagline ALL CAPS with wide tracking. Arabic is never uppercased or tracked.

**Approved copy** — "OWN THE MOMENT" · "YOUR JOURNEY. OUR PRIVILEGE." · "DETAILS MAKE THE DIFFERENCE" · "BECAUSE EVERY MOMENT MATTERS" · "EXCLUSIVE. BY NATURE."

## 5. Visual foundations

### Color
| Name | Hex | Token | Role |
|---|---|---|---|
| Burgundy | `#7A1322` | `--t-color-brand-500` | Primary brand, headlines on light |
| Deep Wine | `#5A0E1A` | `--t-color-brand-700` | Hover, dark hero grounds |
| Merlot | `#3D0910` | `--t-color-brand-900` | Pressed state |
| Brand Ink | `#2C1A1D` | `--t-color-brand-ink` | Body copy |
| Gold | `#C9A75E` | `--t-color-accent-500` | Accent only, sparingly |
| Ivory | `#FAFBF9` | `--t-color-warm-100` | Page ground |
| Champagne | `#E6D8C7` | `--t-color-warm-200` | Warm surfaces |
| Taupe | `#C8B6A6` | `--t-color-warm-300` | Muted text, hairlines |
| Blush neutrals | `#FBF5F6` `#F6ECEF` `#EDE6E8` | `--t-color-neutral-50/100/200` | Card surfaces, tints, dividers |
| Error red | `#C0392B` | `--t-color-danger-500` | Form error state only — not a brand color |
| White / Black | `#FFFFFF` `#0D0D0D` | `--t-color-neutral-0` / `-1000` | Absolutes |

Semantic roles sit on top of these primitives: `--t-bg-*`, `--t-fg-*`, `--t-border-*`, `--t-interactive-*`, plus `--t-fg-danger` / `--t-border-danger` / `--t-border-focus`. Components and specimen cards consume the semantic layer — no file hard-codes a brand value.

### Typography
- **Display / headlines:** Cinzel (local variable file) — `--t-font-display`
- **Body / UI:** Montserrat (local variable file) — `--t-font-body`
- **Arabic (display and body):** Noto Sans Arabic (local variable file) — `--t-font-arabic`
- Latin headline tracking is wide (`--t-ls-display` 0.28em → `--t-ls-subhead` 0.12em); Arabic tracking is 0.
- Control tracking: `--t-ls-button` 0.22em (buttons, Cinzel), `--t-ls-tag` 0.16em (badges, tags).
- Scale: `--t-fs-xs` 11px → `--t-fs-6xl` 90px. Weights 300–700 (Cinzel's axis is 400–900).
- Type is Burgundy on light grounds, Ivory/Champagne on deep wine.

### Spacing
4px base scale `--t-space-1` … `--t-space-32` (128px), plus section rhythm `--t-space-section` 100px / `--t-space-section-sm` 60px. Luxury brands breathe — prefer the larger step.

### Shape
Minimal radius by intent: `--t-radius-sm` 2px (inputs, tags), `--t-radius-card` 3px (cards), `--t-radius-md` 4px (general surfaces), `--t-radius-button` 6px (buttons — refined precision, never pill), `--t-radius-lg` 8px (media only). Hairlines are 1px.

### Motion
Deliberate and unhurried: `--t-motion-duration-fast` 150ms, `-base` 250ms, `-slow` 400ms, `-reveal` 600ms; `--t-motion-ease-standard` ease-in-out, `--t-motion-ease-emphasized` for section reveals. Nothing bouncy. The duration tokens are canonical and never redefined; `prefers-reduced-motion: reduce` neutralizes transitions and animations behaviourally instead.

### Imagery
Full-bleed, warm-graded, golden-hour editorial photography — jets, limousines, yacht decks, hotel lobbies, white-glove service. Moody and dark, never cold or blue. No stock clichés. Placeholders remain in the UI kits pending real photography.

### Layout
Container `--t-layout-container` 1280px (wide 1440px), reading width 640px, gutters 48px / 24px below `md`. Brand pattern: 45° repeating hairlines at 12% opacity — burgundy on light, gold on dark; used subtly, never dominant.

## 6. Responsive system

Canonical, client-approved breakpoints — declared once in `tokens/layout.css` and used everywhere:

| Name | Token | Value |
|---|---|---|
| sm | `--t-layout-bp-sm` | 480px |
| md | `--t-layout-bp-md` | 768px |
| lg | `--t-layout-bp-lg` | 1024px |
| xl | `--t-layout-bp-xl` | 1280px |
| 2xl | `--t-layout-bp-2xl` | 1440px |

These govern grid transitions, navigation transformation, stacking, container gutters, imagery behavior, and future `.dc.html` page composition. No component declares an unrelated breakpoint system.

## 7. Iconography

Minimal, elegant, thin consistent stroke, slightly rounded caps. Monochrome Burgundy on light, Ivory on dark. 24–32px in UI, 48–64px in feature blocks. Categories: Air Travel, Hotel, Transport, Yachts, Experiences, Events, Shopping, VIP Access, Security, 24/7 Support. No icon font, no emoji.

**Substitution:** no original icon set was supplied. Lucide (CDN) is used in `preview/icons.html` as the closest match and is a placeholder — request the production SVG set. Directional icons mirror under `dir="rtl"` via the `.icon-directional` hook in `tokens/base.css`.

## 8. Component index

Public, reusable components (`components/core/`, exported from `index.js`):

| Component | Files | Purpose |
|---|---|---|
| `Button` | `.jsx` `.d.ts` `.prompt.md` | Primary / ghost / gold / text / ghost-inverse, 3 sizes |
| `Card` | `.jsx` `.d.ts` `.prompt.md` | Surface / warm / inverse content card |
| `Badge` | `.jsx` `.d.ts` `.prompt.md` | Service tag and status label |
| `Input` | `.jsx` `.d.ts` `.prompt.md` | Text input, select, textarea with label/hint/error |

Page heroes, service grids, process bands, contact blocks and footers remain **page composition** in the UI kits — they are not promoted to the core library.

## 9. Token index

`styles.css` is the single authored global entry point; it imports only the files below.

| File | Owns |
|---|---|
| `tokens/fonts.css` | `@font-face` for Cinzel, Montserrat, Noto Sans Arabic |
| `tokens/colors.css` | `--t-color-*` primitives; `--t-bg-*`, `--t-fg-*`, `--t-border-*`, `--t-interactive-*` semantics |
| `tokens/typography.css` | `--t-font-*`, `--t-fs-*`, `--t-fw-*`, `--t-lh-*`, `--t-ls-*`, Arabic script variants |
| `tokens/spacing.css` | `--t-space-*` |
| `tokens/layout.css` | `--t-layout-bp-*`, container/reading/gutter, `--t-z-*`, `.t-container` |
| `tokens/effects.css` | `--t-radius-*`, `--t-shadow-*`, border widths |
| `tokens/motion.css` | `--t-motion-*` durations, easings, transitions; behavioural reduced-motion rule |
| `tokens/base.css` | Global resets, link colors, canonical type classes, decorative rules, RTL/Arabic rules |

All authored custom properties follow `--t-<category>-<role>[-<variant>][-<state>]` — 126 tokens. The pre-Teelya `colors_and_type.css` has been retired; no second token system remains, and the specimen cards no longer duplicate values. See `MIGRATION-MAP.md` for the full audit and value-by-value migration record.

## 10. Asset locations

```
assets/logo-horizontal.png         burgundy horizontal + tagline — light grounds only
assets/logo-vertical.png           burgundy stacked — light grounds only
assets/logo-horizontal-white.png   white horizontal — nav, footer, dark grounds
assets/logo-vertical-white.png     white stacked / brand mark — dark grounds
assets/brand-guideline.png         supplied guideline reference sheet
fonts/                             Cinzel, Montserrat, Noto Sans Arabic variable .ttf
```

**Logo rules** — never burgundy on dark, never white on light. The V wing mark (from the vertical logo) may stand alone as favicon, watermark (5–8% opacity) or large decorative graphic. Minimum clear space equals the height of the V. Never rotate, recolor, stretch, or add effects.

## 11. UI kits / reference material

```
ui_kits/website/index.html         English website UI kit (reference composition)
ui_kits/website/index-ar.html      Arabic RTL mirror
ui_kits/website/index-print.html   print-oriented variant
preview/                           specimen cards — color, type, spacing, shadows, logo, icons
components/core/*.html             component specimen cards
thumbnail.html                     design system tile
```

All of these consume `styles.css` and reference `--t-*` tokens; none redefines fonts, colors, radii, shadows, tracking, or motion locally. Only visible swatch labels, inline-SVG presentation attributes, and specimen-local card sizing remain literal (documented in `MIGRATION-MAP.md` §3).

## 12. Development handoff

1. Link `styles.css` (one file, imports the token modules).
2. Use semantic tokens, not raw hex — `var(--t-fg-brand)`, not `#7A1322`.
3. Use the canonical type classes (`.h1`, `.body`, `.label`) or the `--t-fs-*`/`--t-ls-*` tokens directly.
4. Media queries use the approved breakpoint values above.
5. Arabic pages set `lang="ar" dir="rtl"`; the base layer handles font, leading, tracking and casing. Use logical properties (`margin-inline`, `padding-inline`).
6. React reference components live in `components/core/` and are exported from `index.js`. WordPress/PHP implementations may reimplement them with semantic HTML + the same tokens — React is not required downstream.
7. Page designs are authored as self-contained `.dc.html`; JSX is not the page handoff.

## 13. Known substitutions

- **Arabic display font** — the brand documentation referenced *Noto Serif Arabic* for Arabic headlines, but only *Noto Sans Arabic* was supplied. Arabic display and body both use Noto Sans Arabic (display at weight 700). Documented in `COMPLETION-REPORT.md`.
- **Icons** — Lucide (CDN) stands in for the unsupplied production icon set.
- **Photography** — placeholder areas only; no licensed imagery supplied.

## 14. Known gaps

- No production SVG icon set.
- No photography assets.
- No Polish UI kit (Polish copy direction documented only).
- No `.dc.html` page artifacts exist in this package yet.
- Claude Design "starting point" registration did not take effect from `.d.ts` `@startingPoint` tags — see `COMPLETION-REPORT.md`.
- Gold surfaces carry ivory text in the approved brand treatment (≈1.8:1). Preserved as authoritative; flagged for client decision in `COMPLETION-REPORT.md`.
