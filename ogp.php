<?php
/**
 * Adding OGP meta tags to the Coldbox theme
 *
 * @since 1.1.0
 * @package Coldbox_Addon
 */

/**
 * Returns OGP meta tag for singular pages.
 *
 * @since 1.1.0
 * @param bool $echo Whether or not to echo it.
 * @return string
 **/
function cd_addon_meta_ogp_single( $echo = 1 ) {
	if ( is_singular() ) {
		global $post;
		setup_postdata( $post );
		$excerpt   = get_the_excerpt();
		$author_id = $post->post_author;
		wp_reset_postdata();

		$ogp  = '<meta property="og:title" content="' . the_title_attribute( 'echo=0' ) . '"/>';
		$ogp .= '<meta property="og:description" content="' . esc_attr( $excerpt ) . '"/>';
		$ogp .= '<meta property="og:type" content="article"/>';
		$ogp .= '<meta property="og:url" content="' . esc_url( get_permalink() ) . '"/>';
		$ogp .= '<meta property="og:site_name" content="' . esc_attr( get_bloginfo() ) . '"/>';
		$ogp .= '<meta property="og:image" content="' . esc_url( get_the_post_thumbnail_url() ) . '"/>';
		$ogp .= '<meta name="twitter:card" content="summary_large_image" />';
		$ogp .= '<meta name="twitter:domain" content="' . esc_url( home_url() ) . '" />';

		if ( ! empty( cd_twitter_username() ) ) {
			$ogp .= '<meta name="twitter:site" content="' . esc_attr( cd_twitter_username() ) . '" />';
			$ogp .= '<meta name="twitter:creator" content="' . esc_attr( cd_twitter_username() ) . '" />';
		}

		if ( $echo && cd_use_ogp() ) {
			echo apply_filters( 'cd_addon_meta_ogp_single', $ogp ); // WPCS: XSS OK.
		} else {
			return apply_filters( 'cd_addon_meta_ogp_single', $ogp );
		}
	}
}
add_action( 'wp_head', 'cd_addon_meta_ogp_single' );
/**
 * Register customizer contents for OGP settings.
 *
 * @since 1.1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer content to register.
 */
function cd_addon_meta_ogp_customizer( $wp_customize ) {
	// Register OGP tags section.
	$wp_customize->add_section(
		'meta_ogp', array(
			'title'    => __( 'Coldbox Add-on: OGP Tags', 'coldbox-addon' ),
			'priority' => 10,
		)
	);
	// Whether or not output ogp tags.
	$wp_customize->add_setting(
		'use_ogp', array(
			'default'           => true,
			'sanitize_callback' => 'cd_addon_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'use_ogp', array(
				'label'   => __( 'Output OGP tags', 'coldbox-addon' ),
				'section' => 'meta_ogp',
				'type'    => 'checkbox',
			)
		)
	);
}
add_action( 'customize_register', 'cd_addon_meta_ogp_customizer' );

/**
 * Checks if ogp tags are enabled.
 *
 * @since 1.1.0
 * @return bool
 */
function cd_use_ogp() {
	return (bool) get_theme_mod( 'use_ogp', true );
}
