# Home implementation map

Source: `handoff/pages/Home.dc.html`. Status: fidelity-corrected first phase. The approved English defaults remain template-owned pending an approved native WordPress content migration.

| Ordered section | Production mapping and owner | Notes |
| --- | --- | --- |
| Header / mobile navigation | Shared header + WordPress menus / Polylang | Fixed; desktop dropdowns and mobile nested navigation. |
| Cinematic hero | `sections/home.php` + `pages/home.css` | Template structure; hero Media Library asset pending, 100vh/min-height/scrim retained. |
| Trust intro | Home editorial split | Template-owned approved English default; portrait geometry placeholder pending media migration. |
| Main services | Home service cards | Repeatable editorial content now template defaults; service page anchors/confirmations pending. |
| Editorial quote band | Home quote band | Quote approval and wide image pending. |
| Brand promise | Editorial inverse split | Copy/photo pending. |
| Fleet | Fleet preview cards | Vehicle names shown; each card renders the shared capacity component (`template-parts/components/capacity/capacity.php`) with values unconfirmed (`TBC` / `Do potw.`). Fleet configuration and all photography pending. |
| Why Venix | Pillar grid | Claims require client approval. |
| Events & delegations | Inverse split CTA | Venue/delegation imagery and service confirmation pending. |
| How it works | Ordered process | Template structural composition. |
| Additional services | Editorial band | Protection/flights/concierge partners must be verified. |
| Who we serve | Inverse audience band | Editorial translation approval pending. |
| Testimonial | Placeholder band | Explicit approved no-fabricated-testimonial and client permission placeholder retained. |
| Inquiry | Shared inquiry-form partial (disabled prototype) | Rendered by `template-parts/components/inquiry-form/inquiry-form.php` (also used by Contact). Labels/required semantics/select/textarea/consent are present; the submit button is disabled (“Form setup pending”); no backend or success state. Privacy URL, destination, anti-spam, contact details are blockers. |
| Footer | Shared footer home variant | Menu-owned navigation; verified contact/legal details pending. |

Files: `front-page.php`, `template-parts/sections/home.php`, shared header/footer, `assets/css/pages/home.css`, component button/input/capacity/inquiry-form CSS, and reveal behavior. The section reveal is visual-only and disabled for reduced motion. Current media is intentional CSS geometry only, not Media Library output; final images must be Media Library attachments with responsive WordPress output.
