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

	// Whether to use jQuery or not.
	$wp_customize->add_setting(
		'do_not_load_jquery',
		array(
			'default'           => false,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'do_not_load_jquery',
			array(
				'label'       => esc_html__( 'Enforce not to load jQuery', 'coldbox-addon' ),
				'description' => esc_html__( 'Although the Coldbox theme\'s scripts do not require jQuery to work, other plugins scripts require jQuery to operate. This option can enforce not to load jQuery and can make your website faster, but please be careful as this might make some scripts inoperative. This won\'t remove it from admin screens.', 'coldbox-addon' ),
				'section'     => 'global',
				'type'        => 'checkbox',
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
