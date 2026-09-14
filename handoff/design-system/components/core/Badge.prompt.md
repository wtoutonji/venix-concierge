# Badge

Small uppercase label for service categories, status, and tags.

## Usage
```jsx
<Badge tone="gold" dot>Available 24/7</Badge>
<Badge tone="inverse">Member</Badge>
```

## Props
- `tone`: brand | gold | solid | warm | inverse (default brand).
- `dot`: boolean — gold marker dot.

## Behavior
- Tracking is \`--t-ls-tag\` (0.22em ⇢ 0.16em control tracking), matching the approved badge specimen.
- Uppercase and tracking are Latin-only; RTL base rules remove both for Arabic.
- \`gold\` uses the approved ivory-on-gold treatment; contrast is flagged in COMPLETION-REPORT.md.
