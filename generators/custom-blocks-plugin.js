const { writeFileSync, readFileSync, mkdirSync } = require('fs');
const { join } = require('path');
const prompts = require('prompts');
const yaml = require('js-yaml');

const getFirstGroup = (regexp, str, defaultValue) =>
	Array.from(str.matchAll(regexp), (match) => match[1])?.[0] ?? defaultValue;

const getDefaultWordPressVersion = () => {
	const dockerfilePath = join(__dirname, '../Dockerfile');
	const dockerfile = readFileSync(dockerfilePath, { encoding: 'utf-8' });

	const wordPressVersion = getFirstGroup(/WP_VERSION=(.*)/gm, dockerfile, '6.3');

	return wordPressVersion;
};

const getDefaultPHPVersion = () => {
	const workflowPath = join(__dirname, '../Dockerfile');
	const workflow = readFileSync(workflowPath, { encoding: 'utf-8' });

	const phpVersion = getFirstGroup(/php_version:\s'(.*)'/gm, workflow, '8.1');

	return phpVersion;
};

const updatePackageJson = (slugName) => {
	const json = require('../package.json');

	json.scripts[
		`plugins:dev:${slugName}`
	] = `wp-scripts start --webpack-src-dir=src/plugins/${slugName}/src --output-path=src/plugins/${slugName}/build`;

	json.scripts[
		`plugins:build:${slugName}`
	] = `wp-scripts build --webpack-src-dir=src/plugins/${slugName}/src --output-path=src/plugins/${slugName}/build`;

	writeFileSync(join(__dirname, '../package.json'), `${JSON.stringify(json, null, 2)}\n`, 'utf-8');
};

const updateDockerComposeYml = (slugName) => {
	try {
		const dockerComposePath = join(__dirname, '../docker-compose.yml');
		const config = yaml.load(readFileSync(dockerComposePath, { encoding: 'utf-8' }));
		config.services.web.volumes.push(
			`./src/plugins/${slugName}:/var/www/html/wp-content/plugins/${slugName}`
		);

		const updatedConfig = yaml.dump(config, { lineWidth: -1 });
		writeFileSync(dockerComposePath, updatedConfig, 'utf-8');
	} catch (error) {
		console.error(error);
		console.log(
			'Unable to automatically updated docker-compose.yml. You will need to update the volume mapping manually:'
		);
		console.log(`- ./src/plugins/${slugName}:/var/www/html/wp-content/plugins/${slugName}`);
	}
};

const getScriptTemplate = ({
	name,
	description,
	wordPressVersion,
	phpVersion,
	author,
	slugName,
	functionName,
}) => `<?php
/**
 * Plugin Name:       ${name}
 * Description:       ${description}
 * Requires at least: ${wordPressVersion}
 * Requires PHP:      ${phpVersion}
 * Version:           0.1.0
 * Author:            ${author}
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ${slugName}
 *
 * @package           create-block
 */

/**
 * Registers custom blocks from the build directory.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_${functionName}_block_init() {
    $blocks_directory = plugin_dir_path( __FILE__ ) . '/build/';
    $block_directories = glob( $blocks_directory . '*', GLOB_ONLYDIR );

    if ( $block_directories && is_array( $block_directories ) ) {
        foreach ( $block_directories as $block_directory ) {
            register_block_type( $block_directory );
        }
    }
}
add_action( 'init', 'create_block_${functionName}_block_init' );

/**
 * Add a custom block category to the WordPress block editor (Gutenberg).
 *
 * This function is hooked to the 'block_categories_all' filter and adds a new
 * block category named '${name}' with the slug '${slugName}'
 * to the block editor.
 *
 * @param array $categories An array of existing block categories.
 *
 * @return array Modified array of block categories.
 */
function create_category_${functionName}( $categories ) {
	array_unshift(
		$categories,
		array(
			'slug'  => '${slugName}',
			'title' => '${name}',
		)
	);

	return $categories;
}
add_filter( 'block_categories_all', 'create_category_${functionName}', 10, 2 );
`;

const getReadmeTemplate = ({ name, description, wordPressVersion, author }) => `=== ${name} ===
Contributors:      ${author}
Tags:              block
Tested up to:      ${wordPressVersion}
Stable tag:        0.1.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

${description}

== Description ==

<!-- Add more details about the custom blocks included in this plugin or other additional information that would be useful to developers -->

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Run \`npm run plugins:dev\` (or \`npm start\`) to build the blocks in "watch" mode so that changes are applied immediately while developing
1. Run \`npm run plugins:build\` (or \`npm run build:prod\`) to build the blocks for production
1. Activate the plugin through the 'Plugins' screen in WordPress

== Changelog ==

= 0.1.0 =
* Initial Release and Scaffolding
`;

const getDetails = async () => {
	const questions = [
		{
			type: 'text',
			name: 'name',
			message:
				'What should the custom blocks plugin be called? (This name will show up in the WordPress admin plugins list)',
		},
		{
			type: 'text',
			name: 'description',
			message:
				'Please describe the purpose of the custom blocks plugin. (This description will be shown next to the plugin name to provide more context to admins)',
		},
		{
			type: 'text',
			name: 'wordPressVersion',
			message: 'What is the latest version of WordPress that this plugin is compatible with?',
			initial: getDefaultWordPressVersion(),
		},
		{
			type: 'text',
			name: 'phpVersion',
			message: 'What is the latest version of PHP that this plugin is compatible with?',
			initial: getDefaultPHPVersion(),
		},
		{
			type: 'text',
			name: 'author',
			message:
				"What person or organization should be credited creating this custom block? (This will be shown as the plugin's author)",
		},
	];

	const response = await prompts(questions);

	return response;
};

const generateCustomBlocksPlugin = async () => {
	const { name, description, wordPressVersion, phpVersion, author } = await getDetails();
	const slugName = name.toLowerCase().replace(/\W/g, '-');
	const functionName = slugName.replace('-', '_');
	const templateParams = { name, description, wordPressVersion, phpVersion, author, slugName, functionName };

	const pluginPath = join(__dirname, '../src/plugins', slugName);
	mkdirSync(pluginPath);

	const srcPath = join(pluginPath, 'src');
	mkdirSync(srcPath);
	writeFileSync(join(srcPath, '.gitkeep'), '', 'utf-8');

	updatePackageJson(slugName);
	updateDockerComposeYml(slugName);

	const scriptTemplate = getScriptTemplate(templateParams);
	const scriptPath = join(pluginPath, `${slugName}.php`);
	writeFileSync(scriptPath, scriptTemplate, 'utf-8');
	console.log(`Created ${scriptPath}`);

	const readmeTemplate = getReadmeTemplate(templateParams);
	const readmePath = join(pluginPath, 'readme.txt');
	writeFileSync(readmePath, readmeTemplate, 'utf-8');
	console.log(`Created ${readmePath}`);
};

generateCustomBlocksPlugin();
