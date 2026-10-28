# Maintenance

## Runtime behavior and support

AMP, Universal Analytics, Pocket and share counts are not provided.
Normal article display, settings, share links, OGP, verification tags and Ads
extension hooks remain. Old Coldbox `?amp=1` links redirect to ordinary pages.
Unrelated AMP plugins' `/amp/` paths are not intercepted. Saved retired settings
are left in the database; no user data migration or deletion is required.

Requires WordPress 5.2+ and PHP 7.4+. The minimum WordPress version reflects
runtime API requirements, independently of the CI matrix. Browser targets are
the latest two Chrome/Edge/Firefox/Safari releases, including iOS Safari; IE and
Opera Mini are excluded. CI checks WP 7.0/7.1 patches with representative PHP
versions from 7.4–8.5, using desktop Chromium and mobile WebKit in each configuration.
Firefox is also checked on WP 7.1 / PHP 8.3. These are representative engines,
not certification of every device/version. CI retains layout screenshots for
seven days alongside failure traces.

## Build and test

Use Node from `.nvmrc`, Composer, native PHP and MySQL/MariaDB.

```sh
node bin/package.mjs
composer install
# Create disposable databases named coldbox_test and coldbox_browser first.
# Defaults: loopback DB, user coldbox, password coldbox-test. Override with
# DB_HOST, DB_USER and DB_PASSWORD; never point these tests at a production DB.
export COLDBOX_THEME_DIR=/absolute/path/to/coldbox/dist
export COLDBOX_ADDON_DIR=/absolute/path/to/coldbox-addon/dist
WP_VERSION=7.1 bash tests/install.sh
WP_VERSION=7.1 composer test
```

The install script resolves the latest published patch in the chosen WP series.
PHPUnit runs against WordPress's official test bootstrap with a real database.
The companion package path makes local integration checks possible without
publishing either package. CI builds both public source repositories together.

Browser tests live in the theme checkout. Build both packages and follow the
browser commands in the [theme maintenance guide](https://github.com/mirucon/coldbox/blob/main/MAINTENANCE.md),
using COLDBOX_TEST_RUNTIME to point to this runtime if it was installed here.
This repository has no Playwright dependency or browser-install script.

Only `dist/` is installable. `bin/package.mjs` copies the PHP runtime, readme and
language assets; no generated CSS or npm dependencies are needed. Development
files and runtime fixtures are excluded from the package.

## Translation and publication

Extract a POT only when needed with `npm run pot` (official WP-CLI i18n command).
Compare gettext keys before editing wording. Existing language packs remain
usable for unchanged msgids, domains and contexts. Removed feature descriptions
do not require replacement translations. Distribution does not need a fresh POT
to load WordPress.org language packs.

Publication is a separate operation from source maintenance. After explicit
release authorization, choose release versions, build the installable packages
and verify their metadata before updating a dist branch or WordPress.org. CI
artifacts are candidates, not published releases.

See `docs/history/2026-10-21-upkeep.md` for the bounded cleanup decisions and
the deferred translation submission follow-up.
