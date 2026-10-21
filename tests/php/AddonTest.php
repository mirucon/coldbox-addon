<?php
class AddonTest extends WP_UnitTestCase {
  public function test_ogp_disabled_preserves_language_and_direction() {
    set_theme_mod( 'use_ogp', false );
    $this->assertSame( 'lang="ar" dir="rtl"', cd_addon_ogp_html( 'lang="ar" dir="rtl"' ) );
    set_theme_mod( 'use_ogp', true );
    $this->assertSame( 'lang="ja" prefix="og: http://ogp.me/ns#"', cd_addon_ogp_html( 'lang="ja"' ) );
  }

  public function test_verification_and_ogp_values_are_attribute_escaped() {
    $id = self::factory()->post->create( array( 'post_title' => 'Title " <script>bad()</script>', 'post_excerpt' => 'Excerpt " <tag>' ) );
    $this->go_to( get_permalink( $id ) );
    set_theme_mod( 'site_verification_code', 'token"><script>bad()</script>' );
    set_theme_mod( 'ogp_default_image', 'javascript:alert(1)' );
    ob_start();
    cd_addon_google_site_verification();
    cd_addon_meta_ogp();
    $html = ob_get_clean();
    $this->assertStringContainsString( 'google-site-verification', $html );
    $this->assertStringContainsString( 'token&quot;&gt;', $html );
    $this->assertStringNotContainsString( '<script>', $html );
    $this->assertStringNotContainsString( 'javascript:', $html );
  }

  public function test_customizer_keeps_settings_but_has_no_retired_controls() {
    require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';
    wp_set_current_user( self::factory()->user->create( array( 'role' => 'administrator' ) ) );
    $manager = new WP_Customize_Manager();
    cd_addon_czr( $manager );
    cd_addon_sns_buttons( $manager );
    cd_addon_meta_customizer( $manager );
    $this->assertFalse( $manager->get_setting( 'do_not_load_jquery' )->default );
    foreach ( array( 'use_amp', 'amp_analytics', 'ga_tracking_code', 'sns_button_pocket', 'sns_button_count_badges' ) as $id ) {
      $this->assertNull( $manager->get_control( $id ) );
    }
    set_theme_mod( 'do_not_load_jquery', true );
    wp_enqueue_script( 'jquery' );
    coldbox_addon_deregister_jquery();
    $this->assertFalse( wp_script_is( 'jquery', 'registered' ) );
    set_theme_mod( 'do_not_load_jquery', false );
    wp_scripts()->add( 'jquery', false, array(), 'test' );
    coldbox_addon_deregister_jquery();
    $this->assertTrue( wp_script_is( 'jquery', 'registered' ) );
  }

  public function test_shortcode_returns_markup_in_place_and_obeys_saved_buttons() {
    $id = self::factory()->post->create();
    $this->go_to( get_permalink( $id ) );
    set_theme_mod( 'sns_button_twitter', false );
    set_theme_mod( 'sns_button_pocket', true );
    $before = get_theme_mods();
    ob_start();
    $html = do_shortcode( 'before[sns_buttons]after' );
    $unexpected = ob_get_clean();
    $this->assertSame( '', $unexpected );
    $this->assertStringStartsWith( 'before', $html );
    $this->assertStringEndsWith( 'after', $html );
    $this->assertStringContainsString( 'si-hatenabookmark', $html );
    $this->assertStringContainsString( 'si-feedly', $html );
    $this->assertStringNotContainsString( 'twitter balloon-btn', $html );
    $this->assertDoesNotMatchRegularExpression( '/pocket|class="count"|scc_/', $html );
    $this->assertSame( $before, get_theme_mods() );
    $this->assertTrue( cd_is_active_addon() );
  }

  public function test_retired_amp_redirects_without_reenabling_saved_amp_setting() {
    $id = self::factory()->post->create();
    $this->go_to( get_permalink( $id ) );
    set_theme_mod( 'use_amp', true );
    $_GET['amp'] = '1';
    $_SERVER['REQUEST_URI'] = '/?p=' . $id . '&amp=1&utm_source=archive';
    $this->assertSame( home_url( '/?p=' . $id . '&utm_source=archive' ), cd_retired_amp_url() );
    $this->assertFalse( cd_is_amp() );
    $this->assertFalse( has_action( 'wp_head', 'cd_addon_amp_meta' ) );
    $this->assertFalse( has_action( 'wp_head', 'cd_addon_google_analytics' ) );
    $_GET = array();
  }
}
