<?php
/**
 * Adding several meta tags for the Coldbox theme
 *
 * @since 1.1.0
 * @package Coldbox_Addon
 */

function cd_addon_google_analytics() {
    $tracking_code = cd_addon_tracking_code();
    $ga = "<script type=\"text/javascript\" >
            window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
			ga('create', '" . esc_js( $tracking_code ) . "', 'auto');ga('send', 'pageview');
		</script><script async src=\"https://www.google-analytics.com/analytics.js\"></script>";
    echo apply_filters( 'cd_addon_google_analytics', $ga ); // WPCS: XSS OK.
}
add_action( 'wp_head', 'cd_addon_google_analytics' );

/**
 * Register customizer contents for meta settings.
 *
 * @since 1.1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer content to register.
 */
function cd_addon_meta_customizer( $wp_customize ) {

    // Whether or not output ogp tags.
    $wp_customize->add_setting(
        'ga_tracking_code', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'ga_tracking_code', array(
                'label'       => __( 'Google Analytics tracking code', 'coldbox-addon' ),
                'description' => __( 'Please enter your full tracking ID, like "UA-12345-6". You may use the same code that is setting in the AMP section.', 'coldbox-addon' ),
                'section'     => 'meta_ogp',
                'type'        => 'text',
            )
        )
    );
}
add_action( 'customize_register', 'cd_addon_meta_customizer' );

/**
 * Returns Google Analytics tracking code that user has entered.
 *
 * @since 1.1.0
 * @return string
 */
function cd_addon_tracking_code() {
    return get_theme_mod( 'ga_tracking_code', true );
}
