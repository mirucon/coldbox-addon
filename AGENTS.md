# Working on Coldbox Add-on

This optional plugin extends the [Coldbox theme](https://github.com/mirucon/coldbox).
Keep it useful for existing sites with little owner involvement. Add machinery
only when it solves a concrete maintenance or user problem.

## Editing

- `coldbox-addon.php` loads the plugin. `inc/` owns share buttons, metadata,
  Customizer controls and theme integration. `bin/package.mjs` copies release
  files into `dist/`; edit source files, not the package output.
- WordPress loads plugins before the active child and parent themes. Check load
  order when using or defining theme helpers. Verify activation/deactivation and
  behavior with the theme absent when changing integration.
- Assess compatibility by user impact. Preserve saved setting keys, public hooks
  and functions when there is no useful reason to change them. Removing an old
  feature can be appropriate; account for existing content and URLs rather than
  maintaining every historical implementation.
- Preserve gettext msgids, domains and contexts when meaning is unchanged.
  New meaning needs accurate wording and an explicit translation consideration.

## Verification

Use [MAINTENANCE.md](MAINTENANCE.md) for setup and supported targets.
`node bin/package.mjs` builds the installable plugin. `composer test` runs native
PHP tests against WordPress and a real database. Shared Playwright checks live
in the theme repository; test the two built packages together for integration
changes. For settings, verify save/reload and the resulting frontend behavior.
Complete available checks and repair findings without handing local environment
setup to the owner. Add focused regression tests for meaningful failure modes.
Keep runtime fixtures, credentials and development dependencies out of packages.

## Source and releases

Direct commits on the default branch are sufficient; PRs are optional. Preserve
unrelated work and review outgoing changes. WordPress.org uploads, release tags
and `dist` branch updates require explicit release authorization, separate from
source maintenance.

Keep reusable agent guidance here, operational commands in MAINTENANCE.md, and
dated investigations and verification evidence in `docs/history/`.
