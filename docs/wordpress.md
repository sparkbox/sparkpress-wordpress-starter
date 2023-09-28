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
