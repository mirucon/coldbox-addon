<?php
/**
 * General customize for the Coldbox theme.
 *
 * @since 1.1.6
 * @package Coldbox_Addon
 */

/**
 * Add target attr to the social links.
 */
function coldbox_addon_social_links_attr() {
	echo 'target="_blank"';
}
add_action( 'cd_social_links_attr', 'coldbox_addon_social_links_attr' );

/**
 * Deregister jQuery if the option is checked.
 */
function coldbox_addon_deregister_jquery() {
	if ( cd_do_not_load_jquery() ) {
		wp_deregister_script( 'jquery' );
	}
}
add_action( 'wp_enqueue_scripts', 'cd_scripts', 999 );
