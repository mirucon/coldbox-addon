<?php
/**
 * Adding AMP support for the Coldbox theme
 *
 * @since 1.0.0
 * @package Coldbox_Addon
 */

/**
 * Define a function to distinguish AMP pages.
 *
 * @since 1.0.0
 * @param bool $is_amp To distinguish AMP pages.
 * @return bool Whether this is AMP page or not.
 */
function cd_is_amp_addon( $is_amp ) {

	if ( ! cd_addon_use_amp_pages() || is_single( cd_addon_amp_no_generate() ) ) {
		return false;
	}

	// @codingStandardsIgnoreStart
	if ( isset( $_GET['amp'] ) ) {
		if ( '1' === $_GET['amp'] && is_single() ) {
			$is_amp = true;
		}
	}
	// @codingStandardsIgnoreEnd

	return $is_amp;
}
add_filter( 'cd_is_amp', 'cd_is_amp_addon' );

/**
 * Declare the `cd_is_amp` function for in case of the Coldbox theme is not activated
 *
 * @since 1.0.2
 */
function cd_addon_is_amp_force() {

	if ( ! function_exists( 'cd_is_amp' ) ) {

		/**
		 * Declare the `cd_is_amp` function for in case of the Coldbox theme is not activated
		 *
		 * @since 1.0.3
		 */
		function cd_is_amp() {
			return false;
		}
	}
}
add_action( 'wp', 'cd_addon_is_amp_force', 1 );

/**
 * Output the header part of AMP HTML.
 *
 * @since 1.0.0
 */
