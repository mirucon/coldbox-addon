<?php
/**
 * Adding social share buttons to the Coldbox theme
 * https://coldbox.miruc.co/addons/share-buttons/
 *
 * @since 1.0.0
 * @package Coldbox_Addon
 */

/**
 * -----------------------------------------------------------------------------
 *  Share Buttons add-on for the Coldbox Theme
 *  Requires "SNS Count Cache" Plugin installed and enabled
 *  Followed SNS : Twitter, Hatena Bookmark, Facebook, Google Plus, Pocket, Feedly.
 *  Reference: https://coldbox.miruc.co/addons/share-buttons/
 * -----------------------------------------------------------------------------
 */

/**
 * Register customizer contents.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Hooks WP customizer contents to register customizer.
 */
function cd_addon_sns_buttons( $wp_customize ) {

	// Adds the section for the social buttons.
	$wp_customize->add_section(
		'sns_buttons', array(
			'title'    => __( 'Coldbox Add-on: Social Buttons', 'coldbox-addon' ),
			'priority' => 11,
		)
	);
	// Whether or not use the share buttons.
	$wp_customize->add_setting(
		'use_sns_buttons', array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'use_sns_buttons', array(
				'label'   => __( 'Use Social Buttons', 'coldbox-addon' ),
				'section' => 'sns_buttons',
				'type'    => 'checkbox',
			)
		)
	);
	// Twitter.
	$wp_customize->add_setting(
		'sns_button_twitter', array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'sns_button_twitter', array(
				'label'   => __( ' - Twitter', 'coldbox-addon' ),
				'section' => 'sns_buttons',
				'type'    => 'checkbox',
			)
		)
	);
	// Facebook.
	$wp_customize->add_setting(
		'sns_button_facebook', array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'sns_button_facebook', array(
				'label'   => __( ' - Facebook', 'coldbox-addon' ),
				'section' => 'sns_buttons',
				'type'    => 'checkbox',
			)
		)
	);
	// hatena Bookmark.
	$wp_customize->add_setting(
		'sns_button_hatena', array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'sns_button_hatena', array(
				'label'   => __( ' - Hatena Bookmark', 'coldbox-addon' ),
				'section' => 'sns_buttons',
				'type'    => 'checkbox',
			)
		)
	);
	// Google Plus.
	$wp_customize->add_setting(
		'sns_button_googleplus', array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'sns_button_googleplus', array(
				'label'   => __( ' - Google Plus', 'coldbox-addon' ),
				'section' => 'sns_buttons',
				'type'    => 'checkbox',
			)
		)
	);
	// Pocket.
	$wp_customize->add_setting(
		'sns_button_pocket', array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'sns_button_pocket', array(
				'label'   => __( ' - Pocket', 'coldbox-addon' ),
				'section' => 'sns_buttons',
				'type'    => 'checkbox',
			)
		)
	);
	// Feedly.
	$wp_customize->add_setting(
		'sns_button_feedly', array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'sns_button_feedly', array(
				'label'   => __( ' - Feedly', 'coldbox-addon' ),
				'section' => 'sns_buttons',
				'type'    => 'checkbox',
			)
		)
	);

	// Whether show count badges or not.
	$wp_customize->add_setting(
		'sns_button_count_badges', array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'sns_button_count_badges', array(
				'label'       => __( 'Show count badges', 'coldbox-addon' ),
				'description' => sprintf( /* Translators: %s: Plugin URL */ __( 'Requires %s plugin is installed and enabled.', 'coldbox-addon' ), '<a href="' . esc_url( home_url() . '/wp-admin/plugin-install.php?s=sns+count+cache&tab=search&type=term' ) . '" target="_blank">SNS Count Cache</a>' ),
				'section'     => 'sns_buttons',
				'type'        => 'checkbox',
			)
		)
	);

	// Twitter username.
	$wp_customize->add_setting(
		'twitter_username', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'twitter_username', array(
				'label'       => __( 'Twitter Username', 'coldbox-addon' ),
				'description' => __( 'Enter your Twitter username without "@" suffix. The username will be shown in tweets.', 'coldbox-addon' ),
				'section'     => 'sns_buttons',
				'type'        => 'text',
			)
		)
	);

}
add_action( 'customize_register', 'cd_addon_sns_buttons' );

/**
 * Checks social buttons are used
 *
 * @since 1.0.0
 * @return bool True or false
 */
function cd_use_snsb() {
	return ( get_theme_mod( 'use_sns_buttons', true ) );
}

