document.addEventListener('DOMContentLoaded', () => {
  const body = document.body;
  const siteHeader = document.querySelector('.site-header');
  const mobileToggle = document.querySelector('.site-header__menu-toggle');
  const mobilePanel = document.querySelector('#site-mobile-panel');

  const closeAllLangSwitchers = () => {
    document.querySelectorAll('.js-lang-switcher').forEach((switcher) => {
      const toggle = switcher.querySelector('.js-lang-toggle');
      const dropdown = switcher.querySelector('.js-lang-dropdown');

      switcher.classList.remove('is-open');

      if (toggle) {
        toggle.setAttribute('aria-expanded', 'false');
      }

      if (dropdown) {
        dropdown.hidden = true;
      }
    });
  };

  const closeMobileMenu = () => {
    if (!mobileToggle || !mobilePanel) return;

    mobileToggle.setAttribute('aria-expanded', 'false');
    mobilePanel.hidden = true;
    body.classList.remove('mobile-menu-open');

    mobilePanel
      .querySelectorAll('.menu-item-has-children.is-open')
      .forEach((item) => {
        item.classList.remove('is-open');
      });

    mobilePanel
      .querySelectorAll('.sub-menu-toggle')
      .forEach((button) => {
        button.setAttribute('aria-expanded', 'false');
      });
  };

  const openMobileMenu = () => {
    if (!mobileToggle || !mobilePanel) return;

    mobileToggle.setAttribute('aria-expanded', 'true');
    mobilePanel.hidden = false;
    body.classList.add('mobile-menu-open');
  };

  const toggleMobileMenu = () => {
    if (!mobileToggle || !mobilePanel) return;

    const isExpanded = mobileToggle.getAttribute('aria-expanded') === 'true';

    if (isExpanded) {
      closeMobileMenu();
    } else {
      openMobileMenu();
    }
  };

  const initLanguageSwitcher = () => {
    const switchers = document.querySelectorAll('.js-lang-switcher');

    if (!switchers.length) return;

    switchers.forEach((switcher) => {
      const toggle = switcher.querySelector('.js-lang-toggle');
      const dropdown = switcher.querySelector('.js-lang-dropdown');

      if (!toggle || !dropdown) return;

      toggle.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();

        const isOpen = switcher.classList.contains('is-open');

        closeAllLangSwitchers();

        if (!isOpen) {
          switcher.classList.add('is-open');
          toggle.setAttribute('aria-expanded', 'true');
          dropdown.hidden = false;
        }
      });

      dropdown.addEventListener('click', (event) => {
        event.stopPropagation();
      });
    });
  };

  const initMobileSubmenus = () => {
    if (!mobilePanel) return;

    const parentItems = mobilePanel.querySelectorAll('.menu-item-has-children');

    parentItems.forEach((item, index) => {
      const link = item.querySelector(':scope > a');
      const submenu = item.querySelector(':scope > .sub-menu');

      if (!link || !submenu) return;

      const submenuId = `mobile-submenu-${index + 1}`;

      submenu.id = submenuId;
      submenu.hidden = true;

      const toggleButton = document.createElement('button');
      toggleButton.type = 'button';
      toggleButton.className = 'sub-menu-toggle';
      toggleButton.setAttribute('aria-expanded', 'false');
      toggleButton.setAttribute('aria-controls', submenuId);
      toggleButton.setAttribute('aria-label', 'Toggle submenu');

      toggleButton.innerHTML = '<span aria-hidden="true"></span>';

      item.classList.add('has-submenu-toggle');
      item.insertBefore(toggleButton, submenu);

      toggleButton.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();

        const isOpen = item.classList.contains('is-open');

        item.parentElement
          ?.querySelectorAll(':scope > .menu-item-has-children.is-open')
          .forEach((sibling) => {
            if (sibling !== item) {
              sibling.classList.remove('is-open');

              const siblingToggle = sibling.querySelector(':scope > .sub-menu-toggle');
              const siblingSubmenu = sibling.querySelector(':scope > .sub-menu');

              if (siblingToggle) {
                siblingToggle.setAttribute('aria-expanded', 'false');
              }

              if (siblingSubmenu) {
                siblingSubmenu.hidden = true;
              }
            }
          });

        if (isOpen) {
          item.classList.remove('is-open');
          toggleButton.setAttribute('aria-expanded', 'false');
          submenu.hidden = true;
        } else {
          item.classList.add('is-open');
          toggleButton.setAttribute('aria-expanded', 'true');
          submenu.hidden = false;
        }
      });
    });
  };

  initLanguageSwitcher();
  initMobileSubmenus();

  if (mobileToggle && mobilePanel) {
    mobileToggle.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();
      closeAllLangSwitchers();
      toggleMobileMenu();
    });

    mobilePanel.addEventListener('click', (event) => {
      event.stopPropagation();
    });

    document.addEventListener('click', (event) => {
      closeAllLangSwitchers();

      if (
        body.classList.contains('mobile-menu-open') &&
        siteHeader &&
        !siteHeader.contains(event.target)
      ) {
        closeMobileMenu();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        closeAllLangSwitchers();
        closeMobileMenu();
      }
    });
  }
});