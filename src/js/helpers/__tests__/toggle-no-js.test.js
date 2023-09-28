import '@testing-library/jest-dom/vitest';
import { describe, beforeEach, expect, it } from 'vitest';
import { toggleNoJS } from '../toggle-no-js';

describe('toggleNoJS', () => {
	beforeEach(() => {
		document.documentElement.setAttribute('class', 'no-js');
	});

	it("replaces no-js with js in html element's class", () => {
		const htmlElement = document.querySelector('html');
		expect(htmlElement).toHaveAttribute('class', 'no-js');

		toggleNoJS();

		expect(htmlElement).toHaveAttribute('class', 'js');
	});
});
