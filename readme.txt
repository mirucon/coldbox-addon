=== Coldbox Addon ===
Contributors: mirucon
Donate link: https://valu.is/mirucon/
Tags: coldbox, coldbox-theme
Requires at least: 4.7
Tested up to: 4.9
Requires PHP: 5.2
Stable tag: 1.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The powered addon for the Coldbox theme. It brings you AMP HTML and social features which help increasing your website's engagement.


== Description ==

The powered addon for the Coldbox theme. It brings you AMP HTML and share buttons which help increasing your website's engagement. It has been designed for the Coldbox theme. Lightweight and safety.

== Features ==

* **AMP Pages** - The fastest HTML format - AMP. The plugin is the easiest way to use AMP pages unless any setting or coding. Of course, you can use Google Analytics, Adsense etc. in AMP pages, so that you won't loose any opportunities.

* **Share Buttons** - You want your website to be shared by someone? The plugin efficiently increases the social engagement by showing social buttons.

  * *[SNS Count Cache](https://wordpress.org/plugins/sns-count-cache/) plugin is required to use share buttons.*

* **Open Graph tags** - The most important thing to get engagements on the social networks, including Twitter and Facebook! This is the simplest way to add Open Graph tags for the Coldbox users.

* **Other meta tags** - Not only open graph tags, it supports even more meta features, like Google Analytics, and other SEO-related tags! The way, you can simply

* (Coming soon) **Google AdSense**


== Installation Instructions ==

1. You may install the Coldbox Addon plugin via the WordPress.org plugin directory, or by uploading the files to /wp-content/plugins/ directory at your server.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. That's it! The plugin automatically works with the Coldbox theme.

== Frequently Asked Questions ==

= What URL do the AMP pages use? =

You may access AMP page by adding "?amp=1" at the end of your URL. When visitors use Google search on mobile, they will automatically access to your AMP page.

= Where are the share buttons shown? =

By default, the share buttons are shown at the end of article content. You may use `sns_buttons` shortcode when you want to show them at the beginning or midst of the content.
You can also use `<?php cd_addon_sns_buttons_list(); ?>` function to show them on any template files.

If you don't want the buttons to show at the end of content, go and uncheck "Use social buttons" option in the theme customizer. You can still call the buttons using shortcode and the function.


== Screenshots ==

1. Share Buttons sample
2. AMP page sample

== Changelog ==

= 1.1.0 =

* Added: Open Graph tags
* Added: Google Analytics, and other meta integrations
* Added: SEO-related meta tags, such as `rel=next`, `rel=prev` tags
* Improved: Formatting/ brushing up codes

= 1.0.3 =
* Fixed: Translating issues

= 1.0.2 =
* Fixed: Undefined function error when the Coldbox theme is inactive
* Added: Specific PHP version

= 1.0.1 =
* Improved: AMP HTML format
* Added: A custmizer option to select whether or not uses AMP pages

= 1.0 =
* Initial Release