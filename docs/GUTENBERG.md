# Gutenberg Client Policy

PHP owns global structure. Gutenberg owns appropriate editable content.
`theme.json` is preset-first and client projects should expose only reviewed
design controls.

The starter preserves WordPress/plugin block policy by default and provides a
generated project-prefixed `narrow_allowed_blocks()` helper. Client curation
must follow:

```text
incoming true  -> project allowlist
incoming array -> intersection with the project allowlist
incoming false -> false
```

Return the incoming value outside the targeted editor context. Preserve the
WooCommerce Product editor policy unless the project has tested a narrower
policy against the live WooCommerce version.
