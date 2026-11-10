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
 *  Followed SNS : Twitter / X, Hatena Bookmark, Facebook, LINE, Copy link.
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
		'sns_buttons',
		array(
			'title'    => __( 'Coldbox Add-on: Social Buttons', 'coldbox-addon' ),
			'priority' => 11,
		)
	);
	// Whether or not use the share buttons.
	$wp_customize->add_setting(
		'use_sns_buttons',
		array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'use_sns_buttons',
			array(
				'label'   => __( 'Use Social Buttons', 'coldbox-addon' ),
				'section' => 'sns_buttons',
				'type'    => 'checkbox',
			)
		)
	);
	// Twitter.
	$wp_customize->add_setting(
		'sns_button_twitter',
		array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sns_button_twitter',
			array(
				'label'   => __( ' - Twitter', 'coldbox-addon' ),
				'section' => 'sns_buttons',
				'type'    => 'checkbox',
			)
		)
	);
	// Facebook.
	$wp_customize->add_setting(
		'sns_button_facebook',
		array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sns_button_facebook',
			array(
				'label'   => __( ' - Facebook', 'coldbox-addon' ),
				'section' => 'sns_buttons',
				'type'    => 'checkbox',
			)
		)
	);
	// hatena Bookmark.
	$wp_customize->add_setting(
		'sns_button_hatena',
		array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sns_button_hatena',
			array(
				'label'   => __( ' - Hatena Bookmark', 'coldbox-addon' ),
				'section' => 'sns_buttons',
				'type'    => 'checkbox',
			)
		)
	);
	// LINE.
	$wp_customize->add_setting(
		'sns_button_line',
		array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sns_button_line',
			array(
				'label'   => __( ' - LINE', 'coldbox-addon' ),
				'section' => 'sns_buttons',
				'type'    => 'checkbox',
			)
		)
	);
	// Copy link (requires Coldbox 1.10.0+ button styles and clipboard script).
	if ( coldbox_addon_supports_modern_share() ) {
		$wp_customize->add_setting(
			'sns_button_copy',
			array(
				'default'           => true,
				'sanitize_callback' => 'wp_validate_boolean',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sns_button_copy',
				array(
					'label'   => __( ' - Copy link', 'coldbox-addon' ),
					'section' => 'sns_buttons',
					'type'    => 'checkbox',
				)
			)
		);

		if ( $wp_customize->get_setting( 'social_links_twitter_as_x' ) ) {
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'sns_twitter_as_x',
					array(
						'label'       => __( 'Use X icon and name for Twitter', 'coldbox-addon' ),
						'description' => __( 'Applies to social links and share buttons.', 'coldbox-addon' ),
						'section'     => 'sns_buttons',
						'settings'    => 'social_links_twitter_as_x',
						'type'        => 'checkbox',
					)
				)
			);
		}
	}

	// Twitter username.
	$wp_customize->add_setting(
		'twitter_username',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'twitter_username',
			array(
				'label'       => __( 'Twitter Username', 'coldbox-addon' ),
				'description' => __( 'Enter your Twitter username without "@" suffix. The username will be shown in tweets.', 'coldbox-addon' ),
				'section'     => 'sns_buttons',
				'type'        => 'text',
			)
		)
	);

}
add_action( 'customize_register', 'cd_addon_sns_buttons', 20 );

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
 * Checks LINE button is set.
 *
 * @since 1.2.0
 * @return bool True or false
 */
function cd_use_snsb_line() {
	return get_theme_mod( 'sns_button_line', true );
}

/**
 * Whether the active Coldbox theme provides 1.10.0+ share button assets.
 *
 * @since 1.3.0
 * @return bool
 */
function coldbox_addon_supports_modern_share() {
	return defined( 'CD_VER' ) && version_compare( CD_VER, '1.10.0', '>=' );
}

/**
 * Checks Copy link button is enabled.
 *
 * @since 1.3.0
 * @return bool
 */
function cd_use_snsb_copy() {
	return coldbox_addon_supports_modern_share() && (bool) get_theme_mod( 'sns_button_copy', true );
}

/**
 * Whether Twitter share button should render as X.
 *
 * @since 1.3.0
 * @return bool
 */
