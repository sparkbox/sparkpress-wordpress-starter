import { bodyFixed } from '../functions/body-fixed';
import { addClass } from '../functions/add-class.js';
import { removeClass } from '../functions/remove-class.js';

// Opening to Open State
export const openNav = (nav) => {
  bodyFixed('open', nav.bodyEl);
  addClass(nav.siteNav, nav.openingState);

  nav.siteNav.focus();

  nav.siteNav.addEventListener('animationend', () => {
    addClass(nav.siteNav, nav.openState);
    removeClass(nav.siteNav, nav.openingState);
    removeClass(nav.siteNav, nav.closedState);
  });

  nav.openMenuBtn.setAttribute('aria-expanded', 'true');
  nav.siteNav.setAttribute('aria-hidden', 'false');
};
