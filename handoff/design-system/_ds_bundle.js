/* @ds-bundle: {"format":4,"namespace":"VenixConciergeDesignSystem_019dd5","components":[{"name":"Badge","sourcePath":"components/core/Badge.jsx"},{"name":"Button","sourcePath":"components/core/Button.jsx"},{"name":"Card","sourcePath":"components/core/Card.jsx"},{"name":"Input","sourcePath":"components/core/Input.jsx"}],"sourceHashes":{"components/core/Badge.jsx":"27dbfe9fbd59","components/core/Button.jsx":"ecf49dc12550","components/core/Card.jsx":"1ea82af8eb71","components/core/Input.jsx":"a7661d6fd35b","index.js":"ab59b9c5baf5"},"inlinedExternals":[],"unexposedExports":[]} */

(() => {

const __ds_ns = (window.VenixConciergeDesignSystem_019dd5 = window.VenixConciergeDesignSystem_019dd5 || {});

const __ds_scope = {};

(__ds_ns.__errors = __ds_ns.__errors || []);

// components/core/Badge.jsx
try { (() => {
const base = {
  display: 'inline-flex',
  alignItems: 'center',
  gap: 'var(--t-space-2)',
  fontFamily: 'var(--t-font-body)',
  fontSize: 'var(--t-fs-xs)',
  fontWeight: 'var(--t-fw-semibold)',
  letterSpacing: 'var(--t-ls-tag)',
  textTransform: 'uppercase',
  padding: 'var(--t-space-1) var(--t-space-3)',
  borderRadius: 'var(--t-radius-sm)',
  border: 'var(--t-border-width-hairline) solid transparent'
};
const tones = {
  brand: {
    background: 'var(--t-bg-subtle)',
    color: 'var(--t-fg-brand)',
    borderColor: 'var(--t-border-subtle)'
  },
  outline: {
    background: 'transparent',
    color: 'var(--t-fg-brand)',
    borderColor: 'var(--t-border-strong)'
  },
  // Approved Venix treatment: ivory on gold. See COMPLETION-REPORT.md §Conflicts (contrast).
  gold: {
    background: 'var(--t-interactive-accent)',
    color: 'var(--t-fg-inverse)'
  },
  solid: {
    background: 'var(--t-interactive-primary)',
    color: 'var(--t-fg-inverse)'
  },
  dark: {
    background: 'var(--t-bg-inverse)',
    color: 'var(--t-fg-inverse-muted)'
  },
  muted: {
    background: 'var(--t-color-neutral-200)',
    color: 'var(--t-fg-muted)'
  },
  warm: {
    background: 'var(--t-bg-surface-warm)',
    color: 'var(--t-fg-brand-strong)',
    borderColor: 'var(--t-border-warm)'
  },
  inverse: {
    background: 'transparent',
    color: 'var(--t-fg-inverse-muted)',
    borderColor: 'var(--t-border-on-inverse)'
  }
};
function Badge({
  tone = 'brand',
  dot = false,
  children,
  style,
  ...rest
}) {
  return React.createElement('span', {
    ...rest,
    style: {
      ...base,
      ...tones[tone],
      ...style
    }
  }, dot && React.createElement('span', {
    style: {
      width: 5,
      height: 5,
      borderRadius: '50%',
      background: 'var(--t-fg-accent)',
      flexShrink: 0
    }
  }), children);
}
Object.assign(__ds_scope, { Badge });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Badge.jsx", error: String((e && e.message) || e) }); }

// components/core/Button.jsx
try { (() => {
const base = {
  display: 'inline-flex',
  alignItems: 'center',
  justifyContent: 'center',
  gap: 'var(--t-space-2)',
  fontFamily: 'var(--t-font-display)',
  fontSize: 'var(--t-fs-sm)',
  fontWeight: 'var(--t-fw-semibold)',
  letterSpacing: 'var(--t-ls-button)',
  textTransform: 'uppercase',
  cursor: 'pointer',
  borderRadius: 'var(--t-radius-button)',
  border: 'var(--t-border-width-hairline) solid transparent',
  transition: 'background var(--t-motion-transition-base), color var(--t-motion-transition-base), border-color var(--t-motion-transition-base)'
};
const sizes = {
  sm: {
    padding: 'var(--t-space-2) var(--t-space-5)',
    fontSize: 'var(--t-fs-xs)'
  },
  md: {
    padding: 'var(--t-space-3) var(--t-space-8)'
  },
  lg: {
    padding: 'var(--t-space-4) var(--t-space-10)',
    fontSize: 'var(--t-fs-base)'
  }
};
const variants = {
  primary: {
    background: 'var(--t-interactive-primary)',
    color: 'var(--t-fg-inverse)'
  },
  ghost: {
    background: 'transparent',
    color: 'var(--t-fg-brand)',
    borderColor: 'var(--t-border-strong)'
  },
  // Approved Venix treatment: ivory on gold. See COMPLETION-REPORT.md §Conflicts (contrast).
  gold: {
    background: 'var(--t-interactive-accent)',
    color: 'var(--t-fg-inverse)'
  },
  text: {
    background: 'transparent',
    color: 'var(--t-fg-brand)',
    padding: '0',
    fontFamily: 'var(--t-font-body)',
    letterSpacing: 'var(--t-ls-tag)'
  },
  'ghost-inverse': {
    background: 'transparent',
    color: 'var(--t-fg-inverse)',
    borderColor: 'var(--t-border-on-inverse)'
  }
};
function Button({
  variant = 'primary',
  size = 'md',
  as = 'button',
  children,
  style,
  ...rest
}) {
  const Tag = as;
  return React.createElement(Tag, {
    ...rest,
    style: {
      ...base,
      ...sizes[size],
      ...variants[variant],
      ...style
    }
  }, children);
}
Object.assign(__ds_scope, { Button });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Button.jsx", error: String((e && e.message) || e) }); }

// components/core/Card.jsx
try { (() => {
const base = {
  background: 'var(--t-bg-surface)',
  border: 'var(--t-border-width-hairline) solid var(--t-border-subtle)',
  borderRadius: 'var(--t-radius-card)',
  padding: 'var(--t-space-8)',
  display: 'flex',
  flexDirection: 'column',
  gap: 'var(--t-space-4)',
  transition: 'background var(--t-motion-transition-base), box-shadow var(--t-motion-transition-base)'
};
const tones = {
  surface: {},
  warm: {
    background: 'var(--t-bg-surface-warm)',
    borderColor: 'var(--t-border-warm)'
  },
  inverse: {
    background: 'var(--t-bg-inverse)',
    borderColor: 'transparent',
    color: 'var(--t-fg-inverse)'
  }
};
function Card({
  tone = 'surface',
  elevated = false,
  rule = false,
  title,
  eyebrow,
  children,
  style,
  ...rest
}) {
  const inverse = tone === 'inverse';
  return React.createElement('div', {
    ...rest,
    style: {
      ...base,
      ...tones[tone],
      boxShadow: elevated ? 'var(--t-shadow-card)' : 'none',
      ...style
    }
  }, rule && React.createElement('span', {
    style: {
      display: 'block',
      width: 24,
      height: 'var(--t-border-width-rule)',
      background: 'var(--t-color-accent-500)'
    }
  }), eyebrow && React.createElement('span', {
    style: {
      fontFamily: 'var(--t-font-body)',
      fontSize: 'var(--t-fs-xs)',
      fontWeight: 'var(--t-fw-semibold)',
      letterSpacing: 'var(--t-ls-display)',
      textTransform: 'uppercase',
      color: inverse ? 'var(--t-fg-inverse-muted)' : 'var(--t-fg-muted)'
    }
  }, eyebrow), title && React.createElement('h3', {
    style: {
      margin: 0,
      fontFamily: 'var(--t-font-display)',
      fontSize: 'var(--t-fs-lg)',
      fontWeight: 'var(--t-fw-semibold)',
      letterSpacing: 'var(--t-ls-subhead)',
      lineHeight: 'var(--t-lh-snug)',
      textTransform: 'uppercase',
      color: inverse ? 'var(--t-fg-inverse-muted)' : 'var(--t-fg-brand)'
    }
  }, title), React.createElement('div', {
    style: {
      fontFamily: 'var(--t-font-body)',
      fontSize: 'var(--t-fs-sm)',
      lineHeight: 'var(--t-lh-normal)',
      letterSpacing: 'var(--t-ls-body)',
      color: inverse ? 'var(--t-fg-muted)' : 'var(--t-fg-default)'
    }
  }, children));
}
Object.assign(__ds_scope, { Card });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Card.jsx", error: String((e && e.message) || e) }); }

// components/core/Input.jsx
try { (() => {
const fieldBase = {
  width: '100%',
  fontFamily: 'var(--t-font-body)',
  fontSize: 'var(--t-fs-sm)',
  color: 'var(--t-fg-default)',
  background: 'var(--t-bg-page)',
  border: 'var(--t-border-width-hairline) solid var(--t-border-subtle)',
  borderRadius: 'var(--t-radius-sm)',
  padding: 'var(--t-space-3) var(--t-space-4)',
  letterSpacing: 'var(--t-ls-body)',
  outline: 'none',
  transition: 'border-color var(--t-motion-transition-base)'
};
function Input({
  as = 'input',
  label,
  hint,
  invalid = false,
  id,
  style,
  ...rest
}) {
  const Tag = as === 'textarea' ? 'textarea' : as === 'select' ? 'select' : 'input';
  const field = React.createElement(Tag, {
    id,
    'aria-invalid': invalid || undefined,
    ...rest,
    style: {
      ...fieldBase,
      borderColor: invalid ? 'var(--t-border-danger)' : 'var(--t-border-subtle)',
      ...(Tag === 'textarea' ? {
        minHeight: 96,
        resize: 'vertical'
      } : null),
      ...style
    }
  });
  if (!label && !hint) return field;
  return React.createElement('label', {
    htmlFor: id,
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 'var(--t-space-2)'
    }
  }, label && React.createElement('span', {
    style: {
      fontFamily: 'var(--t-font-body)',
      fontSize: 'var(--t-fs-xs)',
      fontWeight: 'var(--t-fw-semibold)',
      letterSpacing: 'var(--t-ls-subhead)',
      textTransform: 'uppercase',
      color: 'var(--t-fg-brand)'
    }
  }, label), field, hint && React.createElement('span', {
    style: {
      fontFamily: 'var(--t-font-body)',
      fontSize: 'var(--t-fs-xs)',
      letterSpacing: 'var(--t-ls-body)',
      color: invalid ? 'var(--t-fg-danger)' : 'var(--t-fg-muted)'
    }
  }, hint));
}
Object.assign(__ds_scope, { Input });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Input.jsx", error: String((e && e.message) || e) }); }

// index.js
try { (() => {

Object.assign(__ds_scope, { Button: __ds_scope.Button, Card: __ds_scope.Card, Badge: __ds_scope.Badge, Input: __ds_scope.Input });
})(); } catch (e) { __ds_ns.__errors.push({ path: "index.js", error: String((e && e.message) || e) }); }

__ds_ns.Badge = __ds_scope.Badge;

__ds_ns.Button = __ds_scope.Button;

__ds_ns.Card = __ds_scope.Card;

__ds_ns.Input = __ds_scope.Input;

})();
