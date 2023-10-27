const { writeFileSync } = require('fs');
const { join } = require('path');
const prompts = require('prompts');

const getConfigurationScript = ({ name, singularName, postTypes, taxonomySlug, configFunctionName }) => `<?php
/**
 * Register ${name} Taxonomy.
 */

/**
 * Register ${name} Taxonomy to custom post types.
 *
 * @return void
 */
function custom_taxonomy_${configFunctionName}() {
	$labels = array(
		'name'          => '${name}',
		'singular_name' => '${singularName}',
	);
	$args   = array(
		'description'       => 'Custom taxonomy for ${name}',
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
  // Populate this array with the post types you want to use the taxonomy with.
  $post_types = array( ${postTypes.map((postType) => `'${postType}'`).join(', ')} );

	register_taxonomy( '${taxonomySlug}', $post_types, $args );
}
add_action( 'init', 'custom_taxonomy_${configFunctionName}', 0 );
`;

const getArchiveScript = ({ name, taxonomySlug }) => `<?php
/**
 * The template for displaying archive pages for ${name}
 */

$context = Timber\\Timber::context();
$context['title'] = '${name}';
$context['posts'] = new Timber\\PostQuery();
$templates = array( 'taxonomy-${taxonomySlug}.twig', 'archive.twig', 'index.twig' );

Timber\\Timber::render( $templates, $context );
`;

const getArchiveTemplate = () => `{% extends "layouts/base.twig" %}

{% block content %}
	<div>
		{% if posts.found_posts %}
			<h1>{{ title }}</h1>
			{% for post in posts %}
				{% include 'partials/content-single.twig' with {post: post} %}
			{% endfor %}

			{% include 'partials/pagination.twig' with {pagination: posts.pagination({show_all: false, mid_size: 2, end_size: 1})} %}
		{% else %}
			{% include 'partials/content-none.twig' %}
		{% endif %}
	</div>
{% endblock %}
`;

const getDetails = async () => {
	const questions = [
		{
			type: 'text',
			name: 'name',
			message: 'What should the taxonomy be called? (plural name)',
		},
		{
			type: 'text',
			name: 'singularName',
			message: 'What should a single tag for this taxonomy be called? (singular name)',
		},
		{
			type: 'multiselect',
			name: 'templates',
			message: 'Which scripts/templates need to be created for this taxonomy?',
			hint: 'Space to select. Return to submit',
			instructions: false,
			choices: [
				{
					title: 'Archive Post Script (taxonomy-$taxonomy.php)',
					value: 'archiveScript',
					selected: true,
				},
				{
					title: 'Archive Post Template (taxonomy-$taxonomy.twig)',
					value: 'archiveTemplate',
					selected: true,
				},
			],
		},
		{
			type: 'list',
			name: 'postTypes',
			message:
				'Which post types should this taxonomy be associated with? Enter post type slugs separated by commas (the slugs should match the first argument used in register_post_type).',
			initial: '',
			separator: ',',
		},
	];

	const response = await prompts(questions);

	return response;
};

const generateTaxonomy = async () => {
	const { name, singularName, templates, postTypes } = await getDetails();
	const taxonomySlug = singularName.toLowerCase().replace(/\W/g, '-');
	const configFunctionName = name.toLowerCase().replace(/\W/g, '_');
	const templateParams = { name, singularName, templates, postTypes, taxonomySlug, configFunctionName };

	const configurationScript = getConfigurationScript(templateParams);
	const configurationScriptPath = join(__dirname, '../src/php/inc/taxonomies', `${taxonomySlug}.php`);
	writeFileSync(configurationScriptPath, configurationScript, 'utf-8');
	console.log(`Created ${configurationScriptPath}`);

	if (templates.includes('archiveScript')) {
		const archiveScript = getArchiveScript(templateParams);
		const archiveScriptPath = join(__dirname, '../src/php', `taxonomy-${taxonomySlug}.php`);
		writeFileSync(archiveScriptPath, archiveScript, 'utf-8');
		console.log(`Created ${archiveScriptPath}`);
	}

	if (templates.includes('archiveTemplate')) {
		const archiveTemplate = getArchiveTemplate();
		const archiveTemplatePath = join(__dirname, '../src/php/views', `taxonomy-${taxonomySlug}.twig`);
		writeFileSync(archiveTemplatePath, archiveTemplate, 'utf-8');
		console.log(`Created ${archiveTemplatePath}`);
	}
};

generateTaxonomy();