function cd_addon_amp_head() {

	$post_id      = get_the_ID();
	$thumbnail_id = get_post_thumbnail_id();
	$logo         = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
	global $post;
	setup_postdata( $post );
	$excerpt   = get_the_excerpt();
	$author_id = $post->post_author;
	wp_reset_postdata();
	$head_items = '';
	$body_items = '';
	// @codingStandardsIgnoreStart
	?>
	<!DOCTYPE html>
	<html ⚡ <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		<script async src="https://cdn.ampproject.org/v0.js"></script>
		<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
		<link rel="canonical" href="<?php the_permalink(); ?>" />
		<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
		<link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel='stylesheet' crossorigin="anonymous">
		<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
		<title><?php echo esc_html( wp_get_document_title() ); ?></title>
		<?php echo apply_filters( 'cd_addon_amp_head', $head_items ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php do_action( 'cd_addon_amp_head_action' ); ?>
		<style amp-custom>
			button,h1,h2,h3,h4,h5,h6,input,select,textarea{font:inherit}iframe,img{vertical-align:middle}a,button,input,select,textarea{-webkit-tap-highlight-color:rgba(68,68,68,.3)}.container,.container-outer,abbr{position:relative}a,abbr{text-decoration:none}.entry abbr:after,.entry table,.gallery-caption,.gallery-icon.landscape,.post-nav .nav-title,.social-links a:after,.wp-caption{text-align:center}*{box-sizing:border-box;margin:0;padding:0}.entry dt,b,strong{font-weight:700}.entry blockquote,address,cite,em,q,var{font-style:italic}a:active,a:hover{outline-width:0}table{border-collapse:collapse;border-spacing:0;overflow:auto}ol,ul{list-style:none}html{font-size:62.5%}body{word-wrap:break-word;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;-webkit-text-size-adjust:100%;background-color:#f8f8f8;color:#333;font-family:"Source Sans Pro",-apple-system,BlinkMacSystemFont,"Helvetica Neue",Arial,sans-serif;font-size:15px;line-height:1.4}#main{margin-bottom:40px;transition:all .4s}.container{display:block;margin:0 auto;max-width:800px;padding:0}.post-meta,.site-title,amp-img,iframe,img{max-width:100%}.content-inner{background-color:#fafafa;box-shadow:0 1px 3px 0 rgba(0,0,0,.05);padding:5px 0}img{border-style:none;height:auto}a{color:inherit;transition:all .2s}big{font-size:larger}small,sub,sup{font-size:smaller}hr{border:1px solid #f0f0f0;height:0;overflow:visible}.entry blockquote,.entry code{border-radius:1px}sub{vertical-align:sub}sup{vertical-align:super}ins{text-decoration:underline}h1,h2,h3,h4,h5,h6{color:#111;letter-spacing:-.03em;line-height:1.4}h1{font-size:1.875em}h2{font-size:1.56em}h3{font-size:1.43em}h4{font-size:1.34em}h5{font-size:1.25em}h6{font-size:1.12em}.entry{line-height:1.6}.entry a{box-shadow:0 1px 0 0 currentColor;color:#00619f}.entry a:hover{box-shadow:0 2px 0 0 #000;color:#2e4453}.entry dd{margin-bottom:1em}.entry hr{margin:1em 0}.entry iframe,.entry p{margin-bottom:1em}.entry p>iframe{margin-bottom:0}.entry .mejs-container{margin-bottom:1em}.entry abbr{-webkit-text-decoration:dotted;text-decoration:dotted}.entry abbr:after{background-color:#f8f8f8;border-radius:1px;box-shadow:0 0 6px 0 rgba(0,0,0,.2);color:#666;content:attr(title);display:block;font-size:.88em;font-weight:300;padding:.1875em .75em;position:absolute;right:-7px;top:-26px;visibility:hidden;white-space:nowrap;z-index:999}.entry abbr:hover:after{visibility:visible}.entry h1,.entry h2,.entry h3,.entry h4,.entry h5,.entry h6{font-weight:700}.entry h1:first-child,.entry h2:first-child,.entry h3:first-child,.entry h4:first-child,.entry h5:first-child,.entry h6:first-child{margin-top:0}.entry h1{margin:1.8em 0 1em}.entry h2{margin:1.6em 0 1em}.entry h3{margin:1.5em 0 1em}.entry h4{margin:1.4em 0 .9em}.entry h5{margin:1.3em 0 .8em}.entry h6{margin:1.2em 0 .8em}.entry ol,.entry ul{margin-bottom:1em;padding-left:30px;position:relative}.entry ul{list-style:square}.entry ol{list-style:decimal}.entry ol li ol,.entry ol li ul,.entry ul li ol,.entry ul li ul{margin-bottom:.5em;margin-top:.5em}.entry blockquote{box-shadow:0 1px 3px 0 rgba(0,0,0,.1);color:#666;margin-bottom:1em;padding:1em 1em 1em 3.2em;position:relative}.entry blockquote:before{color:#aaa;content:"\f10d";display:block;font-family:"Font Awesome 5 Free";font-size:1.6em;font-style:normal;font-weight:900;left:16px;line-height:1;position:absolute;top:15px}.entry address,.gallery-caption{font-style:italic}.entry blockquote>:last-child{margin-bottom:0}.entry pre{background:#44463b;box-shadow:0 1px 3px 0 rgba(0,0,0,.1);color:#e5e5eb;font-family:"Source Code Pro",Monaco,Menlo,"Courier New",Consolas,monospace;font-size:.96em;line-height:1.4;margin:1.1em 0;overflow-x:auto;overflow-y:hidden;padding:1em 1.2em;position:relative;white-space:pre}.entry pre h1,.entry pre h2,.entry pre h3,.entry pre h4,.entry pre h5,.entry pre h6{color:currentColor}.entry pre>code{background:0 0;color:inherit;display:block;padding:0;white-space:inherit}.entry code,.entry kbd{background-color:#f0f0f0;font-family:"Source Code Pro",Monaco,Menlo,"Courier New",Consolas,monospace;font-size:.96em;margin:0 .05em;padding:0 .3em}.entry kbd{border:1px solid #44463b;border-radius:1px}.entry table{box-shadow:0 1px 1px 0 rgba(0,0,0,.08);font-size:.95em;margin-bottom:1em;overflow-x:auto;width:100%}.entry table tr:nth-of-type(2n){background-color:#fbfbfb}.entry table td,.entry table th{border-bottom:1px solid #ddd}.entry table th{background:#f6f6f6;border-top:1px solid #ddd;font-weight:700;padding:7px 10px}.entry table td{padding:6px;vertical-align:middle}.entry address{margin-bottom:1em}@media screen and (max-width:640px){.entry{padding-left:15px;padding-right:15px}}.entry-inner:after{clear:both;content:"";display:block}.content-inside{background-color:#fff;box-shadow:0 1px 3px 0 rgba(0,0,0,.1)}.content-box{border-bottom:1px solid #eaeaea;padding:2em 40px}.content-box:last-child{border-bottom:0}.content-box-heading{font-weight:300;margin:.2em 0 .7em;position:relative;text-transform:capitalize}@media screen and (max-width:640px){.content-box,.sns-buttons.single-bottom{padding-left:20px;padding-right:20px}}.title-box{background-color:#f8f8f8;font-family:Lato,Arial,sans-serif;font-weight:300;padding:1.4em;position:relative}.title-box-inner{flex-flow:column wrap;padding:40px}.title-box .post-date{color:#777;line-height:1;position:relative}.title-box h1{font-size:3rem;margin:0}.title-box a:hover{color:#00619f}@media screen and (max-width:640px){.title-box-inner{padding-left:10px;padding-right:10px}}.action-bar{background-color:#00619f;bottom:-2px;display:block;height:2px;left:0;pointer-events:none;position:absolute;transition:all .2s;width:auto}.author-box .author-links .social-links a>.fa{color:#777}.post-format{font-family:"Font Awesome 5 Free"}.format-aside .post-format:before{content:"\f111"}.format-gallery .post-format:before{content:"\f1c5"}.format-link .post-format:before{content:"\f0c1"}.format-image .post-format:before{content:"\f03e"}.format-quote .post-format:before{content:"\f10d"}.format-status .post-format:before{content:"\f005"}.format-video .post-format:before{content:"\f008"}.format-audio .post-format:before{content:"\f028"}.format-chat .post-format:before{content:"\f086"}.post-meta{align-items:center;color:#666;display:flex;flex-flow:row wrap;font-size:.8em;line-height:1.6;padding-bottom:1em;padding-top:1em;position:relative;text-transform:uppercase}.post-meta a{white-space:nowrap}.post-meta a:hover{color:#00619f}.post-meta>[class^=post-]{display:inline-block;padding-right:10px}.post-meta.content-box a{box-shadow:0 1px 0 0 currentColor;color:#333}.post-meta.content-box a:hover{color:#00619f}.post-meta.content-box .post-category a{margin:0 0 .3em}.post-meta.content-box .post-category a:hover{box-shadow:0 2px 0 0 rgba(216,87,25,.4)}.post-meta.content-box .post-author a:hover{box-shadow:0 2px 0 0 rgba(0,97,159,.4)}.post-meta.content-box .post-comment a:hover{box-shadow:0 2px 0 0 rgba(10,74,18,.4)}.entry .post-meta{margin-bottom:3em}.btm-post-meta{clear:both;margin-top:3em}p.post-btm-cats,p.post-btm-tags{font-size:.88em;line-height:1.6;margin-bottom:.1em;position:relative}p.post-btm-cats .fa,p.post-btm-tags .fa{margin-right:.2em;width:16px}p.post-btm-cats a,p.post-btm-tags a{color:currentColor;display:inline-block;margin:0 .4em .3em 0;white-space:nowrap}p.post-btm-cats a:hover,p.post-btm-tags a:hover{color:#00619f}.meta-label{color:#111;font-size:1.1em;font-weight:300;margin-right:.4em}.post-btm-cats a:hover{box-shadow:0 2px 0 0 rgba(216,87,25,.4)}.post-btm-tags a:hover{box-shadow:0 2px 0 0 rgba(25,216,49,.4)}.author-box{border-radius:2px;box-shadow:0 1px 3px 0 rgba(0,0,0,.14);display:flex;flex-flow:row wrap;margin-top:2em;padding:1em}.author-box .author-thumbnail{flex-shrink:1}.author-box .author-thumbnail img{border-radius:50%}.author-box .author-content{flex:1;padding-left:1em}.author-box .author-infomation{align-items:center;display:flex;flex-flow:row wrap;margin-bottom:.3em}.author-box .author-name{display:inline-block;font-size:1.2em;margin-bottom:0}.author-box .author-description{font-size:.94em;font-weight:300;margin-bottom:0}.author-box .author-links{margin-left:.7em}.author-box .author-links .social-links{font-size:.82em;list-style-type:none;margin-bottom:0}.author-box .author-links .social-links a>.fab,.author-box .author-links .social-links a>.fas{color:#777}.author-box .author-links .social-links a:hover>.fab,.author-box .author-links .social-links a:hover>.fas{color:#222}.author-box .author-links a:after,.author-box .author-links a:before{content:none}@media screen and (max-width:640px){.author-box .author-infomation{display:block}.author-box .author-links{margin-left:0}}.header-inner .related-posts-list,.related-posts .related-posts-list{display:flex;flex-flow:row wrap;margin-left:1%}.header-inner .related-article,.related-posts .related-article{margin-bottom:16px;position:relative;width:33%}.header-inner .post,.related-posts .post{background-color:#fff;height:auto;padding:0 .02em;transition:all .4s}.header-inner .post-thumbnail,.related-posts .post-thumbnail{overflow:hidden}.header-inner .post-thumbnail a,.related-posts .post-thumbnail a{display:block;height:100%}.header-inner .post-thumbnail img,.related-posts .post-thumbnail img{display:block;height:auto;overflow:hidden;transition:all .4s ease-out;width:100%}.header-inner .post-content,.related-posts .post-content{flex-flow:column nowrap;padding:.5625em .75em}.header-inner .post-category,.related-posts .post-category{color:#666;font-size:.8125em;margin-bottom:.25em}.header-inner .post-category a,.related-posts .post-category a{color:#00619f}.header-inner .post-category a:hover,.related-posts .post-category a:hover{color:#444}.header-inner .post-title,.related-posts .post-title{font-family:Lato,Arial,sans-serif;font-size:.9625em;letter-spacing:0;line-height:1.3;overflow:hidden;transition:all .2s}.header-inner .post-title a,.related-posts .post-title a{display:block;height:100%}.header-inner .post:hover,.related-posts .post:hover{box-shadow:0 3px 3px 0 rgba(0,0,0,.15)}.header-inner .post:hover .post-thumbnail img,.related-posts .post:hover .post-thumbnail img{opacity:.8}.header-inner .post:hover .post-title,.related-posts .post:hover .post-title{color:#00619f}@media screen and (max-width:640px){.related-posts .related-posts-list{flex-flow:row wrap;margin-left:0}.related-posts .related-posts-list .related-article{width:50%}.related-posts .related a:hover .post-thumbnail img{opacity:.9;transform:none}}.post-nav{box-shadow:0 1px 3px 0 rgba(0,0,0,.1)}.post-nav ul{display:flex}.post-nav .next,.post-nav .prev{flex:1;overflow:hidden;position:relative}.post-nav .next a,.post-nav .prev a{background:rgba(0,0,0,.6);display:block;min-height:100%;transition:background-color .4s}.post-nav .next a{padding:12px 40px 12px 24px}.post-nav .prev a{padding:12px 24px 12px 40px}.post-nav .nav-title{color:#f0f0f0;font-family:Lato,Arial,sans-serif;font-size:14px;margin-bottom:.4em;position:relative;text-shadow:0 0 2px rgba(0,0,0,.6);text-transform:uppercase}.post-nav .post-title{color:#fff;line-height:1.6;position:relative;text-shadow:1px 1px rgba(0,0,0,.5)}.post-nav .chevron-left,.post-nav .chevron-right{background:0 0;height:16px;position:absolute;top:calc(50% - 10px);width:16px}.post-nav .chevron-right{border-right:1px solid #fff;border-top:1px solid #fff;right:14px;transform:rotate(45deg);transition:all .4s}.post-nav .chevron-left{border-bottom:1px solid #fff;border-left:1px solid #fff;left:14px;transform:rotate(45deg);transition:all .4s}.post-nav .next a:hover,.post-nav .prev a:hover{background:rgba(0,0,0,.55)}.post-nav .next .nav-title{right:-8px}.post-nav .prev .nav-title{left:-8px}.post-nav .next a:hover .post-thumbnail{filter:blur(2px)}.post-nav .next a:hover .chevron-right{right:18px}.post-nav .prev a:hover .post-thumbnail{filter:blur(2px)}.post-nav .prev a:hover .chevron-left{left:18px}@media screen and (max-width:640px){.post-nav ul{display:block}.next a,.prev a{padding:12px 40px}#header{background-position:50%}}.post-pages{align-items:center;color:#00619f;display:flex;font-weight:700;justify-content:center;margin:10px auto;width:100%}.post-pages,.post-pages span{border-bottom:2px solid #ddd;position:relative}.post-pages span{bottom:-2px;display:inline-block;padding:6px 10px;transition:border .4s}.post-pages a:hover>span,.post-pages>span{border-bottom:2px solid #00619f}.post-pages>span{color:#000}.sns-buttons ul{list-style:none;margin-bottom:0;padding-left:0}.share-list-container{display:flex}.balloon-btn{flex-grow:1;position:relative}.balloon-btn .share{transition:all .4s}.balloon-btn .share .share-icon{font-size:2.4rem;left:calc(50% - 1.2rem);position:relative;z-index:999}.balloon-btn .share-inner{box-shadow:0 1px 1px 0 rgba(0,0,0,.2);color:#fff;display:flex;padding:.4em .6em}.balloon-btn .count,.balloon-btn .count-inner{bottom:0;position:absolute;right:0;transition:all .4s}.balloon-btn .count-inner{align-items:center;background-color:#444;border-radius:1px;color:hsla(0,0%,100%,.7);display:inline-flex;font-family:Lato,Arial,sans-serif;font-size:.9em;font-weight:700;justify-content:center;line-height:1;min-height:1.2em;min-width:1.1em;padding:.4em}.balloon-btn .share-inner:hover{box-shadow:0 2px 3px rgba(0,0,0,.2),inset 0 1px 3px rgba(0,0,0,.1);opacity:.8}.balloon-btn .count-inner:hover{color:#fff}.balloon-btn.twitter .share-inner{background-color:#6bace2}.balloon-btn.facebook .share-inner{background-color:#445d93}.balloon-btn.hatena .share-inner{background-color:#4c7ec6}.balloon-btn.line .share-inner{background-color:#50c150}.balloon-btn.pocket .share-inner{background-color:#e15c69}.balloon-btn.feedly .share-inner{background-color:#94be61}.balloon-btn:first-of-type .share-inner{border-radius:2px 0 0 2px}.balloon-btn:last-of-type .share-inner{border-radius:0 2px 2px 0}@media screen and (max-width:767px){.share-list-container{justify-content:center}}.entry-content:after,.entry-footer:after,.entry-header:after{clear:both;content:"";display:block}#header{background-color:#fff;box-shadow:1px 0 1px 0 rgba(0,0,0,.4);left:0;position:relative;right:0;top:0;transition:box-shadow .4s,filter .4s;width:100%;z-index:1000}.nav-toggle,.site-info{-webkit-transition:all .4s}.search-toggle{display:none}.header-inner{font-size:.94em;font-weight:300;padding-right:0}.header-inner,.site-info{align-items:center;display:flex;flex-flow:row wrap}.site-info{flex-grow:1;padding:30px 20px;transition:all .4s}.site-title{color:#444;display:inline-block;font-size:1.875em;font-weight:600;line-height:1.2}.site-title a{display:block}.site-title img{display:block;height:auto;margin:0 auto;max-height:60%}.site-description{color:#666;display:inline-block;font-weight:300;max-width:100%;padding:.4em 1em 0}@media screen and (max-width:767px){.site-info{display:block;max-width:calc(100% - 50px);text-align:center;width:calc(100% - 50px)}.site-description{line-height:1.6;padding:0 .75em}}#header-menu{align-self:center;width:100%}#amp-sidebar{background-color:#51575d;height:120vh;top:0;width:100%}@media screen and (min-width:641px){#amp-sidebar{max-width:420px}}#header-nav{overflow-y:auto;padding-top:6em}#header-nav.menu-container a{color:#fff}#header-nav.menu-container:hover{color:#00619f}.menu-container,.menu-container li{display:block}.menu-container a{display:block;padding:.8em 1em}.menu-container a:hover{background:rgba(68,68,68,.1);color:#000}.menu-container li>a{border-top:1px solid hsla(0,0%,47%,.7)}.menu-container>li:last-child>a{border-bottom:1px solid hsla(0,0%,47%,.7)}.menu-container .sub-menu{display:block;margin-left:2em}.menu-container>li>a{font-weight:700}.menu-container li.menu-item-has-children>a:after{border:4px solid transparent;border-top-color:currentcolor;content:"";display:inline-block;left:2px;position:relative;top:2px}.nav-toggle{-webkit-tap-highlight-color:transparent;align-self:stretch;-webkit-appearance:none;background-color:transparent;border:0 transparent;cursor:pointer;height:auto;position:relative;right:0;transition:all .4s;width:50px;z-index:1000}.nav-toggle .bottom,.nav-toggle .middle,.nav-toggle .top{background:currentColor;height:1px;left:19%;position:absolute;top:50%;transition:all .4s;width:62%;z-index:1001}.nav-toggle .top{transform:translateY(-10px)}.nav-toggle .middle{transform:rotate(0)}.nav-toggle .bottom{transform:translateY(10px)}.nav-toggle.open .top{background-color:#f8f8f8;height:1px;transform:rotate(-45deg) translateY(0)}.nav-toggle.open .middle{height:1px;opacity:0;visibility:hidden}.nav-toggle.open .bottom{background-color:#f8f8f8;height:1px;transform:rotate(45deg) translateY(0)}.footer{background:#44463b;color:hsla(0,0%,100%,.6);min-height:80px;padding:30px 20px;position:relative;transition:all .4s}.footer .container{align-items:center;height:100%}.footer a{color:hsla(0,0%,100%,.9)}.footer a:hover{color:#fff}.footer .copyright{flex-shrink:1;font-weight:300;line-height:1.6}.footer .social-links{flex-grow:1;justify-content:flex-end;padding:0 .7em}.footer .container{display:flex;flex-flow:column wrap}.footer .social-links{justify-content:space-around;padding-top:.9em}.footer .copyright{text-align:center}.wp-caption{margin-bottom:1em;max-width:100%;padding:5px 5px 0}.wp-caption .wp-caption-text{font-size:.97em;font-style:italic;line-height:1.4;margin:0;padding:.4em 4px .6em}.aligncenter{display:block;margin-left:auto;margin-right:auto;max-width:100%}.alignright{float:right;margin-left:1em;max-width:100%}.alignleft{float:left;margin-right:1em;max-width:100%}.clearfix:after{content:""}html body .screen-reader-text{clip:rect(1px,1px,1px,1px);height:1px;overflow:hidden;position:absolute;width:1px}.gallery-columns-1{display:flex;flex-flow:row wrap}.gallery-columns-1 .gallery-item{margin-bottom:1em;padding:0 .1rem;width:100%}.gallery-columns-2{display:flex;flex-flow:row wrap}.gallery-columns-2 .gallery-item{margin-bottom:1em;padding:0 .1rem;width:50%}.gallery-columns-3{display:flex;flex-flow:row wrap}.gallery-columns-3 .gallery-item{margin-bottom:1em;padding:0 .1rem;width:33.33333%}.gallery-columns-4{display:flex;flex-flow:row wrap}.gallery-columns-4 .gallery-item{margin-bottom:1em;padding:0 .1rem;width:25%}.gallery-columns-5{display:flex;flex-flow:row wrap}.gallery-columns-5 .gallery-item{margin-bottom:1em;padding:0 .1rem;width:20%}.wp-caption img{border:0;margin:0 auto;padding:0}.gallery-caption{font-size:.94em;line-height:1.4;max-width:100%;padding:5px 5px 0}.social-links{align-items:center;box-shadow:none;display:flex;flex-flow:row wrap}.social-links li{position:relative}.social-links .fab,.social-links .fas{font-size:1.55em}.social-links>li:not(:first-child){margin-left:.5em}.social-links a,.social-links a:hover{box-shadow:none}.social-links a:after{background-color:#f8f8f8;border-radius:1px;color:#666;content:attr(title);display:block;font-size:.88em;font-weight:300;padding:.1875em .75em;right:-5px;top:-35px;white-space:nowrap;z-index:999}.social-links a:after,.social-links a:before{box-shadow:0 0 6px 0 rgba(0,0,0,.2);position:absolute;visibility:hidden}.social-links a:before{border-color:#f8f8f8 transparent transparent;border-style:solid;border-width:8px 8px 0;content:"";height:0;right:calc(50% - .55em);top:-10px;width:0;z-index:998}.social-links a:hover:after,.social-links a:hover:before{visibility:visible}ul.social-links{list-style:none;padding-left:0}@media screen and (max-width:640px){.social-links i{font-size:2em}}.select-none{-webkit-user-select:none;user-select:none}.clearfix:after{clear:both;display:block}.fs15{font-size:.9375em}.fs17{font-size:1.0625em}.fs20{font-size:1.25em}.ad-label{color:#555;font-size:.92em;margin-bottom:.2em;text-align:center}.sans-serif{font-family:Helvetica,Arial,sans-serif}.serif{font-family:Georgia,serif}.bold{font-weight:700}.semibold{font-weight:600}.monospace{font-family:"Source Code Pro",Monaco,monospace}.info-box{background-color:rgba(51,153,204,.1);border:2px solid #39c;border-radius:3px;display:block;margin:1.6em 0;padding:1.2em 1.4em}.attention-box{background:#ffd580;border:2px solid #ff5000;border-radius:3px;padding:1.4em}.link-box{background-color:#f0f0f0;padding:4px 6px}.link-box,.link-box>a{display:block}:lang(ja) .breadcrumb,:lang(ko) .breadcrumb,:lang(zh) .breadcrumb{margin-bottom:.2em}:lang(ja) .comment-body,:lang(ja) .entry,:lang(ko) .comment-body,:lang(ko) .entry,:lang(zh) .comment-body,:lang(zh) .entry{line-height:1.8}:lang(ja) h1,:lang(ja) h2,:lang(ja) h3,:lang(ja) h4,:lang(ja) h5,:lang(ja) h6,:lang(ko) h1,:lang(ko) h2,:lang(ko) h3,:lang(ko) h4,:lang(ko) h5,:lang(ko) h6,:lang(zh) h1,:lang(zh) h2,:lang(zh) h3,:lang(zh) h4,:lang(zh) h5,:lang(zh) h6{line-height:1.5}:lang(ja) .related-posts .post-title,:lang(ko) .related-posts .post-title,:lang(zh) .related-posts .post-title{line-height:inherit}:lang(ja) h1{font-family:Lato,"Noto Sans CJK JP Light","Yu Gothic Light","Hiragino Sans",Arial,sans-serif}#toc_container{background:0 0;border:1px solid #44463b;display:block;font-size:.95em;line-height:1.4;margin:1.4em auto;max-width:80%;min-width:80%;padding:20px 0;width:80%}#toc_container a,#toc_container a:hover{box-shadow:none;text-decoration:none}#toc_container p.toc_title{font-weight:700;margin:0;text-align:center}#toc_container a span{font-family:Lato,Arial,sans-serif;font-weight:300}#toc_container a span:after{content:".";padding-left:.1em}#toc_container ul{list-style:none;margin:0 0 0 1em;padding:0}#toc_container .toc_list a{border-bottom:1px solid #44463b;display:block;padding:8px 10px;transition:all .4s,border .4s .4s}#toc_container .toc_list ul ul a{border-bottom-style:dotted}@media screen and (max-width:640px){#toc_container{font-size:.95em;max-width:95%;min-width:95%;padding-bottom:15px;padding-top:15px;width:95%}}
		</style>
		<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "NewsArticle",
			"mainEntityOfPage": "<?php the_permalink(); ?>",
			"headline": "<?php the_title(); ?>",
			"datePublished": "<?php echo get_the_date( 'c' ); ?>",
			"dateModified": "<?php the_modified_time( 'c' ); ?>",
			"description": "<?php echo $excerpt; ?>",
			"author": {
				"@type": "Person",
				"name": "<?php echo esc_html( the_author_meta( 'display_name', $author_id ) ); ?>"
			},
			"publisher": {
				"@type": "Organization",
				"name": "<?php bloginfo( 'name' ); ?>",
				"logo": {
					"@type": "ImageObject",
					<?php if ( has_custom_logo() ) :
						?>"url": "<?php echo esc_url( $logo[0] ); ?>",
					<?php elseif ( has_site_icon() ) :
						?>"url": "<?php echo esc_url( get_site_icon_url( 500 ) ); ?>",
					<?php else :
						?>"url": "<?php echo esc_url( get_theme_file_uri( 'assets/img/thumb-standard.png' ) ); ?>",
					<?php endif;
					?>"width": 500,
					"height": 500
				}
			},
			"image": {
				"@type": "ImageObject",
				<?php if ( has_post_thumbnail() ) :
					?>"url": "<?php echo esc_url( the_post_thumbnail_url( 'cd-medium' ) ); ?>",
				<?php else :
					?>"url": "<?php echo esc_url( get_theme_file_uri( 'assets/img/thumb-medium.png' ) ); ?>",
				<?php endif;
				?>"height": 250,
				"width": 500
			}
		}
		</script>
	</head>

	<body <?php body_class(); ?>>

	<?php do_action( 'cd_addon_amp_body_action' ); ?>
	<?php echo apply_filters( 'cd_addon_amp_body', $body_items ); ?>

	<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
		<amp-sidebar layout="nodisplay" side="right" id="amp-sidebar">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'header-menu',
					'container'      => '',
					'menu_class'     => '',
					'fallback_cb'    => 'wp_page_menu',
					'items_wrap'     => '<ul id="header-nav" class="menu-container">%3$s</ul><!--/#header-nav-->',
				)
			);
			?>
		</amp-sidebar>
	<?php endif; ?>

	<?php
	// @codingStandardsIgnoreEnd
}

