# Venix site implementation map

## Shared shell

- A single PHP header is fixed on all pages. It uses a configured WordPress primary menu when available; its production fallback includes Home, About, Services, Other Services, Fleet, Contact, the header CTA, and WordPress page URLs.
- Services fallback: Chauffeur & Private Transfers, Airport Transfers, Business & Private Events, Delegations & Diplomatic. Other Services fallback: Private Protection, Private Flights, Embassy Services, Concierge Services, Weddings. All use `/services/#anchor` production URLs.
- Desktop dropdowns use menu hierarchy, hover and focus-within. Below 1024px, the same navigation becomes an overlay: focus enters at its first control, Escape closes and restores focus to the toggle, and Services/Other Services are JavaScript-enhanced accordion controls with `aria-expanded` and `aria-controls`.
- Polylang owns language URLs, translations, `lang`/direction and language state. The conditional switcher has no client-side EN/PL state; link `lang` uses Polylang `hreflang` or language slug, never a locale such as `en_US`.

## Footer

- One shared PHP footer supports variants. Home (`site-footer--home`) renders four columns: Brand, WordPress footer-menu Navigation, production service-anchor links, and Contact, then the copyright/legal row. Contact details remain explicitly unconfirmed.
- Internal pages retain the simpler shared Brand, Navigation and Contact layout plus the copyright/legal row. Legal and footer navigation remain WordPress menu-owned.
- Live configuration: the `footer` location is assigned per language (Footer EN / Footer PL, five page links each) through Polylang; the `legal` location is registered but **unassigned**. See `polylang-implementation-map.md`.

## Current ownership and gaps

- Home default copy is template-owned in this first phase pending an approved native WordPress content migration. Final imagery is not present: current CSS geometry placeholders are not Media Library output. Final media should migrate to attachment APIs with responsive output.
- Project Core has no form backend. Inquiry forms remain visually present but disabled until recipient, privacy wording/URL, retention, anti-spam and delivery behavior are approved. Verified phone, WhatsApp, email, hours/area, fleet configuration and specialist-partner approvals are unresolved (full register below).

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
| Phone | UNRESOLVED — `[Insert verified phone number]` placeholders |
| WhatsApp | UNRESOLVED — `[Insert WhatsApp number]` placeholder |
| Email | UNRESOLVED — `[Insert verified email address]` placeholder |
| Operating hours / area | UNRESOLVED — `[Confirm operating hours]` (Contact) and `[Confirm operating area]` (Home) |
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
