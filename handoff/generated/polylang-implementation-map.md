# Venix Concierge Polylang Pro implementation map

## Ownership

**WordPress / Polylang Pro** owns page entities, `en`/`pl` languages, translation
relationships, shared slugs, the translated static front-page relationship,
permalink generation, menu assignment, current language, and language-switcher
destinations. The theme never constructs language-directory URLs.

**Theme** owns the frozen PHP page structures, visual composition, approved
server-side EN/PL launch copy, page-role routing, and interaction behavior.
Small reusable shell strings are selected server-side by `inc/i18n.php`.
Rendered-HTML translation and output buffering are prohibited; each visible
template node must consume explicit current-language content data.

**Client / future verified data** owns photography, contact values, privacy
policy, form backend, and approved Polish SEO metadata where it has not been
supplied. A future editorial-CMS pass may move suitable structured copy to
WordPress fields; this launch pass does not rebuild the precision layouts as
Gutenberg blocks.

## Page matrix

| Role | EN / PL entity | Shared slug | PHP template | Content | Relationship/menu | SEO |
| --- | --- | --- | --- | --- | --- | --- |
| Home | Home / Strona główna | static front-page pair | `front-page.php` + `sections/home.php` | theme data + per-page overrides (`_venix_page_content`, per language) | Polylang pair; primary/footer menus | EN approved in handoff; PL unresolved |
| About | About / O nas | `about` | `page.php` + `sections/about.php` | theme data + per-page overrides (`_venix_page_content`, per language) | Polylang pair; primary/footer menus | EN approved; PL unresolved |
| Services | Services / Usługi | `services` | `page.php` + `sections/services.php` | theme data + per-page overrides (`_venix_page_content`, per language) | Polylang pair; primary/footer menus | EN approved; PL unresolved |
| Fleet | Fleet / Flota | `fleet` | `page.php` + `sections/fleet.php` | theme data + per-page overrides (`_venix_page_content`, per language) | Polylang pair; primary/footer menus | EN approved; PL unresolved |
| Contact | Contact / Kontakt | `contact` | `page.php` + `sections/contact.php` | theme data + per-page overrides (`_venix_page_content`, per language) | Polylang pair; primary/footer menus | EN approved; PL unresolved |

Polylang Pro shared slugs are required for the four non-home translation pairs.
The services fragments remain unchanged in both languages: `chauffeur`,
`airport`, `events`, `delegations`, `protection`, `flights`, `embassy`,
`concierge`, and `weddings`.

## Runtime rules

- `venix_concierge_current_language()` calls `pll_current_language( 'slug' )`
  when available and safely falls back to English.
- `venix_concierge_page_url()` resolves the canonical shared-slug page, asks
  `pll_get_post()` for its current-language translation, then calls
  `get_permalink()`. Home uses `pll_home_url()`.
- The switcher consumes `pll_the_languages()` raw data with
  `hide_if_no_translation`; it only emits valid same-page translation URLs and
  marks the current item with `aria-current="page"`.
- Menus remain WordPress/Polylang data. The theme fallback is only for an
  unassigned menu and uses the same URL resolver.
- Contact renders the shared inquiry form partial with server-selected
  current-language copy. There is no Contact behavior script and no
  language-state or UI-copy dictionary in JavaScript.

## Classic menu configuration (live, verified)

Polylang 3.8.5 stores per-language classic-menu location assignments in its
own managed options after the WordPress Admin menu-location workflow. It does
not expose a stable public API to assign those locations, so the bootstrap
script does **not** write plugin internals. The menus below were created in
**Appearance → Menus** and assigned through Polylang's language-aware Locations
UI. Verified read-only against `http://venix-concierge.local` (matches
`LOCAL_URL`); no menu data was changed in the handoff pass.

| Menu | Location (Polylang key) | Items in order |
| --- | --- | --- |
| Primary EN | `primary` | Home, About, Services (Chauffeur & Private Transfers; Airport Transfers; Business & Private Events; Delegations & Diplomatic), Other Services (Private Protection; Embassy Services; Private Flights; Concierge Services; Weddings), Fleet, Contact |
| Primary PL | `primary` (PL) | Strona główna, O nas, Usługi (Szofer i transfery prywatne; Transfery lotniskowe; Wydarzenia biznesowe i prywatne; Delegacje i dyplomacja), Inne usługi (Ochrona osobista; Obsługa ambasad; Loty prywatne; Usługi concierge; Śluby i wesela), Flota, Kontakt |
| Footer EN | `footer` | Home, About, Services, Fleet, Contact |
| Footer PL | `footer` (PL) | Strona główna, O nas, Usługi, Flota, Kontakt |

