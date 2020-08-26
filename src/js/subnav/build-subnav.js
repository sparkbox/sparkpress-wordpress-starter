import { toggleAriaState } from '../functions/toggle-aria';
import { closeAll } from './close-all';

export const buildSubnav = (subnavItems) => {
  if (!subnavItems.length) { return; }

  let toggleState = 'close';

  [...subnavItems].forEach((subnav) => {
    const toggler = subnav.querySelector('[id*="parent-"]');
    const togglerID = toggler.getAttribute('id');
    const togglerContent = document.querySelector(`[aria-labelledby="${togglerID}"]`);

    const setToggleState = (state) => {
      toggleAriaState(state, toggler, togglerContent);
    };

    setToggleState(toggleState);

    toggler.addEventListener('click', () => {
      if (toggler.getAttribute('aria-expanded') === 'true') {
        // If the selected items is open, close it
        closeAll(subnavItems);
        toggleState = 'close';
        setToggleState('close');
      } else if (toggleState === 'open') {
        // If there is an open menu, close it then open the selected item
        closeAll(subnavItems);
        toggleState = 'open';
        setToggleState('open');
      } else if (toggleState === 'close') {
        // If everything is closed, then open the selected item
        toggleState = 'open';
        setToggleState('open');
      } else {
        // Close everything
        toggleState = 'close';
        setToggleState('close');
        closeAll(subnavItems);
      }
    });
  });
};
