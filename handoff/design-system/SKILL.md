# Venix Concierge — Agent Skill Descriptor
# SKILL.md

## Project Identity
**Venix Concierge** — premium luxury lifestyle management & concierge service based in Poland.

## Design System Location
This project IS the design system. **This package follows the Teelya Design System v0.0.4 validation contract.**
Package contract version: `v0.0.4` · Mode of last change: REFACTOR · Audit record: `MIGRATION-MAP.md` · Verification: `COMPLETION-REPORT.md`.
The single authored global CSS entry point is `styles.css`, which imports the modular `tokens/` files.

## When Starting a New Design for Venix

### Essential Reading
1. `README.md` — brand brief, tone, voice, visual system, token index
2. `styles.css` + `tokens/` — the canonical token system (`--t-*`)
3. `preview/` and `components/core/*.html` — visual reference cards
4. `COMPLETION-REPORT.md` — substitutions, gaps, handoff readiness

### Linking the Design System
Link one stylesheet; fonts and tokens come with it.
```html
<link rel="stylesheet" href="../styles.css">
```
Adjust the relative path to `styles.css` from your file. Do not redeclare `@font-face` or token values locally.

### Tokens
Use semantic tokens: `var(--t-fg-brand)`, `var(--t-bg-inverse)`, `var(--t-space-8)`, `var(--t-radius-button)`, `var(--t-motion-transition-base)`.
Breakpoints: sm 480px · md 768px · lg 1024px · xl 1280px · 2xl 1440px.

### Components
React reference components: `components/core/` (Button, Card, Badge, Input), exported from `index.js`.
These are Design System **reference material only**. The canonical page-design handoff is self-contained `.dc.html`; JSX must not enter the page handoff workflow.

### Icons
```html
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
```
Call `lucide.createIcons()` at end of body. Use `<i data-lucide="icon-name" stroke-width="1.2">`. Lucide is a documented substitution for the unsupplied production icon set.

### Arabic / RTL
Set `lang="ar" dir="rtl"`. Noto Sans Arabic carries display and body; no uppercasing, no tracking, leading 2. Use logical properties.

### Brand Voice Checklist
- [ ] Headlines ALL CAPS (Latin only — never Arabic)
- [ ] No emoji
- [ ] No exclamation marks
- [ ] Cinzel for display, Montserrat for body, Noto Sans Arabic for Arabic
- [ ] Burgundy on light, Ivory on dark
- [ ] Gold accent used sparingly
