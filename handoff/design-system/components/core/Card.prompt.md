# Card

Quiet container for a service, feature, or statement. Hairline border, \`--t-radius-card\` (3px), generous 32px padding — elevation is optional and always soft.

## Usage
```jsx
<Card eyebrow="01" title="Private Aviation">Seat-level curation on every leg.</Card>
<Card tone="inverse" title="Membership">Invitation only.</Card>
```

## Props
- `tone`: surface | warm | inverse (default surface).
- `elevated`: boolean — adds `--t-shadow-card`.
- `eyebrow`, `title`, `children`.

## Behavior
- `inverse` switches body copy to champagne for contrast on deep wine.
- Titles are uppercase Cinzel in Latin; Arabic context uses Noto Sans Arabic without uppercasing.
