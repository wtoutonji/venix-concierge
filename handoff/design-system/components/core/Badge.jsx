const base = {
  display: 'inline-flex', alignItems: 'center', gap: 'var(--t-space-2)',
  fontFamily: 'var(--t-font-body)', fontSize: 'var(--t-fs-xs)', fontWeight: 'var(--t-fw-semibold)',
  letterSpacing: 'var(--t-ls-tag)', textTransform: 'uppercase',
  padding: 'var(--t-space-1) var(--t-space-3)', borderRadius: 'var(--t-radius-sm)',
  border: 'var(--t-border-width-hairline) solid transparent'
};

const tones = {
  brand: { background: 'var(--t-bg-subtle)', color: 'var(--t-fg-brand)', borderColor: 'var(--t-border-subtle)' },
  outline: { background: 'transparent', color: 'var(--t-fg-brand)', borderColor: 'var(--t-border-strong)' },
  // Approved Venix treatment: ivory on gold. See COMPLETION-REPORT.md §Conflicts (contrast).
  gold: { background: 'var(--t-interactive-accent)', color: 'var(--t-fg-inverse)' },
  solid: { background: 'var(--t-interactive-primary)', color: 'var(--t-fg-inverse)' },
  dark: { background: 'var(--t-bg-inverse)', color: 'var(--t-fg-inverse-muted)' },
  muted: { background: 'var(--t-color-neutral-200)', color: 'var(--t-fg-muted)' },
  warm: { background: 'var(--t-bg-surface-warm)', color: 'var(--t-fg-brand-strong)', borderColor: 'var(--t-border-warm)' },
  inverse: { background: 'transparent', color: 'var(--t-fg-inverse-muted)', borderColor: 'var(--t-border-on-inverse)' }
};

export function Badge({ tone = 'brand', dot = false, children, style, ...rest }) {
  return React.createElement('span', {
    ...rest,
    style: { ...base, ...tones[tone], ...style }
  },
    dot && React.createElement('span', { style: { width: 5, height: 5, borderRadius: '50%', background: 'var(--t-fg-accent)', flexShrink: 0 } }),
    children
  );
}
