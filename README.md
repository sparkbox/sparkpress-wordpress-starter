# SparkPress WordPress Starter

This is a starter to fast-track WordPress websites. It provides a way to skip many of the steps required when setting up a WordPress installation. [Create a new repository from this template](./generate).

Out of the box, this template provides a minimal WordPress theme with basic support for core WordPress features with some boilerplate templates, JS, and CSS that can easily be removed or replaced as needed. Key features of this repo include:

- A docker development workflow to make local development predictable and consistent
- Support for SCSS with an ITCSS structure already in place
- Support for bundling JS with `esbuild` and testing JS with `vitest`
- Support for [Twig][twig] templates using [Timber][timber]
- Database import and export scripts to make syncing between environments simple and fast
- Generator scripts to speed up the process of adding:
  - Page templates
  - Custom post types
  - Shortcodes
  - Custom taxonomies
  - Reusable patterns
- Sample custom blocks which you can reference to create your own custom blocks
- Code style rules that are enforced by language-specific linters
- GitHub Action workflows for code quality, release management, and deployment processes

## Table of Contents

| Developer Documentation                             |
| --------------------------------------------------- |
| [Quickstart](#quickstart)                           |
| [Customization](#customization)                     |
| [Local Development Setup](#local-development-setup) |
| [WordPress](#wordpress)                             |
| [Project Structure](#project-structure)             |
| [Generators](#generators)                           |
| [Plugins](#plugins)                                 |
| [Custom Blocks](#custom-blocks)                     |
| [Deployment](#deployment)                           |
| [How to Contribute](./CONTRIBUTING.md)              |
| [Code of Conduct](./CODE_OF_CONDUCT.md)             |

## Quickstart

This project requires [Docker][docker] and [Node.js][node] for local development. You may also find it useful to install [Composer][composer] for linting in your editor, but it isn't strictly necessary. To run the project for the first time, do the following:

1. Duplicate `.env.example` and rename it `.env`, changing variables [as needed](#setting-local-environment-variables)
1. Run `npm install`
1. Run `npm run plugins:install` (this is necessary for the plugin for custom blocks)
1. Either run `npm start` or run `npm run build:dev` and `npm run serve:dev` in separate terminals
1. Based on whether you have a database to import or not, do one of the following:
   - Visit `https://localhost:8000/wp-admin` and run through the WordPress setup
   - Follow the instructions for [importing a DB](#importing-databases)
1. Go to `http://localhost:8000` to ensure the home page loads
1. Use `Ctrl+C` to stop any processes running in the terminal when you are done working or need to restart a process to pick up changes

## Customization

After generating a new repo from the Sparkpress template, you will need to change the following things to make the project your own:

- [ ] References to "sparkpress", "SparkPress", or "sparkpress-wordpress-starter"
	- [ ] `composer.json` (organization/project name in `name` field)
	- [ ] `docker-compose.yml` (web `container_name`)
	- [ ] `docker-compose.yml` (theme folder volume mapping)
	- [ ] `docker-compose.yml` (db `container_name`)
	- [ ] `Dockerfile` (link to repo)
	- [ ] `Dockerfile` (theme folder name)
	- [ ] `package.json` (`name` field)
	- [ ] `package-lock.json` (`name` fields)
	- [ ] `.github/workflows/deploy.docker.yml` (references to the container registry or delete the file if not using a docker deployment process)
	- [ ] `.github/workflows/deploy.pantheon.yml` (theme folder names)
	- [ ] `.github/workflows/release-please.yml` (`package-name` field)
	- [ ] `scripts/export-db.sh` (db container name)
	- [ ] `scripts/import-db.sh` (db container names)
	- [ ] `scripts/run.sh` (container name)
	- [ ] `src/php/style.css` (theme name plus the other metadata in the file)
	- [ ] `src/php/inc/theme-scripts.php` (metadata and prefixes for function/script names)
	- [ ] `src/php/inc/theme-setup.php` (metadata and prefixes for function names)
	- [ ] `src/php/inc/theme-styles.php` (metadata and prefixes for function names)
	- [ ] `src/php/inc/theme-widgets.php` (prefixes for function names)
	- [ ] `wp-configs/wp-config.php` (default theme name)
- [ ] `README` updates
	- [ ] Update main heading and project description
	- [ ] Delete the Sparkpress Team section with the list of contributors
	- [ ] Delete this Customization section (once finished with the other steps)

Beyond that, it's up to you to customize the site based on your project's needs. You can use or discard as much of the boilerplate JS, SCSS, or templates as you want, and you can use [generators](#generators) to scaffold new features to get up and running quickly.

## Local Development Setup

### Setting Local Environment Variables

For the local environment we are using a `.env` to define the username, passwords, and the database name used in the Docker container.

- `MYSQL_USER` is the username WordPress will use to access the database
- `MYSQL_PASSWORD` is the password for `MYSQL_USER`
- `MYSQL_DATABASE` is the name of the database for the WordPress installation
- `MYSQL_ROOT_PASSWORD` can be anything, it needs to be specified for your build to run
- `WP_ENV` is used to determine the environment. If it ends with `-local`, debugging will be enabled
- `SITE_URL` is used for DB imports/exports. It is used in find/replace operations to swap localhost URLs for staging/production environment URLs in the database

### Linting

This theme uses the following files for linting:

- ESLint for JS files with recommended rules for vanilla JS and React
- Stylelint for SCSS files with standard CSS and SCSS rules
- PHP_Codesniffer for PHP Files with rules from `wp-configs/phpcs-rules-standard.xml` which extends the WordPress Coding Standards.
- Twig_Codesniffer with default rules

### Syncing Environments

The preferred mechanism for syncing your environment with others is to use database imports and exports. This repo has a few scripts to make this process as easy as possible. While your containers are running, you can run any of these commands to import, export, or backup a database. Here are the quick commands, with more instructions below.

```sh
# import a DB from the `sql` folder
npm run import-db

# export your DB
npm run export-db

# export your DB with a custom name
npm run export-db validation-data

# backup your DB in case you need to restore it later
npm run backup-db

# backup your DB with a custom name
npm run backup-db work-in-progress
```

#### Importing Databases

You can import databases from production, a saved backup, or another developer's DB export with the `import-db` script. To use it, put a `*.sql.gz` file in a top-level `sql` folder in the repo and run `npm run import-db`. This will first back up your existing database in case you need to revert back to it, and then it will import the database from the given file, effectively replacing your database with a new one.

#### Exporting Databases

You can export your database for another developer to import or to import to a staging environment by running `npm run export-db`. By default, this will create a timestamped and gzipped file in `sql/exports`, but you can specify a name by running `npm run export-db <your-db-name-here>`. The exported file will still be timestamped, but it will use the name you give it instead of the default prefix.

#### Backing Up Databases

This will happen automatically when you import a database, but if you want to manually backup your database, you can run `npm run backup-db`. This functions nearly identically to the `export-db` script, except for using a different prefix and putting the file in `sql/backups`. As with `export-db`, you can specify a name for your DB backup if you want.

### Atom

If you use Atom, go to Preferences > Packages. Open the `language-php` Core Package settings. Go to the Tab Type setting and set the drop down option to `hard`.

#### VS Code

If you use Microsoft VS Code, create a `settings.json` inside a `.vscode` directory at the root of the project. Include this in your setting (it will help make developing with PHP_Codesniffer much easier):

```json
{
	"phpcs.standard": "wp-configs/phpcs-rules-standard.xml",
	"editor.tabSize": 2,
	"[php]": {
		"editor.tabSize": 4,
		"editor.insertSpaces": false,
		"editor.detectIndentation": false
	}
}
```

Helpful VS Code Extensions:

- [phpcs][phpcs_vscode]
- [Twig][twig_vscode]

## WordPress

### Upgrading WordPress

Whenever a new version of WordPress is released, follow this process to update to the new version.

1. Through your local WordPress admin, update the WordPress install to the latest version
1. If you can confirm the update made no breaking changes:
   1. Change `WP_VERSION` in `Dockerfile` to the latest version
   1. Submit a PR with the update
   1. If your hosting provider manages the WordPress version, update it through their mechanism for staging, test, and/or production enviroments
1. If the update made breaking changes, create a bug card and _do not_ push any changes

### Permalink Settings

Most likely, you want your urls to be more user/SEO friendly, like `example.com/category-name/name-of-page` rather than `example.com/?page_id=2` and `example.com/category-name` rather than `example.com/?cat=1`. To accomplish this:

1. Go to `Settings` > `Permalinks` in the admin dashboard
1. Select "Custom Structure" for the permalink setting
1. Set `/%category%/%postname%/` in the text field
1. Set `.` in the "Category base" field
1. Hit "Save Changes"

For other options see the [WordPress docs](https://wordpress.org/documentation/article/customize-permalinks/) for more info.

### Template Hierarchy

This starter template covers the generic templates needed for things like single post pages, archive (or listing) pages, the 404 page, and the search page, but you can override those using [WordPress' template hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/).

![Template hierarchy diagram](https://developer.wordpress.org/files/2014/10/Screenshot-2019-01-23-00.20.04.png)

For example, if you have a post type with the slug "news", you could create `single-news.php` and `archive-news.php` to take precedence over the default back-end logic and point them to `single-news.twig` and/or `archive-news.twig` if those pages need unique markup.

## Project Structure

All the files regarding editing the theme can be found in the `src` directory. Inside this directory are four sub-directories:

### JavaScript (`js/`)

The `js/` directory holds our individual JavaScript files. These are built with `esbuild`, which uses `index.js` as the entry point. The built file is written to `theme/js/scripts.js`, which is referenced by WordPress in `src/php/inc/theme-scripts.php`.

`eslint` is used to lint JS for code issues, and `vitest` is used to run JS tests. Use the following npm scripts to lint/test JS.

```sh
# lint JS files only
npm run lint:js

# run JS tests once
npm run test

# run JS tests in watch mode
npm run test:watch

# run JS tests and get a coverage report
npm run test:ci
```

### Sass (`scss/`)

The `scss/` directory holds our styles for the site which are written using [Sass][sass] and follows a modified [BEMIT][bemit] approach to naming and organizing. `stylelint` is used to check that SCSS files conform to our standards. Run `npm run lint:scss` to check SCSS files for issues.

We use SCSS partials to organize our styles according to [Inverted Triangle CSS][itcss]. Files should be organized into the following folders, depending on their purpose.

- `settings` - variables for things like colors, fonts, etc. to be reused
- `tools` - functions and mixins
- `generic` - used mainly for CSS resets and non-site-specific styles
- `elements` - styling for bare HTML elements (`h1`, `p`, `a`, etc.)
- `objects` - used mainly for generic layouts and high level structural styles
- `components` - specific component styles (most CSS will live here)
- `vendors` - third party styles
- `utilities` - helper classes to override any styles declared earlier in the cascade

### Plugins (`plugins/`)

See the [custom blocks](#custom-blocks) section for details.

### PHP (`php/`)

The `php/` directory holds the PHP template files for the WordPress theme. Other core, non-php files are included here as well. It structured to have a “lean” `functions.php` and include functionality in the `inc` subdirectory. `phpcs` will check that PHP files follow the [WordPress Coding Standards][wpcs], and `twigcs` will check Twig templates for linting issues as well. Run `npm run lint:php` to check PHP files and `npm run lint:twig` to check Twig templates for issues.

#### PHP Subdirectories

- `inc/` - Includes directory, to keep the `functions.php` file clean. Some important files to note are:
  - `custom-post-types/*.php` - Register custom post types
  - `helpers/*.php` - Add helper functions here, separated by purpose
  - `shortcodes/*.php` - Add shortcodes for the content editor to use
  - `taxonomies/*.php` - Register custom taxonomies to be made available to certain post types
  - `setup-queries.php` - Specify query variables here so WordPress can read them from HTTP requests
  - `theme-scripts.php` - Add JavaScript files here
  - `theme-setup.php` - Configure theme settings and supported features here
  - `theme-styles.php` - Add CSS files here
  - `theme-widgets.php` - Register [widgets][widgets] for admins to utilize and add them to Timber context here.
- `views/` - [Twig][twig] is used to separate presentation from logic, and all `.twig` components can be found here. Some Twig extensions, notably [HTML Extension][html-extension] and [String Extension][string-extension] have been added to enhance templates with data URIs, class management, text manipulation, and ASCII-safe string transformations.
  - `layouts` - Any twig templates that include the full document structure should go here. That includes the default `base.twig` template and any alternatives, such as for art-directed posts.
  - `partials` - Twig templates for components or pieces of the page to be reused should go here.
  - `shortcodes` - Twig templates for shortcodes should go here.

## Generators

We have a handful of generators to make it easier to add new custom post types, taxonomies, shortcodes, and page templates. If none of the generators give you what you need, you can try using https://generatewp.com/ to get more relevant code snippets.

### Custom Post Type

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

### Custom Taxonomy

The generator for custom taxonomies will prompt you for some details that it will use to create the necessary files for registering the taxonomy. You can specify whether to create a script/template for the taxonomy listing page, and if you choose not to, the default archive script/template will be used. You will also be prompted to specify which post types the taxonomy should be associated with.

```sh
npm run generate:taxonomy
```

The following files will be created based on your inputs:

- `src/php/inc/taxonomies/<taxonomy-name>.php`
- `src/php/taxonomy-<taxonomy-name>.php` (optional)
- `src/php/views/taxonomy-<taxonomy-name>.twig` (optional)

[Custom Taxonomies documentation](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/)

### Shortcode

The generator for shortcodes will prompt you for a name, then create minimal files to register a shortcode. The bulk of implementation will still be up to you, but the boilerplate should speed things up a bit.

```sh
npm run generate:shortcode
```

The following files will be created based on your input:

- `src/php/inc/shortcodes/<shortcode-name>.php`
- `src/php/views/shortcodes/<shortcode-name>.twig`

[Shortcode documentation](https://codex.wordpress.org/Shortcode_API)

### Custom Page Template

The generator for custom page templates will prompt you for a name, then create minimal files to register a custom page type.

```sh
npm run generate:page-template
```

The following files will be created based on your input:

- `src/php/<page-template-name>.php`
- `src/php/views/<page-template-name>.twig`

[Page Template documentation](https://developer.wordpress.org/themes/template-files-section/page-template-files/)

## Reusable Pattern

The generator for reusable patterns will prompt you for a name, description, and categories for the pattern, then create a script to register a reusable pattern with metadata based on your inputs and instructions for how to create the markup for the pattern.

```sh
npm run generate:pattern
```

The following file will be created based on your input:

- `src/php/patterns/<pattern-name>.php`

[Reusable pattern (a.k.a. Block pattern) documentation](https://developer.wordpress.org/themes/advanced-topics/block-patterns/)

## Plugins

### Installing Plugins

Install plugins via `composer` by running `npm run php:run composer require wpackagist-plugin/<plugin-name>:<version-number-or-range>`. For example:

```sh
# install a specific version/range for advanced-custom-fields
npm run php:run composer require wpackagist-plugin/advanced-custom-fields:^6.1

# or just install the latest version, letting composer resolve the range
npm run php:run composer require wpackagist-plugin/advanced-custom-fields
```

Running this command will update `composer.json` and `composer.lock`, but you will need to rebuild (`docker compose build`) and restart your container (`npm start` or `npm run serve:dev`) to see the new plugin reflected in the WordPress admin.

### Updating Plugins

You can run `composer require` as above to update existing plugins, or you can do the following.

1. Update the version number in the "require" list in `composer.json`.
1. Run `npm run php:run composer update` to update `composer.lock`.

Again, you'll need to rebuild and restart your container to see the changes reflected in WordPress.

### Recommended Plugins

This is a non-comprehensive list of plugins that we have found useful on other projects.

- [Metabox][metabox]
- [Advanced Custom Fields][advanced-custom-fields]
- [Yoast SEO][yoast-seo]
- [Google Site Kit][google-site-kit]
- [Contact Form 7][contact-form-7]
- [Rollbar][rollbar]

## Custom Blocks

We have a plugin for custom blocks called `example-blocks`, which lives in `src/plugins`. For the blocks to be available in WordPress, these steps must be taken:

1. Run `npm run plugins:install` to install the plugin's npm dependencies
1. Run `npm start` for local development (this runs the plugin's `npm start` command)
1. Activate the "Example Blocks" plugin from the WordPress menu

For production builds, running `npm run build:prod` will also work, outputting production bundles for the blocks.

### Creating a New Custom Block

Follow these steps to create a new custom block and wire it up with the normal development/build processes:

1. Create a new folder at `src/plugins/example-blocks/blocks/<block-name>`
1. Either copy files from another block or manually create these files:
   - `block.json`: configuration/metadata for the block
   - `src/index.js`: entry point for the JS bundle
   - `src/edit.js`: the component used while editing
   - `src/save.js`: the component rendered on the site
   - `src/editor.scss`: custom styles for the editor view
   - `src/style.scss`: custom styles for the block when rendered on the site
1. Configure the custom block by updating `block.json`, namely the `name`, `title`, `icon`, and `description` fields
1. Implement the edit function, which will usually be form controls corresponding to attributes that you define in `index.js`
1. Implement the save function, which will consume the attributes defined in `index.js` and render the block's desired markup

### Useful Resources

- [Create a Block Tutorial](https://developer.wordpress.org/block-editor/getting-started/create-block/)
- [Component Reference](https://developer.wordpress.org/block-editor/reference-guides/components/)

## Deployment

This starter template includes a couple of options for deployment workflows, including:

- Docker
- Pantheon

### Docker deployment workflow

This repo includes a [GitHub workflow for building a docker image](./.github/workflows/deploy.docker.yml) that gets pushed GitHub's container registry. This image can be deployed to any hosting provider that supports docker containers.

The image includes all core WordPress files for the version specified for `WP_VERSION` in the `Dockerfile`, as well as the theme and plugin files necessary for the site. The other element required for the site to run is the database, which is excluded, since each environment should have its own database that is specified by environment variables. This allows local developers to test against local data without interfering with production or staging environments.

### Pantheon

This repo includes a [Github workflow for deployment to Pantheon](./.github/workflows/deploy.pantheon.yml).
When enabled and configured, this workflow will deploy to Pantheon when commits are added to the `main` branch. This workflow is disabled by default. See instructions below for configuration.

#### Deployment workflow

Pantheon maintains its own git remote containing the WordPress core files. To deploy, we:

1. Build our theme artifacts
1. Fetch the Pantheon remote repo
1. Copy our theme artifacts into the appropriate locations in the Pantheon codebase
1. Commit the changes to the Pantheon repo
1. Push to the Pantheon remote

#### Site setup

1. See these instructions to [add a site to your Pantheon account](https://docs.pantheon.io/guides/getstarted/addsite).
1. Visit your Pantheon [site dashboard](https://docs.pantheon.io/guides/account-mgmt/workspace-sites-teams/sites#site-dashboard) and make sure your site's Development Mode is set to Git (it will likely be set to SFTP by default).
1. Click the "Clone with Git" button, follow the instructions to clone the repo locally.
1. In the cloned repo, open the `wp-config.php` file.
1. At the top of the file, directly under the `<?php` line, add this line:
   - `require __DIR__ . '/vendor/autoload.php';`
   - This allows the Pantheon site to autoload our vendor dependencies.
1. Commit the changes to this file.
1. Push the commit to Pantheon's `master` branch.

#### Deployment configuration

Deployment to Pantheon requires setting the following variables and secrets in Github. See these instructions for creating [variables](https://docs.github.com/en/actions/learn-github-actions/variables#creating-configuration-variables-for-a-repository) and [secrets](https://docs.github.com/en/actions/security-guides/using-secrets-in-github-actions#creating-secrets-for-a-repository).

##### Variables

- `DEPLOY_TO_PANTHEON`: set the value to `true` in order to enable deployment

##### Secrets

- `PANTHEON_ID_RSA` - The **private** ssh key that will be used to connect to Pantheon. See instructions for [generating an ssh key](https://docs.pantheon.io/ssh-keys#generate-an-ssh-key).
- `PRODUCTION_REPO` - The address of the Pantheon remote repo. See instructions below for [obtaining the value](#obtaining-production_repo-value).
- `PRODUCTION_USER_EMAIL` - The email address that will be used for deployment commit messages.
- `PRODUCTION_USER_NAME` - The username that will be used for deployment commit messages.
- `KNOWN_HOSTS` - Required in order to authenticate with Pantheon. See instructions below for [obtaining the value](#obtaining-known_hosts-value).

##### Obtaining `PRODUCTION_REPO` value

1. Visit your Pantheon [site dashboard](https://docs.pantheon.io/guides/account-mgmt/workspace-sites-teams/sites#site-dashboard).
1. In the "Development Mode" section, click "Clone with git" and copy the value.
1. Extract the server address from the copied value. It will have the format `ssh://*.git`. Use this as the value for `PRODUCTION_REPO`.

##### Obtaining `KNOWN_HOSTS` value

1. First, follow the instructions for generating an ssh key and obtaining the `PRODUCTION_REPO` values. You will use both of these to SSH into the Pantheon remote server to obtain the `KNOWN_HOSTS` value.
1. Ensure that the ssh key generated from step 1 is added to your local ssh agent by running:
   - `ssh-add ~/.ssh/id_rsa` (replace `id_rsa` with your key name)
1. SSH into the Pantheon server. The server address is a modified version of the `PRODUCTION_REPO` value, removing `/~/repository.git` from the end. The ssh command will look like this:
   - `ssh ssh://<SERVER_ADDRESS>.drush.in:2222`, where `<SERVER_ADDRESS>` is a unique value for your site.
1. After running the above command, you should be prompted to accept the server's fingerprint. Type `yes` and press enter.
1. This will add an entry into your `~/.ssh/known_hosts` file. You will likely see a message that `shell request failed on channel 0`, this can be ignored.
1. Open the file at `~/.ssh/known_hosts`.
1. In the file, locate the line that contains a server address matching `PRODUCTION_REPO`. Copy this entire line and use it as the value for `KNOWN_HOSTS`.

## Sparkpress Team

- **[Kasey Bonifacio](https://github.com/kaseybon)**
- **[Rise Erpelding](https://github.com/rise-erpelding)**
- **[Ricardo Fearing](https://github.com/rfearing)**
- **[Theo Gainey](https://github.com/theogainey)**
- **[Jon Oliver](https://github.com/jonoliver)**
- **[Rob Tarr](https://github.com/robtarr)**
- **[Dustin Whisman](https://github.com/dustin-jw)**
- **[Philip Zastrow](https://github.com/zastrow/)**

<!-- Links: -->

[docker]: https://www.docker.com
[composer]: https://getcomposer.org/download/
[node]: https://nodejs.org/en/
[twig_vscode]: https://marketplace.visualstudio.com/items?itemName=whatwedo.twig
[phpcs_vscode]: https://marketplace.visualstudio.com/items?itemName=shevaua.phpcs
[babel]: https://babeljs.io
[sb-eslint]: https://github.com/sparkbox/eslint-config-sparkbox
[sb-stylelint]: https://github.com/sparkbox/stylelint-config-sparkbox
[wpcs]: https://github.com/WordPress/WordPress-Coding-Standards
[bemit]: https://csswizardry.com/2015/08/bemit-taking-the-bem-naming-convention-a-step-further/
[twig]: https://twig.symfony.com/
[timber]: https://timber.github.io/docs/
[html-extension]: https://github.com/twigphp/html-extra
[string-extension]: https://github.com/twigphp/string-extra
[widgets]: https://developer.wordpress.org/themes/functionality/sidebars/
[metabox]: https://metabox.io/
[advanced-custom-fields]: https://www.advancedcustomfields.com/
[yoast-seo]: https://wordpress.org/plugins/wordpress-seo/
[google-site-kit]: https://sitekit.withgoogle.com/
[contact-form-7]: https://contactform7.com/
[rollbar]: https://docs.rollbar.com/docs/wordpress
[itcss]: https://www.xfive.co/blog/itcss-scalable-maintainable-css-architecture/
[bem]: http://getbem.com
[sass]: https://sass-lang.com/
