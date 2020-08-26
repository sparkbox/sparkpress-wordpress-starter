import { openNavTrigger } from './open-nav-trigger.js';
import { closeNavTrigger } from './close-nav-trigger.js';
import { handleClickOutside } from './click-outside.js';
import { checkFocus } from './check-focus.js';

export const inithandleMenuButtonClick = (nav) => {
  if (!nav.siteNav) return;
  if (nav.siteNav && window.innerWidth < nav.headerSwitchBreakpoint) {
    nav.siteNav.classList.add(nav.closedState);

    openNavTrigger(nav);
    closeNavTrigger(nav);
    handleClickOutside(nav);

    document.addEventListener('keyup', checkFocus);

    nav.openMenuBtn.setAttribute('aria-expanded', 'false');
    nav.siteNav.setAttribute('aria-hidden', 'true');
  } else {
    nav.siteNav.classList.remove(nav.closedState);

    nav.openMenuBtn.setAttribute('aria-expanded', 'true');
    nav.siteNav.setAttribute('aria-hidden', 'false');
  }
};