/**
 * Adds favicon to head.
 *
 * @since 1.0.1
 * @param string $head_items Hook the filter to add contents to inside of head.
 */
function cd_addon_amp_favicon( $head_items ) {
	if ( has_site_icon() ) {
		return wp_site_icon();
	}
}
add_action( 'cd_addon_amp_head', 'cd_addon_amp_favicon' );

/**
 * Adds OGP meta tags to head.
 *
 * @since 1.0.0
 */
function cd_addon_amp_ogp() {
	if ( has_post_thumbnail() ) {
		$thumbnail_src = get_the_post_thumbnail_url( 'cd-medium' );
	} else {
		$thumbnail_src = get_theme_file_uri( 'assets/img/thumb-medium.png' );
	}

	echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '"/>
		<meta property="og:description" content="' . esc_attr( get_the_excerpt() ) . '"/>
		<meta property="og:type" content="article"/>
		<meta property="og:url" content="' . esc_url( get_the_permalink() ) . '"/>
		<meta property="og:site_name" content="' . esc_attr( get_bloginfo() ) . '"/>
		<meta property="og:image" content="' . esc_url( $thumbnail_src ) . '"/>
		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:domain" content="' . esc_url( home_url() ) . '" />';
	$twitter_username = cd_twitter_username();
	if ( ! empty( $twitter_username ) ) {
		echo '<meta name="twitter:site" content="' . esc_attr( cd_twitter_username() ) . '" />
			<meta name="twitter:creator" content="' . esc_attr( cd_twitter_username() ) . '" />';
	}
}
add_action( 'cd_addon_amp_head_action', 'cd_addon_amp_ogp' );


