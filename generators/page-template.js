const { writeFileSync } = require('fs');
const { join } = require('path');
const prompts = require('prompts');

const getScriptTemplate = (templateName, baseFileName) => `<?php
/**
 * Template Name: ${templateName}
 */

$context = Timber\\Timber::context();
$timber_post = new Timber\\Post();
$context['post'] = $timber_post;

// Render HTML templates.
render_with_password_protection( $timber_post, '${baseFileName}.twig', $context );
`;

const twigTemplate = `{% extends "layouts/base.twig" %}

{% block content %}
	<div>
		{{ post.content }}
	</div>
{% endblock %}
`;

const getName = async () => {
	const response = await prompts({
		type: 'text',
		name: 'value',
		message: 'What should the page template be called?',
	});

	return response.value;
};

const generatePageTemplate = async () => {
	const templateName = await getName();
	const baseFileName = templateName.toLowerCase().replace(/\W/g, '-');

	const scriptTemplate = getScriptTemplate(templateName, baseFileName);

	const scriptPath = join(__dirname, '../src/php', `${baseFileName}.php`);
	const twigPath = join(__dirname, '../src/php/views', `${baseFileName}.twig`);

	writeFileSync(scriptPath, scriptTemplate, 'utf-8');
	console.log(`Created ${scriptPath}`);

	writeFileSync(twigPath, twigTemplate, 'utf-8');
	console.log(`Created ${twigPath}`);
};

generatePageTemplate();
