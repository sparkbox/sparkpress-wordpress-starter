# Deployment

## Pantheon

This repo includes a [Github workflow for deployment to Pantheon](../.github/workflows/deploy.pantheon.yml).
When enabled and configurated, this workflow will deploy to Pantheon when commits are added to the `main` branch. This workflow is disabled by default. See instructions below for configuration.

### Deployment workflow
Pantheon maintains its own git remote containing the WordPress core files. To deploy, we:
1. Build our theme artifacts
1. Fetch the Pantheon remote repo
1. Copy our theme artifacts into the appropriate locations in the Pantheon codebase
1. Commit the changes to the Pantheon repo
1. Push to the Pantheon remote

### Site setup

1. See these instructions to [add a site to your Pantheon account](https://docs.pantheon.io/guides/getstarted/addsite).
1. Visit your Pantheon [site dashboard](https://docs.pantheon.io/guides/account-mgmt/workspace-sites-teams/sites#site-dashboard) and make sure your site's Development Mode is set to Git (it will likely be set to SFTP by default).
![Pantheon Development Mode](_assets/pantheon-development-mode.png)
1. Click the "Clone with Git" button, follow the instructions to clone the repo locally.
1. In the cloned repo, open the `wp-config.php` file.
1. At the top of the file, directly under the `<?php` line, add this line:
   - `require __DIR__ . '/vendor/autoload.php';`
   - This allows the Pantheon site to autoload our vendor dependencies.
1. Commit the changes to this file.
1. Push the commit to Pantheon's `master` branch.
### Deployment configuration

Deployment to Pantheon requires setting the following variables and secrets in Github. See these instructions for creating [variables](https://docs.github.com/en/actions/learn-github-actions/variables#creating-configuration-variables-for-a-repository) and [secrets](https://docs.github.com/en/actions/security-guides/using-secrets-in-github-actions#creating-secrets-for-a-repository).

#### Variables

- `DEPLOY_TO_PANTHEON`: set the value to `true` in order to enable deployment
#### Secrets

- `PANTHEON_ID_RSA` - The **private** ssh key that will be used to connect to Pantheon. See instructions for [generating an ssh key](https://docs.pantheon.io/ssh-keys#generate-an-ssh-key).
- `PRODUCTION_REPO` - The address of the Pantheon remote repo. See instructions below for [obtaining the value](#obtaining-production_repo-value).
- `PRODUCTION_USER_EMAIL` - The email address that will be used for deployment commit messages.
- `PRODUCTION_USER_NAME` - The username that will be used for deployment commit messages.
- `KNOWN_HOSTS` - Required in order to authenticate with Pantheon. See instructions below for [obtaining the value](#obtaining-known_hosts-value).

#### Obtaining `PRODUCTION_REPO` value

1. Visit your Pantheon [site dashboard](https://docs.pantheon.io/guides/account-mgmt/workspace-sites-teams/sites#site-dashboard).
1. In the "Development Mode" section, click "Clone with git" and copy the value.
![Pantheon Development Mode](_assets/pantheon-development-mode.png)
1. Extract the server address from the copied value. It will have the format `ssh://*.git`. Use this as the value for `PRODUCTION_REPO`.

#### Obtaining `KNOWN_HOSTS` value
1. First, follow the instructions for generating an ssh key and obtaining the `PRODUCTION_REPO` values. You will use both of these to SSH into the Pantheon remote server to obtain the `KNOWN_HOSTS` value.
1. Ensure that the ssh key generated from step 1 is added to your local ssh agent by running:
   - `ssh-add ~/.ssh/id_rsa` (replace `id_rsa` with your key name)
1. SSH into the Pantheon server. The server address is a modified version of the `PRODUCTION_REPO` value, removing `/~/repository.git` from the end. The ssh command will look like this:
   - `ssh ssh://<SERVER_ADDRESS>.drush.in:2222`, where `<SERVER_ADDRESS>` is a unique value for your site.
1. After running the above command, you should be prompted to accept the server's fingerprint. Type `yes` and press enter.
1. This will add an entry into your `~/.ssh/known_hosts` file. You will likely see a message that `shell request failed on channel 0`, this can be ignored.
1. Open the file at `~/.ssh/known_hosts`.
1. In the file, locate the line that contains a server address matching `PRODUCTION_REPO`. Copy this entire line and use it as the value for `KNOWN_HOSTS`.