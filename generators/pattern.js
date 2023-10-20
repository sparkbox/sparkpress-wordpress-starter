const { writeFileSync, readFileSync } = require('fs');
const { join } = require('path');
const prompts = require('prompts');

const getPatternScript = ({ patternSlug, themeSlug, description, categories }) => `<?php
/**
 * Title: ${description}
 * Slug: ${themeSlug}/${patternSlug}
 * Categories: ${categories.join(', ')}
 */
?>
<!-- wp:paragraph -->
<p>Replace this sample content with markup for a pattern.</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><!-- wp:list-item -->
<li>Arrange whichever blocks you need to form the pattern in the WordPress editor</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Select all blocks (or the outermost block), the click the kebab menu > Copy (or Copy blocks)</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Paste the resulting content in ${patternSlug}.php</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->
`;

const getDetails = async () => {
	const questions = [
		{
			type: 'text',
			name: 'name',
			message: 'What should the pattern be called? Content editors will search for this name.',
		},
		{
			type: 'text',
			name: 'description',
			message:
				'Please describe this pattern. This will help content editors understand what the pattern should be used for.',
		},
		{
			type: 'multiselect',
			name: 'categories',
			message:
				'Which pattern categories should this pattern be included in? This will help content editors find the pattern.',
			hint: 'Space to select. Return to submit',
			instructions: false,
			choices: [
				{
					title: 'My patterns (recommended)',
					value: 'custom',
					selected: true,
				},
				{
					title: 'Featured',
					value: 'featured',
					selected: false,
				},
				{
					title: 'Posts',
					value: 'posts',
					selected: false,
				},
				{
					title: 'Text',
					value: 'text',
					selected: false,
				},
				{
					title: 'Gallery',
					value: 'gallery',
					selected: false,
				},
				{
					title: 'Call to Action',
					value: 'call-to-action',
					selected: false,
				},
				{
					title: 'Banners',
					value: 'banner',
					selected: false,
				},
				{
					title: 'Headers',
					value: 'header',
					selected: false,
				},
				{
					title: 'Footers',
					value: 'footer',
					selected: false,
				},
			],
		},
	];

	const response = await prompts(questions);

	return response;
};

const getFirstGroup = (regexp, str) =>
	Array.from(str.matchAll(regexp), (match) => match[1])?.[0] ?? 'theme-slug';

const getThemeSlug = () => {
	const themeDefinitionPath = join(__dirname, '../src/php/style.css');
	const themeDefinition = readFileSync(themeDefinitionPath, { encoding: 'utf-8' });

	const themeSlug = getFirstGroup(/Theme Name:\s(.*)/gm, themeDefinition);

	return themeSlug.toLowerCase().replace(/\W/g, '-');
};

const generatePattern = async () => {
	const themeSlug = getThemeSlug();
	const { name, description, categories } = await getDetails();
	const patternSlug = name.toLowerCase().replace(/\W/g, '-');
	const templateParams = { patternSlug, themeSlug, description, categories };

	const patternScript = getPatternScript(templateParams);
	const patternScriptPath = join(__dirname, '../src/php/patterns', `${patternSlug}.php`);
	writeFileSync(patternScriptPath, patternScript, 'utf-8');
	console.log(`Created ${patternScriptPath}`);
};

generatePattern();