/**
 * Output the footer parts of AMP HTML.
 *
 * @since 1.0.0
 */
function cd_addon_amp_footer() {
	if ( function_exists( 'the_privacy_policy_link' ) && function_exists( 'cd_is_privacy_policy_link_shown' ) ) {
		if ( cd_is_privacy_policy_link_shown() ) {
			$link = get_the_privacy_policy_link( ' / ', '<span role="separator" aria-hidden="true"></span>' );
		} else {
			$link = '';
		}
	} else {
		$link = '';
	}
	?>
	<footer id="footer" class="footer">
		<div class="container">
			<div class="copyright">
				<p>
					&copy;
					<?php echo esc_html( date( 'Y' ) ); // phpcs:ignore WordPress.DateTime.RestrictedFunctions.date_date ?>
					<a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
					<?php echo $link; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</p>
				<p><a href="https://coldbox.miruc.co/">Coldbox WordPress theme</a> by <a href="https://miruc.co/">mirucon</a></p>
			</div>
			<?php cd_social_links(); ?>
		</div>
	</footer>
</body></html>
	<?php
}


/**
 * Removing and replacing articles contents to be compatible with AMP.
 *
 * @since 1.0.0
 * @param string $content The actual contents of the article.
 * @return string
 */
function cd_addon_amp_img( $content ) {

	if ( function_exists( 'cd_is_amp' ) && cd_is_amp() ) {

		// Replace special character spaces to normal spaces.
		$content = str_replace( '\xc2\xa0', ' ', $content );

		// Remove style attrs.
		$content = preg_replace( '/ +style=["][^"]*?["]/i', '', $content );
		$content = preg_replace( '/ +style=[\'][^\']*?[\']/i', '', $content );

		// Remove target attrs.
		$content = preg_replace( '/ +target=["][^"]*?["]/i', '', $content );
		$content = preg_replace( '/ +target=[\'][^\']*?[\']/i', '', $content );

		// Remove onclick attrs.
		$content = preg_replace( '/ +onclick=["][^"]*?["]/i', '', $content );
		$content = preg_replace( '/ +onclick=[\'][^\']*?[\']/i', '', $content );

		// Remove border attrs.
		$content = preg_replace( '/ +border=["][^"]*?["]/i', '', $content );
		$content = preg_replace( '/ +border=[\'][^\']*?[\']/i', '', $content );

		// Remove marginwidth attrs.
		$content = preg_replace( '/ +marginwidth=["][^"]*?["]/i', '', $content );
		$content = preg_replace( '/ +marginwidth=[\'][^\']*?[\']/i', '', $content );

		// Remove marginheight attrs.
		$content = preg_replace( '/ +marginheight=["][^"]*?["]/i', '', $content );
		$content = preg_replace( '/ +marginheight=[\'][^\']*?[\']/i', '', $content );

		// Remove security attrs.
		$content = preg_replace( '/ +security=["][^"]*?["]/i', '', $content );
		$content = preg_replace( '/ +security=[\'][^\']*?[\']/i', '', $content );

		// Remove hspace attrs.
		$content = preg_replace( '/ +hspace=["][^"]*?["]/i', '', $content );
		$content = preg_replace( '/ +hspace=[\'][^\']*?[\']/i', '', $content );

		// Remove vspace attrs.
		$content = preg_replace( '/ +vspace=["][^"]*?["]/i', '', $content );
		$content = preg_replace( '/ +vspace=[\'][^\']*?[\']/i', '', $content );

		// Remove contenteditable attrs.
		$content = preg_replace( '/ +contenteditable=["][^"]*?["]/i', '', $content );
		$content = preg_replace( '/ +contenteditable=[\'][^\']*?[\']/i', '', $content );

		// Remove mozallowfullscreen attrs.
		$content = preg_replace( '/ +mozallowfullscreen=["][^"]*?["]/i', '', $content );
		$content = preg_replace( '/ +mozallowfullscreen=[\'][^\']*?[\']/i', '', $content );

		// Remove font tags.
		$content = preg_replace( '/<font[^>]+?>/i', '', $content );
		$content = preg_replace( '/<\/font>/i', '', $content );

		// Remove font tags.
		$content = preg_replace( '/<style.*>.*<\/style>/i', '', $content );

		// Replace img tags to <amp-img>.
		$content = preg_replace( '/<img/i', '<amp-img layout="responsive"', $content );

		// Replace embedded tweets to <amp-twitter>.
		// @codingStandardsIgnoreStart
		$pattern = '/<blockquote class="twitter-tweet".*?>.+?<a href="https:\/\/twitter.com\/.*?\/status\/(.*?)">.+?<\/blockquote>.*?' .
				   '<script async src="https:\/\/platform\.twitter\.com\/widgets\.js" charset="utf-8"><\/script>/is';
		$append  = '<p><amp-twitter width=592 height=472 layout="responsive" data-tweetid="$1"></amp-twitter></p>';
		$content = preg_replace( $pattern, $append, $content );
		// @codingStandardsIgnoreEnd

		// Replace embedded YouTube videos to <amp-youtube>.
		$pattern = '/<iframe.+?src="https:\/\/www.youtube.com\/embed\/(.+?)(\?feature=oembed)?".*?><\/iframe>/is';
		$append  = '<amp-youtube layout="responsive" data-videoid="$1" width="800" height="450"></amp-youtube>';
		$content = preg_replace( $pattern, $append, $content );

		// Replace video tags to <amp-video>.
		$content = preg_replace( '/<video/i', '<amp-video layout="responsive"', $content );

		// Replace iframe tags to <amp-iframe>.
		$pattern = '/<iframe/i';
		$append  = '<amp-iframe sandbox="allow-scripts allow-same-origin" layout="responsive"';
		$content = preg_replace( $pattern, $append, $content );
		$pattern = '/<\/iframe>/i';
		$append  = '</amp-iframe>';
		$content = preg_replace( $pattern, $append, $content );

		// Remove script tags.
		$pattern = '/<script.+?<\/script>/is';
		$append  = '';
		$content = preg_replace( $pattern, $append, $content );

	} // End if.

	return $content;
}
add_filter( 'the_content', 'cd_addon_amp_img', 60 );


