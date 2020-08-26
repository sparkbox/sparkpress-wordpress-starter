Plugins
=======

Installing Plugins
------------------
1. Add the plugin to the "require" list in `composer.json` following the format:
   ```
   "wpackagist-plugin/<slug of the new plugin>": "<version number>"
   ```
   e.g.
   ```
   "wpackagist-plugin/wordpress-seo": "14.5"
   ```
2. Add any relevant details to the [Plugins List](#plugins-list) found at the bottom of this page.

Updating Plugins
----------------
1. Update the version number in the "require" list in `composer.json`.
1. Run `composer update` to update `composer.lock`.
