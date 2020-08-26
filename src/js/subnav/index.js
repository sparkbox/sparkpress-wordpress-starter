import { buildSubnav } from './build-subnav';
import { clickOutside } from './click-outside';

const subnavItems = document.querySelectorAll('.js-subnav');

buildSubnav(subnavItems);
clickOutside(subnavItems, '.js-subnav');
