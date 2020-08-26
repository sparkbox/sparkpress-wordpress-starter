export const toggle = (button, action) => {
  const toggler = button;
  const togglerID = toggler.getAttribute('id');
  const togglerContent = document.querySelector(`[aria-labelledby="${togglerID}"]`);

  if (action === 'false') {
    togglerContent.setAttribute('aria-hidden', true);
    toggler.setAttribute('aria-expanded', false);
  } else {
    togglerContent.setAttribute('aria-hidden', false);
    toggler.setAttribute('aria-expanded', true);
  }
};
