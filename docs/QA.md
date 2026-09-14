# QA Checklist

## Functional
- Header and footer render on all required templates.
- Desktop navigation and mobile menu work with keyboard and touch.
- Search, archive pagination, 404, and empty results are handled.
- Forms have success/error states.
- CPT archives/singles work when present.
- Multilingual switching uses the selected multilingual solution, not DC/prototype client-side language state.

## Content resilience
- Long headings do not break layouts.
- Missing optional fields do not leave empty decorative containers.
- Missing featured images have an intentional fallback.
- Cards remain usable with unequal text lengths.
- RTL behavior is reviewed when applicable.

## Accessibility
- One meaningful H1 per page in normal templates.
- Logical heading hierarchy.
- Landmark elements used correctly.
- Interactive controls are real buttons/links.
- Visible focus states.
- Menus/dialogs can be operated by keyboard.
- Icon-only controls have accessible names.
- Images have appropriate alt handling.
- Motion respects `prefers-reduced-motion`.

## Performance
- No accidental global component assets.
- No unused frontend framework runtime.
- No unneeded font weights.
- Hero/LCP image is not lazy loaded.
- Below-the-fold media is lazy loaded where appropriate.
- Third-party scripts are documented.

## Security / WordPress quality
- Escape dynamic output at render time.
- Sanitize/validate stored input.
- Use nonces and capability checks for mutations.
- Avoid direct SQL unless WordPress APIs are insufficient; prepare queries when SQL is necessary.
- No credentials or secrets committed.
