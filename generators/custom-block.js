const { writeFileSync, mkdirSync, readdirSync } = require('fs');
const { join } = require('path');
const prompts = require('prompts');

const getBlockJsonTemplate = ({ pluginSlug, slugName, name, description, hasViewScript }) => `{
	"$schema": "https://schemas.wp.org/trunk/block.json",
	"apiVersion": 3,
	"name": "${pluginSlug}/${slugName}",
	"version": "0.1.0",
	"title": "${name}",
	"category": "${pluginSlug}",
	"icon": "admin-generic",
	"description": "${description}",
	"supports": {
		"html": false
	},
	"textdomain": "${pluginSlug}",
	"editorScript": "file:index.js",
	"editorStyle": "file:index.css",
	"style": "file:style-index.css"${
		hasViewScript
			? `,
	"viewScript": "file:view.js"`
			: ''
	}
}
`;

const getEditJSTemplate = ({ name }) => `/** @typedef {import('@wordpress/element').WPElement} WPElement */

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit() {
	return <p {...useBlockProps()}>${name}</p>;
}
`;

const getEditorSCSSTemplate = ({ pluginSlug, slugName }) => `/**
 * The following styles get applied inside the editor only.
 *
 * Replace them with your own styles or remove the file completely.
 */

.wp-block-${pluginSlug}-${slugName} {
	/* insert custom styles here */
}
`;

const getIndexJSTemplate = () => `/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing \`style\` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './style.scss';

/**
 * Internal dependencies
 */
import Edit from './edit';
import save from './save';
import metadata from './block.json';

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType(metadata.name, {
	/**
	 * @see ./edit.js
	 */
	edit: Edit,

	/**
	 * @see ./save.js
	 */
	save,
});
`;

const getSaveJSTemplate = ({ name }) => `/** @typedef {import('@wordpress/element').WPElement} WPElement */

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into \`post_content\`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default function save() {
	return <p {...useBlockProps.save()}>{'${name}'}</p>;
}
`;

const getStyleSCSSTemplate = ({ pluginSlug, slugName }) => `/**
 * The following styles get applied both on the front of your site
 * and in the editor.
 *
 * Replace them with your own styles or remove the file completely.
 */

.wp-block-${pluginSlug}-${slugName} {
	/* insert custom styles here */
}
`;

const getViewJSTemplate = ({ name }) => `/**
 * Put any JS here that is needed for your block to function when rendered outside of the editor.
 */
console.log('Hello from the ${name} block!');
`;

const getCustomBlockPluginOptions = () => {
	const directories = readdirSync(join(__dirname, '../src/plugins'));
	return directories
		.filter((dir) => dir !== '.gitkeep')
		.map((dir) => ({
			title: dir,
			value: dir,
		}));
};

const getDetails = async () => {
	const pluginOptions = getCustomBlockPluginOptions();
	if (!pluginOptions.length) {
		console.log(
			'There are no existing plugins in `src/plugins` to add custom blocks to. Please run `npm run generate:custom-blocks-plugin` to scaffold a plugin before running `npm run generate:custom-block`'
		);
		return;
	}

	const questions = [
		{
			type: 'select',
			name: 'pluginSlug',
			message: 'Which custom blocks plugin should this block belong to?',
			choices: pluginOptions,
			initial: 0,
		},
		{
			type: 'text',
			name: 'name',
			message:
				'What should the custom block be called? (This is the name editors will use to search for the block)',
		},
		{
			type: 'text',
			name: 'description',
			message:
				'Please describe the custom block. (This description will help editors understand how to use the block)',
		},
		{
			type: 'select',
			name: 'hasViewScript',
			message:
				'Will this block require JavaScript to function when rendered on the site? (If yes, a `view.js` file will be created)',
			choices: [
				{
					title: 'Yes',
					value: true,
				},
				{
					title: 'No',
					value: false,
				},
			],
			initial: 0,
		},
	];

	const response = await prompts(questions);

	return response;
};

const generateCustomBlocksPlugin = async () => {
	const { pluginSlug, name, description, hasViewScript } = await getDetails();
	const slugName = name.toLowerCase().replace(/\W/g, '-');
	const templateParams = { pluginSlug, slugName, name, description, hasViewScript };

	const blockPath = join(__dirname, '../src/plugins', pluginSlug, 'src', slugName);
	mkdirSync(blockPath);

	const blockJsonTemplate = getBlockJsonTemplate(templateParams);
	const blockJsonPath = join(blockPath, 'block.json');
	writeFileSync(blockJsonPath, blockJsonTemplate, 'utf-8');
	console.log(`Created ${blockJsonPath}`);

	const editJSTemplate = getEditJSTemplate(templateParams);
	const editJSPath = join(blockPath, 'edit.js');
	writeFileSync(editJSPath, editJSTemplate, 'utf-8');
	console.log(`Created ${editJSPath}`);

	const editorSCSSTemplate = getEditorSCSSTemplate(templateParams);
	const editorSCSSPath = join(blockPath, 'editor.scss');
	writeFileSync(editorSCSSPath, editorSCSSTemplate, 'utf-8');
	console.log(`Created ${editorSCSSPath}`);

	const indexJSTemplate = getIndexJSTemplate(templateParams);
	const indexJSPath = join(blockPath, 'index.js');
	writeFileSync(indexJSPath, indexJSTemplate, 'utf-8');
	console.log(`Created ${indexJSPath}`);

	const saveJSTemplate = getSaveJSTemplate(templateParams);
	const saveJSPath = join(blockPath, 'save.js');
	writeFileSync(saveJSPath, saveJSTemplate, 'utf-8');
	console.log(`Created ${saveJSPath}`);

	const styleSCSSTemplate = getStyleSCSSTemplate(templateParams);
	const styleSCSSPath = join(blockPath, 'style.scss');
	writeFileSync(styleSCSSPath, styleSCSSTemplate, 'utf-8');
	console.log(`Created ${styleSCSSPath}`);

	if (hasViewScript) {
		const viewJSTemplate = getViewJSTemplate(templateParams);
		const viewJSPath = join(blockPath, 'view.js');
		writeFileSync(viewJSPath, viewJSTemplate, 'utf-8');
		console.log(`Created ${viewJSPath}`);
	}
};

generateCustomBlocksPlugin();
