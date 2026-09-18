document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-site-header]').forEach((header) => {
    const toggle = header.querySelector('[data-menu-toggle]');
    const panel = header.querySelector('[data-navigation-panel]');
    if (!toggle || !panel) return;

    const mobileViewport = window.matchMedia('(max-width: 1024px)');
    const submenuItems = Array.from(panel.querySelectorAll('.menu-item-has-children')).map((item, index) => ({
      item,
      link: item.querySelector(':scope > a'),
      list: item.querySelector(':scope > .sub-menu'),
      id: `venix-submenu-${index}`,
    })).filter(({ link, list }) => link && list);

    const closeDesktopSubmenus = (except = null) => {
      submenuItems.forEach(({ item, link }) => {
        if (item === except) return;
        item.classList.remove('is-submenu-open');
        link.setAttribute('aria-expanded', 'false');
      });
    };
    const closeMobileSubmenus = (except = null) => {
      submenuItems.forEach(({ item, link, list }) => {
        if (item === except) return;
        list.hidden = true;
        link.setAttribute('aria-expanded', 'false');
      });
    };
    const setDesktopSubmenu = (record, open) => {
      if (mobileViewport.matches) return;
      if (open) closeDesktopSubmenus(record.item);
      record.item.classList.toggle('is-submenu-open', open);
      record.link.setAttribute('aria-expanded', String(open));
    };
    const setMobileSubmenu = (record, open) => {
      if (!mobileViewport.matches) return;
      if (open) closeMobileSubmenus(record.item);
      record.list.hidden = !open;
      record.link.setAttribute('aria-expanded', String(open));
    };
    const syncSubmenus = (isMobile) => {
      submenuItems.forEach((record) => {
        const { item, link, list, id } = record;
        const redundantToggle = item.querySelector(':scope > .mobile-submenu-toggle');
        if (redundantToggle) redundantToggle.remove();

        list.id = id;
        link.setAttribute('aria-controls', id);
        link.setAttribute('aria-expanded', 'false');
        link.setAttribute('aria-haspopup', 'true');
        link.setAttribute('role', 'button');
        item.classList.remove('is-submenu-open');
        list.hidden = isMobile;
      });
    };

    submenuItems.forEach((record) => {
      const { item, link } = record;
      link.addEventListener('click', (event) => {
        event.preventDefault();
        if (mobileViewport.matches) {
          setMobileSubmenu(record, record.list.hidden);
          return;
        }
        setDesktopSubmenu(record, !item.classList.contains('is-submenu-open'));
      });
      link.addEventListener('keydown', (event) => {
        if (event.key !== ' ') return;
        event.preventDefault();
        if (mobileViewport.matches) {
          setMobileSubmenu(record, record.list.hidden);
          return;
        }
        setDesktopSubmenu(record, !item.classList.contains('is-submenu-open'));
      });
      item.addEventListener('mouseenter', () => setDesktopSubmenu(record, true));
      item.addEventListener('mouseleave', () => {
        if (!item.contains(document.activeElement)) setDesktopSubmenu(record, false);
      });
      item.addEventListener('focusin', () => setDesktopSubmenu(record, true));
      item.addEventListener('focusout', () => {
        window.setTimeout(() => {
          if (!item.contains(document.activeElement)) setDesktopSubmenu(record, false);
        }, 0);
      });
    });

    syncSubmenus(mobileViewport.matches);
    const close = (restore = false) => {
      header.classList.remove('is-menu-open');
      toggle.setAttribute('aria-expanded', 'false');
      if (mobileViewport.matches) closeMobileSubmenus();
      if (restore) toggle.focus();
    };
    const open = () => {
      header.classList.add('is-menu-open');
      toggle.setAttribute('aria-expanded', 'true');
      const first = panel.querySelector('a,button');
      if (first) first.focus();
    };

    toggle.addEventListener('click', () => toggle.getAttribute('aria-expanded') === 'true' ? close(true) : open());
    panel.addEventListener('click', (event) => {
      if (!mobileViewport.matches) return;
      const link = event.target.closest('a');
      if (!link || !panel.contains(link)) return;
      const parentItem = link.closest('.menu-item-has-children');
      if (parentItem && link === parentItem.querySelector(':scope > a')) return;
      close();
    });
    header.addEventListener('keydown', (event) => {
      if (event.key !== 'Escape') return;
      const openDesktopItem = submenuItems.find(({ item }) => item.classList.contains('is-submenu-open'));
      if (openDesktopItem && !mobileViewport.matches) {
        event.preventDefault();
        setDesktopSubmenu(openDesktopItem, false);
        openDesktopItem.link.focus();
        return;
      }
      if (toggle.getAttribute('aria-expanded') === 'true') {
        event.preventDefault();
        close(true);
      }
    });
    document.addEventListener('click', (event) => {
      if (!mobileViewport.matches && !header.contains(event.target)) closeDesktopSubmenus();
    });
    mobileViewport.addEventListener('change', (event) => {
      syncSubmenus(event.matches);
      if (!event.matches) close();
    });
  });
});