/**
 * Checks Twitter button is set
 *
 * @since 1.0.0
 * @return bool True or false
 */
function cd_use_snsb_twitter() {
	return ( get_theme_mod( 'sns_button_twitter', true ) );
}

/**
 * Checks Facebook button is set
 *
 * @since 1.0.0
 * @return bool True or false
 */
function cd_use_snsb_facebook() {
	return ( get_theme_mod( 'sns_button_facebook', true ) );
}

/**
 * Checks Hatena Bookmark button is set
 *
 * @since 1.0.0
 * @return bool True or false
 */
function cd_use_snsb_hatena() {
	return ( get_theme_mod( 'sns_button_hatena', true ) );
}

/**
 * Checks Google Plus button is set
 *
 * @since 1.0.0
 * @return bool True or false
 */
function cd_use_snsb_googleplus() {
	return ( get_theme_mod( 'sns_button_googleplus', true ) );
}

/**
 * Checks Pocket button is set
 *
 * @since 1.0.0
 * @return bool True or false
 */
function cd_use_snsb_pocket() {
	return ( get_theme_mod( 'sns_button_pocket', true ) );
}

/**
 * Checks Feedly button is set
 *
 * @since 1.0.0
 * @return bool True or false
 */
function cd_use_snsb_feedly() {
	return ( get_theme_mod( 'sns_button_feedly', true ) );
}

/**
 * Checks whether it shows count badges or not.
 *
 * @since 1.1.2
 * @return bool True or false
 */
function cd_addon_show_count_badge() {
	$czr_option = get_theme_mod( 'sns_button_count_badges', true );
	if ( $czr_option && function_exists( 'scc_get_share_total' ) ) {
		$count_badge = true;
	} else {
		$count_badge = false;
	}
	return apply_filters( 'cd_addon_show_count_badge', $count_badge );
}

/**
 * Return the Twitter username
 *
 * @since 1.0.0
 * @return bool True or false
 */
function cd_twitter_username() {
	return ( get_theme_mod( 'twitter_username', '' ) );
}


if ( cd_use_snsb() || cd_use_snsb_hatena() || cd_use_snsb_feedly() ) {

	/**
	 * Load Icomoon Web font
	 *
	 * @since 1.0.0
	 */
	function cd_addon_load_icomoon() {
		wp_enqueue_style( 'icomoon', get_theme_file_uri( 'assets/fonts/icomoon/icomoon.min.css' ), array(), '1.0.0' );
	}
	add_action( 'wp_enqueue_scripts', 'cd_addon_load_icomoon' );
}

/**
 * Defines the function that output social buttons
 *
 * @since 1.0.0
 * @param string $class (optional) Custom class.
 */
