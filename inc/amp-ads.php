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
function cd_addon_amp_ampad_script( $head_items ) {

	if ( ! empty( cd_addon_amp_adsense_client() ) && ! empty( cd_addon_amp_adsense_unit_after() ) || ! empty( cd_addon_amp_adsense_unit_middle() ) ) {
		// @codingStandardsIgnoreStart
		$head_items .= '<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>';
		// @codingStandardsIgnoreEnd
	}
	return $head_items;
}
add_action( 'cd_addon_amp_head', 'cd_addon_amp_ampad_script' );

/**
 * Adds amp-ad on after the content for AMP pages.
 *
 * @since 1.0.0
 * @param string $contents Hook the filter to add ads to after the single article.
 * @return The contents will be output after the single articles.
 */
function cd_addon_amp_ads_single_bottom( $contents ) {

	if ( ! cd_is_amp() ) {
		return;
	}

	if ( ! empty( cd_addon_amp_adsense_client() ) && ! empty( cd_addon_amp_adsense_unit_after() ) ) {

		$contents = '<div class="content-box"><amp-ad layout="responsive" width="300" height="250" type="adsense" data-ad-client="' . cd_addon_amp_adsense_client() . '" data-ad-slot="' . cd_addon_amp_adsense_unit_after() . '"></amp-ad></div>';

	}
	$allowed_html = array(
		'amp-ad'          => array(
			'data-ad-client' => array(),
			'data-ad-slot'   => array(),
			'layout'         => array(),
			'type'           => array(),
			'height'         => array(),
			'width'          => array(),
			'class'          => array(),
		),
		'i-amphtml-sizer' => array(
			'style' => array(),
			'class' => array(),
		),
		'div'             => array(
			'class' => array(),
		),
	);
	echo wp_kses( $contents, $allowed_html );
	return $contents;
}
add_filter( 'cd_single_after_contents', 'cd_addon_amp_ads_single_bottom' );

/**
 * Adds amp-ad on middle of the post for AMP pages.
 *
 * @since 1.0.0
 * @param string $contents Hook the filter to add ads to middle of the single article.
 * @return string The contents will be output middle of the single articles.
 */
function cd_addon_amp_ads_single_middle( $contents ) {

	if ( ! cd_is_amp() ) {
		return;
	}

	if ( ! empty( cd_addon_amp_adsense_client() ) && ! empty( cd_addon_amp_adsense_unit_middle() ) ) {

		$contents .= '<amp-ad layout="fixed-height" height="100" type="adsense" data-ad-client="' . cd_addon_amp_adsense_client() . '" data-ad-slot="' . cd_addon_amp_adsense_unit_middle() . '"></amp-ad>';

		$allowed_html = array(
			'amp-ad'          => array(
				'data-ad-client' => array(),
				'data-ad-slot'   => array(),
				'layout'         => array(),
				'type'           => array(),
				'height'         => array(),
				'width'          => array(),
				'class'          => array(),
			),
			'i-amphtml-sizer' => array(
				'style' => array(),
				'class' => array(),
			),
			'div'             => array(
				'class' => array(),
			),
		);
		echo wp_kses( $contents, $allowed_html );
		return $contents;
	}
}
add_filter( 'cd_single_middle_contents', 'cd_addon_amp_ads_single_middle' );

/**
 * Load the script for amp-ad for AMP pages.
 *
 * @since 1.0.0
 * @param string $head_items Hook the filter to add contents to inside of head.
 * @return The head contents will be output.
 */
function cd_addon_amp_analytics_script( $head_items ) {

	if ( ! empty( cd_addon_amp_analytics_id() ) ) {
		// @codingStandardsIgnoreStart
		$head_items .= '<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>';
		// @codingStandardsIgnoreEnd
	}
	return $head_items;
}
add_action( 'cd_addon_amp_head', 'cd_addon_amp_analytics_script' );

/**
 * Adds Google Analytics for AMP pages.
 *
 * @since 1.0.0
 * @param string $body_items Hook the filter to add contents to inside of body.
 * @return The contents will be output after the body tag.
 */
function cd_addon_amp_analytics( $body_items ) {

	if ( ! empty( cd_addon_amp_analytics_id() ) ) {
		$body_items .= '<amp-analytics type="googleanalytics">
			<script type="application/json">
			{
				"vars": {
					"account": "' . cd_addon_amp_analytics_id() . '"
				},
				"triggers": {
					"trackPageviews": {
						"on": "visible",
						"request": "pageview"
					}
				}
			}
			</script>
		</amp-analytics>';
	}
	return $body_items;
}
add_action( 'cd_addon_amp_body', 'cd_addon_amp_analytics' );
