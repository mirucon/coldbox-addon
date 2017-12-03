<?php
/**
 * Plugin Name:     Coldbox Addon
 * Plugin URI:      https://coldbox.miruc.co/addon/
 * Description:     The official addon plugin for the Coldbox theme.
 * Author:          Toshihiro Kanai (Mirucon)
 * Author URI:      https://miruc.co/
 * Text Domain:     coldbox-addon
 * Domain Path:     /languages
 * Version:         1.0.3
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
require_once 'share-buttons.php';

// Load the customizer part.
require_once 'customizer.php';

// Load the AMP part.
require_once 'amp.php';

// Load the amp ads part.
require_once 'amp-ads.php';
