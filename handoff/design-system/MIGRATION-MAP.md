# MIGRATION MAP — Venix Concierge Design System

Teelya Design System Skill `v0.0.4` · Mode: **REFACTOR** · Date: 2026-09-14 · Contract: Teelya v0.0.4 validation contract

Existing Venix values and visual identity treated as authoritative. No brand redesign. This map records every structural change made and every value's origin and destination.

---

## 1. Read-only audit findings (pre-refactor state)

| # | Finding | Severity | Resolution |
|---|---|---|---|
| A1 | 11 `preview/*.html` specimen cards hard-coded brand hexes, font stacks, radii, shadows and tracking despite linking `styles.css` — a duplicated second source of truth | High | Normalized onto `--t-*` tokens |
| A2 | 4 `components/core/*.html` specimen cards likewise hard-coded values | High | Normalized onto `--t-*` tokens |
| A3 | Component specimens and `.jsx` contracts disagreed: buttons Cinzel/0.22em (specimen, UI kit) vs Montserrat/0.06em (`Button.jsx`) | High | `.jsx` reconciled to the approved specimen appearance |
| A4 | Badge specimen exposed 6 tones (primary, outline, gold, neutral, dark, muted); `Badge.jsx` exposed 5 different ones | Medium | `Badge.jsx` + `.d.ts` extended to the approved 6 + 2 inverse/warm |
| A5 | Card specimen used a gold hairline and 3px radius; `Card.jsx` had no rule and 4px radius | Medium | `rule` prop added; `--t-radius-card` 3px introduced |
| A6 | Input error color `#C0392B` existed in the approved specimen but was outside the token system (unmanaged); `Input.jsx` reused burgundy, making error indistinguishable from focus | High | Existing value promoted to `--t-color-danger-500`; `--t-fg-danger`/`--t-border-danger`/`--t-border-focus` added |
| A7 | `tokens/motion.css` redefined the canonical durations to `1ms` inside `@media (prefers-reduced-motion)` — mutating canonical tokens | High | Token redefinition removed; reduced-motion now behavioural only |
| A8 | `@font-face` declared Cinzel `font-weight: 100 900`, wider than the file's real 400–900 axis | Low | Corrected to `400 900` |
| A9 | Ghost-on-dark border alpha differed between specimen (0.5) and token (0.35) | Low | Normalized to the canonical `--t-border-on-inverse` (0.35) |
| A10 | Specimen transitions used `250ms ease`; canonical easing is `ease-in-out` | Low | Normalized to `--t-motion-transition-base` |
| A11 | Gold surfaces carry ivory text (≈1.8:1) in the approved brand treatment | Medium | **Preserved** as approved; recorded as a conflict for client decision |
| A12 | `@startingPoint` `.d.ts` annotations not registered by Claude Design | Medium | Left to native mechanism; documented |

Unchanged and re-verified as authoritative: all 13 brand colors, the three font families, the 4px spacing scale, section rhythm, the five approved breakpoints, radius character, shadow character, motion durations, logo rules, RTL/Arabic behavior, UI kit composition.

---

## 2. Token additions (this refactor)

All are promotions of values that already existed in approved artifacts. No new brand color, font, size, or spacing step was invented.

| New token | Value | Origin | File |
|---|---|---|---|
| `--t-color-danger-500` | `#C0392B` | Existing approved input-error red, previously unmanaged (A6) | `tokens/colors.css` |
| `--t-fg-danger` | → `--t-color-danger-500` | Semantic layer for A6 | `tokens/colors.css` |
| `--t-border-danger` | → `--t-color-danger-500` | Semantic layer for A6 | `tokens/colors.css` |
| `--t-border-focus` | → `--t-color-brand-500` | Existing focused-input border in the specimen | `tokens/colors.css` |
| `--t-ls-button` | `0.22em` | Existing button tracking in specimen + UI kit (A3) | `tokens/typography.css` |
| `--t-ls-tag` | `0.16em` | Existing badge/tag tracking in specimen (A4) | `tokens/typography.css` |
| `--t-radius-card` | `3px` | Existing card radius in specimen (A5) | `tokens/effects.css` |

Token count: 119 → 126. No token was removed, renamed, or revalued.

---

## 3. Value → token normalization applied to specimen files

Applied to all 11 `preview/*.html` and all 4 `components/core/*.html` cards.

