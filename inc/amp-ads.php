<?php
/**
 * Adding adverts part of the AMP pages.
 *
 * @since 1.0.0
 * @package Coldbox_Addon
 */

/**
 * Load the script for amp-ad for AMP pages.
 *
 * @since 1.0.0
 * @param string $head_items Hook the filter to add contents to inside of head.
 * @return The head contents will be output.
 */
function cd_addon_amp_analytics_script( $head_items ) {

	$analytics_id = cd_addon_amp_analytics_id();

	if ( ! empty( $analytics_id ) ) {
		// @codingStandardsIgnoreStart
		$head_items .= '<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>';
		// @codingStandardsIgnoreEnd
	}
	return $head_items;
}
add_action( 'cd_addon_amp_head', 'cd_addon_amp_analytics_script' );
