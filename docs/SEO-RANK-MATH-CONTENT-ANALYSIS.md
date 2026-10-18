# Rank Math content analysis for Teelya-rendered pages

Date: 2026-10-18 · Rank Math Free 1.0.280 · Polylang Pro 3.8.5 · WordPress 7.1.3

## 1. Why the scores were near zero

Venix pages are built by PHP section templates from language-aware content arrays
(`theme/venix-concierge/inc/content/*.php`, `$copy( EN, PL, RU )`) plus per-page editor
overrides (`_venix_page_content` post meta, schema in Venix Concierge Core). `post_content`
is **empty** on all five page families. Rank Math's analyzer reads only the editor content
(`post_content`), so it saw an empty page: no words, no headings, no images, no links.

### Content pipeline

| Layer | Owner | Role |
|---|---|---|
| Copy defaults (EN/PL/RU) | theme `inc/content/{home,about,services,fleet,contact,footer}.php` via `venix_concierge_language_copy()` (`inc/i18n.php`); language = Polylang current language | Canonical editorial strings, UI labels and button text mixed in the same arrays |
| Overrides | Core `inc/page-content.php` (meta box, `_venix_page_content`); theme merges via `venix_concierge_get_page_content()` | Optional editor replacement of default strings |
| Composition | theme `template-parts/sections/{page}.php` (chosen by `page.php`/`front-page.php`) | Turns arrays into HTML: eyebrow, H1, H2/H3, paragraphs, lists, CTAs, media with alt text |
| Global shell | theme header/footer/menus | Navigation and footer text, not page copy |

Not all strings are editorial: badges, anchor navigation, forms, buttons and footer/nav
text are UI. The integration therefore starts from the **rendered section template** (so
the language, overrides and ordering are exactly what a visitor gets) and keeps only
visitor-readable editorial elements.

## 2. Chosen mechanism

Rank Math's own JavaScript filter **`rank_math_content`** (verified in the installed
`assets/admin/js/gutenberg.js` and `classic.js`: both run
`applyFilters("rank_math_content", content)` before analysis, and again when sending
content on save). It is Rank Math's supported extension point; no plugin files are
modified. Rank Math Free has no PHP filter for analysis content.

```
Admin opens a Venix page in the editor
 → Core (inc/rank-math-analysis.php) resolves the page key and applies
   venix_concierge_core_seo_analysis_content
 → Theme (inc/seo-analysis.php) renders template-parts/sections/{key}.php in the
   page's Polylang language and reduces it to editorial HTML
 → Core prints it as a JS string and enqueues rank-math-content.js
 → wp.hooks.addFilter('rank_math_content', …) appends it to the editor content
 → Rank Math analyses real H1/H2/H3, paragraphs, links and image alts
```

What the collector keeps: `h1–h6`, `p`, `ul/ol/li`, `a[href]`, `strong/em`, `img` with
non-empty `alt`. What it drops: `script/style/noscript/template/svg`, `form`, `nav`,
`button`, `select/input/textarea`, `video/iframe`, elements with `hidden`,
`aria-hidden="true"` or `inert`, badges, screen-reader/skip links. It never injects
keywords and does not touch `post_content`.

### Files

| File | Change |
|---|---|
| `theme/venix-concierge/inc/seo-analysis.php` | new — renders the section in the edited page's language/query context, restores globals/Polylang language/enqueue queues, extracts editorial HTML; registers `venix_concierge_core_seo_analysis_content` |
| `theme/venix-concierge/functions.php` | loads the file **only when `is_admin()`** |
| `project-core/venix-concierge-core/inc/rank-math-analysis.php` | new — on `post.php` for Venix pages with Rank Math active, passes content to the script |
| `project-core/venix-concierge-core/assets/admin/rank-math-content.js` | new — 10-line `rank_math_content` filter |
| `project-core/venix-concierge-core/project-core.php` | `require_once` for the new include |

### Impact

- **Frontend:** none. Nothing is loaded on public requests (`seo-analysis.php` is not
  included; the script is admin-only). Verified: `venixRankMathContent` and
  `rank-math-content.js` absent from the HTML of `/`, `/pl/services/`, `/ru/fleet/`; all 15
  public pages and the sitemap re-audited unchanged.
- **Editor:** one extra server-side render on page-edit load (~55–60 ms measured for Home
  and Services). Content shown to the analyzer is the state **at page load**: after
  changing text in the Venix meta box, save and reload to re-analyze.
- **Save:** Rank Math also posts the filtered content with its metadata update (used for
  its internal-link counter), so link counts now reflect the real page.
