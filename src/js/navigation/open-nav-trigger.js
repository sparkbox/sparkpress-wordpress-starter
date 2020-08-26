import { openNav } from './open-nav.js';

// Open Nav on Click
export const openNavTrigger = (nav) => {
  nav.openMenuBtn.addEventListener('click', (e) => {
    e.preventDefault();

    if (nav.siteNav.classList.contains(nav.closedState)) {
      openNav(nav);
    }
  });
};
