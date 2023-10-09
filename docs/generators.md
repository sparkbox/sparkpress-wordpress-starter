# Generators

We have a handful of generators to make it easier to add new custom post types, taxonomies, shortcodes, and page templates. If none of the generators give you what you need, you can try using https://generatewp.com/ to get more relevant code snippets.

## Custom Post Type

The generator for custom post types will prompt you for some details that it will use to create the necessary files for registering the post type. You can specify whether to create scripts and templates for single and archive pages for the post type. If you opt not to, the default scripts/templates will be used based on WordPress' template hierarchy.

```sh
npm run generate:post-type
```

The following files will be created based on your inputs:

- `src/php/inc/custom-post-types/<post-type-name>.php`
- `src/php/single-<post-type-name>.php` (optional)
- `src/php/archive-<post-type-name>.php` (optional)
- `src/php/views/single-<post-type-name>.twig` (optional)
- `src/php/views/archive-<post-type-name>.twig` (optional)

[Custom Post Types documentation](https://wordpress.org/support/article/post-types/#custom-post-types)

## Custom Taxonomy

The generator for custom taxonomies will prompt you for some details that it will use to create the necessary files for registering the taxonomy. You can specify whether to create a script/template for the taxonomy listing page, and if you choose not to, the default archive script/template will be used. You will also be prompted to specify which post types the taxonomy should be associated with.

```sh
npm run generate:taxonomy
```

The following files will be created based on your inputs:

- `src/php/inc/taxonomies/<taxonomy-name>.php`
- `src/php/taxonomy-<taxonomy-name>.php` (optional)
- `src/php/views/taxonomy-<taxonomy-name>.twig` (optional)

[Custom Taxonomies documentation](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/)

## Shortcode

The generator for shortcodes will prompt you for a name, then create minimal files to register a shortcode. The bulk of implementation will still be up to you, but the boilerplate should speed things up a bit.

```sh
npm run generate:shortcode
```

The following files will be created based on your input:

- `src/php/inc/shortcodes/<shortcode-name>.php`
- `src/php/views/shortcodes/<shortcode-name>.twig`

[Shortcode documentation](https://codex.wordpress.org/Shortcode_API)

## Custom Page Template

The generator for custom page templates will prompt you for a name, then create minimal files to register a custom page type.

```sh
npm run generate:page-template
```

The following files will be created based on your input:

- `src/php/<page-template-name>.php`
- `src/php/views/<page-template-name>.twig`

[Page Template documentation](https://developer.wordpress.org/themes/template-files-section/page-template-files/)
