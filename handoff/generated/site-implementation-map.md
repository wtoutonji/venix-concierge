# Venix site implementation map

## Shared shell

- A single PHP header is fixed on all pages. It uses a configured WordPress primary menu when available; its production fallback includes Home, About, Services, Other Services, Fleet, Contact, the header CTA, and WordPress page URLs.
- Services fallback: Chauffeur & Private Transfers, Airport Transfers, Business & Private Events, Delegations & Diplomatic. Other Services fallback: Private Protection, Private Flights, Embassy Services, Concierge Services, Weddings. All use `/services/#anchor` production URLs.
- Desktop dropdowns use menu hierarchy, hover and focus-within. Below 1024px, the same navigation becomes an overlay: focus enters at its first control, Escape closes and restores focus to the toggle, and Services/Other Services are JavaScript-enhanced accordion controls with `aria-expanded` and `aria-controls`.
- Polylang owns language URLs, translations, `lang`/direction and language state. The conditional switcher has no client-side EN/PL state; link `lang` uses Polylang `hreflang` or language slug, never a locale such as `en_US`.

## Footer

- One shared PHP footer (`template-parts/footer/site-footer.php`, copy and service links from `venix_concierge_footer_content()`) renders the same four columns on every page: Brand, WordPress footer-menu Navigation, production service-anchor links, and Contact. Contact rows (address, phone, WhatsApp, email) come from the global Venix → Site Settings option `venix_site_settings` and are omitted when empty; the copyright name uses Legal Name when set.
- The copyright/legal row sits below the four columns on every page. Legal and footer navigation remain WordPress menu-owned.
- Live configuration: the `footer` location is assigned per language (Footer EN / Footer PL, five page links each) through Polylang; the `legal` location is registered but **unassigned**. See `polylang-implementation-map.md`.

## Current ownership and gaps

- Home default copy stays template-owned and is the canonical fallback; Home, About, Services, Fleet and Contact text and images can be overridden per page from WP Admin (see Editable page content below). Final imagery is not present: current CSS geometry placeholders are not Media Library output. Final media should migrate to attachment APIs with responsive output.
- Project Core has no form backend. Inquiry forms remain visually present but disabled until recipient, privacy wording/URL, retention, anti-spam and delivery behavior are approved. Verified phone, WhatsApp, email, hours/area, fleet configuration and specialist-partner approvals are unresolved (full register below).

## Editable page content (Home, About, Services, Fleet, Contact)

All five page types support structured editable text and Media Library images from WP Admin. Layout, CSS, templates and PHP are never edited by editors.

- **Architecture:** `existing PHP defaults → page-specific _venix_page_content overrides → existing frozen templates`. Project Core (`inc/page-content.php` plus one explicit schema per page: `inc/page-content/schema-{home,about,services,fleet,contact}.php`, and `assets/admin/page-content.*`) owns the schema, the "Venix Page Content" meta box, sanitization and save logic. The theme (`inc/page-content.php`) only reads: `venix_concierge_get_page_content()`, `venix_concierge_get_page_value()`, the image override in `venix_concierge_media_attachment_id()` and the alt override in `venix_concierge_render_media_slot()`. Templates never call `get_post_meta()`. No ACF or third-party plugin.
- **`_venix_page_content` ownership:** one meta array per page. Text overrides mirror the paths of the theme content array of that page (for example `story.copy`, `main.1.benefits.2`, `vehicles.3.name`, `info.next_steps.1`); `media` maps a semantic slot to an attachment ID; `media_alt` maps a slot to an optional contextual alt string. Only paths whitelisted in that page's schema are read or written; unknown keys are dropped on save **and** on read.
- **Fallback behavior:** the theme content arrays stay canonical. A never-saved or emptied field resolves to the theme value; only edits create overrides (defaults are never copied into meta). An override can only replace an existing string, so item counts, order, ids and structure stay fixed. Clearing a field, or ticking "Reset everything on this page" and saving, restores the default; a page with no overrides has no meta row and renders exactly as the theme defaults.
- **EN/PL separation:** each translated page is its own Polylang page entity and owns its own `_venix_page_content`. The key is removed from Polylang meta copy/sync (`pll_copy_post_metas`), so an EN edit never reaches PL (verified on all four page pairs). Templates contain no language checks; language-specific defaults come from the theme content arrays.
- **Image attachment-ID workflow:** every semantic media slot has Select / Replace / Remove Image (native media modal) plus an optional Alt Text field. Only the attachment ID (validated as an image) and the optional alt string are stored. Output is always `wp_get_attachment_image()` inside the existing `venix-media-slot` wrapper (src, srcset, sizes, width, height, loading, decoding preserved); with no image the wrapper stays empty. No raw URLs, no placeholder services.
- **Alt precedence:** (1) page-slot alt override, (2) Media Library attachment alt, (3) the page/language default slot alt stored in that page's content array (`media_alt`, EN and PL), (4) empty alt for decorative images (hero backgrounds). A slot alt is stored independently of the image, but an alt without an image renders nothing.
- **Fixed-repeaters policy:** no add/remove/reorder anywhere. Fixed groups stay fixed (Home cards, About values/process steps, Services benefit points and compact cards, Fleet vehicles/use cases/recommendation questions, Contact next steps); editors change only the content of existing items.
- **Editable fields and slots per page:**

