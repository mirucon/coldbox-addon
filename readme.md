# Coldbox Addons v1.2.2

[![Greenkeeper badge](https://badges.greenkeeper.io/mirucon/coldbox-addon.svg)](https://greenkeeper.io/)

**Contributors:** [@mirucon](https://profiles.wordpress.org/mirucon/)    
**Donate link:** https://gumroad.com/l/coldbox-ads-extension  
**Tags:** coldbox, coldbox-theme  
**Requires PHP**: 5.6  
**Requires at least:** 5.0  
**Tested up to:** 5.4  
**Stable tag:** 1.2.2  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  

Now available from the WordPress plugin directory! [https://wordpress.org/plugins/coldbox-addon/](https://wordpress.org/plugins/coldbox-addon/)

## Description

The powered addon for the Coldbox theme. It brings you AMP HTML and social features which help increasing your website's engagements. It is designed just for the Coldbox theme. Lightweight and safety, works perfectly with the theme.

### Features

* **AMP Pages** - The fastest HTML format - AMP. The plugin provides the easiest way to use AMP pages without any setting or coding. You can still use Google Analytics, Adsense etc. in the AMP pages.

* **Share Buttons** - You want your website to be shared by someone? The plugin efficiently increases the social engagement by showing social buttons.

  * *[SNS Count Cache](https://wordpress.org/plugins/sns-count-cache/) plugin is required to **show share counts.***

* **Open Graph tags** - It's the most important thing to get engagements on the social networks, including Twitter and Facebook! This is the simplest way to add Open Graph tags for the Coldbox users.

* **Other meta tags** - Not only open graph tags, but it supports even more meta features, such as Google Analytics, and other SEO-related tags too!


## Installation Instructions

1. You may install the Coldbox Addon plugin via the WordPress.org plugin directory, or by uploading the files to /wp-content/plugins/ directory at your server.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. That's it! The plugin automatically works with the Coldbox theme.

## Frequently Asked Questions

### How can I access to AMP pages?

You may access AMP page by adding "?amp=1" at the end of your articles URL. When visitors use Google search on mobile, they will automatically access to your AMP pages.

### Where are the share buttons shown?

By default, share buttons will be shown at the end of article content. Use `sns_buttons` shortcode to show them wherever you want in an article.
You can also use `<?php cd_addon_sns_buttons_list(); ?>` function to show them on any template files.

If you don't want the buttons to show at the end of content automatically, go and uncheck "Use social buttons" option in the theme customizer. You can call the share buttons using the shortcode function in that case.

## Changelog

1.2.2

* fix: Better amp-iframe setting for default in AMP pages
* fix: Delete incompatible attribute `mozallowfullscreen` in AMP pages

1.2.1

* fix: PHP Warning when Coldbox theme is not activated

1.2.0

* feat: Add share button support for LINE
* fix: "amphtml" href is broken when the URL includes query parameter
* fix: Correct Feedly button URL
* fix: Delete Google Plus things
* fix: Use custom excerpt for og:description content
* fix: "Not to use jQuery" option is not working in some cases

1.1.9

* Improved: Better AMP content detection
* Other small bug fixes and refactors

1.1.8

* Fixed: Make large size thumbnail AMP compatible
* Fixed: Fix AMP styling due to the upgrade of Font Awesome 5
* refactor: Upgrade to Font Awesome version 5
* refactor: Replace IcoMoon icons with Simple Icons

1.1.7

* Added: New option to deregister jQuery
* Added: New option to select fallback image for Open Graph
* Fixed: HTML outline
* Fixed: og:url field
* Fixed: Several styling issues on AMP pages

1.1.6

* Moved AMP AdSense features to the Coldbox Ads Extension plugin: https://coldbox.miruc.co/addons/google-adsense-extension/

1.1.5

* Added: Privacy Policy link in footer
* Fixed: Styling issue in AMP pages

1.1.4

* Added: Support for AdSense auto-ads on AMP pages
* Fixed: Custom logo was not showing on AMP pages
* Fixed: Several issues on AMP pages to make compatible with latest standard

1.1.3

* Updated: Changed file path as per Coldbox v1.5.0 release

1.1.2

* Improved: No more SNS Count Cache plugin to show social buttons (It's still required to show count badges)

1.1.1

* Bug fix

1.1.0

* Added: Open Graph tags
* Added: Google Analytics, and other meta integrations
* Added: SEO-related meta tags, such as `rel=next`, `rel=prev` tags
* Improved: Formatting/ brushing up codes

1.0.2
* Added: Specific PHP version
* Fixed: Undefined function error when the Coldbox theme is inactive

1.0.1
* Added: A customizer option to select whether or not uses AMP pages
* Improved: AMP HTML format

1.0

* Initial Release