/**
 * Get the full post content.
 *
 * @since 1.0.0
 */
function cd_addon_amp_post_content() {
	if ( function_exists( 'cd_is_amp' ) && cd_is_amp() ) {
		global $post;
		setup_postdata( $post );
		$post_content = $post->post_content;
		// phpcs:ignore WordPress.NamingConventions
		$post_content = apply_filters( 'the_content', $post_content );
		wp_reset_postdata();
		return $post_content;
	}
	return '';
}

/**
 * Check whether Twitter are embedded or not in an article.
 *
 * @since 1.0.0
 */
function cd_addon_amp_embedded_tweets() {
	if ( function_exists( 'cd_is_amp' ) && cd_is_amp() ) {
		$post_content = cd_addon_amp_post_content();
		if ( strpos( $post_content, 'twitter-tweet' ) !== false ||
		strpos( $post_content, '<amp-twitter' ) !== false ||
		strpos( $post_content, 'twitter.com/' ) !== false ) {
			return true;
		}
	}
}
add_action( 'wp', 'cd_addon_amp_embedded_tweets', 12 );

/**
 * Check whether embedded YouTube videos are used or not.
 *
 * @since 1.0.0
 */
function cd_addon_amp_embedded_youtube() {
	if ( function_exists( 'cd_is_amp' ) && cd_is_amp() ) {
		$post_content = cd_addon_amp_post_content();
		if ( preg_match( '<iframe.+?src="https:\/\/www.youtube.com\/embed\/(.+?)(\?feature=oembed)?".*?>', $post_content ) !== 0 ||
		strpos( $post_content, '<amp-youtube' ) !== false ) {
			return true;
		}
	}
}
add_action( 'wp', 'cd_addon_amp_embedded_youtube', 12 );

