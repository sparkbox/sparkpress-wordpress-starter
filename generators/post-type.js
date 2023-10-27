const { writeFileSync } = require('fs');
const { join } = require('path');
const prompts = require('prompts');

const getConfigurationScript = ({ name, singularName, postTypeSlug, configFunctionName }) => `<?php
/**
 * File for Registering ${name}
 */

/**
 * Register ${name}
 *
 * @return void
 */
function custom_post_type_${configFunctionName}() {
	$labels = array(
		'name'                  => '${name}',
		'singular_name'         => '${singularName}',
		'all_items'             => 'All Posts',
	);
	$args = array(
		'label'                 => '${name}',
		'description'           => 'Custom post type for ${name}',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( '${postTypeSlug}', $args );
}
add_action( 'init', 'custom_post_type_${configFunctionName}', 0 );
`;

const getSinglePostScript = ({ name, postTypeSlug }) => `<?php
/**
 * The template for displaying single posts for ${name}
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

// https://timber.github.io/docs/reference/timber/#context
$context           = Timber\\Timber::context();
$timber_post       = new Timber\\Post();
$context['post']   = $timber_post;
$templates         = array( 'single-${postTypeSlug}.twig', 'page.twig' );

render_with_password_protection( $timber_post, $templates, $context );
`;

const getSinglePostTemplate = () => `{% extends "layouts/base.twig" %}

{% block content %}
  <div>
    {{ post.content }}
  </div>
{% endblock %}
`;

const getArchiveScript = ({ name, postTypeSlug }) => `<?php
/**
 * The template for displaying archive pages for ${name}
 */

$context = Timber\\Timber::context();
$context['title'] = '${name}';
$context['posts'] = new Timber\\PostQuery();
$templates = array( 'archive-${postTypeSlug}.twig', 'archive.twig', 'index.twig' );

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
			message: 'What should the post type be called? (plural name)',
		},
		{
			type: 'text',
			name: 'singularName',
			message: 'What should a single post of this post type be called? (singular name)',
		},
		{
			type: 'multiselect',
			name: 'templates',
			message: 'Which scripts/templates need to be created for this post type?',
			hint: 'Space to select. Return to submit',
			instructions: false,
			choices: [
				{
					title: 'Single Post Script (single-$posttype.php)',
					value: 'singleScript',
					selected: true,
				},
				{
					title: 'Single Post Template (single-$posttype.twig)',
					value: 'singleTemplate',
					selected: true,
				},
				{
					title: 'Archive Post Script (archive-$posttype.php)',
					value: 'archiveScript',
					selected: true,
				},
				{
					title: 'Archive Post Template (archive-$posttype.twig)',
					value: 'archiveTemplate',
					selected: true,
				},
			],
		},
	];

	const response = await prompts(questions);

	return response;
};

const generatePostType = async () => {
	const { name, singularName, templates } = await getDetails();
	const postTypeSlug = singularName.toLowerCase().replace(/\W/g, '-');
	const configFunctionName = name.toLowerCase().replace(/\W/g, '_');
	const templateParams = { name, singularName, templates, postTypeSlug, configFunctionName };

	const configurationScript = getConfigurationScript(templateParams);
	const configurationScriptPath = join(__dirname, '../src/php/inc/custom-post-types', `${postTypeSlug}.php`);
	writeFileSync(configurationScriptPath, configurationScript, 'utf-8');
	console.log(`Created ${configurationScriptPath}`);

	if (templates.includes('singleScript')) {
		const singlePostScript = getSinglePostScript(templateParams);
		const singlePostScriptPath = join(__dirname, '../src/php', `single-${postTypeSlug}.php`);
		writeFileSync(singlePostScriptPath, singlePostScript, 'utf-8');
		console.log(`Created ${singlePostScriptPath}`);
	}

	if (templates.includes('singleTemplate')) {
		const singlePostTemplate = getSinglePostTemplate();
		const singlePostTemplatePath = join(__dirname, '../src/php/views', `single-${postTypeSlug}.twig`);
		writeFileSync(singlePostTemplatePath, singlePostTemplate, 'utf-8');
		console.log(`Created ${singlePostTemplatePath}`);
	}

	if (templates.includes('archiveScript')) {
		const archiveScript = getArchiveScript(templateParams);
		const archiveScriptPath = join(__dirname, '../src/php', `archive-${postTypeSlug}.php`);
		writeFileSync(archiveScriptPath, archiveScript, 'utf-8');
		console.log(`Created ${archiveScriptPath}`);
	}

	if (templates.includes('archiveTemplate')) {
		const archiveTemplate = getArchiveTemplate();
		const archiveTemplatePath = join(__dirname, '../src/php/views', `archive-${postTypeSlug}.twig`);
		writeFileSync(archiveTemplatePath, archiveTemplate, 'utf-8');
		console.log(`Created ${archiveTemplatePath}`);
	}

	console.log(`
Note: to get posts from your new custom post type to show up on archive pages, you will need to update enable_custom_posts_in_archives in ./src/php/inc/setup-queries.php.
	`);
};

generatePostType();
