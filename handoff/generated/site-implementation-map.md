# Venix site implementation map

## Shared shell

- A single PHP header is fixed on all pages. It uses a configured WordPress primary menu when available; its production fallback includes Home, About, Services, Other Services, Fleet, Contact, the header CTA, and WordPress page URLs.
- Services fallback: Chauffeur & Private Transfers, Airport Transfers, Business & Private Events, Delegations & Diplomatic. Other Services fallback: Private Protection, Private Flights, Embassy Services, Concierge Services, Weddings. All use `/services/#anchor` production URLs.
- Desktop dropdowns use menu hierarchy, hover and focus-within. Below 1024px, the same navigation becomes an overlay: focus enters at its first control, Escape closes and restores focus to the toggle, and Services/Other Services are JavaScript-enhanced accordion controls with `aria-expanded` and `aria-controls`.
- Polylang owns language URLs, translations, `lang`/direction and language state. The conditional switcher has no client-side EN/PL state; link `lang` uses Polylang `hreflang` or language slug, never a locale such as `en_US`.

## Footer

- One shared PHP footer supports variants. Home (`site-footer--home`) renders four columns: Brand, WordPress footer-menu Navigation, production service-anchor links, and Contact, then the copyright/legal row. Contact details remain explicitly unconfirmed.
- Internal pages retain the simpler shared Brand, Navigation and Contact layout plus the copyright/legal row. Legal and footer navigation remain WordPress menu-owned.

## Current ownership and gaps

- Home default copy is template-owned in this first phase pending an approved native WordPress content migration. Final imagery is not present: current CSS geometry placeholders are not Media Library output. Final media should migrate to attachment APIs with responsive output.
- Project Core has no form backend. Inquiry forms remain visually present but disabled until recipient, privacy wording/URL, retention, anti-spam and delivery behavior are approved. Verified phone, WhatsApp, email, hours/area, fleet configuration and specialist-partner approvals are unresolved.

## Responsive and interaction contracts

- The approved 480, 768, 1024, 1280 and 1440 breakpoints remain in use. CSS owns layout; only small vanilla JavaScript owns menu/accordion state and optional reduced-motion-aware reveal behavior.
