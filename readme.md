# Coldbox Addon
**Contributors:** [@mirucon](https://profiles.wordpress.org/mirucon/)    
**Donate link:** https://valu.is/mirucon/  
**Tags:** coldbox, coldbox-theme  
**Requires at least:** 4.7  
**Tested up to:** 4.8  
**Stable tag:** 1.0.0  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html

The powered addon for the Coldbox theme. It brings you AMP HTML and share buttons which help increasing your website's engagement. It is degined for the Coldbox theme. Lightweight and safety.

This plugin is now available on the WP.org directory! [https://wordpress.org/plugins/coldbox-addon/](https://wordpress.org/plugins/coldbox-addon/)


## Description

The addon plugin makes the most of the Coldbox theme. 

### Features

* **AMP Pages** - The fastest HTML format - AMP. The plugin is the easiest way to use AMP pages unless any setting or coding.

* **Share Buttons** - You want your website to be shared by someone? The plugin efficiently increases the social engagement by showing social buttons.

  * *Require the [SNS Count Cache](https://wordpress.org/plugins/sns-count-cache/) plugin to use share buttons.*


## Installation Instructions

1. You may install the Coldbox Addon plugin via the WordPress.org plugin directory, or by uploading the files to /wp-content/plugins/ directory at your server.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. That's it! The plugin automatically works with the Coldbox theme.

## Frequently Asked Questions

### What URL do the AMP pages use?

You may access AMP page by adding "?amp=1" at last of the URLs. When visitors use Google search, they automatically access to your AMP page.

### Where are the share buttons shown?

By default, the share buttons are shown at the end of article content. You may use `sns_buttons` shortcode when you want to show them at beginning or midst of the content.  
You can also call the buttons anywhere by using the `<?php cd_addon_sns_buttons_list(); ?>` function.

If you don't want the buttons to show at the end of article content, go to customizer and uncheck "Use social buttons" option. You can still call the buttons using shortcode or the function.

## Changelog

1.0

* Initial Release
