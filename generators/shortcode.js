const { writeFileSync } = require('fs');
const { join } = require('path');
const prompts = require('prompts');

const getScriptTemplate = (templateName, baseFileName, functionName) => `<?php
/**
 * ${templateName} Shortcode
 */

/**
 * ${templateName} Shortcode.
 *
 * @param {array}  $atts - shortcode attributes.
 * @param {string} $content - content between the opening and closing shortcode braces.
 */
function ${functionName}( $atts, $content = null ) {
	$defaults             = array();
	$variables            = wp_parse_args( $atts, $defaults );
	$variables['content'] = $content;

	return Timber\\Timber::compile( 'shortcodes/${baseFileName}.twig', $variables );
}
add_shortcode( '${baseFileName}', '${functionName}' );
`;

const getTwigTemplate = (templateName, baseFileName) => `{# ${templateName} Shortcode #}
{# Can use in WP Editor: [${baseFileName} attribute="value"]Include dynamic content here, if supported.[/${baseFileName}] #}
{# TODO: replace markup for shortcode here #}
<p>{{ content }}</p>
`;

const getName = async () => {
	const response = await prompts({
		type: 'text',
		name: 'value',
		message: 'What should the shortcode be called?',
	});

	return response.value;
};

const generateShortcode = async () => {
	const templateName = await getName();
	const baseFileName = templateName.toLowerCase().replace(/\W/g, '-');
	const functionName = templateName.toLowerCase().replace(/\W/g, '_');

	const scriptTemplate = getScriptTemplate(templateName, baseFileName, functionName);
	const twigTemplate = getTwigTemplate(templateName, baseFileName);

	const scriptPath = join(__dirname, '../src/php/inc/shortcodes', `${baseFileName}.php`);
	const twigPath = join(__dirname, '../src/php/views/shortcodes', `${baseFileName}.twig`);

	writeFileSync(scriptPath, scriptTemplate, 'utf-8');
	console.log(`Created ${scriptPath}`);

	writeFileSync(twigPath, twigTemplate, 'utf-8');
	console.log(`Created ${twigPath}`);
};

generateShortcode();
