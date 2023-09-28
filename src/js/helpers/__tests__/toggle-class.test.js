import '@testing-library/jest-dom/vitest';
import { describe, beforeEach, expect, it } from 'vitest';
import { addClass, removeClass, toggleClass } from '../toggle-class';

describe('addClass', () => {
	beforeEach(() => {
		document.body.innerHTML = `<div id="test-element"></div>`;
	});

	it('adds the class to the specified element', () => {
		const element = document.querySelector('#test-element');
		addClass(element, 'test-class');

		expect(element).toHaveAttribute('class', 'test-class');
	});

	it('does not throw an error when the element does not exist', () => {
		const element = document.querySelector('#nonexistent-element');

		expect(() => addClass(element, 'test-class')).not.toThrowError();
	});
});

describe('removeClass', () => {
	beforeEach(() => {
		document.body.innerHTML = `<div id="test-element" class="test-class some-other-class"></div>`;
	});

	it('removes the class from the specified element', () => {
		const element = document.querySelector('#test-element');
		removeClass(element, 'test-class');

		expect(element).not.toHaveAttribute('class', 'test-class');
		expect(element).toHaveAttribute('class', 'some-other-class');
	});

	it('does not throw an error when the element does not exist', () => {
		const element = document.querySelector('#nonexistent-element');

		expect(() => removeClass(element, 'test-class')).not.toThrowError();
	});
});

describe('toggleClass', () => {
	beforeEach(() => {
		document.body.innerHTML = `<div id="test-element" class="test-class some-other-class"></div>`;
	});

	it('toggles the class on the specified element', () => {
		const element = document.querySelector('#test-element');
		toggleClass(element, 'test-class');

		expect(element).toHaveAttribute('class', 'some-other-class');

		toggleClass(element, 'test-class');

		expect(element).toHaveAttribute('class', 'some-other-class test-class');

		toggleClass(element, 'some-other-class');

		expect(element).toHaveAttribute('class', 'test-class');
	});

	it('does not throw an error when the element does not exist', () => {
		const element = document.querySelector('#nonexistent-element');

		expect(() => toggleClass(element, 'test-class')).not.toThrowError();
	});
});
