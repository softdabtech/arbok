# ARBOK WordPress Theme/Plugin Deployment

This repository deploys only the ARBOK WordPress theme and custom plugins to the live WordPress installation.

## Deployment path

GitHub repository:

`wp-content/`

is deployed to the live server path:

`/public_html/wp-content/`

## Included

- `wp-content/themes/arbok-deeptech/`
- `wp-content/plugins/arbok-core/`
- `wp-content/plugins/arbok-technologies-importer/`

## Not included

- WordPress core files
- `wp-config.php`
- database dumps
- media uploads
- credentials

## Deployment

Every push to `main` runs GitHub Actions and deploys the files by FTP using repository secrets.
