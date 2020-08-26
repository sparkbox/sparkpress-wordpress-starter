import { toggleAriaState } from '../functions/toggle-aria';

export const closeAll = (subnavItems) => {
  if (!subnavItems.length) { return; }

  [...subnavItems].forEach((subnav) => {
    const toggler = subnav.querySelector('[id]');
    const togglerID = toggler.getAttribute('id');
    const togglerContent = document.querySelector(`[aria-labelledby="${togglerID}"]`);

    toggleAriaState('close', toggler, togglerContent);
  });
};
