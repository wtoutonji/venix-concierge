const base = {
  background: 'var(--t-bg-surface)', border: 'var(--t-border-width-hairline) solid var(--t-border-subtle)',
  borderRadius: 'var(--t-radius-card)', padding: 'var(--t-space-8)',
  display: 'flex', flexDirection: 'column', gap: 'var(--t-space-4)',
  transition: 'background var(--t-motion-transition-base), box-shadow var(--t-motion-transition-base)'
};

const tones = {
  surface: {},
  warm: { background: 'var(--t-bg-surface-warm)', borderColor: 'var(--t-border-warm)' },
  inverse: { background: 'var(--t-bg-inverse)', borderColor: 'transparent', color: 'var(--t-fg-inverse)' }
};

export function Card({ tone = 'surface', elevated = false, rule = false, title, eyebrow, children, style, ...rest }) {
  const inverse = tone === 'inverse';
  return React.createElement('div', {
    ...rest,
    style: { ...base, ...tones[tone], boxShadow: elevated ? 'var(--t-shadow-card)' : 'none', ...style }
  },
    rule && React.createElement('span', { style: { display: 'block', width: 24, height: 'var(--t-border-width-rule)', background: 'var(--t-color-accent-500)' } }),
    eyebrow && React.createElement('span', { style: { fontFamily: 'var(--t-font-body)', fontSize: 'var(--t-fs-xs)', fontWeight: 'var(--t-fw-semibold)', letterSpacing: 'var(--t-ls-display)', textTransform: 'uppercase', color: inverse ? 'var(--t-fg-inverse-muted)' : 'var(--t-fg-muted)' } }, eyebrow),
    title && React.createElement('h3', { style: { margin: 0, fontFamily: 'var(--t-font-display)', fontSize: 'var(--t-fs-lg)', fontWeight: 'var(--t-fw-semibold)', letterSpacing: 'var(--t-ls-subhead)', lineHeight: 'var(--t-lh-snug)', textTransform: 'uppercase', color: inverse ? 'var(--t-fg-inverse-muted)' : 'var(--t-fg-brand)' } }, title),
    React.createElement('div', { style: { fontFamily: 'var(--t-font-body)', fontSize: 'var(--t-fs-sm)', lineHeight: 'var(--t-lh-normal)', letterSpacing: 'var(--t-ls-body)', color: inverse ? 'var(--t-fg-muted)' : 'var(--t-fg-default)' } }, children)
  );
}
