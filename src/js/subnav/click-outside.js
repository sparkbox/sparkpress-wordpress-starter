import { closeAll } from './close-all';

export const clickOutside = (subnavItems, element) => {
  document.addEventListener('click', (event) => {
    if (!event.target.closest(element)) {
      closeAll(subnavItems);
    }
  }, false);
};
