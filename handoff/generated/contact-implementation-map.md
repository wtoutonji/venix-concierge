# Contact implementation map

Source: `handoff/pages/Contact.dc.html`. Status: first production implementation. The approved EN/PL defaults remain theme-owned (`inc/content/contact.php`) and are the fallback; the copy around the form (11 fields: hero, Inquiry Introduction, what-happens-next steps, accessibility labels, map description) and the hero image (`contact.hero`) are overridable per page and per language through the Venix Page Content meta box (see `site-implementation-map.md` → Editable page content). The shared inquiry form is owned by its component and is not page meta. Company phone, WhatsApp, email and address belong only to Venix → Site Settings; the four placeholder rows in the info column are **not** editable here and are pending an ownership decision. Polylang owns server-side URLs, language and translations; no client-side language state or new multilingual architecture is introduced.

SEO record: **Request a Chauffeur in Warsaw | Venix Concierge**. Description: **Contact Venix Concierge to arrange a private chauffeur, airport transfer, event transportation or delegation service in Warsaw.** No SEO owner exists in the project, so these exact approved values are recorded rather than injected through a competing system.

| Area | Exact approved English content / contract | Production mapping and unresolved inputs |
| --- | --- | --- |
| Hero | Eyebrow: “Contact”. H1: “Let us arrange the details”. | `sections/contact.php` + `pages/contact.css`; 48vh, 360px minimum, `#1A0A0C` texture and bottom scrim, bottom padding 72px. No hero photography. |
| Main contact information | “Begin the arrangement”; “Share your requirements. We will handle the rest.”; “Provide your journey details, schedule and any special requirements. Our team will review the information and contact you through your preferred method with a considered proposal.” | 0.8fr / 1.2fr grid, 88px gap, neutral-100, 100px block padding. The information column is sticky at 104px above 768px and static below. Phone, WhatsApp, email and address rows are rendered from Venix → Site Settings (see “Site Settings ownership”); empty settings omit the row, and phone/WhatsApp/email link via `tel:`, `wa.me` and `mailto:`. |
| What happens next | 1. “Your request is reviewed by our team — typically within one business day.” 2. “We prepare a tailored proposal based on your requirements.” 3. “Once confirmed, all details are provided and the arrangement is set.” | Template-owned ordered list with the approved three-step hierarchy. |
| Inquiry form | Design override (user decision): the Contact form is the shared Home inquiry form (`template-parts/components/inquiry-form/inquiry-form.php`, styles in `assets/css/components/inquiry-form.css`) with the same fields, labels, states and disabled submit as Home. The earlier four-step wizard and `contact.js` were removed. No network request, storage, AJAX, email, recipient, anti-spam mechanism or backend is introduced. |
| Fields and options | Superseded canonical four-step wizard field lists (vehicle preference, journey type, vehicle count, luggage, flight number, special-request checkboxes, contact method, company) are **not** implemented. Contact renders the shared Home inquiry schema: Full Name*, Email Address*, Phone / WhatsApp*, Pickup Date*, Passengers, Pickup Location*, Destination, Required Service* (Select a service…; Private transfer / chauffeur hire; Airport transfer; Event transportation; Delegation / diplomatic transfer; Wedding transportation; Concierge assistance; Other / custom quotation) and Message, plus a required consent checkbox. Copy is the Home `form` group in `inc/content/home.php` (EN/PL). | Same 9-field schema and DOM on Home and Contact; native controls with token-driven styling from `assets/css/components/inquiry-form.css`. Fields stack at the shared form breakpoints. |
| Validation and disabled final state | Superseded: canonical inline-error copy and step validation are not implemented. | Native browser `required`/type semantics only. The submit control is actually `disabled` with `aria-disabled=true`, labelled “Form setup pending” (PL equivalent from the Home form group); it cannot submit or claim success. Consent layout is preserved but no Privacy Policy URL/text is verified, so there is no invented link and no claim that consent enables processing. This is a **prototype/simulated form, not production submission functionality.** Form backend, recipient, anti-spam, retention and privacy approval remain unresolved. |
| Future success contract | Heading: “Request received”. Body: “Thank you. The Venix Concierge team will review your details and contact you through your preferred method.” Action: “Send another request”. | Not implemented and not rendered: no runtime success state exists while no real backend returns success. Recorded only as a future integration contract. |
| Location / map | Approved neutral-100 location area, 80px bottom spacing, 280px high small-radius map/media geometry. | Safe CSS fallback only. No external map, coordinates, street address, Google Maps or placeholder service. Verified operating/street address and client map decision are pending. |

Accessibility: one H1; explicit labels; native required and autocomplete semantics; visible focus (global 2px ring, 3px offset); disabled status communicated semantically. Internal shared footer (Brand, Navigation, Contact, legal/copyright) is reused unchanged. Likely production files: `page.php`, `inc/navigation.php`, `inc/assets.php`, `template-parts/sections/contact.php`, `assets/css/pages/contact.css`, and the shared `template-parts/components/inquiry-form/inquiry-form.php` + `assets/css/components/inquiry-form.css`. There is no Contact page JavaScript.

## Final intentional overrides of the canonical `Contact.dc.html`

`handoff/pages/Contact.dc.html` is unchanged; production deliberately differs as follows.

- Contact uses the **exact shared Home inquiry form** instead of the canonical four-step wizard (shared partial and CSS; see `site-implementation-map.md`). The wizard markup, its option lists, inline validation and `contact.js` were removed.
- The outer Contact composition is unchanged: information column and form column at **0.8fr / 1.2fr**, 88px gap.

## Site Settings ownership (resolved)

Global company data is owned only by **Venix → Site Settings**. The Contact detail rows are rendered by `venix_concierge_get_contact_detail_items()` (theme `inc/site-settings.php`), which reads `phone`, `whatsapp`, `email` and `address` through `venix_concierge_get_site_setting()` and builds links with the shared `venix_concierge_get_site_setting_url()` (`tel:`, normalized `wa.me`, `mailto:`). The address is plain text. A row is omitted when its setting is empty, and the whole list is omitted when all four are empty. No placeholder or default text remains.

| Row | Site Settings field | Link | Label (`info.detail_labels`, EN / PL) |
| --- | --- | --- | --- |
| Phone | `phone` | `tel:` | Phone / Telefon |
| WhatsApp | `whatsapp` | normalized `https://wa.me/…` | WhatsApp / WhatsApp |
| Email | `email` | `mailto:` | Email / E-mail |
| Address | `address` | none | Address / Adres |

The values are shared across languages; only the labels are translated theme strings (screen-reader prefixes, and the visible `WhatsApp ·` prefix). They are not Contact page meta and are absent from the Contact editor schema. Operating hours are not a Site Settings field, are not rendered, and are not invented; if wanted later they become their own Site Settings field.

Also noted, unchanged: Home `form.contact_note` (`Warsaw, Poland · [Confirm operating area]`, editable on Home as wording around the shared form) is an area/hours line, not a Site Settings field. No Instagram/Facebook, company-name or legal-name values exist in any page body; the brand name appears only inside running prose.
