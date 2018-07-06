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
 * @param WP_Customize_Manager $wp_customize Hook the wp customizer contents.
 */
function cd_addon_czr( $wp_customize ) {

	require_once 'class-cd-addon-custom-content.php';

	// Whether not to use jQuery.
	$wp_customize->add_setting(
		'do_not_load_jquery', array(
			'default'           => false,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'do_not_load_jquery', array(
				'label'       => esc_html__( 'Enforce not to load jQuery', 'coldbox-addon' ),
				'description' => esc_html__( 'Since the Coldbox theme\'s scripts do not require jQuery to work, other plugin\'s scripts require jQuery to operate if the site loads jQuery. This option can enforce not to load jQuery, but please be careful as this might make some scripts inoperative. This won\'t remove it from admin pages.', 'coldbox-addon' ),
				'section'     => 'global',
				'type'        => 'checkbox',
			)
		)
	);

	// Adds AMP section of the customizer.
	$wp_customize->add_section(
		'amp_section', array(
			'title'    => __( 'Coldbox Add-on: AMP', 'coldbox-addon' ),
			'priority' => 10,
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

	$wp_customize->add_setting(
		'amp_ads_have_been_moved', array(
			'sanitize_callback' => 'cd_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Cd_Addon_Custom_Content(
			$wp_customize, 'amp_ads_have_been_moved', array(
				'content'     => '<h3 class="czr-heading">' . __( 'Ads settings have been moved!', 'coldbox-addon' ) . '</h3>',
				'description' => sprintf(
					/* translators: 1: opening a tag, 2: closing a tag. */
					esc_html__(
						'AMP ads settings have been moved to the %1$sColdbox Ads Extension%2$s plugin. This plugin contains the full support of Coldbox theme\'s ad settings, including one-click auto-ads and suitable places for matched content, in-feed ads, other native ads and more! Available from $20 with the GPL license.', 'coldbox-addon'
					),
					'<a href="' . esc_url( __( 'https://coldbox.miruc.co/addons/google-adsense-extension/', 'coldbox-addon' ) ) . '">',
					'</a>'
				),
				'section'     => 'amp_section',
			)
		)
	);

}
add_action( 'customize_register', 'cd_addon_czr' );

/**
 * Get whether not to load jQuery or not
 *
 * @since 1.1.7
 */
function cd_do_not_load_jquery() {
	$do_not_load_jquery = get_theme_mod( 'do_not_load_jquery', false );

	return apply_filters( 'cd_do_not_load_jquery', $do_not_load_jquery );
}

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
