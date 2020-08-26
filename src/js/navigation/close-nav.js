import { bodyFixed } from '../functions/body-fixed';
import { addClass } from '../functions/add-class.js';
import { removeClass } from '../functions/remove-class.js';

// Closing to Closed State
export const closeNav = (nav) => {
  bodyFixed('closed', nav.bodyEl);
  addClass(nav.siteNav, nav.closingState);
  removeClass(nav.siteNav, nav.openState);

  nav.siteNav.addEventListener('animationend', () => {
    addClass(nav.siteNav, nav.closedState);
    removeClass(nav.siteNav, nav.openState);
    removeClass(nav.siteNav, nav.closingState);
  });

  nav.openMenuBtn.setAttribute('aria-expanded', 'false');
  nav.siteNav.setAttribute('aria-hidden', 'true');
};