function coldbox_addon_use_x_for_twitter() {
	return coldbox_addon_supports_modern_share() && (bool) get_theme_mod( 'social_links_twitter_as_x', false );
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
	$use_x_twitter           = coldbox_addon_use_x_for_twitter();
	?>
	<section id="sns-buttons" class="content-box sns-buttons<?php echo ' ' . esc_attr( $class ); ?>">
		<h2 id="sns-btn-bottom-head" class="content-box-heading"><?php esc_html_e( 'Share', 'coldbox-addon' ); ?></h2>
		<ul class="share-list-container">

			<?php if ( cd_use_snsb_twitter() ) : ?>
				<?php $twitter_label = $use_x_twitter ? __( 'Share on X', 'coldbox-addon' ) : __( 'Share on Twitter', 'coldbox-addon' ); ?>
				<li class="<?php echo esc_attr( $use_x_twitter ? 'twitter x-twitter balloon-btn' : 'twitter balloon-btn' ); ?>">
					<div class="share">
						<a class="share-inner" href="https://twitter.com/intent/tweet?url=<?php echo esc_attr( $canonical_url_encode ); ?>&text=<?php echo esc_attr( $title_encode ); ?>&tw_p=tweetbutton<?php echo esc_attr( $cd_twitter_via_username ); ?>" title="<?php echo esc_attr( $twitter_label ); ?>" target="_blank" rel="noopener">
							<span class="share-icon icon-twitter <?php echo esc_attr( $use_x_twitter ? 'fab fa-x-twitter' : 'fab fa-twitter' ); ?>" aria-hidden="true"></span>
							<span class="screen-reader-text"><?php echo esc_html( $twitter_label ); ?></span>
							<?php coldbox_addon_new_window_notice(); ?>
						</a>
					</div>
				</li>
			<?php endif; ?>

			<?php if ( cd_use_snsb_hatena() ) : ?>
				<li class="hatena balloon-btn">
					<div class="share">
						<a class="share-inner" href="https://b.hatena.ne.jp/add?mode=confirm&url=<?php echo esc_attr( $canonical_url_encode ); ?>&title=<?php echo esc_attr( $title_encode ); ?>" title="<?php esc_attr_e( 'Save to Hatena Bookmark', 'coldbox-addon' ); ?>" target="_blank" rel="noopener">
							<span class="share-icon si si-hatenabookmark" aria-hidden="true"></span>
							<span class="screen-reader-text"><?php esc_html_e( 'Save to Hatena Bookmark', 'coldbox-addon' ); ?></span>
							<?php coldbox_addon_new_window_notice(); ?>
						</a>
					</div>
				</li>
			<?php endif; ?>

			<?php if ( cd_use_snsb_line() ) : ?>
				<li class="line balloon-btn">
					<div class="share">
						<a class="share-inner" href="https://social-plugins.line.me/lineit/share?url=<?php echo esc_attr( $canonical_url_encode ); ?>&title=<?php echo esc_attr( $title_encode ); ?>" title="<?php esc_attr_e( 'Share on LINE', 'coldbox-addon' ); ?>" target="_blank" rel="noopener">
							<span class="share-icon icon-line fab fa-line" aria-hidden="true"></span>
							<span class="screen-reader-text"><?php esc_html_e( 'Share on LINE', 'coldbox-addon' ); ?></span>
							<?php coldbox_addon_new_window_notice(); ?>
						</a>
					</div>
				</li>
			<?php endif; ?>

			<?php if ( cd_use_snsb_facebook() ) : ?>
				<li class="facebook balloon-btn">
					<div class="share">
						<a class="share-inner" href="https://www.facebook.com/sharer.php?src=bm&u=<?php echo esc_attr( $canonical_url_encode ); ?>&t=<?php echo esc_attr( $title_encode ); ?>" title="<?php esc_attr_e( 'Share on Facebook', 'coldbox-addon' ); ?>" target="_blank" rel="noopener">
							<span class="share-icon icon-facebook fab fa-facebook" aria-hidden="true"></span>
							<span class="screen-reader-text"><?php esc_html_e( 'Share on Facebook', 'coldbox-addon' ); ?></span>
							<?php coldbox_addon_new_window_notice(); ?>
						</a>
					</div>
				</li>
			<?php endif; ?>

			<?php if ( cd_use_snsb_copy() ) : ?>
				<li class="copy balloon-btn">
					<div class="share">
						<button type="button" class="share-inner js-copy-url" title="<?php esc_attr_e( 'Copy link', 'coldbox-addon' ); ?>" data-copy-url="<?php echo esc_url( $canonical_url ); ?>" data-copied-label="<?php esc_attr_e( 'Link copied', 'coldbox-addon' ); ?>">
							<span class="share-icon icon-copy fas fa-link" aria-hidden="true"></span>
							<span class="screen-reader-text"><?php esc_html_e( 'Copy link', 'coldbox-addon' ); ?></span>
						</button>
						<span class="screen-reader-text js-copy-status" role="status" aria-live="polite"></span>
					</div>
				</li>
			<?php endif; ?>

		</ul>
	</section>
	<?php
}

/** Whether the active Coldbox theme provides new-window notice styles and keeps icons enabled. */
function coldbox_addon_show_new_window_icon() {
	return coldbox_addon_supports_modern_share()
		&& (bool) get_theme_mod( 'social_links_new_tab_icon', true );
}

/** Visible and screen-reader notice for share destinations. */
function coldbox_addon_new_window_notice() {
	if ( coldbox_addon_show_new_window_icon() ) :
		?>
	<svg class="new-window-notice" viewBox="0 0 12 12" width="10" height="10" aria-hidden="true" focusable="false"><path d="M9.2 7.2V9.8C9.2 10.46 8.66 11 8 11H2.2C1.54 11 1 10.46 1 9.8V4C1 3.34 1.54 2.8 2.2 2.8H4.8M6.8 1H11V5.2M10.6 1.4L5.2 6.8" fill="none" stroke="currentColor" stroke-width="1.65" stroke-linecap="round" stroke-linejoin="round"/></svg>
		<?php
	endif;
	?>
	<span class="screen-reader-text"> (<?php esc_html_e( 'Opens in a new tab', 'coldbox-addon' ); ?>)</span>
	<?php
}

/**
 * Adds social buttons shortcode.
 *
 * @since 1.0.0
 */
function sns_buttons_shortcode() {
	ob_start();
	cd_addon_sns_buttons_list();
	return ob_get_clean();
}
add_shortcode( 'sns_buttons', 'sns_buttons_shortcode' );
