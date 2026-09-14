# Button

Primary call-to-action control of the Venix Concierge system. Reserved, uppercase, minimal radius (6px) — never pill-shaped.

## Usage
```jsx
<Button variant="primary" size="lg">Request Consultation</Button>
<Button variant="ghost">View Services</Button>
<Button variant="ghost-inverse">Discover</Button>
```

## Props
- `variant`: primary | ghost | gold | text | ghost-inverse (default primary). Use `ghost-inverse` on deep wine / burgundy grounds.
- `size`: sm | md | lg (default md).
- `as`: button | a.

## Behavior
- Hover darkens burgundy to deep wine over `--t-motion-transition-base`.
- Uppercase and letter-spacing are Latin-only; the RTL base rules remove both for Arabic.
- Minimum hit height 44px at `size="md"` and above.