| Hard-coded | Token |
|---|---|
| `#7A1322` `#5A0E1A` `#3D0910` `#2C1A1D` | `--t-color-brand-500 / -700 / -900 / -ink` |
| `#C9A75E` | `--t-color-accent-500` |
| `#FAFBF9` `#E6D8C7` `#C8B6A6` | `--t-color-warm-100 / -200 / -300` |
| `#FBF5F6` `#F6ECEF` `#EDE6E8` `#FFFFFF` `#0D0D0D` | `--t-color-neutral-50 / -100 / -200 / -0 / -1000` |
| `#C0392B` | `--t-color-danger-500` → `--t-border-danger` / `--t-fg-danger` |
| `'Cinzel', serif` | `--t-font-display` |
| `'Montserrat', sans-serif` | `--t-font-body` |
| `'Noto Sans Arabic', sans-serif` | `--t-font-arabic` |
| `0 2px 16px rgba(90,14,26,0.06)` | `--t-shadow-card` |
| `0 1px 4px rgba(90,14,26,0.04)` / `0 8px 40px rgba(90,14,26,0.14)` | `--t-shadow-subtle` / `--t-shadow-modal` |
| `rgba(250,251,249,0.5)` / `0.35` | `--t-border-on-inverse` |
| `border-radius: 2px / 3px / 4px / 6px / 8px` | `--t-radius-sm / -card / -md / -button / -lg` |
| `letter-spacing: 0.28 / 0.22 / 0.18 / 0.16 / 0.12 / 0.06 / 0.02em` | `--t-ls-display / -button / -headline / -tag / -subhead / -ui / -body` |
| `font-weight: 300 / 400 / 500 / 600 / 700` | `--t-fw-light / -regular / -medium / -semibold / -bold` |
| `transition: … 250ms ease` | `--t-motion-transition-base` |

**Deliberately left literal:** hex strings shown as visible swatch labels (they document the value); hexes inside inline SVG `stroke`/`fill` attributes (CSS variables do not resolve in the presentation attributes used here); and the small 8–12px specimen-local font sizes and card paddings, which exist to fit the `@dsCard` viewport and are not brand type-scale or spacing decisions.

Verification: a scan of `preview/`, `components/`, `ui_kits/`, `tokens/`, `styles.css` and `thumbnail.html` finds **zero** non-`--t-` authored custom properties and zero hard-coded brand hexes in style positions.

---

## 4. Component contract reconciliation

| Component | Specimen (authoritative appearance) | `.jsx` before | `.jsx` after |
|---|---|---|---|
| Button | Cinzel, `0.22em`, uppercase, 6px radius; `text` variant Montserrat `0.16em`; gold = ivory on gold | Montserrat, `--t-ls-ui`; gold = wine on gold | `--t-font-display` + `--t-ls-button`; `text` → `--t-font-body` + `--t-ls-tag`; gold = `--t-fg-inverse` |
| Badge | 6 tones: primary, outline, gold, neutral, dark, muted; `0.16em`; 5px gold dot | 5 tones; `--t-ls-ui`; 4px dot | 8 tones (approved 6 + `warm`, `inverse`); `--t-ls-tag`; 5px dot |
| Card | 3px radius, gold hairline, `--t-lh-normal` body, taupe body on dark | 4px radius, no rule, `--t-lh-relaxed` | `--t-radius-card`, `rule` prop, `--t-lh-normal`, `--t-fg-muted` on inverse |
| Input | `--t-border-subtle` idle, burgundy focus, `#C0392B` error | `--t-border-muted` idle, burgundy error | `--t-border-subtle` idle, `--t-border-focus`, `--t-border-danger` / `--t-fg-danger` |

`.d.ts` and `.prompt.md` were updated in step with each `.jsx`. Triads remain complete; `index.js` exports are unchanged.

---

## 5. Reduced-motion correction (A7)

Before — canonical tokens were overwritten:
```css
@media (prefers-reduced-motion:reduce){ :root{ --t-motion-duration-base:1ms; … } }
```

After — durations stay 150 / 250 / 400 / 600ms at all times; reduced motion is applied behaviourally:
```css
@media (prefers-reduced-motion:reduce){
  *,*::before,*::after{animation-duration:0.01ms!important;animation-iteration-count:1!important;
  transition-duration:0.01ms!important;transition-delay:0s!important;animation-delay:0s!important;scroll-behavior:auto!important}
}
```

---

## 6. Files touched

**Modified:** `tokens/colors.css`, `tokens/typography.css`, `tokens/effects.css`, `tokens/fonts.css`, `tokens/motion.css`, all 11 `preview/*.html`, all 4 `components/core/*.html`, all 4 `.jsx`, `Badge.d.ts`, `Card.d.ts`, all 4 `.prompt.md`, `README.md`.
**Created:** `MIGRATION-MAP.md`, `COMPLETION-REPORT.md` (regenerated).
**Untouched:** `styles.css` (import list unchanged), `tokens/spacing.css`, `tokens/layout.css`, `tokens/base.css`, `index.js`, all three `ui_kits/website/*.html`, `assets/`, `fonts/`, `uploads/`, `SKILL.md`, `thumbnail.html`.
**Claude Design-owned, never hand-edited:** `_ds_manifest.json`, `_ds_bundle.js`, `_adherence.oxlintrc.json`.

No `.dc.html` page artifacts exist, so no page required token updates. No JSX was introduced into the page handoff; self-contained `.dc.html` remains the canonical page-design handoff.

