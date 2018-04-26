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
 */
function cd_addon_amp_ampad_script() {

	$adsense_client      = cd_addon_amp_adsense_client();
	$adsense_unit_after  = cd_addon_amp_adsense_unit_after();
	$unit_middle         = cd_addon_amp_adsense_unit_middle();
	$client_for_auto_ads = cd_addon_amp_auto_ads_client_id();

	if ( ! empty( $adsense_client ) && ! empty( $adsense_unit_after ) || ! empty( $unit_middle ) ) {
		// @codingStandardsIgnoreStart
		echo '<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>';
		// @codingStandardsIgnoreEnd
	}
	if ( $client_for_auto_ads ) {
		// @codingStandardsIgnoreStart
		echo '<script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js"></script>';
		// @codingStandardsIgnoreEnd
	}
}
add_action( 'cd_addon_amp_head_action', 'cd_addon_amp_ampad_script' );

/**
 * Adds amp-ad on after the content for AMP pages.
 *
 * @since 1.0.0
 * @param string $contents Hook the filter to add ads to after the single article.
 * @return string The contents will be output after the single articles.
 */
function cd_addon_amp_ads_single_bottom( $contents ) {

	if ( ! cd_is_amp() ) {
		return;
	}

	$adsense_client     = cd_addon_amp_adsense_client();
	$adsense_unit_after = cd_addon_amp_adsense_unit_after();

	if ( ! empty( $adsense_client ) && ! empty( $adsense_unit_after ) ) {

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

	$adsense_client = cd_addon_amp_adsense_client();
	$adsense_unit   = cd_addon_amp_adsense_unit_middle();

	if ( ! empty( $adsense_client ) && ! empty( $adsense_unit ) ) {

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

	$analytics_id = cd_addon_amp_analytics_id();

	if ( ! empty( $analytics_id ) ) {
		// @codingStandardsIgnoreStart
		$head_items .= '<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>';
		// @codingStandardsIgnoreEnd
	}
	return $head_items;
}
add_action( 'cd_addon_amp_head', 'cd_addon_amp_analytics_script' );


/**
 * Adds AdSense auto ads support for AMP pages.
 *
 * @since 1.1.4
 */
function cd_addon_amp_auto_ads() {
	if ( cd_addon_amp_auto_ads_client_id() ) {
		echo '<amp-auto-ads type="adsense" data-ad-client="' . esc_attr( cd_addon_amp_auto_ads_client_id() ) . '"></amp-auto-ads>';
	}
}
add_action( 'cd_addon_amp_body_action', 'cd_addon_amp_auto_ads' );

/**
 * Adds a customizer option to input the client ID for auto-ads.
 *
 * @param WP_Customize_Manager $wp_customize Customizer hook.
 * @since 1.1.0
 */
function cd_addon_amp_auto_ads_customizer( $wp_customize ) {

	// Client id input.
	$wp_customize->add_setting(
		'amp_adsense_client', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'amp_adsense_client', array(
				'label'   => __( 'AdSense Client ID (data-ad-client)', 'coldbox-addon' ),
				'section' => 'amp_section',
				'type'    => 'text',
			)
		)
	);

	// Whether enable auto-ads or not.
	$wp_customize->add_setting(
		'amp_auto_ads', array(
			'default'           => false,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'amp_auto_ads', array(
				'label'   => __( 'Enable auto-ads on AMP pages.', 'coldbox' ),
				'section' => 'amp_section',
				'type'    => 'checkbox',
			)
		)
	);

	// Slot id for ad 1.
	$wp_customize->add_setting(
		'amp_adsense_unit_after', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'amp_adsense_unit_after', array(
				'label'       => __( 'AdSense Ad Unit ID 1 (data-ad-slot)', 'coldbox-addon' ),
				'description' => __( 'The ad unit will be shown at the end of the content. If you do not want to show ads, just leave it blank.', 'coldbox-addon' ),
				'section'     => 'amp_section',
				'type'        => 'text',
			)
		)
	);

	// Slot id for ad 2.
	$wp_customize->add_setting(
		'amp_adsense_unit_middle', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'amp_adsense_unit_middle', array(
				'label'       => __( 'AdSense Ad Unit ID 2 (data-ad-slot)', 'coldbox-addon' ),
				'description' => __( 'The ad unit will be shown at midst of the content.', 'coldbox-addon' ),
				'section'     => 'amp_section',
				'type'        => 'text',
			)
		)
	);
}
add_action( 'customize_register', 'cd_addon_amp_auto_ads_customizer' );


/**
 * Return client ID for auto-ads from Customizer.
 *
 * @since 1.1.4
 */
function cd_addon_amp_auto_ads_client_id() {
	$client_id = apply_filters( 'cd_addon_amp_auto_ads_client_id', get_theme_mod( 'amp_adsense_client', '' ) );
	if ( ! $client_id || ! get_theme_mod( 'amp_auto_ads', false ) ) {
		return false;
	}
	return wp_kses_data( $client_id );
}
