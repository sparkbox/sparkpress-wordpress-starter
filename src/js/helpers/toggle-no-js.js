// Removes the .no-js class on the HTML and replaces it with the .js class.
// This allows us to apply specific styles for noJS solutions.
export const toggleNoJS = () => {
	const html = document.querySelector('html');

	html.classList.remove('no-js');
	html.classList.add('js');
};
