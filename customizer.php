<?php
/**
 * Adding customizer sections.
 *
 * @since 1.0.0
 * @package Coldbox_Addon
 */

/**
 * Adding sections for the addon settings.
 *
 * @since 1.0.0
 * @param array $wp_customize Hook the wp customizer contents.
 */
function cd_addon_czr( $wp_customize ) {

	// Adds AMP section of the customizer.
	$wp_customize->add_section(
		'amp_section', array(
			'title'    => __( 'Coldbox Add-on: AMP', 'coldbox-addon' ),
			'priority' => 13,
		)
	);

	// Whether or not use AMP pages.
	$wp_customize->add_setting(
		'use_amp', array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'use_amp', array(
				'label'   => __( 'Use AMP pages', 'coldbox-addon' ),
				'section' => 'amp_section',
				'type'    => 'checkbox',
			)
		)
	);

	// Pages you don't want to generate AMP.
	$wp_customize->add_setting(
		'no_amp_pages', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'no_amp_pages', array(
				'label'       => __( 'Pages you don\'t want to generate AMP', 'coldbox-addon' ),
				'description' => __( 'The page IDs articles will not be generated the AMP pages. You can set it like: 1, 12, 43.', 'coldbox-addon' ),
				'section'     => 'amp_section',
				'type'        => 'text',
			)
		)
	);

	// Adds Analytics settings for AMP pages.
	$wp_customize->add_setting(
		'amp_analytics', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'amp_analytics', array(
				'label'       => __( 'Analytics Tracking ID', 'coldbox-addon' ),
				'description' => __( 'Please enter your full tracking ID, like "UA-12345-6"', 'coldbox-addon' ),
				'section'     => 'amp_section',
				'type'        => 'text',
			)
		)
	);

	// Adds AdSense settings for AMP pages.
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

	// Adds AdSense settings for AMP pages.
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
				'description' => __( 'The ad unit will be shown at the end of the content. If you do not want to show ads, just keep it blank.', 'coldbox-addon' ),
				'section'     => 'amp_section',
				'type'        => 'text',
			)
		)
	);

	// Adds AdSense settings for AMP pages.
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
add_action( 'customize_register', 'cd_addon_czr' );

/**
 * Set the page IDs not to be AMP page as a function.
 *
 * @since 1.0.0
 */
function cd_addon_amp_no_generate() {
	$ids_raw = get_theme_mod( 'no_amp_pages', '' );
	$ids     = array_map( 'trim', explode( ',', $ids_raw ) );
	return $ids;
}

/**
 * Set the status of whether using AMP pages as a function.
 *
 * @since 1.0.1
 */
function cd_addon_use_amp_pages() {
	return get_theme_mod( 'use_amp', true );
}


/**
 * Set the Analytics tracking ID as a function.
 *
 * @since 1.0.0
 */
function cd_addon_amp_analytics_id() {
	return ( get_theme_mod( 'amp_analytics', '' ) );
}

/**
 * Set the AdSense client ID as a function.
 *
 * @since 1.0.0
 */
function cd_addon_amp_adsense_client() {
	return ( get_theme_mod( 'amp_adsense_client', '' ) );
}

/**
 * Set the AdSense unit ID that shown on after the content as a function.
 *
 * @since 1.0.0
 */
function cd_addon_amp_adsense_unit_after() {
	return ( get_theme_mod( 'amp_adsense_unit_after', '' ) );
}

/**
 * Set the AdSense unit ID that shown on middle of the content as a function.
 *
 * @since 1.0.0
 */
function cd_addon_amp_adsense_unit_middle() {
	return ( get_theme_mod( 'amp_adsense_unit_middle', '' ) );
}
