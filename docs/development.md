Local Development Setup
=======================

| Table of Contents                                                           |
|-----------------------------------------------------------------------------|
| [Docker and WordPress Setup](#docker-and-wordPress-setup)                   |
| [Running the Project](#running-the-project)                                 |
| [Setting Local Environment Variables](#setting-local-environment-variables) |
| [Syncing Environments](#syncing-environments)                               |
| [Editor Settings (where applicable)](#editor-settings-where-applicable)   |

Docker and WordPress Setup
--------------------------

1. Install [Docker][docker]
1. Install [Composer][composer]
1. Clone and pull down the repo
1. Open the repo directory in your terminal
1. Duplicate `env-sample` and rename it `.env`
1. Update the values in the `.env` to whatever you choose. **Note:** Leave `MYSQL_HOST=db` unchanged. The remaining values can be whatever you would like. Further information about those values below.
1. Run `npm install` to install node modules.
1. Run `npm start` to build your project with Docker.
1. Visit `https://localhost:8000/wp-admin` and run through the WordPress setup.
1. Head to `localhost:8000` to ensure the page loads.

Running the Project
-------------------

**Note:** If the Docker server is running, you will need stop it as this final step in the process will start it.

1. [Docker and WordPress Setup](#docker-and-wordpress-setup) must be run first, after which stop the Docker instance by pressing `Ctrl + C` in the running terminal session.
1. Install [Node][node]
1. In your terminal, navigate to the repo directory
1. Run `npm install`, wait for installation of modules
1. Run `npm start` to build the theme and have a watch task to automatically rerun the build when changes are made.

Setting Local Environment Variables
-----------------------------------

For the local environment we are using a `.env` to define the username, passwords, and the database name used in the Docker container.

- `MYSQL_USER` is the username WordPress will use to access the database
- `MYSQL_PASSWORD` is the password for `MYSQL_USER`
- `MYSQL_DATABASE` is the name of the database for the WordPress installation
- `MYSQL_ROOT_PASSWORD` can be anything, it needs to be specified for your build to run

Linting
-------

This theme uses the following files for linting:

- PHP_Codesniffer for PHP Files with rules from `sparkpress-standard.xml` which extends the WordPress Coding Standards.
- ESLint for JS files with rules that extend the `@sparkbox/eslint-config-sparkbox` coding standard
- Twig_Codesniffer with default rules

Syncing Environments
--------------------
**TBD**

## Atom

If you use Atom, go to Preferences>Packages. Open the `language-php` Core Package settings. Go to the Tab Type setting and set the drop down option to `hard`.

### VS Code

If you use Microsoft VS Code, create a `settings.json` inside a `.vscode` directory at the root of the project. Include this in your setting (it will help make developing with PHP_Codesniffer much easier):

```json
{
  "phpcs.standard": "sparkpress-standard.xml",
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
- [Twig][twigcs]
- [Twigcs Linter][twig_vscode]

<!-- Links: -->
[docker]:https://www.docker.com
[composer]:https://getcomposer.org/download/
[node]:https://nodejs.org/en/
[twigcs]:https://marketplace.visualstudio.com/items?itemName=cerzat43.twigcs
[twig_vscode]:https://marketplace.visualstudio.com/items?itemName=whatwedo.twig
[phpcs_vscode]:https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs
