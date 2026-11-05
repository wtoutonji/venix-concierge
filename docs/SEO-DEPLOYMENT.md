# SEO deployment (Rank Math + Polylang Pro)

The audited Rank Math metadata lives in the database, so it must be applied to
every environment. `scripts/apply-seo-metadata.php` does this idempotently.
Full audit: `docs/SEO-AUDIT-2026-10-18.md`. Arabic (`ar`) is the fourth language; its setup is in
`docs/ARABIC-RTL.md` and is deployed in the order described under "Arabic deployment" below.

## What the script does

- Matches pages by **Polylang language + shared page-family slug**
  (`home`, `about`, `services`, `fleet`, `contact`), never by database ID.
- Sets `rank_math_title`, `rank_math_description`, `rank_math_focus_keyword` for the
  20 EN/PL/RU/AR pages from `scripts/seo/rank-math-seo-data.php`. Arabic pages are matched by Polylang
  language `ar` + the same shared slug as the other languages (never by ID); an Arabic focus keyword that
  contains tashkeel (U+064B–U+0652) or tatweel (U+0640) is reported as a `PROBLEM` and skipped.
- Adds `noindex` (merged into existing robots) to the EN `sample-page`, if present.
- Merges only three Rank Math titles options: `title_separator`,
  `pt_page_default_rich_snippet`, `knowledgegraph_type`. Other options are untouched.
- Fixes two exact-match data defects: a duplicated-brand attachment alt and the EN
  menu link `/services` → `/services/`.
- Never calls `wp_update_post`, creates pages, or touches translation links; it only
  *checks* that each PL/RU/AR page is the Polylang translation of the EN page.
  `post_modified` is compared before/after and the script exits non-zero if it moved.
- Skips (and reports `PROBLEM`) any language/slug that does not match exactly one
  published page. Exit code 1 on any problem.
- **Dry-run by default.** Nothing is written without the `apply` argument.

**Metadata and copy travel separately.** The script carries only titles, descriptions and
focus keywords (data file `scripts/seo/rank-math-seo-data.php`). The matching page copy
(Services lead, Fleet guidance paragraph, revised headings and in-body links, 2026-10-18
content round) ships with the **theme** and **project-core** (new editor fields), so deploy
both before or together with the script; none of that copy is stored in the database
(`_venix_page_content` holds only media and alt overrides). Inline links in copy use
`{{link text|page#anchor}}` tokens resolved per language by
`venix_concierge_linked_text()`, so they point at the right `/pl/`, `/ru/` URL on any host.

Not done by the script (by design): Rank Math setup wizard, module changes, x-default
hreflang, site logo/social image, schema other than the options above. The
homepage `SearchAction` is removed by a filter in `project-core`
(`venix_concierge_core_remove_search_action`), so deploy the plugin too.

## Running on staging / production

Prerequisites: Polylang Pro and Rank Math active, project-core deployed, pages and
translations already present. Rank Math must have been activated at least once
(its options exist). If an admin runs the Rank Math setup wizard, do it **before**
this script, then run the script so the three option keys are re-asserted.

1. Take a database backup (WPvivid or `wp db export`).
2. `cd` to the WordPress root and confirm the site: `wp option get home`
   (must be the intended staging/production URL).
3. Dry-run and read the report:
   `wp eval-file path/to/scripts/apply-seo-metadata.php`
   Lines: `OK` already correct · `WOULD` pending change · `PROBLEM` needs a human.
4. Resolve every `PROBLEM`, then apply:
   `wp eval-file path/to/scripts/apply-seo-metadata.php apply`
5. Run it once more (dry-run): it must show `0 would change` and `0 problems`.
6. Flush any page/CDN cache, then complete the checklist below.

Local example (LocalWP, from the WP root):
`wp eval-file "D:\Wordpress Projects\Projects\venix-concierge\scripts\apply-seo-metadata.php" apply`

Editing metadata later: change `scripts/seo/rank-math-seo-data.php`, run dry-run, then apply.
PL values are **pending human approval**; update the data file if wording changes.

## Arabic deployment (language, pages, menus, then SEO)

Arabic needs entities that the SEO script deliberately never creates, so run the scripts in this order
(WP root, after the backup and the `wp option get home` check above; both are dry-run-safe to repeat):

1. Deploy the theme (CSS, `lang-ar.css`, `languages/ar.l10n.php`, content arrays) and project-core.
2. `wp language core install ar` (the WordPress `ar` core pack; Polylang also fetches it when it creates
   the language).
