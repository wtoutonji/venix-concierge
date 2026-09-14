# Input

Single form-field primitive covering text input, select, and textarea.

## Usage
```jsx
<Input id="name" label="Full name" placeholder="Your name" />
<Input id="brief" as="textarea" label="Brief" hint="Optional" />
<Input id="email" label="Email" invalid hint="Enter a valid address" />
```

## Props
- `as`: input | select | textarea (default input).
- `label`, `hint`, `invalid`.

## Behavior
- Error state uses \`--t-border-danger\` / \`--t-fg-danger\` (\`--t-color-danger-500\` #C0392B — the pre-existing approved error red, now managed). Focus uses \`--t-border-focus\` (burgundy).
- Focus and error both express through border colour only — no glow.
- Placeholder colour is taupe; label colour is burgundy.
- In RTL, labels and fields follow logical inline direction automatically.
