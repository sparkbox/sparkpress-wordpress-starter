import '@testing-library/jest-dom/vitest';
import { describe, beforeEach, expect, it } from 'vitest';
import { addClass } from './add-class';

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
