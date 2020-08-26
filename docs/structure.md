Project Structure
=================

All the files regarding editing the theme can be found in the `src` directory. Inside this directory are three sub-directories:

JavasScript (`js/`)
-------------------

The `js/` directory holds our individual JavaScript files. These are concatenated via [Babel][babel] with the build. Tests will check that JavaScript follows Sparkbox's [linting standards][sb-eslint].

Sass (`scss/`)
--------------

The `scss/` directory holds our styles for the site which are written using [Sass][sass] and follows a modified [BEMIT][bemit] approach to naming and organizing. Tests will check that SCSS follows Sparkbox's Sass [linting standards][sb-stylelint].

PHP (`php/`)
--------------
The `php/` directory holds the PHP template files for the WordPress theme. Other core, non-php files are included here as well.  It structured to have a “lean” `functions.php` and include functionality in the `inc` subdirectory. This directory was built off of the [Underscores Starter Theme][underscores]. Tests will check that PHP files follow the [WordPress Coding Standards][wpcs].

### PHP Subdirectories

- `inc/` - Includes directory, to keep the `functions.php` file clean. Some important files to note are:
	- `shortcodes/*.php` - Add shortcodes for the content editor to use
	- `helpers/*.php` - Add helper functions here, separated by purpose
	- `theme-scripts.php` - Add CSS and JavaScript files here.
- `template-parts/` - WordPress provides "Template Parts" which can be thought of as "Components". To use the template part you should utilize the `get_template_part` function provided by WordPress ([docs][template]).

[babel]:https://babeljs.io
[node]:https://nodejs.org/en/
[sb-eslint]:https://github.com/sparkbox/eslint-config-sparkbox
[sb-stylelint]:https://github.com/sparkbox/stylelint-config-sparkbox
[wpcs]:https://github.com/WordPress/WordPress-Coding-Standards
[bemit]:https://csswizardry.com/2015/08/bemit-taking-the-bem-naming-convention-a-step-further/
[template]:https://developer.wordpress.org/reference/functions/get_template_part/
[underscores]:https://underscores.me/
