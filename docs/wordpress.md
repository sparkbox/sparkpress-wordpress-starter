# WordPress

## Upgrading Process

1. Update the WordPress install to the latest version.
1. If you can confirm the update made no breaking changes:
   1. Change `WP_VERSION` in `Dockerfile` and `.circleci/config.yml` to the latest version.
   1. Submit a PR with the update.
1. If the update made breaking changes. Create a bug card. Do not push any changes.

## Suggested Settings

- **Permalinks**: Most likely, you want your urls to look like `example.com/name-of-page` rather than `example.com/?page_id=2`. To accomplish this:

  1. Go to `Settings` > `Permalinks` in the admin dashboard
  1. Select "Post Name" for the permalink setting
  1. Hit "Save Changes"

## Template Hierarchy

This starter template covers the generic templates needed for things like single post pages, archive (or listing) pages, the 404 page, and the search page, but you can override those using [WordPress' template hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/).

![Template hierarchy diagram](https://developer.wordpress.org/files/2014/10/Screenshot-2019-01-23-00.20.04.png)

For example, if you have a post type with the slug "news", you could create `single-news.php` and `archive-news.php` to take precedence over the default back-end logic and point them to `single-news.twig` and/or `archive-news.twig` if those pages need unique markup.
