# Plugins

## Installing Plugins

Install plugins via `composer` by running `npm run php:run composer require wpackagist-plugin/<plugin-name>:<version-number-or-range>`. For example:

```sh
# install a specific version/range for advanced-custom-fields
npm run php:run composer require wpackagist-plugin/advanced-custom-fields:^6.1

# or just install the latest version, letting composer resolve the range
npm run php:run composer require wpackagist-plugin/advanced-custom-fields
```

Running this command will update `composer.json` and `composer.lock`, but you will need to rebuild (`docker compose build`) and restart your container (`npm start` or `npm run serve:dev`) to see the new plugin reflected in the WordPress admin.

## Updating Plugins

You can run `composer require` as above to update existing plugins, or you can do the following.

1. Update the version number in the "require" list in `composer.json`.
1. Run `npm run php:run composer update` to update `composer.lock`.

Again, you'll need to rebuild and restart your container to see the changes reflected in WordPress.

## Recommended Plugins

This is a non-comprehensive list of plugins that we have found useful on other projects.

- [Metabox][metabox]
- [Advanced Custom Fields][advanced-custom-fields]
- [Yoast SEO][yoast-seo]
- [Google Site Kit][google-site-kit]
- [Contact Form 7][contact-form-7]
- [Rollbar][rollbar]

[metabox]: https://metabox.io/
[advanced-custom-fields]: https://www.advancedcustomfields.com/
[yoast-seo]: https://wordpress.org/plugins/wordpress-seo/
[google-site-kit]: https://sitekit.withgoogle.com/
[contact-form-7]: https://contactform7.com/
[rollbar]: https://docs.rollbar.com/docs/wordpress
