# Local Development Setup

| Table of Contents                                                           |
| --------------------------------------------------------------------------- |
| [Docker and WordPress Setup](#docker-and-wordPress-setup)                   |
| [Running the Project](#running-the-project)                                 |
| [Setting Local Environment Variables](#setting-local-environment-variables) |
| [Syncing Environments](#syncing-environments)                               |
| [Editor Settings (where applicable)](#editor-settings-where-applicable)     |

## Docker and WordPress Setup

1. Install [Docker][docker]
1. Install [Composer][composer]
1. Clone and pull down the repo
1. Open the repo directory in your terminal
1. Duplicate `.env.example` and rename it `.env`
1. Update the values in the `.env` to whatever you choose. **Note:** Leave `MYSQL_HOST=db` unchanged. The remaining values can be whatever you would like. Further information about those values below.
1. Run `npm install` to install node modules.
1. Start the project:
   1. Run `npm run build:dev` to build and watch theme files.
   1. Run `npm run serve:dev` to start the WordPress server with Docker.
      - Note: both of these commands can be run together with `npm start` if desired.
1. Visit `https://localhost:8000/wp-admin` and run through the WordPress setup.
1. Head to `localhost:8000` to ensure the page loads.

## Running the Project

**Note:** If the Docker server is running, you will need stop it as this final step in the process will start it.

1. [Docker and WordPress Setup](#docker-and-wordpress-setup) must be run first, after which stop the Docker instance by pressing `Ctrl + C` in the running terminal session.
1. Install [Node][node]
1. In your terminal, navigate to the repo directory
1. Run `npm install`, wait for installation of modules
1. Run `npm start` to build the theme and have a watch task to automatically rerun the build when changes are made.

## Setting Local Environment Variables

For the local environment we are using a `.env` to define the username, passwords, and the database name used in the Docker container.

- `MYSQL_USER` is the username WordPress will use to access the database
- `MYSQL_PASSWORD` is the password for `MYSQL_USER`
- `MYSQL_DATABASE` is the name of the database for the WordPress installation
- `MYSQL_ROOT_PASSWORD` can be anything, it needs to be specified for your build to run

## Linting

This theme uses the following files for linting:

- PHP_Codesniffer for PHP Files with rules from `sparkpress-standard.xml` which extends the WordPress Coding Standards.
- ESLint for JS files with rules that extend the `@sparkbox/eslint-config-sparkbox` coding standard
- Twig_Codesniffer with default rules

## Syncing Environments

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

### Importing Databases

You can import databases from production, a saved backup, or another developer's DB export with the `import-db` script. To use it, put a `*.sql.gz` file in a top-level `sql` folder in the repo and run `npm run import-db`. This will first back up your existing database in case you need to revert back to it, and then it will import the database from the given file, effectively replacing your database with a new one.

### Exporting Databases

You can export your database for another developer to import or to import to a staging environment by running `npm run export-db`. By default, this will create a timestamped and gzipped file in `sql/exports`, but you can specify a name by running `npm run export-db <your-db-name-here>`. The exported file will still be timestamped, but it will use the name you give it instead of the default prefix.

### Backing Up Databases

This will happen automatically when you import a database, but if you want to manually backup your database, you can run `npm run backup-db`. This functions nearly identically to the `export-db` script, except for using a different prefix and putting the file in `sql/backups`. As with `export-db`, you can specify a name for your DB backup if you want.

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

[docker]: https://www.docker.com
[composer]: https://getcomposer.org/download/
[node]: https://nodejs.org/en/
[twigcs]: https://marketplace.visualstudio.com/items?itemName=cerzat43.twigcs
[twig_vscode]: https://marketplace.visualstudio.com/items?itemName=whatwedo.twig
[phpcs_vscode]: https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs
