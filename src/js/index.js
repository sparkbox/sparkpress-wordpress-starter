import { toggleNoJS } from './helpers/toggle-no-js';
import { initializeDisclosureButtonHandler } from './helpers/toggle-disclosure';

toggleNoJS();
initializeDisclosureButtonHandler('.cmp-main-nav__toggler');
