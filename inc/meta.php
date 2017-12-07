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
	$ga = "<script type=\"text/javascript\">
           (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},
           i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })
           (window,document,'script','https://www.google-analytics.com/analytics.js','ga'); ga('create', '" . esc_js( $tracking_code ) . "', 'auto'); ga('send', 'pageview');</script>";

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
	$verify = '<meta name="google-site-verification" content="' . esc_attr( $verification_code ) . '" />';
	echo apply_filters( 'cd_addon_google_site_verification', $verify ); // WPCS: XSS OK.
	return apply_filters( 'cd_addon_google_site_verification', $verify );
}
add_action( 'wp_head', 'cd_addon_google_analytics' );

/**
 * Remove WP default prev/next tags.
 */
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );

/**
 * Getting prev/next page link for multiple page.
 *
 * @see Based on `_wp_link_page()` https://developer.wordpress.org/reference/functions/_wp_link_page/
 * @param string $rel Whether 'prev' or 'next' to getting the link.
 * @since 1.1.0
 * @return string
 */
function cd_addon_wp_link_page( $rel ) {
	global $multipage;
	global $page;
	global $pages;
	global $wp_rewrite;
	$post       = get_post();
	$i          = 'prev' === $rel ? $page - 1 : $page + 1;
	$total_page = count( $pages );

	if ( $i > 0 && $i <= $total_page && $multipage ) {
		if ( '' == get_option( 'permalink_structure' ) || in_array( $post->post_status, array( 'draft', 'pending' ) ) ) {
			$url = add_query_arg( 'page', $i, get_permalink() );
		} elseif ( 'page' === get_option( 'show_on_front' ) && get_option( 'page_on_front' ) === $post->ID ) {
			$url = trailingslashit( get_permalink() ) . user_trailingslashit( "$wp_rewrite->pagination_base/" . $i, 'single_paged' );
		} else {
			$url = trailingslashit( get_permalink() ) . user_trailingslashit( $i, 'single_paged' );
		}
	} else {
		return false;
	}

	return esc_url( $url );
}

/**
 * Output prev/next tags in pages where articles have more than one page, and archives.
 */
function cd_addon_meta_prev_next() {
	global $multipage;
	$meta = '';

	if ( $multipage ) {
		$prev = cd_addon_wp_link_page( 'prev' );
		$next = cd_addon_wp_link_page( 'next' );

		if ( $prev ) {
			$meta .= '<link rel="prev" href="' . esc_url( $prev ) . '" />';
		}
		if ( $next ) {
			$meta .= '<link rel="next" href="' . esc_url( $next ) . '" />';
		}
		$meta = apply_filters( 'cd_addon_meta_prev_next', $meta );
	} else {
		$prev = get_previous_posts_page_link();
		$next = get_next_posts_page_link();

		if ( get_previous_posts_link() ) {
			$meta .= '<link rel="prev" href="' . esc_url( $prev ) . '" />';
		}
		if ( get_next_posts_link() ) {
			$meta .= '<link rel="next" href="' . esc_url( $next ) . '" />';
		}
	}
	echo $meta; // WPCS: XSS OK.
	return $meta;
}

add_action( 'wp_head', 'cd_addon_meta_prev_next' );

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
					__(
						'Google site verification code is used to make sure that this site is owned by you.%s
						This will be the content of google-site-verification tag.', 'coldbox-addon'
					),
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
