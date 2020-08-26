import { inithandleMenuButtonClick } from './init-menu.js';
import { breakPoint } from '../settings/breakpoints';

const handleMenuButtonClick = () => {
  const bodyEl = document.body;
  const openMenuBtn = document.querySelector('.js-menu-open');
  const closeMenuBtn = document.querySelector('.js-menu-close');
  const siteNavClass = '.js-menu';
  const siteNav = document.querySelector(siteNavClass);
  const headerSwitchBreakpoint = breakPoint.lg;

  const openState = 'cmp-menu--open';
  const openingState = 'cmp-menu--opening';

  const closedState = 'cmp-menu--closed';
  const closingState = 'cmp-menu--closing';

  inithandleMenuButtonClick({
    bodyEl,
    openMenuBtn,
    closeMenuBtn,
    siteNavClass,
    siteNav,
    headerSwitchBreakpoint,
    openState,
    openingState,
    closedState,
    closingState,
  });
};

handleMenuButtonClick();

// When the window is resized we need to check for changes to aria attributes.
// The following code includes a debounce method so that the JS is only fired
// once after the page is done resizing.
let timeout;
const delay = 100;

window.addEventListener('resize', () => {
  clearTimeout(timeout);
  timeout = setTimeout(handleMenuButtonClick, delay);
});
