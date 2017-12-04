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
 * @return string
 **/
function cd_addon_meta_ogp() {

	if ( is_singular() ) {
		global $post;
		setup_postdata( $post );
		$description = get_the_excerpt();
		wp_reset_postdata();
	} elseif ( is_front_page() ) {
		$description = get_bloginfo( 'description' );
	} else {
		$description = '';
	}
	$description = apply_filters( 'cd_addon_ogp_type', $description );

	if ( is_singular() ) {
		if ( has_post_thumbnail() ) {
			$image = get_the_post_thumbnail_url();
		}
	} elseif ( has_custom_header() ) {
		$custom_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
		$image = $custom_logo[0];
	} elseif ( has_site_icon() ) {
		$image = esc_url( get_site_icon_url( 500 ) );
	} else {
		$image = esc_url( get_theme_file_uri( '/img/thumb-standard.png' ) );
	}
	$image = apply_filters( 'cd_addon_ogp_type', $image );

	if ( is_single() ) {
		$type = 'article';
	} else {
		$type = 'website';
	}
	$type = apply_filters( 'cd_addon_ogp_type', $type );

	$ogp  = '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '"/>';
	$ogp .= '<meta property="og:description" content="' . esc_attr( $description ) . '"/>';
	$ogp .= '<meta property="og:type" content="' . esc_attr( $type ) . '"/>';
	$ogp .= '<meta property="og:url" content="' . esc_url( get_permalink() ) . '"/>';
	$ogp .= '<meta property="og:site_name" content="' . esc_attr( get_bloginfo() ) . '"/>';
	$ogp .= '<meta property="og:image" content="' . esc_url( $image ) . '"/>';
	$ogp .= '<meta name="twitter:card" content="summary_large_image" />';
	$ogp .= '<meta name="twitter:domain" content="' . esc_url( home_url() ) . '" />';

	if ( ! empty( cd_ogp_twitter_username() ) ) {
		$ogp .= '<meta name="twitter:site" content="' . esc_attr( cd_ogp_twitter_username() ) . '" />';
		$ogp .= '<meta name="twitter:creator" content="' . esc_attr( cd_ogp_twitter_username() ) . '" />';
	}
	if ( ! empty( cd_ogp_facebook_id() ) ) {
		$ogp .= '<meta property="fb:admins" content="' . esc_attr( cd_ogp_facebook_id() ) . '" />';
	}

	if ( cd_use_ogp() ) {
		echo apply_filters( 'cd_addon_meta_ogp_single', $ogp ); // WPCS: XSS OK.
	} else {
		return apply_filters( 'cd_addon_meta_ogp_single', $ogp );
	}
}
add_action( 'wp_head', 'cd_addon_meta_ogp' );
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
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'use_ogp', array(
				'label'       => __( 'Output OGP tags', 'coldbox-addon' ),
				'description' => __( 'OGP tags are always enabled for AMP pages.', 'coldbox-addon' ),
				'section'     => 'meta_ogp',
				'type'        => 'checkbox',
			)
		)
	);

	// Twitter username.
	$wp_customize->add_setting(
		'ogp_twitter_username', array(
			'default'           => true,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'ogp_twitter_username', array(
				'label'   => __( 'Twitter username', 'coldbox-addon' ),
				'section' => 'meta_ogp',
				'type'    => 'checkbox',
			)
		)
	);
	// Facebook ID.
	$wp_customize->add_setting(
		'ogp_facebook_id', array(
			'default'           => true,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'ogp_facebook_id', array(
				'label'   => __( 'Facebook page ID', 'coldbox-addon' ),
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

/**
 * Return Twitter username that user has entered.
 *
 * @since 1.1.0
 * @return string
 */
function cd_ogp_twitter_username() {
	return get_theme_mod( 'ogp_twitter_username', true );
}

/**
 * Return Facebook page ID that user has entered.
 *
 * @since 1.1.0
 * @return string
 */
function cd_ogp_facebook_id() {
	return get_theme_mod( 'ogp_facebook_id', true );
}