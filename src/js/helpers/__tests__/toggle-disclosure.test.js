import '@testing-library/jest-dom/vitest';
import { screen } from '@testing-library/dom';
import { describe, beforeEach, expect, it } from 'vitest';
import { initializeDisclosureButtonHandler } from '../toggle-disclosure';

describe('initializeDisclosureButtonHandler', () => {
	beforeEach(() => {
		document.body.innerHTML = `
      <button class="cmp-disclosure-button" aria-expanded="false" aria-controls="test-element-closed">Reveal Content</button>
      <p id="test-element-closed" hidden>This content will be revealed!</p>
      <button class="cmp-disclosure-button" aria-expanded="true" aria-controls="test-element-open">Hide Content</button>
      <p id="test-element-open">This content will be hidden!</p>
      <button class="cmp-disclosure-button" aria-expanded="false">Do Nothing</button>
      <p id="test-element-forever-hidden" hidden>This content will always be hidden!</p>
    `;
	});

	it('opens the first menu when the button is clicked', () => {
		initializeDisclosureButtonHandler('.cmp-disclosure-button');

		const revealContentButton = screen.getByText('Reveal Content');
		revealContentButton.click();
		expect(revealContentButton).toHaveAttribute('aria-expanded', 'true');
		expect(screen.getByText('This content will be revealed!')).not.toHaveAttribute('hidden');
	});

	it('closes the second menu when the button is clicked', () => {
		initializeDisclosureButtonHandler('.cmp-disclosure-button');

		const hideContentButton = screen.getByText('Hide Content');
		hideContentButton.click();
		expect(hideContentButton).toHaveAttribute('aria-expanded', 'false');
		expect(screen.getByText('This content will be hidden!')).toHaveAttribute('hidden');
	});

	it('toggles the menu on subsequent clicks', () => {
		initializeDisclosureButtonHandler('.cmp-disclosure-button');

		const revealContentButton = screen.getByText('Reveal Content');
		revealContentButton.click();
		expect(revealContentButton).toHaveAttribute('aria-expanded', 'true');
		expect(screen.getByText('This content will be revealed!')).not.toHaveAttribute('hidden');

		revealContentButton.click();
		expect(revealContentButton).toHaveAttribute('aria-expanded', 'false');
		expect(screen.getByText('This content will be revealed!')).toHaveAttribute('hidden');

		revealContentButton.click();
		expect(revealContentButton).toHaveAttribute('aria-expanded', 'true');
		expect(screen.getByText('This content will be revealed!')).not.toHaveAttribute('hidden');

		revealContentButton.click();
		expect(revealContentButton).toHaveAttribute('aria-expanded', 'false');
		expect(screen.getByText('This content will be revealed!')).toHaveAttribute('hidden');
	});

	it("does nothing when the button isn't pointing to content correctly", () => {
		initializeDisclosureButtonHandler('.cmp-disclosure-button');

		const uselessButton = screen.getByText('Do Nothing');
		uselessButton.click();
		expect(uselessButton).toHaveAttribute('aria-expanded', 'false');
		expect(screen.getByText('This content will always be hidden!')).toHaveAttribute('hidden');
	});
});
