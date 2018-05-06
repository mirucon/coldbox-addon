# Coldbox Addon v1.1.4
**Contributors:** [@mirucon](https://profiles.wordpress.org/mirucon/)    
**Donate link:** Bitcoin: 1FRoTiS4kFVP9oK8cWqrJhvAu1tC1PqVxx  
**Tags:** coldbox, coldbox-theme  
**Requires at least:** 4.7  
**Tested up to:** 4.9  
**Stable tag:** 1.1.4  
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
