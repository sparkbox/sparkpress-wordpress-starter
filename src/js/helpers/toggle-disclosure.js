const handleDisclosureButtonClick = (event) => {
	const button = event.target;
	const disclosureContent = document.querySelector(`#${button.getAttribute('aria-controls')}`);
	if (!disclosureContent) {
		return;
	}

	const isExpanded = button.getAttribute('aria-expanded') === 'true';
	button.setAttribute('aria-expanded', !isExpanded);

	if (isExpanded) {
		disclosureContent.setAttribute('hidden', true);
	} else {
		disclosureContent.removeAttribute('hidden');
	}
};

export const initializeDisclosureButtonHandler = (selector) => {
	const disclosureButtons = document.querySelectorAll(selector);
	disclosureButtons.forEach((disclosureButton) => {
		disclosureButton.addEventListener('click', handleDisclosureButtonClick);
	});
};
