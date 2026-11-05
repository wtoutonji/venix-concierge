# Arabic (ar) — language, RTL and localization

Date: 2026-10-20 · WordPress 7.1.3 · Polylang Pro 3.8.5 · Rank Math Free 1.0.280 · LocalWP site
`http://venix-concierge.local`. Nothing is committed. Polylang Pro and Rank Math plugin files are
untouched; the Rank Math setup wizard was not run.

Arabic follows the existing EN/PL/RU architecture: Polylang owns languages, relationships, hreflang
and menus; the theme owns presentation, RTL CSS and the copy arrays; Venix Concierge Core owns the
page-content overrides; Rank Math owns SEO output. There is no parallel Arabic site.

## 1. Language setup

| Item | Value |
|---|---|
| Polylang language | name `العربية`, slug `ar`, locale `ar`, RTL, flag `arab`, order 3 (term 26) |
| Locale verification | `ar` is Polylang's predefined Arabic entry (`src/settings/languages.php`: code `ar`, locale `ar`, dir `rtl`) and the WordPress.org core translation `ar` (Arabic, 7.1.3). `ary` is Moroccan Arabic and was **not** used. Core pack installed with `wp language core install ar` |
| URL mode | unchanged: directory mode, default `en` hidden. Arabic is `/ar/…` with the shared English slugs (`about`, `services`, `fleet`, `contact`). Slugs are not translated |
| `<html>` | `<html dir="rtl" lang="ar">` — produced by WordPress/Polylang from the language's RTL flag (`language_attributes()`); the theme does not set it |
| Open Graph locale | `og:locale=ar_AR` (Polylang's Facebook locale for Arabic), alternates en_US/pl_PL/ru_RU |

Created and kept idempotent by `scripts/setup-polylang-site.php` (data in `scripts/arabic-site-data.php`):
the script creates the language only when it is missing, creates/reuses the five pages by language +
shared slug, links the translation groups, copies the English page's media and video selection, writes
the Arabic alt text, and creates/populates/assigns the two Arabic menus. A second run changes nothing.

## 2. Pages, translation groups and URLs

| Family | EN | PL | RU | **AR** | Arabic URL |
|---|---|---|---|---|---|
| Home | 6 | 8 | 172 | **202** | `/ar/` (translation of the static front page) |
| About | 10 | 12 | 174 | **204** | `/ar/about/` |
| Services | 14 | 16 | 176 | **206** | `/ar/services/` |
| Fleet | 18 | 20 | 178 | **208** | `/ar/fleet/` |
| Contact | 22 | 24 | 180 | **210** | `/ar/contact/` |

Arabic page titles: الرئيسية · من نحن · الخدمات · الأسطول · تواصل معنا. Each family is one Polylang
translation group (`pll_save_post_translations`); no custom relationship table exists. Public URLs after
Arabic: 20 (5 × 4 languages). Sample Page (#2) stays `noindex` and outside the sitemap; Privacy Policy
(#3) stays a draft.

## 3. Menus and language switcher

- **Primary AR** (menu 31) and **Footer AR** (menu 32), assigned to the `primary` and `footer` locations
  for `ar` through Polylang's `nav_menus` option. Structure mirrors EN (Home, About, Services ▸ four
  anchors, Other services ▸ five anchors, Fleet, Contact); anchor items use relative `/ar/services/#…`
  URLs; page items point at the Arabic pages. The `legal` location is unassigned, as in the other languages.
- **Switcher** (`inc/navigation.php`, the existing renderer): EN · PL · RU · AR, each linking to the
  translation of the current page. The visible label stays the language code; the accessible name and
  tooltip are now the native language name (English, Polski, Русский, **العربية**). This adds
  `aria-label`/`title` to the EN/PL/RU links too (an accessibility improvement shared by all languages).

## 4. Copy ownership and localization

- `inc/content/*.php` use `venix_concierge_language_copy( $english, $polish, $russian, $arabic )` through
  each file's `$copy()` closure; 370 distinct strings (≈ 400 call sites) gained a fourth Arabic argument. A
  call that omits Arabic falls back to English, never Polish or Russian.
- `languages/ar.l10n.php` holds the gettext/accessibility strings (skip link, menu, landmark labels,
  breadcrumb, pagination, 404…), with the six-form Arabic plural rule.
- Per-page contextual image alt text lives in the Arabic pages' `_venix_page_content` meta
  (`media_alt`), because the Media Library alt is English and would otherwise win. The source of those
  strings is `scripts/arabic-site-data.php`, so a new environment gets them from the script.
- Voice: neutral Modern Standard Arabic; premium, restrained, discreet. Written from the approved English
  meaning (Polish/Russian consulted for context only), not translated word by word. The reader is
  addressed in the singular (ك), which is the usual register of Arabic premium service sites and keeps
  buttons ("اطلب سائقًا") and body copy consistent. Latin digits (2024, 9 · 16 · 19) are used because phone
  numbers, model names and years are already Latin. Tashkeel is omitted except the tanwin fatḥ
  (سائقًا). Punctuation is Arabic (، ؟). Nothing stronger than the approved English wording was written.
- A scripted scan of all 490 strings the theme can output in Arabic found no leaked English prose, Cyrillic
  or Polish; the only non-Arabic values are technical identifiers (ids, input types, slot keys), the
  network names Instagram/Facebook and the intentional terms below.

### Intentional untranslated terms

Venix Concierge · Mercedes-Benz · S-Class · E-Class · V-Class · Sprinter · VIP · WhatsApp · Instagram ·
Facebook · `SHORT · LONG · XL` (existing product label; no approved Arabic variant) · the brand slogan
**Own the moment** (footer, kept as tracked Latin capitals) · phone, email and handle strings (kept
left-to-right inside the Arabic line) · the logo's alt text "Venix Concierge".

### Claims not strengthened

Existing pending wording was translated at the same strength and nothing was added: no service area, no
Europe-wide operation (the About "vision" stays a vision), no response-time guarantee ("عادةً خلال يوم عمل
واحد" mirrors "typically within one business day"), no diplomatic/government authorization (the Services
disclaimer is translated in full), protection and private flights remain *coordination through authorised
partners*, no BMW, limousine or armoured vehicle, no capacities (the "TBC" label reads يُؤكَّد لاحقًا) and
no testimonial (the section stays disabled; no bracketed placeholder exists anywhere in the Arabic copy).

## 5. RTL implementation

Direction comes from Polylang/WordPress; the CSS was made direction-aware instead of mirrored by hand.

| Layer | Change |
|---|---|
| Existing CSS (all languages) | Physical properties converted to logical ones: `margin/padding/border-left|right` → `*-inline-start|end`, `text-align:left|right` → `start|end`, two asymmetric four-value shorthands, three single-side offsets → `inset-inline-*`. Every conversion is value-identical in LTR (see §7) |
| `assets/css/lang-ar.css` (Arabic only) | Typeface variables, line-height, letter-spacing/uppercase/italic reset, size scale, arrow direction, hero scrim mirror, LTR data inputs |
| `assets/css/base.css` | `[dir="rtl"] .venix-icon-directional` gained `display:inline-block` (a transform has no effect on an inline box, so the arrow was not mirroring) |
| `assets/css/header.css` | the switcher link keeps the page typeface (see §6) |
| font sizes | every px size ≤ 14.5 px is `calc(N px * var(--venix-type-scale, 1))`; the scale is 1 everywhere except Arabic (1.25) |
| Templates | `venix_concierge_isolate_ltr()` / `venix_concierge_isolate_text()` / `venix_concierge_directional_arrow()` in `inc/i18n.php`: phone, WhatsApp, email and handles are wrapped in `<bdi dir="ltr">` on RTL pages only; the legal name in the footer is isolated so its final full stop stays attached; the three literal "→" in `sections/home.php` follow the reading direction |
| `inc/assets.php` | enqueues `lang-ar.css` on Arabic pages only |

Mirrored on purpose: layout, navigation order, the mobile menu (toggle at the inline end, "+" markers),
the language switcher order, text-link arrows (text and masked SVG), the Home hero scrim, the "who we
serve"/"pillars" column rules. **Not** mirrored: the logo, vehicle photography, contact icons (phone,
mail, pin), the decorative diagonal hatch, the header dropdown (centered under its parent).

LTR data (email, tel, URL, number, date inputs) uses `direction:ltr; text-align:end` so values stay
readable and sit at the form's reading edge. The mobile submenu, dropdown and form select arrow already
used logical positioning.

## 6. Typography and font decision

- Cinzel (display) and Montserrat (body) contain **no Arabic glyphs**; unaided, the browser would fall
  back to an arbitrary system font — and it did for body copy before `lang-ar.css` (the base `[lang=ar]`
  rule only covered headings).
- Decision: **Noto Sans Arabic**, already bundled by the design-system handoff
  (`assets/fonts/NotoSansArabic-VariableFont_wdth,wght.woff2`, declared in `theme.json`), for display and
  body in Arabic. Source: Noto Project, <https://github.com/notofonts/arabic>, version 2.012; licence
  **SIL Open Font License 1.1** (embedded in the font's name table); self-hosted, not served from a third
  party. No new font file was added. The design-system README documents the same choice (Noto Serif
  Arabic was referenced in the brand text but never supplied).
- Verified with fontTools: the file maps all of U+0621–U+064A, the tashkeel U+064B–U+0652, Arabic comma,
  semicolon and question mark, guillemets, ZWJ/ZWNJ and the Latin letters/digits/punctuation used for
  model names, so no glyph falls back. Variable axes: weight 100–900, width 62.5–100.
- Loaded only where used: on `/ar/` pages the browser downloads that one file (Cinzel and Montserrat are
  not requested, saving ~250 KB); on EN/PL/RU it is not downloaded (this required the header switcher
  fix above — the `lang="ar"` switcher link would otherwise have matched the base `[lang=ar]` rule and
  pulled the font into every page).
- Hierarchy is preserved with weight (headings 700, body 400/600) and the type scale, not with Latin
  letter-spacing, uppercase or italics, none of which exist in Arabic (an `!important` reset guards every
  page/component rule; a scripted audit confirms 0 Arabic text nodes with tracking, case change or tight
  leading). Line-height is 1.9 body / 1.5 headings.

## 7. Verification

**EN/PL/RU unchanged by the CSS refactor.** Computed layout (font size, margins, paddings, borders,
text-align, letter-spacing, line-height, offsets, display, and every element's rectangle) was captured for
all 15 existing pages at 1440 and 390 px before and after the conversion: **30/30 views identical**
(one mis-converted shorthand was found and fixed by this test).

**Responsive RTL (1440 / 768 / 390, all five Arabic pages):** no horizontal page overflow
(`scrollWidth == clientWidth` on all 15 views); header, desktop navigation, dropdown (centered, opens
with Enter, closes with Escape), mobile menu, language switcher, Services anchor bar (scrolls from the
right; targets clear the sticky header within 2 px, identical to EN), Fleet cards, forms, buttons, arrows
and footer were reviewed visually. The breadcrumb component is not rendered by any template and has no
stylesheet, so there is no breadcrumb output to test; its Arabic strings are in `ar.l10n.php`. Mixed Arabic/Latin lines render
correctly: "Mercedes-Benz S-Class" is not reversed, "9 · 16 · 19 مقعدًا" reads in logical order, phone
and email are legible left-to-right.

**Keyboard / focus / motion:** the skip link is the first tab stop on every page and its target exists
(it did **not** exist on Services and Fleet — see §9); the mobile menu opens with Enter, moves focus into
the panel, closes with Escape and returns focus to the toggle; submenus expand; every tabbed control shows
a 2 px outline; no focusable control is rendered at zero size. With `prefers-reduced-motion: reduce`:
`scroll-behavior:auto`, the hero video is hidden and transitions are 0.01 ms (identical to the other
languages); without it smooth scrolling and 0.25 s transitions apply.

**Forms/UI accessibility:** labels, optional markers, select placeholder, consent, status note, submit
label, skip link, menu toggle, landmark labels (Primary navigation → التنقل الرئيسي, Language → اللغة) and
the language names are all Arabic; the form is an unbound prototype (disabled submit) exactly as in the
other languages — no validation messages exist to translate.

## 8. Unresolved business/legal items (unchanged, still pending)

Operating area; "within one business day" response promise; delegation, protection and flight
disclaimers and partner/licensing statements; consent/privacy wording (Privacy Policy is a draft, no
`legal` menu); passenger/luggage capacities; real testimonial; contact address; default social image;
wedding photography shows a Rolls-Royce, which is not a fleet vehicle (the Arabic alt describes a luxury
wedding car without naming it); the "limousine, BMW 7, armoured vehicle, VIP Line, Europe-wide and
intercity transfer" terms remain blocked (see `SEO-KEYWORD-STRATEGY.md` §16). Observed, not changed: the
site setting email reads `inquery@…` (possible typo of "inquiry" — confirm with the client).

## 9. Defects found along the way

| Finding | Action |
|---|---|
| Services and Fleet used `<main id="main-content">` while the skip link targets `#primary`, so the skip link did nothing on those pages (all languages) | Changed both to `id="primary"` (nothing else referenced the old id). This is the only visible-markup change to existing EN/PL/RU pages besides the Arabic additions |
| Base RTL rule left body copy in a system fallback font; letter-spacing and `text-transform` still applied through page rules | `lang-ar.css` |
| `.venix-icon-directional` arrows did not mirror (inline box) | `display:inline-block` |
| Observed, not changed (affects every language): the switcher styles the current language with `[aria-current=true]`, but the markup is `aria-current="page"`, so the active language is not highlighted; the keyboard focus ring (brand red) is low-contrast on the dark mobile menu panel | Report only |

## 10. Files

Theme: `assets/css/lang-ar.css` (new), `base.css`, `header.css`, `footer.css`, `components/inquiry-form.css`,
`components/mobile-menu.css`, `pages/{home,about,services,fleet,contact}.css` (logical properties and size
scale), `inc/{i18n,assets,navigation}.php`, `inc/content/{home,about,services,fleet,contact,footer}.php`,
`languages/ar.l10n.php` (new), `template-parts/header/site-header.php`,
`template-parts/footer/site-footer.php`, `template-parts/sections/{home,contact,services,fleet}.php`.
Scripts: `scripts/setup-polylang-site.php`, `scripts/arabic-site-data.php` (new),
`scripts/apply-seo-metadata.php`, `scripts/seo/rank-math-seo-data.php`. Docs: this file,
`SEO-KEYWORD-STRATEGY.md` §16, `SEO-DEPLOYMENT.md`, `SEO-RANK-MATH-CONTENT-ANALYSIS.md` §6,
`handoff/generated/polylang-implementation-map.md`.
