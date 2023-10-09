# Project Structure

All the files regarding editing the theme can be found in the `src` directory. Inside this directory are three sub-directories:

## JavasScript (`js/`)

The `js/` directory holds our individual JavaScript files. These are concatenated via [Babel][babel] with the build. Tests will check that JavaScript follows Sparkbox's [linting standards][sb-eslint].

## Sass (`scss/`)

The `scss/` directory holds our styles for the site which are written using [Sass][sass] and follows a modified [BEMIT][bemit] approach to naming and organizing. Tests will check that SCSS follows Sparkbox's Sass [linting standards][sb-stylelint].

## PHP (`php/`)

The `php/` directory holds the PHP template files for the WordPress theme. Other core, non-php files are included here as well. It structured to have a “lean” `functions.php` and include functionality in the `inc` subdirectory. This directory was built off of the [Underscores Starter Theme][underscores]. Tests will check that PHP files follow the [WordPress Coding Standards][wpcs].

### PHP Subdirectories

- `inc/` - Includes directory, to keep the `functions.php` file clean. Some important files to note are:
  - `shortcodes/*.php` - Add shortcodes for the content editor to use
  - `helpers/*.php` - Add helper functions here, separated by purpose
  - `setup-queries.php` - Specify query variables here so WordPress can read them from HTTP requests.
  - `theme-scripts.php` - Add JavaScript files here.
  - `theme-setup.php` - Configure theme settings and supported features here.
  - `theme-styles.php` - Add CSS files here.
  - `theme-widgets.php` - Register [widgets][widgets] for admins to utilize and add them to Timber context here.
- `views/` - [Twig][twig] is used to separate presentation from logic, and all `.twig` components can be found here. Some Twig extensions, notably [HTML Extension][html-extension] and [String Extension][string-extension] have been added to enhance templates with data URIs, class management, text manipulation, and ASCII-safe string transformations.
  - `layouts` - Any twig templates that include the full document structure should go here. That includes the default `base.twig` template and any alternatives, such as for art-directed posts.
  - `partials` - Twig templates for components or pieces of the page to be reused should go here.
  - `shortcodes` - Twig templates for shortcodes should go here.

[babel]: https://babeljs.io
[node]: https://nodejs.org/en/
[sb-eslint]: https://github.com/sparkbox/eslint-config-sparkbox
[sb-stylelint]: https://github.com/sparkbox/stylelint-config-sparkbox
[wpcs]: https://github.com/WordPress/WordPress-Coding-Standards
[bemit]: https://csswizardry.com/2015/08/bemit-taking-the-bem-naming-convention-a-step-further/
[twig]: https://twig.symfony.com/
[html-extension]: https://github.com/twigphp/html-extra
[string-extension]: https://github.com/twigphp/string-extra
[underscores]: https://underscores.me/
[widgets]: https://developer.wordpress.org/themes/functionality/sidebars/
