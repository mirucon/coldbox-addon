<?php
/**
 * Plugin Name:     Coldbox Addons
 * Plugin URI:      https://coldbox.miruc.co/
 * Description:     The official addon plugin for the Coldbox theme.
 * Author:          Toshihiro Kanai
 * Author URI:      https://miruc.co/
 * Text Domain:     coldbox-addon
 * Domain Path:     /languages
 * Version:         1.1.7
 *
 * @package         Coldbox_Addon
 */

/**
 * Whether or not addon plugin is active.
 *
 * @since 1.0.0
 * @param bool $is_active Whether or not addon plugin is active.
 * @return bool Return true so that says addon is active.
 */
function cd_addon_is_active_addon( $is_active ) {
	$is_active = true;
	return $is_active;
}
add_filter( 'cd_is_active_addon', 'cd_is_active_addon', 1 );

/**
 * Register the language pack.
 *
 * @since 1.0.0
 */
function cd_addon_languages() {
	load_plugin_textdomain( 'coldbox-addon' );
}
add_action( 'plugins_loaded', 'cd_addon_languages' );

// Load the Social Buttons part.
require_once 'inc/share-buttons.php';

// Load the customizer part.
require_once 'inc/customizer.php';

// Load the AMP part.
require_once 'inc/amp.php';

// Load the amp ads part.
require_once 'inc/amp-ads.php';

// Load ogp part.
require_once 'inc/ogp.php';

// Load meta part.
require_once 'inc/meta.php';

// Load general part.
require_once 'inc/general.php';