- **Data:** nothing written to `post_content` or any meta. `post_modified` unchanged.
- **Failure mode:** if rendering fails or returns nothing, the filter is not registered and
  Rank Math behaves exactly as before.
- Works for EN, PL and RU (language taken from the page being edited via Polylang).

## 3. Score validation (real Rank Math editor, headless Chromium)

Method: opened each page's edit screen with a throw-away admin session on the local site,
waited for the analysis, read `wp.data.select('rank-math').getAnalysisScore()` and
`rankMathEditor.resultManager` results. "Before" = same code with only the new include
temporarily disabled (restored afterwards).

| Page | Focus keyword | Before | After | Words seen (before → after) | Internal links | Images | Short paragraphs |
|---|---|---|---|---|---|---|---|
| PL Home `/pl/` | szofer Warszawa | **0** | **20** | 0 → 851 | 0/5 → 0/5 | 0/6 → 6/6 | 0/3 → 3/3 |
| PL Services | transfery z szoferem Warszawa | 4 | 17 | 0 → 540 | 0/5 → 5/5 | 0/6 → 6/6 | 0/3 → 3/3 |
| PL Fleet | Mercedes z kierowcą Warszawa | 4 | 17 | 0 → 284 | 0/5 → 5/5 | 0/6 → 6/6 | 0/3 → 3/3 |
| EN Services | private transfer services Warsaw | 5 | 18 | 0 → 566 | 0/5 → 5/5 | 0/6 → 6/6 | 0/3 → 3/3 |
| RU Services | VIP трансфер Варшава | 4 | 17 | 0 → 577 | 0/5 → 5/5 | 0/6 → 6/6 | 0/3 → 3/3 |

Rank Math now detects the real body text, a realistic word count, images (and their alt
text), short paragraphs and internal links. Scores stay low **because of the next
section, not because of missing content**. Scores were not optimized and should not be.

## 4. What the remaining warnings mean

Common to all five pages tested.

### Real SEO / copy issues

| Warning (max points) | Cause | Action |
|---|---|---|
| Focus keyword not in SEO title (36) | Keyword and title are phrased differently (e.g. "transfery z szoferem **Warszawa**" vs title "…w **Warszawie**"; EN "private transfer services Warsaw" vs "Private Transfer Services **in** Warsaw") | Strategy decision (see `SEO-KEYWORD-STRATEGY.md` §8): choose un-inflected focus phrases that match natural copy. Do not stuff. |
| Keyword not in meta description (2), content (3), first 10% (3), subheadings (3), image alt (2); density 0 (6) | The focus keywords chosen earlier are metadata-only; the copy doesn't use those exact phrases | Same as above; PL/RU morphology means exact-match checks will fail on correct grammar |
| Home: no internal links in the body (5) | Home body links only to `#inquiry`, `#fleet` and Contact; Services/Fleet/About are linked only from header/footer | Real finding: add 2–3 contextual in-body links (structure change needing approval) |
| Content length < 600 words on Services (540/566/577) and Fleet (273–296) | Page copy is compact | Fleet is thin; Services is borderline. Do not pad. Consider only if the copy plan in the strategy document is approved. |

### Optional Rank Math recommendations

External/outbound links (0/4) and "all outbound nofollow" (0/2) — there are no outbound
links in the body and none are needed. Table of contents (0/2). Title sentiment, power
word and number checks (1 point each). Content AI (0/5): needs a Rank Math account.

### Architecture-limited / not relevant

- **Keyword in URL (5):** slugs are intentionally shared (`/about/`, `/pl/about/`,
  `/ru/about/`) and English; Polish/Russian keywords can never appear in them without
  changing the URL structure, which is out of scope.
- **Inflection/morphology (Polish, Russian):** Rank Math Free tests exact strings, not
  lemmas.
- **Home "linksHasExternals", TOC:** brochure pages by design.
- Rank Math cannot score the **live-edited** meta box text until save+reload (§2).

## 4b. Scores after the 2026-10-18 content round

After the approved Home/Services/Fleet content and metadata changes (`SEO-KEYWORD-STRATEGY.md`
§15) the nine pages score 62–85 (Home 85, Services 65–69, Fleet 62–64; they were 17–20). The
remaining failures are the legitimate ones listed in §4 plus low keyword density; none are
fixed by bending Polish or Russian grammar.

## 5. Reproduce

1. WordPress admin → Pages → edit Home/Services/Fleet (any language) → open the Rank Math
   sidebar; the Content Analysis list reflects the full page text.
2. Disable by removing the `require_once` of `inc/rank-math-analysis.php` from
   `project-core/venix-concierge-core/project-core.php` — Rank Math returns to reading an
   empty page.
