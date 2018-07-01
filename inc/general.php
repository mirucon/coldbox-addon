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
