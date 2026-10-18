# SEO deployment (Rank Math + Polylang Pro)

The audited Rank Math metadata lives in the database, so it must be applied to
every environment. `scripts/apply-seo-metadata.php` does this idempotently.
Full audit: `docs/SEO-AUDIT-2026-10-18.md`.

## What the script does

- Matches pages by **Polylang language + shared page-family slug**
  (`home`, `about`, `services`, `fleet`, `contact`), never by database ID.
- Sets `rank_math_title`, `rank_math_description`, `rank_math_focus_keyword` for the
  15 EN/PL/RU pages from `scripts/seo/rank-math-seo-data.php`.
- Adds `noindex` (merged into existing robots) to the EN `sample-page`, if present.
- Merges only three Rank Math titles options: `title_separator`,
  `pt_page_default_rich_snippet`, `knowledgegraph_type`. Other options are untouched.
- Fixes two exact-match data defects: a duplicated-brand attachment alt and the EN
  menu link `/services` → `/services/`.
- Never calls `wp_update_post`, creates pages, or touches translation links; it only
  *checks* that each PL/RU page is the Polylang translation of the EN page.
  `post_modified` is compared before/after and the script exits non-zero if it moved.
- Skips (and reports `PROBLEM`) any language/slug that does not match exactly one
  published page. Exit code 1 on any problem.
- **Dry-run by default.** Nothing is written without the `apply` argument.

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

## Deployment verification checklist

Replace `$H` with `https://venixconcierge.com`. Check all 15 URLs:
`/`, `/about/`, `/services/`, `/fleet/`, `/contact/`, and the same under `/pl/` and `/ru/`.

- [ ] **Host:** `curl -sI https://www.venixconcierge.com/` → 301 to `https://venixconcierge.com/` (single hop, path preserved, also for `/pl/`, `/ru/`); `http://` → https.
- [ ] **Canonical host:** every canonical, `og:url`, hreflang, sitemap `<loc>` and menu/footer link uses `https://venixconcierge.com` — no `www`, no `http`, no `.local`.
- [ ] **Sitemap:** `$H/sitemap_index.xml` returns 200 (Rank Math, `page-sitemap.xml` listed); `$H/page-sitemap.xml` returns 200; `$H/wp-sitemap.xml` redirects to it; `robots.txt` has the `Sitemap:` line with the production host and does not block public pages.
- [ ] **15 URLs:** `page-sitemap.xml` contains exactly the 15 URLs (5 EN, 5 PL, 5 RU); no `sample-page`, no test/prototype/draft pages; each URL returns 200.
- [ ] **Canonicals:** each page has exactly one canonical equal to its own URL; no EN page points to PL/RU and vice versa.
- [ ] **hreflang:** each page lists en, pl, ru (own URL for itself, correct counterpart for others), reciprocal across the 5 groups; no `x-default` (intentional).
- [ ] **Titles / descriptions:** one `<title>` and one `meta name="description"` per page, matching `scripts/seo/rank-math-seo-data.php`; `<html lang>` is en-US / pl-PL / ru-RU.
- [ ] **Robots:** `index, follow, max-image-preview:large…` on all 15; `noindex` only on non-public pages (`/sample-page/` if still present).
- [ ] **Schema:** Home (each language) has JSON-LD `Organization` + `WebSite` + `WebPage` with production URLs and **no** `SearchAction`; inner pages have no `Article`/`Person` schema; validate with Google Rich Results Test / Schema.org validator.
- [ ] **Open Graph / social:** `og:title`, `og:description`, `og:url` (= canonical), `og:locale` + alternates, `twitter:card`. `og:image` is expected to be missing until a default social image is chosen — record the decision.
- [ ] **No duplicates:** exactly one title, description, canonical, set of OG tags and JSON-LD block per page (view-source; no tags from theme, Polylang or a second SEO/cache plugin).
- [ ] **Regression:** page content, menus and language switcher unchanged; `wp post list --post_type=page --fields=ID,post_modified` unchanged by the script.
- [ ] **Search Console:** submit `$H/sitemap_index.xml`; request indexing for the 5 Home/Contact URLs if desired.