---

## 7. v0.0.4 compliance correction pass (addendum)

| # | Item | Action | Visual effect |
|---|---|---|---|
| B1 | Package contract references read `v0.0.3` | Bumped to `v0.0.4` in `SKILL.md`, `README.md`, `MIGRATION-MAP.md`, `COMPLETION-REPORT.md`; `SKILL.md` now states the v0.0.4 validation contract explicitly | none |
| B2 | `#C9A75E` literal in the 45° brand-pattern gradient of all three UI kits | → `var(--t-color-accent-500)` in `index.html`, `index-ar.html`, `index-print.html` | none — identical value |
| B3 | `letter-spacing: 0.2em` on `.btn-sm` in `components/core/buttons.html` | → `var(--t-ls-button)` (0.22em). No functional reason for a distinct small-button tracking was documented, and no new token was created | intentional, +0.02em on one specimen small button (~1px wider label) |

### Post-correction scan (actual result, all of `preview/`, `components/`, `ui_kits/`, `tokens/`, `styles.css`, `thumbnail.html`, `index.js`)

| Class | Count | Verdict |
|---|---|---|
| Authored custom properties not using `--t-*` | **0** | PASS |
| Brand hex in a CSS style position outside `tokens/colors.css` | **0** | PASS — the only hexes in style positions are the 14 primitive definitions in `tokens/colors.css`, the intended single source of truth |
| Brand hex as visible swatch label text | 10 (`preview/colors-primary.html`, `colors-neutrals.html`) | Intentional — the card documents the value |
| Brand hex in inline-SVG presentation attributes | 2 (`components/core/cards.html` `stroke="#C9A75E"`, `stroke="#E6D8C7"`) | Open — `var()` does not resolve in the SVG presentation attributes used here; needs a `currentColor` refactor of the specimen icons (deferred, appearance-preserving change required) |
| Literal `letter-spacing` values remaining | 63 across page-level UI kits and specimen cards | Open by design — page-level tracking (0.04 / 0.08 / 0.1 / 0.14 / 0.18 / 0.24em) is page composition, not Design System type roles; the 7 canonical roles are tokenized and used by the components |
| Literal `rgba()` values remaining | 40, of which 4 are the canonical definitions in `tokens/effects.css`/`colors.css` | Open by design — the remaining 36 are page-level translucent overlays and pattern alphas in the UI kits; tokenizing them would require new alpha tokens or `color-mix()`, i.e. new values, which REFACTOR mode forbids |

**No claim of "zero hard-coded values" is made.** The verified claim is narrower and exact: zero non-`--t-` authored custom properties, and zero brand hexes in style positions outside the token source of truth.

---

## 8. Final surgical correction pass (v0.0.4)

| # | Item | Action | Visual effect |
|---|---|---|---|
| C1 | `.btn-text` in `components/core/buttons.html` used literal `letter-spacing: 0.14em` | → `var(--t-ls-tag)` (0.16em), matching the canonical `Button.jsx` `text` variant | intentional, +0.02em on the text-button label (~1px) |
| C2 | URL-encoded burgundy `%237A1322` in the select-chevron SVG data URI of `components/core/inputs.html` and `ui_kits/website/index.html` | Chevron rewritten as a `mask`/`-webkit-mask` on a `.select-wrap` wrapper; the data URI now carries only geometry (`stroke='%23000'`, which the mask discards) and the visible colour comes from `background-color: var(--t-color-brand-500)` | none — same path, stroke width, 10×6 size, right 14px, vertically centred |

`.select-wrap` is a one-element markup wrapper added around each `<select>` purely to anchor the mask; no field geometry, padding, border, or state styling changed. `appearance: none` behaviour is unchanged.

### Final scan — plain AND URL-encoded forms of all 14 canonical brand hexes

Scope: `preview/`, `components/`, `ui_kits/`, `tokens/`, `styles.css`, `thumbnail.html`, `index.js`.

| Class | Count | Verdict |
|---|---|---|
| URL-encoded brand hex (`%237A1322` and all equivalents) anywhere | **0** | PASS |
| Brand hex in a CSS style position outside `tokens/colors.css` | **0** | PASS |
| Brand hex definitions in `tokens/colors.css` | 14 | Intended single source of truth |
| Brand hex as visible swatch label text | 10 | Intentional — the card documents the value |
| Brand hex in inline-SVG presentation attributes | 2 (`components/core/cards.html`) | Still open — see §7; the two service-card icons need a `currentColor` rewrite |
| Authored custom properties not using `--t-*` | **0** | PASS |
| Literal page-level tracking / `rgba()` alphas | unchanged from §7 | Open by design — tokenizing them would invent values |

Still no claim of "zero hard-coded values". The proven claims are: zero URL-encoded brand hexes, zero brand hexes in style positions outside the token source of truth, zero non-`--t-` authored custom properties.
