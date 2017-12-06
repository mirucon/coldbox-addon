<?php
/**
 * Adding several meta tags for the Coldbox theme
 *
 * @since 1.1.0
 * @package Coldbox_Addon
 */

/**
 * Output Google Analytics tag.
 *
 * @since 1.1.0
 * @return string
 */
function cd_addon_google_analytics() {
    $tracking_code = cd_addon_tracking_code();
    if ( empty( $tracking_code ) ) {
        return;
    }
    $ga = "<script type=\"text/javascript\" >
            window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
			ga('create', '" . esc_js( $tracking_code ) . "', 'auto');ga('send', 'pageview');
		</script><script async src=\"https://www.google-analytics.com/analytics.js\"></script>";
    echo apply_filters( 'cd_addon_google_analytics', $ga ); // WPCS: XSS OK.
    return apply_filters( 'cd_addon_google_analytics', $ga );
}
add_action( 'wp_head', 'cd_addon_google_analytics' );

/**
 * Output Google Analytics tag.
 *
 * @since 1.1.0
 * @return string
 */
function cd_addon_google_site_verification() {
    $verification_code = cd_addon_verification_code();
    if ( empty( $tracking_code ) ) {
        return;
    }
    $ga = '<meta name="google-site-verification" content="' . esc_attr( $verification_code ) . '" />';
    echo apply_filters( 'cd_addon_google_site_verification', $ga ); // WPCS: XSS OK.
    return apply_filters( 'cd_addon_google_site_verification', $ga );
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

    // Getting Google Analytics tracking code.
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
                'description' => __( 'Please enter your full tracking ID, like "UA-12345-6". You may use the same code set in the AMP section.', 'coldbox-addon' ),
                'section'     => 'meta_ogp',
                'type'        => 'text',
            )
        )
    );
    // Getting Google site verification code.
    $wp_customize->add_setting(
        'site_verification_code', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'site_verification_code', array(
                'label'       => __( 'Google site verification', 'coldbox-addon' ),
                'description' => sprintf( /* Translators: %s: line break. */
                                  __( 'Google site verification code is used to make sure that this site is owned by you.%s
                                       This will be the content of google-site-verification tag.', 'coldbox-addon' ),
                                  '<br />'
                                  ),
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
    return get_theme_mod( 'ga_tracking_code', '' );
}

/**
 * Returns Google Analytics tracking code that user has entered.
 *
 * @since 1.1.0
 * @return string
 */
function cd_addon_verification_code() {
    return get_theme_mod( 'site_verification_code', '' );
}
