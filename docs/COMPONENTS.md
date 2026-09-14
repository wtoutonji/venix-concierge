# Client Component Guidance

The pinned starter includes Experimental Teelya components and layout
primitives: Breadcrumb, Pagination, Container, Section, Grid, Stack,
Accordion, Dialog, and Card Shell.

- Consume stable inherited `tly-*` markup/CSS contracts without renaming them.
- Apply client branding through the client design system and scoped styles.
- Compose inherited components and create client-owned components or sections
  when the approved design requires them.
- Keep component PHP server-rendered and JavaScript progressively enhancing.
- Load conditional component CSS/JavaScript only when used.
- Test accessibility, reduced motion, responsive behavior and missing content.

These inherited components remain Experimental. Record reusable discoveries as
upstream candidates, but do not modify the Teelya master automatically.
