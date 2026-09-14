const base = {
  display: 'inline-flex', alignItems: 'center', justifyContent: 'center', gap: 'var(--t-space-2)',
  fontFamily: 'var(--t-font-display)', fontSize: 'var(--t-fs-sm)', fontWeight: 'var(--t-fw-semibold)',
  letterSpacing: 'var(--t-ls-button)', textTransform: 'uppercase', cursor: 'pointer',
  borderRadius: 'var(--t-radius-button)', border: 'var(--t-border-width-hairline) solid transparent',
  transition: 'background var(--t-motion-transition-base), color var(--t-motion-transition-base), border-color var(--t-motion-transition-base)'
};

const sizes = {
  sm: { padding: 'var(--t-space-2) var(--t-space-5)', fontSize: 'var(--t-fs-xs)' },
  md: { padding: 'var(--t-space-3) var(--t-space-8)' },
  lg: { padding: 'var(--t-space-4) var(--t-space-10)', fontSize: 'var(--t-fs-base)' }
};

const variants = {
  primary: { background: 'var(--t-interactive-primary)', color: 'var(--t-fg-inverse)' },
  ghost: { background: 'transparent', color: 'var(--t-fg-brand)', borderColor: 'var(--t-border-strong)' },
  // Approved Venix treatment: ivory on gold. See COMPLETION-REPORT.md §Conflicts (contrast).
  gold: { background: 'var(--t-interactive-accent)', color: 'var(--t-fg-inverse)' },
  text: { background: 'transparent', color: 'var(--t-fg-brand)', padding: '0', fontFamily: 'var(--t-font-body)', letterSpacing: 'var(--t-ls-tag)' },
  'ghost-inverse': { background: 'transparent', color: 'var(--t-fg-inverse)', borderColor: 'var(--t-border-on-inverse)' }
};

export function Button({ variant = 'primary', size = 'md', as = 'button', children, style, ...rest }) {
  const Tag = as;
  return React.createElement(Tag, {
    ...rest,
    style: { ...base, ...sizes[size], ...variants[variant], ...style }
  }, children);
}