3. `wp eval-file path/to/scripts/setup-polylang-site.php` — creates the Polylang language `ar`
   (locale `ar`, RTL) if missing, the five Arabic pages (shared slugs), the EN ↔ PL ↔ RU ↔ AR
   translation groups, the inherited media/video selection and Arabic alt text, and the **Primary AR** /
   **Footer AR** menus assigned to `primary`/`footer`. It aborts before writing when a prerequisite is
   missing and is idempotent (a second run prints no `CREATED`/`UPDATED` lines and does not change
   `post_modified`). Source data: `scripts/arabic-site-data.php`.
4. `wp eval-file path/to/scripts/apply-seo-metadata.php`, read the report (`0 problems`), then `… apply`,
   then a final dry-run: `0 would change`. A fresh Arabic deployment reports 15 `WOULD` lines (5 pages ×
   title, description, focus keyword) and nothing else.
5. Flush page/CDN caches and run the checklist below. Arabic-specific extras: `<html lang="ar" dir="rtl">`;
   only one font file (`NotoSansArabic-…woff2`) is requested on `/ar/` pages and **none** on EN/PL/RU;
   `lang-ar.css` is requested on `/ar/` pages only; the skip link works on every page (`#primary`).

Production note: attachment IDs differ between environments, so the setup script copies each Arabic page's
media/video selection from the **English** page of the same family at run time — set the English pages'
Venix Page Content first.

## Deployment verification checklist

Replace `$H` with `https://venixconcierge.com`. Check all 20 URLs:
`/`, `/about/`, `/services/`, `/fleet/`, `/contact/`, and the same under `/pl/`, `/ru/` and `/ar/`.

- [ ] **Host:** `curl -sI https://www.venixconcierge.com/` → 301 to `https://venixconcierge.com/` (single hop, path preserved, also for `/pl/`, `/ru/`, `/ar/`); `http://` → https.
- [ ] **Canonical host:** every canonical, `og:url`, hreflang, sitemap `<loc>` and menu/footer link uses `https://venixconcierge.com` — no `www`, no `http`, no `.local`.
- [ ] **Sitemap:** `$H/sitemap_index.xml` returns 200 (Rank Math, `page-sitemap.xml` listed); `$H/page-sitemap.xml` returns 200; `$H/wp-sitemap.xml` redirects to it; `robots.txt` has the `Sitemap:` line with the production host and does not block public pages.
- [ ] **20 URLs:** `page-sitemap.xml` contains exactly the 20 URLs (5 EN, 5 PL, 5 RU, 5 AR); no `sample-page`, no test/prototype/draft pages; each URL returns 200.
- [ ] **Canonicals:** each page has exactly one canonical equal to its own URL; no page points to another language's URL (EN/PL/RU/AR).
- [ ] **hreflang:** each page lists en, pl, ru, ar (own URL for itself, correct counterpart for others), reciprocal across the 5 groups; no `x-default` (intentional).
- [ ] **Titles / descriptions:** one `<title>` and one `meta name="description"` per page, matching `scripts/seo/rank-math-seo-data.php`; `<html lang>` is en-US / pl-PL / ru-RU / ar, and `dir="rtl"` only on `/ar/`.
- [ ] **Robots:** `index, follow, max-image-preview:large…` on all 20; `noindex` only on non-public pages (`/sample-page/` if still present).
- [ ] **Schema:** Home (each language) has JSON-LD `Organization` + `WebSite` + `WebPage` with production URLs and **no** `SearchAction`; inner pages have no `Article`/`Person` schema; validate with Google Rich Results Test / Schema.org validator.
- [ ] **Open Graph / social:** `og:title`, `og:description`, `og:url` (= canonical), `og:locale` (`ar_AR` on Arabic) + alternates, `twitter:card`. `og:image` is expected to be missing until a default social image is chosen — record the decision.
- [ ] **No duplicates:** exactly one title, description, canonical, set of OG tags and JSON-LD block per page (view-source; no tags from theme, Polylang or a second SEO/cache plugin).
- [ ] **Regression:** page content, menus and language switcher unchanged; `wp post list --post_type=page --fields=ID,post_modified` unchanged by the script.
- [ ] **Search Console:** submit `$H/sitemap_index.xml`; request indexing for the 5 Home/Contact URLs if desired.