/**
 * Check whether iframe tags are used or not.
 *
 * @since 1.0.0
 */
function cd_addon_amp_iframe() {
	if ( function_exists( 'cd_is_amp' ) && cd_is_amp() ) {
		$post_content = cd_addon_amp_post_content();
		if ( strpos( $post_content, '<iframe' ) !== false ||
		strpos( $post_content, '<amp-iframe' ) !== false ||
		strpos( $post_content, '[embed' ) !== false ||
		strpos( $post_content, home_url() ) !== false ) {
			return true;
		}
	}
}
add_action( 'wp', 'cd_addon_amp_iframe', 12 );

/**
 * Check whether iframe tags are used or not.
 *
 * @since 1.0.0
 */
function cd_addon_amp_video() {
	if ( function_exists( 'cd_is_amp' ) && cd_is_amp() ) {
		$post_content = cd_addon_amp_post_content();
		if (
			strpos( $post_content, '<video' ) !== false ||
			strpos( $post_content, '[video' ) !== false ||
			strpos( $post_content, '<amp-video' ) !== false
		) {
			return true;
		}
	}
}
add_action( 'wp', 'cd_addon_amp_video', 12 );

/**
 * Load required scripts when needed.
 *
 * @since 1.0.0
 * @param string $head_items Hook the filter to add contents to inside of head.
 * @return string
 */
