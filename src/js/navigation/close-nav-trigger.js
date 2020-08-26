import { closeNav } from './close-nav.js';

// Close Nav on Click
export const closeNavTrigger = (nav) => {
  nav.closeMenuBtn.addEventListener('click', (e) => {
    e.preventDefault();

    if (nav.siteNav.classList.contains(nav.openState)) {
      closeNav(nav);
    }
  });
};
