export const bodyFixed = (state, bodyEl) => {
  if (state === 'open') {
    bodyEl.setAttribute('style', 'height: 100vh; overflow: hidden;');
  } else if (state === 'closed') {
    bodyEl.removeAttribute('style');
  }
};
