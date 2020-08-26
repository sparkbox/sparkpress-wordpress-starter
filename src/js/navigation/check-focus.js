import { closeNav } from './close-nav.js';

// event listener for keyup
export const checkFocus = (nav) => {
  const focusedElement = document.activeElement;
  const closestElement = focusedElement.closest(nav.siteNavClass);
  const closestParent = focusedElement.parentNode.closest(nav.siteNavClass);

  if (!closestElement || !closestParent) {
    if (nav.siteNav.classList.contains(nav.openState)) {
      closeNav(nav);
    }
  }
};