function cd_addon_amp_required_scripts( $head_items ) {

	// @codingStandardsIgnoreStart
	if ( cd_addon_amp_embedded_tweets()) {
		$head_items .= '<script async custom-element="amp-twitter" src="https://cdn.ampproject.org/v0/amp-twitter-0.1.js"></script>';
	}
	if ( cd_addon_amp_embedded_youtube() ) {
		$head_items .= '<script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>';
	}
	if ( cd_addon_amp_iframe() ) {
		$head_items .= '<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>';
	}
	if ( cd_addon_amp_video() ) {
		$head_items .= '<script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>';
	}
	return $head_items;
	// @codingStandardsIgnoreEnd
}
add_action( 'cd_addon_amp_head', 'cd_addon_amp_required_scripts' );


/**
 * Replace related posts thumbnails to AMP HTML tag.
 *
 * @since 1.0.0
 * @param string $thumbnail The thumbnail images.
 * @return string
 */
function cd_addon_amp_related_posts( $thumbnail ) {
	if ( cd_is_amp() ) {
		$thumbnail = preg_replace( '/<img/i', '<amp-img layout="responsive"', $thumbnail );
	}
	return $thumbnail;
}
add_filter( 'cd_middle_thumbnail', 'cd_addon_amp_related_posts' );