- Every Services child uses its translated Services page plus the unchanged
  fragment ID (`/services/#chauffeur` and `/pl/services/#chauffeur`, etc.).
  The “Other Services” / “Inne usługi” parents are custom links to the
  Services page.
- The `footer` location is assigned **per language**: `footer` → Footer EN and
  `footer___pl` → Footer PL. Likewise `primary` → Primary EN and
  `primary___pl` → Primary PL. The shared PHP footer consumes whichever menu
  Polylang resolves for the current language.
- The `legal` location is registered by the theme but **remains unassigned**.
  The footer renders no legal menu until approved legal/privacy pages and
  menu data are supplied (see unresolved client data in
  `site-implementation-map.md`).
- Programmatic assignment by the setup script remains prohibited; re-assign
  through the Polylang Locations UI if a menu is ever recreated.

## SEO matrix

| Page | EN | PL |
| --- | --- | --- |
| Home | APPROVED canonical handoff metadata | UNRESOLVED — approved Polish SEO copy required |
| About | APPROVED canonical handoff metadata | UNRESOLVED — approved Polish SEO copy required |
| Services | APPROVED canonical handoff metadata | UNRESOLVED — approved Polish SEO copy required |
| Fleet | APPROVED canonical handoff metadata | UNRESOLVED — approved Polish SEO copy required |
| Contact | APPROVED canonical handoff metadata | UNRESOLVED — approved Polish SEO copy required |

No SEO plugin, custom Polish meta description, canonical, or hreflang output
is introduced here; those remain with Polylang and the future SEO owner.

## Copy completion status

| Page | Status |
| --- | --- |
| Home | COMPLETE — `inc/content/home.php` explicitly maps all approved canonical Home visible EN/PL copy, including testimonial and inquiry form (the footer is shared; see below). The inquiry (shared inquiry-form partial) remains a disabled prototype with no backend behavior. |
| About | COMPLETE — `inc/content/about.php` explicitly maps all approved canonical About visible EN/PL copy (footer copy lives in the shared `inc/content/footer.php`). |
| Services | COMPLETE — `inc/content/services.php` explicitly maps all approved canonical Services visible EN/PL copy (footer copy lives in the shared `inc/content/footer.php`). |
| Fleet | COMPLETE — `inc/content/fleet.php` explicitly maps all approved canonical Fleet visible EN/PL copy (footer copy lives in the shared `inc/content/footer.php`). |
| Contact | COMPLETE — `inc/content/contact.php` explicitly maps the approved Contact hero, information column, next-steps and map copy; phone, WhatsApp, email and address come from Venix → Site Settings, and footer copy lives in the shared `inc/content/footer.php`. The form is the shared Home inquiry form (`inc/content/home.php` `form` group); submission remains disabled. |

### Home completion findings

- Testimonial: COMPLETE — approved quote and attribution placeholders are explicitly mapped.
- Inquiry Form: COMPLETE — approved eyebrow, introduction, field labels, service options, consent, and prototype status text are explicitly mapped; the disabled `Form setup pending` button is an approved unresolved implementation placeholder retained as explicit Home data.
- Shared Footer: COMPLETE — one footer for every page; brand copy, column headings and service labels are mapped EN/PL in `inc/content/footer.php`. Contact rows come from Venix → Site Settings (no in-code contact placeholder). WordPress/Polylang remains the owner of menu labels and legal-menu content.
- Accessibility-only strings without approved Polish wording in `Home.dc.html`: `Venix Concierge home`, `Open menu`, `Primary navigation`, `Photography placeholder: chauffeur beside a premium vehicle in Warsaw.`, `Photography placeholder: chauffeur adjusting cufflinks.`, and `Legal navigation`. These remain safe current-language-neutral/English accessibility labels and do not affect approved visible Home copy completion.

### About completion findings

- About PL status: COMPLETE.
- PMV: COMPLETE — 3 items in canonical order.
- Approach: COMPLETE — 6 items in canonical order.
- Values: COMPLETE — 5 items in canonical order.
- Cultural: COMPLETE — 4 points in canonical order.
- Accessibility-only strings without approved Polish wording in `About.dc.html`: `Photography placeholder: a black Mercedes-Benz on a Warsaw boulevard in warm evening light.`, `Photography placeholder: international travellers arriving at Warsaw airport, greeted by a Venix Concierge representative.`, `Venix Concierge home`, `Open menu`, `Primary navigation`, and `Legal navigation`. They remain safe existing labels and do not affect approved visible About copy completion.

