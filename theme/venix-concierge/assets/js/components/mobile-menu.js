document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-site-header]').forEach((header) => {
    const toggle = header.querySelector('[data-menu-toggle]');
    const panel = header.querySelector('[data-navigation-panel]');
    if (!toggle || !panel) return;
    const accordions = [];
    panel.querySelectorAll('.menu-item-has-children').forEach((item, index) => {
      const link = item.querySelector(':scope > a'); const list = item.querySelector(':scope > .sub-menu');
      if (!link || !list) return;
      const button = document.createElement('button'); button.type = 'button'; button.className = 'mobile-submenu-toggle'; button.setAttribute('aria-expanded', 'false'); button.setAttribute('aria-controls', `mobile-submenu-${index}`); button.textContent = '+';
      list.id = `mobile-submenu-${index}`; list.hidden = true; link.after(button);
      button.addEventListener('click', () => { const open = button.getAttribute('aria-expanded') === 'true'; button.setAttribute('aria-expanded', String(!open)); list.hidden = open; button.textContent = open ? '+' : '−'; }); accordions.push({ button, list });
    });
    const close = (restore = false) => { header.classList.remove('is-menu-open'); toggle.setAttribute('aria-expanded', 'false'); accordions.forEach(({button,list}) => { button.setAttribute('aria-expanded','false'); list.hidden=true; button.textContent='+'; }); if (restore) toggle.focus(); };
    const open = () => { header.classList.add('is-menu-open'); toggle.setAttribute('aria-expanded', 'true'); const first = panel.querySelector('a,button'); if (first) first.focus(); };
    toggle.addEventListener('click', () => toggle.getAttribute('aria-expanded') === 'true' ? close(true) : open());
    header.addEventListener('keydown', (event) => { if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') { event.preventDefault(); close(true); } });
    window.matchMedia('(min-width: 1025px)').addEventListener('change', (event) => { if (event.matches) close(); });
  });
});