/**
 * Make post thumbnail shown in a post AMP compatible.
 *
 * @since 1.1.8
 * @param string $thumbnail The thumbnail image.
 * @return string
 */
function cd_addon_amp_large_thumbs( $thumbnail ) {
	if ( cd_is_amp() ) {
		$thumbnail = preg_replace( '/<img/i', '<amp-img layout="responsive"', $thumbnail );
	}
	return $thumbnail;
}
add_filter( 'cd_large_thumbnail_template', 'cd_addon_amp_large_thumbs' );


/**
 * Remove menus on AMP pages.
 *
 * @since 1.0.0
 * @param string $menu The menu items.
 * @return string
 */
function cd_addon_amp_menu( $menu ) {

	if ( cd_is_amp() ) {
		$menu = '';
	}

	return $menu;
}
add_filter( 'cd_header_menu', 'cd_addon_amp_menu' );


/**
 * Remove comments from the single articles.
 *
 * @since 1.0.0
 * @param string $template The comments template hooked.
 * @return bool
 */
function cd_addon_amp_remove_comments( $template ) {
	if ( cd_is_amp() ) {
		return false;
	}
	return $template;
}
add_filter( 'cd_comments_template', 'cd_addon_amp_remove_comments' );


if ( function_exists( 'cd_is_amp' ) ) {

	/**
	 * Remove sidebar on AMP pages.
	 *
	 * @since 1.0.0
	 * @param bool $is_active_sidebar Hook the `is_active_sidebar` so that it always returns false.
	 * @return bool
	 */
	function cd_addon_amp_remove_sidebar( $is_active_sidebar ) {
		if ( function_exists( 'cd_is_amp' ) && cd_is_amp() ) {
			return false;
		}
		return $is_active_sidebar;
	}
	add_filter( 'is_active_sidebar', 'cd_addon_amp_remove_sidebar' );
}


/**
 * Replace avatars to AMP HTML tag.
 *
 * @since 1.0.0
 * @param string $author The author's avatar.
 * @return string
 */
function cd_addon_amp_avatar( $author ) {
	if ( cd_is_amp() ) {
		$author = preg_replace( '/<img/i', '<amp-img layout="responsive"', $author );
	}
	return $author;
}
add_filter( 'cd_get_avatar', 'cd_addon_amp_avatar' );


/**
 * Adds the AMPHTML meta tag on normal pages.
 *
 * @since 1.0.0
 */
function cd_addon_amp_meta() {
	if ( ! function_exists( 'cd_is_amp' ) ) {
		return;
	}

	if ( ! cd_is_amp() && is_single() && ! is_single( cd_addon_amp_no_generate() && cd_addon_use_amp_pages() ) ) {
		$parsed_url = wp_parse_url( get_the_permalink() );
		$separator  = '?';
		if ( key_exists( 'query', $parsed_url ) && $parsed_url['query'] ) {
			$separator = '&';
		}
		$tag = '<link rel="amphtml" href="' . esc_url( get_the_permalink() ) . $separator . 'amp=1">' . PHP_EOL;
		echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'cd_addon_amp_meta' );


/**
 * Replace img to amp-img in the logo.
 *
 * @since 1.1.4
 * @param string $logo HTML of logo to filter.
 * @return string
 */
function cd_addon_amp_replace_logo_tag( $logo ) {
	if ( ! cd_is_amp() ) {
		return $logo;
	}
	$logo = preg_replace( '/<img/i', '<amp-img layout="responsive"', $logo, 1 );
	return $logo;
}
add_filter( 'cd_custom_logo', 'cd_addon_amp_replace_logo_tag' );


/**
 * Remove loading="lazy" from AMP pages.
 *
 * @since 1.2.6
 * @param string $default Default value.
 * @return string
 */
function cd_addon_disable_lazy( $default ) {
	if ( function_exists( 'cd_is_amp' ) && cd_is_amp() ) {
		return false;
	}
	return $default;
}
add_filter( 'wp_lazy_loading_enabled', 'cd_addon_disable_lazy' );

/**
 * Adds Google Analytics for AMP pages.
 *
 * @since 1.1.0
 */
function cd_addon_amp_analytics() {

	$analytics_id = cd_addon_amp_analytics_id();

	if ( ! empty( $analytics_id ) ) {
		echo '<amp-analytics type="googleanalytics">
		<script type="application/json">
		{
			"vars": {
				"account": "' . esc_html( cd_addon_amp_analytics_id() ) . '"
			},
			"triggers": {
				"trackPageviews": {
					"on": "visible",
					"request": "pageview"
				}
			}
		}
		</script>
	</amp-analytics>';
	}
}
add_action( 'cd_addon_amp_body_action', 'cd_addon_amp_analytics' );


/**
 * Allow AMP-specific HTML tags in `wp_kses_post()`.
 *
 * @param array $allowedposttags The list of tags allowed.
 * @return array.
 */
function cd_addon_amp_allow_amp_tags( $allowedposttags ) {
	if ( ! function_exists( 'cd_is_amp' ) ) {
		return $allowedposttags;
	}

	$amp_img         = array(
		'amp-img' => array(
			'class'  => true,
			'layout' => true,
			'src'    => true,
			'alt'    => true,
			'width'  => true,
			'height' => true,
		),
	);
	$allowedposttags = $allowedposttags + $amp_img;
	return $allowedposttags;
}
add_filter( 'wp_kses_allowed_html', 'cd_addon_amp_allow_amp_tags' );