### Services completion findings

- Services PL status: COMPLETE.
- Sticky service navigation: COMPLETE — 9 canonical labels retain the stable `chauffeur`, `airport`, `events`, `delegations`, `protection`, `flights`, `embassy`, `concierge`, and `weddings` fragments.
- Main services: COMPLETE — Chauffeur (5 benefits), Airport (5 benefits), Events (6 benefits), and Delegations (5 benefits) remain in canonical order.
- Additional services: COMPLETE — Protection, Flights, and 3 compact services (Embassy, Concierge, Weddings) explicitly map approved copy in canonical order.
- Services footer: COMPLETE — Services-specific brand copy, navigation/contact headings, and location are explicitly mapped; WordPress/Polylang remains the owner of actual menu labels.
- Accessibility-only strings without approved Polish wording in `Services.dc.html`: `Service sections`; the four main-service photography labels; `Photography placeholder: a discreet private protection coordination scenario.`; `Photography placeholder: a private aviation terminal with a Mercedes-Benz S-Class nearby.`; compact-card `Photography placeholder for [service title].`; `Venix Concierge home`; `Open menu`; `Primary navigation`; and `Legal navigation`. They remain safe existing labels and do not affect approved visible Services copy completion.

### Fleet completion findings

- Fleet PL status: COMPLETE.
- Frozen page areas: COMPLETE — Hero, availability notice, five vehicles, and recommendation retain the 8-area sequence.
- Vehicles: COMPLETE — S-Class, E-Class, V-Class, V-Class Extra Long, and Sprinter remain in canonical order; each retains 3 use cases.
- Interiors: COMPLETE — S-Class has 2 approved interior descriptions and V-Class has 2; no interiors were introduced for other vehicles.
- Capacity: the earlier `[Confirm passenger & luggage capacity]` text placeholder is superseded by the shared capacity component. Values are `null` in `venix_concierge_fleet_capacity_data()` and render as `TBC` (EN) / `Do potw.` (PL); no capacities are fabricated (see `site-implementation-map.md`).
- Fleet footer: COMPLETE — Fleet-specific brand copy, navigation/contact headings, and location are explicitly mapped; WordPress/Polylang remains the owner of actual menu labels.
- Accessibility-only strings without approved Polish wording in `Fleet.dc.html`: `Venix Concierge home`, `Open menu`, `Primary navigation`, and `Legal navigation`; the approved vehicle and interior accessibility wording is explicitly mapped. These remaining safe labels do not affect approved visible Fleet copy completion.

### Contact completion findings

- Contact PL status: COMPLETE — all 3 frozen page areas are explicitly mapped.
- Inquiry UI: intentional design override — Contact renders the exact shared Home inquiry form (9 fields plus consent, 7 service options plus placeholder) via `template-parts/components/inquiry-form/inquiry-form.php`. The canonical four-step wizard, its step/vehicle/journey option lists, and its inline-validation script were removed.
- Validation: native browser required/type semantics only; no custom validation summary or per-field error script is loaded on Contact.
- Submission: intentionally disabled (`Form setup pending`); no backend, recipient, network, storage, simulated success, or processing behavior is present.
- Contact detail rows (phone, WhatsApp, email, address) come from Venix → Site Settings and are shared across languages; only the row labels (Phone/Telefon, WhatsApp, Email/E-mail, Address/Adres) are translated. Empty settings omit the row. The footer reads the same settings. All values remain unresolved client data until supplied in Site Settings.
- Contact footer: COMPLETE — Contact-specific brand copy, tagline, navigation/contact headings, and location are explicitly mapped; WordPress/Polylang remains the owner of actual menu labels.
- Accessibility-only strings without approved Polish wording in `Contact.dc.html`: `Venix Concierge home`, `Open menu`, `Primary navigation`, and `Legal navigation`. The map label has approved Polish wording and is explicitly mapped.
- Polish SEO: UNRESOLVED — no approved Polish title or description exists; no SEO system or English meta is forced onto Polish.

## Local setup gate

Before page/menu mutations: confirm Polylang Pro is active, confirm existing
`en` and `pl` language records/locales, verify the LocalWP target URL exactly,
then create or reuse the five page pairs idempotently with WordPress and
Polylang APIs. Do not use SQL or modify rewrite settings. Verify resulting
`post_name` values are exactly `about`, `services`, `fleet`, and `contact` for
both translations; report a shared-slug configuration issue if WordPress
instead produces a suffixed slug.
