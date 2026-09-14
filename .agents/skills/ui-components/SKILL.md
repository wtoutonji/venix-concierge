# UI Components

Use for reusable UI primitives.

Priority:
1. native HTML
2. CSS
3. vanilla JS
4. lightweight library only if justified

Client components must:
- be accessible
- support keyboard interaction
- support reduced motion where relevant
- avoid brand-specific styling
- have scoped CSS/JS
- expose stable semantic markup

Client branding is expected in client-owned presentation. Preserve stable
inherited `tly-*` primitive contracts when consuming Teelya components.
