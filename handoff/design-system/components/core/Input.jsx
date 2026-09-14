const fieldBase = {
  width: '100%', fontFamily: 'var(--t-font-body)', fontSize: 'var(--t-fs-sm)',
  color: 'var(--t-fg-default)', background: 'var(--t-bg-page)',
  border: 'var(--t-border-width-hairline) solid var(--t-border-subtle)',
  borderRadius: 'var(--t-radius-sm)', padding: 'var(--t-space-3) var(--t-space-4)',
  letterSpacing: 'var(--t-ls-body)', outline: 'none',
  transition: 'border-color var(--t-motion-transition-base)'
};

export function Input({ as = 'input', label, hint, invalid = false, id, style, ...rest }) {
  const Tag = as === 'textarea' ? 'textarea' : as === 'select' ? 'select' : 'input';
  const field = React.createElement(Tag, {
    id, 'aria-invalid': invalid || undefined, ...rest,
    style: {
      ...fieldBase,
      borderColor: invalid ? 'var(--t-border-danger)' : 'var(--t-border-subtle)',
      ...(Tag === 'textarea' ? { minHeight: 96, resize: 'vertical' } : null),
      ...style
    }
  });
  if (!label && !hint) return field;
  return React.createElement('label', { htmlFor: id, style: { display: 'flex', flexDirection: 'column', gap: 'var(--t-space-2)' } },
    label && React.createElement('span', { style: { fontFamily: 'var(--t-font-body)', fontSize: 'var(--t-fs-xs)', fontWeight: 'var(--t-fw-semibold)', letterSpacing: 'var(--t-ls-subhead)', textTransform: 'uppercase', color: 'var(--t-fg-brand)' } }, label),
    field,
    hint && React.createElement('span', { style: { fontFamily: 'var(--t-font-body)', fontSize: 'var(--t-fs-xs)', letterSpacing: 'var(--t-ls-body)', color: invalid ? 'var(--t-fg-danger)' : 'var(--t-fg-muted)' } }, hint)
  );
}
