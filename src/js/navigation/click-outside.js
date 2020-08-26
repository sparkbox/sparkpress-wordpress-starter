import { closeNav } from './close-nav.js';

export const handleClickOutside = (nav) => {
  document.addEventListener('click', (event) => {
    if (nav.siteNav.classList.contains(nav.openState) && !event.target.closest(nav.siteNavClass)) {
      closeNav(nav);
    }
  }, false);
};