function cd_addon_sns_buttons_list( $class = null ) {

	$canonical_url           = get_permalink();
	$title                   = wp_title( '', false, 'right' ) . '| ' . get_bloginfo( 'name' );
	$canonical_url_encode    = rawurlencode( $canonical_url );
	$title_encode            = rawurlencode( $title );
	$cd_twitter_via_username = cd_twitter_username() ? '&via=' . cd_twitter_username() : '';
	?>
	<section id="sns-buttons" class="content-box sns-buttons<?php echo ' ' . esc_attr( $class ); ?>">
		<h2 id="sns-btn-bottom-head" class="content-box-heading"><?php esc_html_e( 'Share', 'coldbox-addon' ); ?></h2>
		<ul class="share-list-container">

			<?php if ( cd_use_snsb_twitter() ) : ?>
				<li class="twitter balloon-btn">
					<div class="share">
						<a class="share-inner" href="http://twitter.com/intent/tweet?url=<?php echo esc_attr( $canonical_url_encode ); ?>&text=<?php echo esc_attr( $title_encode ); ?>&tw_p=tweetbutton<?php echo esc_attr( $cd_twitter_via_username ); ?>" target="_blank">
							<i class="icon-twitter fa fa-twitter"></i>
						</a>
					</div>
					<?php if ( function_exists( 'scc_get_share_twitter' ) && cd_addon_show_count_badge() ) : ?>
						<span class="count">
							<a class="count-inner" href="http://twitter.com/intent/tweet?url=<?php echo esc_attr( $canonical_url_encode ); ?>&text=<?php echo esc_attr( $title_encode ); ?>&tw_p=tweetbutton" target="_blank">
								<?php echo absint( scc_get_share_twitter() ); ?>
							</a>
						</span>
					<?php endif; ?>
				</li>
			<?php endif; ?>

			<?php if ( cd_use_snsb_hatena() && ! cd_is_amp() ) : ?>
				<li class="hatena balloon-btn">
					<div class="share">
						<a class="share-inner" href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo esc_attr( $canonical_url_encode ); ?>&title=<?php echo esc_attr( $title_encode ); ?>" target="_blank">
							<i class="icon-hatena"></i>
						</a>
					</div>
					<?php if ( function_exists( 'scc_get_share_hatebu' ) ) : ?>
						<span class="count">
							<a class="count-inner" href="http://b.hatena.ne.jp/entry/<?php echo esc_attr( $canonical_url_encode ); ?>" target="_blank">
								<?php echo absint( scc_get_share_hatebu() ); ?>
							</a>
						</span>
					<?php endif; ?>
				</li>
			<?php endif; ?>

			<?php if ( cd_use_snsb_facebook() ) : ?>
				<li class="facebook balloon-btn">
					<div class="share">
						<a class="share-inner" href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo esc_attr( $canonical_url_encode ); ?>&t=<?php echo esc_attr( $title_encode ); ?>" target="_blank">
							<i class="icon-facebook fa fa-facebook"></i>
						</a>
					</div>
					<?php if ( function_exists( 'scc_get_share_facebook' ) ) : ?>
						<span class="count">
							<a class="count-inner" href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo esc_attr( $canonical_url_encode ); ?>&t=<?php echo esc_attr( $title_encode ); ?>" target="_blank">
								<?php echo absint( scc_get_share_facebook() ); ?>
							</a>
						</span>
					<?php endif; ?>
				</li>
			<?php endif; ?>

			<?php if ( cd_use_snsb_googleplus() ) : ?>
				<li class="googleplus balloon-btn">
					<div class="share">
						<a class="share-inner" href="https://plus.google.com/share?url=<?php echo esc_attr( $canonical_url_encode ); ?>" target="_blank">
							<i class="icon-googleplus fa fa-google-plus"></i>
						</a>
					</div>
					<?php if ( function_exists( 'scc_get_share_gplus' ) ) : ?>
						<span class="count">
							<a class="count-inner" href="https://plus.google.com/share?url=<?php echo esc_attr( $canonical_url_encode ); ?>" target="_blank">
								<?php echo absint( scc_get_share_gplus() ); ?>
							</a>
						</span>
					<?php endif; ?>
				</li>
			<?php endif; ?>

			<?php if ( cd_use_snsb_pocket() ) : ?>
				<li class="pocket balloon-btn">
					<div class="share">
						<a class="share-inner" href="https://getpocket.com/edit?url=<?php echo esc_attr( $canonical_url_encode ); ?>&title=<?php echo esc_attr( $title_encode ); ?>" target="_blank">
							<i class="icon-pocket fa fa-get-pocket"></i>
						</a>
					</div>
					<?php if ( function_exists( 'scc_get_share_pocket' ) ) : ?>
						<span class="count">
							<a class="count-inner" href="https://getpocket.com/edit?url=<?php echo esc_attr( $canonical_url_encode ); ?>&title=<?php echo esc_attr( $title_encode ); ?>" target="_blank">
								<?php echo absint( scc_get_share_pocket() ); ?>
							</a>
						</span>
					<?php endif; ?>
				</li>
			<?php endif; ?>

			<?php if ( cd_use_snsb_feedly() && ! cd_is_amp() ) : ?>
				<li class="feedly balloon-btn">
					<div class="share">
						<a class="share-inner" href="https://cloud.feedly.com/#subscription%2Ffeed%2F<?php bloginfo( 'rss2_url' ); ?>" target="_blank">
							<i class="icon-feedly"></i>
						</a>
					</div>
					<?php if ( function_exists( 'scc_get_follow_feedly' ) ) : ?>
						<span class="count">
							<a class="count-inner" href="https://cloud.feedly.com/#subscription%2Ffeed%2F<?php bloginfo( 'rss2_url' ); ?>" target="_blank">
								<?php echo absint( scc_get_follow_feedly() ); ?>
							</a>
						</span>
					<?php endif; ?>
				</li>
			<?php endif; ?>

		</ul>
	</section>
	<?php
}

/**
 * Adds social buttons shortcode
 *
 * @since 1.0.0
 */
function sns_buttons_shortcode() {
	return cd_addon_sns_buttons_list();
}
add_shortcode( 'sns_buttons', 'sns_buttons_shortcode' );
