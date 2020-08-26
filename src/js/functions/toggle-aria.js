import { toggle } from './toggle-state';

export const toggleAriaState = (state, toggler) => {
  if (state === 'open') {
    toggle(toggler, 'true');
  } else {
    toggle(toggler, 'false');
  }
};