| Page | Text fields | Image slots | Admin panels |
| --- | --- | --- | --- |
| Home | 144 | 13 | Hero, Introduction, Main Services, Quote, Brand Promise, Fleet, Why Venix, Events, How It Works, Other Services, Who We Serve, Testimonial, Inquiry, Images |
| About | 55 | 3 (`about.hero`, `about.story`, `about.culture`) | Hero, Our Story, Purpose / Mission / Vision, How We Work, Values, International Service, Final CTA, Images |
| Services | 72 | 10 (hero + nine services) | Hero (incl. tab labels), Shared Labels, Chauffeur, Airport, Events, Delegations, Other Services Introduction, Protection, Private Flights, Embassy, Concierge, Weddings, Final CTA, Images |
| Fleet | 56 | 10 (hero, five exteriors, four interiors) | Hero, Disclaimer, S-Class, E-Class, V-Class, V-Class Extra Long, Sprinter, Recommendation, Images |
| Contact | 11 | 1 (`contact.hero`) | Hero, Contact Information, Location, Inquiry Introduction, Images |

- **Not editable (any page):** CSS/layout values, ids/anchors, surfaces and split direction, the Services tab bar position/sticky behaviour, step/value numbering, icons, card counts/order and every CTA destination.
- **Site Settings vs page content:** company name, legal name, address, phone, WhatsApp, email, Instagram and Facebook are owned **only** by Venix → Site Settings and are never stored in page meta. The Contact info column renders its phone, WhatsApp, email and address rows from Site Settings (empty setting = row omitted); they are deliberately **not** in the Contact schema, and operating hours are not a Site Settings field and are not shown.
- **Shared components stay separate:** the 9-field inquiry form is owned by `template-parts/components/inquiry-form/` and is not part of Contact (or Home) page meta — only the wording around it is editable. Fleet passenger/luggage capacity is owned only by `venix_concierge_fleet_capacity_data()` and the capacity component; it is not present in any schema.
- **Editor note:** in the block editor the meta box sits in the collapsed "Meta Boxes" panel at the bottom; open it to edit.

## Responsive and interaction contracts

- The approved 480, 768, 1024, 1280 and 1440 breakpoints remain in use. CSS owns layout; only small vanilla JavaScript owns menu/accordion state and optional reduced-motion-aware reveal behavior.

## Shared components

### Vehicle capacity (Home + Fleet)

- **Data source:** `venix_concierge_fleet_capacity_data()` in `inc/content/fleet.php`; vehicle ids `sclass`, `eclass`, `vclass`, `vclassxl`, `sprinter`; each has `passengers` and `luggage`, currently **`null`** (unconfirmed).
- **Rendering:** `venix_concierge_vehicle_capacity()`; a missing value shows `TBC` (EN) / `Do potw.` (PL). The component renders passenger and luggage icons (decorative inline SVG) with screen-reader labels.
- **Component:** `template-parts/components/capacity/capacity.php` + `assets/css/components/capacity.css`, enqueued only on the front page and the Fleet page.
- **Rule:** passenger/luggage numbers are unconfirmed client data and must not be invented. When confirmed values arrive, only the data function is edited.

### Inquiry form (Home + Contact)

- **Partial:** `template-parts/components/inquiry-form/inquiry-form.php` + `assets/css/components/inquiry-form.css`, enqueued on the front page and the Contact page only. Copy comes from the `form` group of `venix_concierge_home_content()` in `inc/content/home.php`.
- **Schema (identical on both pages):** 9 fields — Full Name*, Email Address*, Phone / WhatsApp*, Pickup Date*, Passengers, Pickup Location*, Destination, Required Service*, Message — plus a required consent checkbox.
- **State:** prototype/simulated only. There is no real form backend; the submit button is disabled and labelled “Form setup pending”. This is **not** production-ready submission functionality: no recipient, network request, storage, anti-spam, retention policy or success state exists.

## Final intentional design overrides

Canonical `.dc.html` files are unchanged. Deviations are recorded in each page map: Services (centered desktop tabs, horizontally scrolling mobile tabs, image-first split stacking at ≤768px, sticky tabs `z-index: 90` under the `z-index: 100` header), Fleet (interior pairs stack one per row at ≤480px, 24px gap, global 2px/3px-offset focus ring, shared capacity icons replace text placeholders), and Contact (exact shared Home inquiry form, outer 0.8fr / 1.2fr composition kept).

## Unresolved client data register

None of these has been supplied; none has been invented or filled in.

| Item | Status |
| --- | --- |
| Phone | UNRESOLVED — Site Settings `phone` is empty; footer and Contact omit the row until supplied |
| WhatsApp | UNRESOLVED — Site Settings `whatsapp` is empty; footer and Contact omit the row until supplied |
| Email | UNRESOLVED — Site Settings `email` is empty; footer and Contact omit the row until supplied |
| Operating hours / area | UNRESOLVED — not a Site Settings field and no longer shown on Contact; Home keeps `[Confirm operating area]` |
| Specialist-partner arrangements | UNRESOLVED — Home services disclaimer still carries `[Confirm service partner arrangements]` (PL: `[Do potwierdzenia: ustalenia partnerskie]`) |
| Privacy policy URL/text | UNRESOLVED — no link; consent text carries no policy claim |
| Form recipient / backend | UNRESOLVED — none exists; submit disabled |
| Retention policy | UNRESOLVED |
| Anti-spam provider | UNRESOLVED |
| Map / street address | UNRESOLVED — CSS placeholder block only; no coordinates or embed |
| Polish SEO metadata | UNRESOLVED — no approved PL titles/descriptions; no SEO plugin |
| Production SVG icon set | UNRESOLVED — no set supplied; only the two decorative capacity icons exist as inline SVG |
| Font licensing documentation | UNRESOLVED — three local WOFF2 files are shipped; licence documentation is a project gap |
| Fleet passenger / luggage capacities | UNRESOLVED — data is `null`, rendered TBC / Do potw. |
| Testimonials | UNRESOLVED — approved placeholder retained; no testimonial fabricated |
| Legal menu / legal pages | UNRESOLVED — `legal` location unassigned |
| Photography / Media Library IDs | UNRESOLVED — CSS fallback geometry (see page maps) |
