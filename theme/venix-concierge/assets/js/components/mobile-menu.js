document.addEventListener('DOMContentLoaded', () => {
  const headers = document.querySelectorAll('[data-site-header]');

  headers.forEach((header) => {
    const toggle = header.querySelector('[data-menu-toggle]');
    const panel = header.querySelector('[data-navigation-panel]');
    const label = header.querySelector('[data-menu-toggle-label]');
    const icon = header.querySelector('[data-menu-toggle-icon]');

    if (!toggle || !panel || !label || !icon) return;

    const desktopMediaQuery = window.matchMedia('(min-width: 53.75rem)');

    const setMenuState = (open, restoreFocus = false) => {
      header.classList.toggle('is-menu-open', open);
      toggle.setAttribute('aria-expanded', String(open));
      label.textContent = open ? toggle.dataset.closeLabel : toggle.dataset.openLabel;
      icon.textContent = open ? '×' : '☰';

      if (!open && restoreFocus) toggle.focus();
    };

    setMenuState(false);
    header.classList.add('is-enhanced');
    toggle.hidden = false;

    toggle.addEventListener('click', () => {
      const open = toggle.getAttribute('aria-expanded') === 'true';
      setMenuState(!open, open);
    });

    header.addEventListener('keydown', (event) => {
      if (event.key !== 'Escape' || toggle.getAttribute('aria-expanded') !== 'true') return;

      event.preventDefault();
      setMenuState(false, true);
    });

    desktopMediaQuery.addEventListener('change', (event) => {
      if (event.matches) setMenuState(false);
    });
  });
});
