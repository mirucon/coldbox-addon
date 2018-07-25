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
		$content     = get_the_content();
		$description = wp_trim_words( $content, 95, '...' );
		wp_reset_postdata();
	} elseif ( is_front_page() ) {
		$description = get_bloginfo( 'description' );
	} else {
		$description = '';
	}
	$description = apply_filters( 'cd_addon_ogp_description', $description );

	$ogp_default_image = get_theme_mod( 'ogp_default_image' );
	if ( is_singular() && has_post_thumbnail() ) {
		$image = get_the_post_thumbnail_url();
	} elseif ( ! empty( $ogp_default_image ) ) {
		$image = $ogp_default_image;
	} elseif ( has_custom_logo() ) {
		$custom_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
		$image       = $custom_logo[0];
	} elseif ( has_site_icon() ) {
		$image = esc_url( get_site_icon_url( 500 ) );
	} else {
		$image = esc_url( get_theme_file_uri( 'assets/img/thumb-standard.png' ) );
	}
	$image = apply_filters( 'cd_addon_ogp_image', $image );

	if ( is_single() ) {
		$type = 'article';
	} else {
		$type = 'website';
	}
	$type = apply_filters( 'cd_addon_ogp_type', $type );

	global $wp;
	$link = home_url( $wp->request );
	$link = apply_filters( 'coldbox_addon_ogp_url', $link );

	$card = 'summary_large_image';
	$card = apply_filters( 'cd_addon_ogp_card_type', $card );

	$ogp  = '<!-- Coldbox Addon Open Graph -->' . PHP_EOL;
	$ogp .= '<meta name="description" content="' . esc_attr( $description ) . '"/>' . PHP_EOL;
	$ogp .= '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '"/>' . PHP_EOL;
	$ogp .= '<meta property="og:description" content="' . esc_attr( $description ) . '"/>' . PHP_EOL;
	$ogp .= '<meta property="og:type" content="' . esc_attr( $type ) . '"/>' . PHP_EOL;
	$ogp .= '<meta property="og:url" content="' . esc_url( $link ) . '"/>' . PHP_EOL;
	$ogp .= '<meta property="og:site_name" content="' . esc_attr( get_bloginfo() ) . '"/>' . PHP_EOL;
	$ogp .= '<meta property="og:image" content="' . esc_url( $image ) . '"/>' . PHP_EOL;
	$ogp .= '<meta name="twitter:card" content="' . esc_attr( $card ) . '" />' . PHP_EOL;
	$ogp .= '<meta name="twitter:domain" content="' . esc_url( home_url() ) . '" />' . PHP_EOL;
	$ogp .= '<meta property="og:locale" content="' . esc_attr( get_bloginfo( 'language' ) ) . '" />' . PHP_EOL;

	$twitter_username = cd_ogp_twitter_username();
	$facebook_id      = cd_ogp_facebook_id();

	if ( ! empty( $twitter_username ) ) {
		$ogp .= '<meta name="twitter:site" content="@' . esc_attr( $twitter_username ) . '" />' . PHP_EOL;
		$ogp .= '<meta name="twitter:creator" content="' . esc_attr( $twitter_username ) . '" />' . PHP_EOL;
	}
	if ( ! empty( $facebook_id ) ) {
		$ogp .= '<meta property="fb:admins" content="' . esc_attr( $facebook_id ) . '" />' . PHP_EOL;
	}

	if ( is_single() ) {
		$ogp .= '<meta property="article:published_time" content="' . esc_attr( get_the_time( 'c' ) ) . '" />' . PHP_EOL;
		if ( get_the_time() !== get_the_modified_time() ) {
			$ogp .= '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_time( 'c' ) ) . '" />' . PHP_EOL;
		}
	}

	$ogp .= '<!-- /Coldbox Addon Open Graph -->' . PHP_EOL;

	if ( cd_use_ogp() ) {
		echo apply_filters( 'cd_addon_meta_ogp_single', $ogp ); // WPCS: XSS OK.
	} else {
		return apply_filters( 'cd_addon_meta_ogp_single', $ogp );
	}
}
add_action( 'wp_head', 'cd_addon_meta_ogp' );


/**
 * Add ogp prefix to <html> tag.
 *
 * @since 1.1.0
 * @param string $output HTML attributes will be output.
 * @return string
 */
function cd_addon_ogp_html( $output ) {
	if ( ! cd_use_ogp() ) {
		return;
	}
	$output .= ' prefix="og: http://ogp.me/ns#"';
	return $output;
}
add_filter( 'language_attributes', 'cd_addon_ogp_html' );


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
			'title'    => __( 'Coldbox Add-on: OGP/Meta Settings', 'coldbox-addon' ),
			'priority' => 11,
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
				'label'       => __( 'Output Open Graph tags', 'coldbox-addon' ),
				'description' => __( 'Whether or not use Open Graph for normal pages. They are always active for AMP pages.', 'coldbox-addon' ),
				'section'     => 'meta_ogp',
				'type'        => 'checkbox',
			)
		)
	);

	// Open Graph default image.
	$wp_customize->add_setting( 'ogp_default_image' );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'ogp_default_image', array(
				'label'       => __( 'Open Graph default image', 'coldbox-addon' ),
				'description' => __( 'The default image used as a fallback image for Open Graph (Recommended size 1200x630 px)', 'coldbox-addon' ),
				'section'     => 'meta_ogp',
				'settings'    => 'ogp_default_image',
			)
		)
	);

	// Twitter username.
	$wp_customize->add_setting(
		'ogp_twitter_username', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'ogp_twitter_username', array(
				'label'       => __( 'Twitter username', 'coldbox-addon' ),
				'description' => __( 'Enter your Twitter username without "@" suffix.', 'coldbox-addon' ),
				'section'     => 'meta_ogp',
				'type'        => 'text',
			)
		)
	);
	// Facebook ID.
	$wp_customize->add_setting(
		'ogp_facebook_id', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'ogp_facebook_id', array(
				'label'   => __( 'Facebook page ID', 'coldbox-addon' ),
				'section' => 'meta_ogp',
				'type'    => 'text',
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
	return get_theme_mod( 'ogp_twitter_username', '' );
}

/**
 * Return Facebook page ID that user has entered.
 *
 * @since 1.1.0
 * @return string
 */
function cd_ogp_facebook_id() {
	return get_theme_mod( 'ogp_facebook_id', '' );
}
