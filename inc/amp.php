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
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel='stylesheet'>
		<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
		<title><?php echo esc_html( wp_get_document_title() ); ?></title>
		<?php echo apply_filters( 'cd_addon_amp_head', $head_items ); // WPCS: XSS OK. ?>
		<style amp-custom>
			button,h1,h2,h3,h4,h5,h6,input,select,textarea{font:inherit}.container,.post-meta{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap}iframe,img{vertical-align:middle}a,button,input,select,textarea{-webkit-tap-highlight-color:rgba(68,68,68,.3)}.container,.container-outer,abbr{position:relative}a,abbr{text-decoration:none}.container,.post-meta,.title-box-inner{-webkit-box-direction:normal}.entry abbr::after,.entry table,.gallery-caption,.gallery-icon.landscape,.post-nav .nav-title,.social-links a::after,.wp-caption{text-align:center}*{margin:0;padding:0;-webkit-box-sizing:border-box;box-sizing:border-box}.entry dt,b,strong{font-weight:700}.entry blockquote,address,cite,em,q,var{font-style:italic}a:active,a:hover{outline-width:0}table{border-collapse:collapse;border-spacing:0;overflow:auto}ol,ul{list-style:none}html{font-size:62.5%}body{background-color:#f8f8f8;color:#333;word-wrap:break-word;font-size:1.7em;line-height:1.4;font-family:"Source Sans Pro",-apple-system,BlinkMacSystemFont,"Helvetica Neue",Arial,sans-serif;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;-webkit-text-size-adjust:100%}#main{margin-bottom:40px;-webkit-transition:all .4s;transition:all .4s}.container{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap;max-width:1140px;padding:0 10px;margin:0 auto}.post-meta,.site-title,amp-img,iframe,img{max-width:100%}@media screen and (max-width:980px) and (min-width:641px){.container{display:block}}@media screen and (max-width:640px){.container{display:block;padding:0}}@media screen and (min-width:961px){.content{min-height:80vh;width:100%}}.content-inner{padding:10px;background-color:#fafafa;-webkit-box-shadow:0 1px 3px 0 rgba(0,0,0,.05);box-shadow:0 1px 3px 0 rgba(0,0,0,.05)}@media screen and (max-width:640px){.content-inner{padding:5px}}.sidebar-s1{width:320px}.right-sidebar-s1 .content{padding-right:340px;padding-left:0}.right-sidebar-s1 .sidebar-s1{margin-left:-320px}@media screen and (max-width:980px){.sidebar-s1{width:100%}.right-sidebar-s1 .content{padding:0}.right-sidebar-s1 .sidebar-s1{margin-left:0}}.left-sidebar-s1 .content{padding-right:0;padding-left:340px}.left-sidebar-s1 .sidebar-s1{margin-right:-320px;-webkit-box-ordinal-group:0;-webkit-order:-1;-ms-flex-order:-1;order:-1}@media screen and (max-width:980px){.left-sidebar-s1 .content{padding:0}.left-sidebar-s1 .sidebar-s1{margin-right:0}}.bottom-sidebar-s1 #wrapper>.container{display:block}@media screen and (min-width:961px){.hide-sidebar-s1 .grid-view .page,.hide-sidebar-s1 .grid-view .post{width:33.333%}.bottom-sidebar-s1 .sidebar-s1{width:100%;margin-top:24px}.bottom-sidebar-s1 .sidebar-inner{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap;-ms-flex-flow:row wrap;flex-flow:row wrap}.bottom-sidebar-s1 .sidebar .widget{width:calc(33.333% - 10px);margin:5px}.bottom-sidebar-s1 .grid-view .page,.bottom-sidebar-s1 .grid-view .post{width:33.333%}}::-webkit-scrollbar{height:12px;background-color:transparent}::-webkit-scrollbar-thumb{background-color:#888}::-webkit-scrollbar-thumb:hover{background-color:#777}::-moz-selection{background:#00619F;color:#fff;text-shadow:none}::selection{background:#00619F;color:#fff;text-shadow:none}img{height:auto;border-style:none}a{color:inherit;-webkit-transition:all .2s;transition:all .2s}big{font-size:larger}small,sub,sup{font-size:smaller}hr{height:0;overflow:visible;border:1px solid #f0f0f0}.entry blockquote,.entry code{border-radius:1px}sub{vertical-align:sub}sup{vertical-align:super}ins{text-decoration:underline}h1,h2,h3,h4,h5,h6{color:#111;line-height:1.4;letter-spacing:-.03em}h1{font-size:1.875em}h2{font-size:1.56em}h3{font-size:1.43em}h4{font-size:1.34em}h5{font-size:1.25em}h6{font-size:1.12em}.entry{line-height:1.6}.entry a{color:#00619F;-webkit-box-shadow:0 1px 0 0 currentColor;box-shadow:0 1px 0 0 currentColor}.entry a:hover{color:#2e4453;-webkit-box-shadow:0 2px 0 0 #000;box-shadow:0 2px 0 0 #000}.entry dd{margin-bottom:1em}.entry hr{margin:1em 0}.entry iframe,.entry p{margin-bottom:1em}.entry p>iframe{margin-bottom:0}.entry .mejs-container{margin-bottom:1em}.entry abbr{-webkit-text-decoration:dotted;text-decoration:dotted}.entry abbr::after{content:attr(title);display:block;visibility:hidden;position:absolute;top:-26px;right:-7px;z-index:999;padding:.1875em .75em;border-radius:1px;background-color:#f8f8f8;color:#666;font-size:.88em;font-weight:300;white-space:nowrap;-webkit-box-shadow:0 0 6px 0 rgba(0,0,0,.2);box-shadow:0 0 6px 0 rgba(0,0,0,.2)}.entry abbr:hover::after{visibility:visible}.entry h1,.entry h2,.entry h3,.entry h4,.entry h5,.entry h6{font-weight:700}.entry h1:first-child,.entry h2:first-child,.entry h3:first-child,.entry h4:first-child,.entry h5:first-child,.entry h6:first-child{margin-top:0}.entry h1{margin:1.8em 0 1em}.entry h2{margin:1.6em 0 1em}.entry h3{margin:1.5em 0 1em}.entry h4{margin:1.4em 0 .9em}.entry h5{margin:1.3em 0 .8em}.entry h6{margin:1.2em 0 .8em}.entry ol,.entry ul{margin-bottom:1em;padding-left:30px;position:relative}.entry ul{list-style:square}.entry ol{list-style:decimal}.entry ol li ol,.entry ol li ul,.entry ul li ol,.entry ul li ul{margin-bottom:.5em;margin-top:.5em}.entry blockquote{position:relative;margin-bottom:1em;padding:1em 1em 1em 3.2em;color:#666;-webkit-box-shadow:0 1px 3px 0 rgba(0,0,0,.1);box-shadow:0 1px 3px 0 rgba(0,0,0,.1)}.entry blockquote::before{content:"\f10d";display:block;position:absolute;top:15px;left:16px;color:#aaa;font-family:FontAwesome;font-weight:300;font-size:1.6em;line-height:1;font-style:normal}.entry address,.gallery-caption,.hljs-emphasis{font-style:italic}.entry blockquote>:last-child{margin-bottom:0}.entry pre{position:relative;margin:1.1em 0;padding:1em 1.2em;background:#44463B;color:#E5E5EB;white-space:pre;overflow-x:auto;overflow-y:hidden;font-size:.96em;line-height:1.4;font-family:'Source Code Pro',Monaco,Menlo,'Courier New',Consolas,monospace;-webkit-box-shadow:0 1px 3px 0 rgba(0,0,0,.1);box-shadow:0 1px 3px 0 rgba(0,0,0,.1)}.entry pre h1,.entry pre h2,.entry pre h3,.entry pre h4,.entry pre h5,.entry pre h6{color:currentColor}.entry pre>code{display:block;padding:0;background:0 0;color:inherit;white-space:inherit}.entry code,.entry kbd{background-color:#f0f0f0;padding:0 .3em;margin:0 .05em;font-size:.96em;font-family:'Source Code Pro',Monaco,Menlo,'Courier New',Consolas,monospace}.entry kbd{border:1px solid #44463B;border-radius:1px}.entry table{width:100%;margin-bottom:1em;font-size:.95em;overflow-x:auto;-webkit-box-shadow:0 1px 1px 0 rgba(0,0,0,.08);box-shadow:0 1px 1px 0 rgba(0,0,0,.08)}.entry table tr:nth-of-type(even){background-color:#fbfbfb}.entry table td,.entry table th{border-bottom:1px solid #ddd}.entry table th{padding:7px 10px;border-top:1px solid #ddd;background:#f6f6f6;font-weight:700}.entry table td{padding:6px;vertical-align:middle}.entry address{margin-bottom:1em}@media screen and (max-width:640px){.entry{padding-right:15px;padding-left:15px}}.entry-inner::after{content:"";display:block;clear:both}.content-inside{background-color:#fff;-webkit-box-shadow:0 1px 3px 0 rgba(0,0,0,.1);box-shadow:0 1px 3px 0 rgba(0,0,0,.1)}.content-box,.sns-buttons.single-buttom{padding:2em 40px;border-bottom:1px solid #eaeaea}.content-box:last-child,.sns-buttons.single-buttom:last-child{border-bottom:0}@media screen and (max-width:640px){.content-box,.sns-buttons.single-buttom{padding-right:20px;padding-left:20px}}.title-box{position:relative;padding:1.4em;background-color:#f8f8f8;font-weight:300;font-family:Lato,Arial,sans-serif}.title-box-inner{-webkit-box-orient:vertical;-webkit-flex-flow:column wrap;-ms-flex-flow:column wrap;flex-flow:column wrap;padding:40px}.title-box .post-date{position:relative;color:#777;line-height:1}.title-box h1{margin:0;font-size:3rem}.title-box a:hover{color:#00619F}@media screen and (max-width:640px){.title-box-inner{padding-right:10px;padding-left:10px}}.action-bar{display:block;position:absolute;bottom:-2px;left:0;width:auto;height:2px;background-color:#00619F;pointer-events:none;-webkit-transition:all .2s;transition:all .2s}.author-box,.post-meta{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox}.post-meta{display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;position:relative;padding-top:1em;padding-bottom:1em;color:#666;font-size:.8em;line-height:1.6;text-transform:uppercase}.author-box,.author-box .author-infomation{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap}.post-meta a{white-space:nowrap}.post-meta a:hover{color:#00619F}.post-meta>[class^=post-]{display:inline-block;padding-right:10px}.post-meta .post-comment a::before,.post-meta>[class^=post-]::before{padding-right:.2em;font-family:FontAwesome;line-height:1;display:inline-block;position:relative}.post-meta .post-date::before{content:"\f017"}.post-meta .post-category::before{content:"\f07b"}.post-meta .post-modified::before{content:"\f1da"}.post-meta .post-tag::before{content:"\f02b"}.post-meta .post-author::before{content:"\f007"}.post-meta .post-edit::before{content:"\f040"}.post-meta .post-update::before{content:"\f021"}.post-meta .post-comment a::before{content:"\f075"}.post-meta.content-box a,.post-meta.sns-buttons.single-buttom a{color:#333;-webkit-box-shadow:0 1px 0 0 currentColor;box-shadow:0 1px 0 0 currentColor}.post-meta.content-box a:hover,.post-meta.sns-buttons.single-buttom a:hover{color:#00619F}.post-meta.content-box .post-category a,.post-meta.sns-buttons.single-buttom .post-category a{margin:0 0 .3em}.post-meta.content-box .post-category a:hover,.post-meta.sns-buttons.single-buttom .post-category a:hover{-webkit-box-shadow:0 2px 0 0 rgba(216,87,25,.4);box-shadow:0 2px 0 0 rgba(216,87,25,.4)}.post-meta.content-box .post-author a:hover,.post-meta.sns-buttons.single-buttom .post-author a:hover{-webkit-box-shadow:0 2px 0 0 rgba(0,97,159,.4);box-shadow:0 2px 0 0 rgba(0,97,159,.4)}.post-meta.content-box .post-comment a:hover,.post-meta.sns-buttons.single-buttom .post-comment a:hover{-webkit-box-shadow:0 2px 0 0 rgba(10,74,18,.4);box-shadow:0 2px 0 0 rgba(10,74,18,.4)}.entry .post-meta{margin-bottom:3em}.btm-post-meta{margin-top:3em;clear:both}p.post-btm-cats,p.post-btm-tags{position:relative;margin-bottom:.1em;font-size:.88em;line-height:1.6}p.post-btm-cats .fa,p.post-btm-tags .fa{margin-right:.2em;width:16px}p.post-btm-cats a,p.post-btm-tags a{display:inline-block;margin:0 .4em .3em 0;color:currentColor;white-space:nowrap}p.post-btm-cats a:hover,p.post-btm-tags a:hover{color:#00619F}.meta-label{margin-right:.4em;color:#111;font-size:1.1em;font-weight:300}.post-btm-cats a:hover{-webkit-box-shadow:0 2px 0 0 rgba(216,87,25,.4);box-shadow:0 2px 0 0 rgba(216,87,25,.4)}.post-btm-tags a:hover{-webkit-box-shadow:0 2px 0 0 rgba(25,216,49,.4);box-shadow:0 2px 0 0 rgba(25,216,49,.4)}.author-box{display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap;margin-top:2em;padding:1em;border-radius:2px;-webkit-box-shadow:0 1px 3px 0 rgba(0,0,0,.14);box-shadow:0 1px 3px 0 rgba(0,0,0,.14)}.author-box .author-thumbnail{-webkit-flex-shrink:1;-ms-flex-negative:1;flex-shrink:1}.author-box .author-thumbnail img{border-radius:50%}.author-box .author-content{-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;padding-left:1em}.author-box .author-infomation{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;margin-bottom:.3em}.header-inner,.related-posts .related-posts-list{-webkit-flex-flow:row wrap;-webkit-box-orient:horizontal;-webkit-box-direction:normal}.author-box .author-name{display:inline-block;margin-bottom:0;font-size:1.2em}.author-box .author-description{margin-bottom:0;font-size:.94em;font-weight:300}.author-box .author-links{margin-left:.7em}.author-box .author-links .social-links{list-style-type:none;margin-bottom:0;font-size:.82em}.author-box .author-links .social-links a>i{color:#777}.author-box .author-links .social-links a:hover>i{color:#222}.author-box .author-links a::after,.author-box .author-links a::before{content:none}@media screen and (max-width:640px){.author-box .author-infomation{display:block}.author-box .author-links{margin-left:0}}.content-box>h4,.sns-buttons.single-buttom>h4{position:relative;margin:.2em 0 .7em;text-transform:capitalize;font-weight:300}.related-posts .related-posts-list{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap;margin-left:1%}.related-posts .related-article{position:relative;width:33%;margin-bottom:16px}.related-posts .post{height:auto;padding:0 .02em;background-color:#fff;-webkit-transition:all .4s;transition:all .4s}.related-posts .post-thumbnail{overflow:hidden}.related-posts .post-thumbnail a{display:block;height:100%}.related-posts .post-thumbnail img{display:block;width:100%;height:auto;overflow:hidden;-webkit-transition:all .4s ease-out;transition:all .4s ease-out}.related-posts .post-content{-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-flow:column nowrap;-ms-flex-flow:column nowrap;flex-flow:column nowrap;padding:.5625em .75em}.related-posts .post-category{margin-bottom:.25em;font-size:.8125em;color:#666}.related-posts .post-category a{color:#00619F}.related-posts .post-category a:hover{color:#444}.related-posts .post-title{font-size:.9625em;line-height:1.3;font-family:Lato,Arial,sans-serif;letter-spacing:0;overflow:hidden;-webkit-transition:all .2s;transition:all .2s}.related-posts .post-title a{display:block;height:100%}.related-posts .post:hover{-webkit-box-shadow:0 3px 3px 0 rgba(0,0,0,.15);box-shadow:0 3px 3px 0 rgba(0,0,0,.15)}.related-posts .post:hover .post-thumbnail img{opacity:.8}.related-posts .post:hover .post-title{color:#00619F}@media screen and (max-width:640px){.related-posts .related-posts-list{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap;-ms-flex-flow:row wrap;flex-flow:row wrap;margin-left:0}.related-posts .related-posts-list .related-article{width:50%}.related-posts .related a:hover .post-thumbnail img{-webkit-transform:none;transform:none;opacity:.9}}.post-nav{-webkit-box-shadow:0 1px 3px 0 rgba(0,0,0,.1);box-shadow:0 1px 3px 0 rgba(0,0,0,.1)}.post-nav ul{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex}.post-nav .next,.post-nav .prev{position:relative;overflow:hidden;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1}.post-nav .next a,.post-nav .prev a{display:block;min-height:100%;background:rgba(0,0,0,.6);-webkit-transition:background-color .4s;transition:background-color .4s}.post-nav .next a{padding:12px 40px 12px 24px}.post-nav .prev a{padding:12px 24px 12px 40px}.post-nav .post-thumbnail{position:absolute;top:0;right:0;bottom:0;left:0;margin:auto;background-size:cover;background-repeat:no-repeat;background-position:center;overflow:hidden;opacity:.5;-webkit-filter:blur(3px);filter:blur(3px);-webkit-transition:all .4s;transition:all .4s}.post-nav .nav-title{position:relative;margin-bottom:.4em;color:#f0f0f0;text-transform:uppercase;text-shadow:0 0 2px rgba(0,0,0,.6);font-size:14px;font-family:Lato,Arial,sans-serif}.post-nav .post-title{position:relative;color:#fff;text-shadow:1px 1px rgba(0,0,0,.5);line-height:1.6}.post-nav .chevron-left,.post-nav .chevron-right{position:absolute;top:calc(50% - 10px);width:16px;height:16px;background:0 0}.post-nav .chevron-right{right:14px;border-right:1px solid #fff;border-top:1px solid #fff;-webkit-transform:rotate(45deg);transform:rotate(45deg);-webkit-transition:all .4s;transition:all .4s}.post-nav .chevron-left{left:14px;border-left:1px solid #fff;border-bottom:1px solid #fff;-webkit-transform:rotate(45deg);transform:rotate(45deg);-webkit-transition:all .4s;transition:all .4s}.post-nav .next a:hover,.post-nav .prev a:hover{background:rgba(0,0,0,.55)}.post-pages,.post-pages span{border-bottom:2px solid #ddd;position:relative}.post-nav .next .nav-title{right:-8px}.post-nav .prev .nav-title{left:-8px}.post-nav .next a:hover .post-thumbnail{-webkit-filter:blur(2px);filter:blur(2px)}.post-nav .next a:hover .chevron-right{right:18px}.post-nav .prev a:hover .post-thumbnail{-webkit-filter:blur(2px);filter:blur(2px)}.post-nav .prev a:hover .chevron-left{left:18px}@media screen and (max-width:640px){.post-nav ul{display:block}.next a,.prev a{padding:12px 40px}#header{background-position:center}}.post-pages,.share-list-container{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox}.post-pages{display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;width:100%;margin:10px auto;color:#00619F;font-weight:700}.post-pages span{display:inline-block;bottom:-2px;padding:6px 10px;-webkit-transition:border .4s;transition:border .4s}.post-pages>a:hover>span,.post-pages>span{border-bottom:2px solid #00619F}.post-pages li>*{display:block;-webkit-transition:border .4s;transition:border .4s}.post-pages>span{color:#000}.sns-buttons ul{margin-bottom:0;padding-left:0;list-style:none}.share-list-container{display:flex}.balloon-btn .share-inner,.post-password-form p:last-child{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox}.balloon-btn{-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;position:relative}.balloon-btn .share{-webkit-transition:all .4s;transition:all .4s}.balloon-btn .share i{position:relative;left:calc(50% - 1.2rem);z-index:999;font-size:2.4rem}.balloon-btn .share-inner{display:flex;padding:.4em .6em;-webkit-box-shadow:0 1px 1px 0 rgba(0,0,0,.2);box-shadow:0 1px 1px 0 rgba(0,0,0,.2);color:#fff}.balloon-btn .count{position:absolute;right:0;bottom:0;-webkit-transition:all .4s;transition:all .4s}.balloon-btn .count-inner{display:-webkit-inline-box;display:-webkit-inline-flex;display:-ms-inline-flexbox;display:inline-flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;position:absolute;bottom:0;right:0;min-height:1.2em;min-width:1.1em;padding:.4em;border-radius:1px;background-color:#444;color:rgba(255,255,255,.7);font-size:.9em;line-height:1;font-family:Lato,Arial,sans-serif;font-weight:700;-webkit-transition:all .4s;transition:all .4s}.balloon-btn .share-inner:hover{opacity:.8;-webkit-box-shadow:0 2px 3px rgba(0,0,0,.2),0 1px 3px rgba(0,0,0,.1) inset;box-shadow:0 2px 3px rgba(0,0,0,.2),0 1px 3px rgba(0,0,0,.1) inset}.balloon-btn .count-inner:hover{color:#fff}.balloon-btn.twitter .share-inner{background-color:#6bace2}.balloon-btn.facebook .share-inner{background-color:#445d93}.balloon-btn.googleplus .share-inner{background-color:#d36054}.balloon-btn.hatena .share-inner{background-color:#4c7ec6}.balloon-btn.pocket .share-inner{background-color:#e15c69}.balloon-btn.line .share-inner{background-color:#50c150}.balloon-btn.feedly .share-inner{background-color:#94be61}.balloon-btn:first-of-type .share-inner{border-radius:2px 0 0 2px}.balloon-btn:last-of-type .share-inner{border-radius:0 2px 2px 0}@media only screen and (max-width:767px){.share-list-container{-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center}}.post-password-form p:last-child{display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row nowrap;-ms-flex-flow:row nowrap;flex-flow:row nowrap}.header-inner,.post-password-form p:last-child label{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox}.post-password-form p:last-child label{-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.format-aside .post-title-box,.header-searchbar .search-submit{display:none}.post-password-form p:last-child input[type=password]{-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;border-right-width:0}.post-password-form p:last-child input[type=submit]{-webkit-flex-shrink:1;-ms-flex-negative:1;flex-shrink:1;padding:4px 10px}.format-aside .post-format::before{content:"\f111"}.format-gallery .post-format::before{content:"\f1c5"}.format-link .post-format::before{content:"\f0c1"}.format-image .post-format::before{content:"\f03e"}.format-quote .post-format::before{content:"\f10d"}.format-status .post-format::before{content:"\f005"}.format-video .post-format::before{content:"\f008"}.format-audio .post-format::before{content:"\f028"}.format-chat .post-format::before{content:"\f086"}.entry-content::after,.entry-footer::after,.entry-header::after{content:"";display:block;clear:both}#header{position:relative;top:0;right:0;left:0;z-index:1000;width:100%;background-color:#fff;-webkit-transition:-webkit-box-shadow .4s,-webkit-filter .4s;transition:-webkit-box-shadow .4s,-webkit-filter .4s;transition:box-shadow .4s,filter .4s;transition:box-shadow .4s,filter .4s,-webkit-box-shadow .4s,-webkit-filter .4s;-webkit-box-shadow:1px 0 1px 0 rgba(0,0,0,.4);box-shadow:1px 0 1px 0 rgba(0,0,0,.4)}.nav-toggle,.site-info{-webkit-transition:all .4s}#header.sticky{position:fixed;-webkit-box-shadow:0 0 6px 0 rgba(0,0,0,.2);box-shadow:0 0 6px 0 rgba(0,0,0,.2)}.header-inner{display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;padding-right:50px;font-size:.94em;font-weight:300}.site-info{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap;-ms-flex-flow:row wrap;flex-flow:row wrap;-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;padding:30px 20px;transition:all .4s}.site-title{display:inline-block;font-size:1.875em;color:#444;font-weight:600;line-height:1.2}.site-title a{display:block}.site-title img{display:block;max-height:60%;height:auto;margin:0 auto}.site-description{display:inline-block;max-width:100%;padding:0 2rem;color:#666;font-weight:300}@media screen and (min-width:768px) and (max-width:768px){.site-info{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap;-ms-flex-flow:row wrap;flex-flow:row wrap}.site-description{padding:.4em 1em 0}}@media screen and (max-width:767px){.header-inner{padding-right:0}.site-info{display:block;text-align:center;width:calc(100% - 50px);max-width:calc(100% - 50px)}.site-description{padding:0 .75em;line-height:1.6}}@media screen and (min-width:768px){.header-column .site-info{-webkit-align-self:flex-start;-ms-flex-item-align:start;align-self:flex-start;width:100%}.header-column .header-inner{-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-flow:column wrap;-ms-flex-flow:column wrap;flex-flow:column wrap}.header-row .search-toggle{height:100%}.header-row .header-inner{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row nowrap;-ms-flex-flow:row nowrap;flex-flow:row nowrap}.header-row #header-menu{width:auto}}.header-row .sticky .site-info{padding:15px 20px}@media screen and (min-width:768px) and (max-width:782px){body.admin-bar.header-row #header.sticky{padding-top:46px}}@media screen and (min-width:783px){body.admin-bar.header-row #header.sticky{padding-top:32px}}@media screen and (max-width:640px){.site-info{padding-right:20px;padding-left:20px}}#header-menu{-webkit-align-self:center;-ms-flex-item-align:center;align-self:center;width:100%}.gallery-columns-1,.menu-container{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap}.menu-container{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap;position:relative;width:100%}.menu-container li{display:inline-block;position:relative;max-width:100%}@media screen and (min-width:768px){.menu-container#top-nav{padding-right:50px}.menu-container a{display:block;padding:15px 12px;line-height:20px;-webkit-transition:color .2s,background-color .2s;transition:color .2s,background-color .2s}.menu-container li:hover>a{color:#000}.menu-container .sub-menu{display:none;width:200px;position:absolute;top:0;left:0;z-index:1000;padding:4px 0;background-color:#fff;color:#555;-webkit-box-shadow:0 1px 2px 0 rgba(0,0,0,.2);box-shadow:0 1px 2px 0 rgba(0,0,0,.2)}.menu-container .sub-menu li{width:100%}.menu-container .sub-menu li>a{padding:8px 14px}.menu-container li:hover>.sub-menu{display:block;top:50px}.menu-container li>.sub-menu>li:hover>.sub-menu{top:-4px;left:200px}.menu-container .sub-menu li:hover>a{background-color:#4b4b4b;color:#fff}.menu-container>li>a::before{content:"";position:absolute;right:50%;bottom:11px;left:50%;width:0;border-bottom:1px solid currentColor;-webkit-transition:all .2s;transition:all .2s}.menu-container>li:hover>a::before{right:15px;left:15px;width:calc(100% - 30px);overflow:hidden}.menu-container>li.menu-item-has-children li.menu-item-has-children>a::after,.menu-container>li.menu-item-has-children>a::after{content:'';display:inline-block;position:relative;width:6px;height:6px;border-bottom:1px solid currentColor;border-right:1px solid currentColor;background-color:transparent}.menu-container>li.menu-item-has-children>a::after{top:-3px;left:3px;-webkit-transform:rotate(45deg);transform:rotate(45deg);-webkit-transition:all .2s;transition:all .2s}.menu-container>li.menu-item-has-children li.menu-item-has-children>a::after{float:right;top:6px;left:2px;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);-webkit-transition:all .4s;transition:all .4s}.menu-container>li.menu-item-has-children:hover>a::after{top:0;-webkit-transform:rotate(225deg);transform:rotate(225deg)}}@media screen and (max-width:767px){#amp-sidebar,#header-menu{background-color:#51575d;top:0;height:120vh;width:100%}#header-nav{padding-top:6em;overflow-y:auto}#header-nav.menu-container a{color:#fff}#header-nav.menu-container:hover{color:#00619F}.menu-container,.menu-container li{display:block}.menu-container a{display:block;padding:.8em .9em}.menu-container a:hover{background:rgba(68,68,68,.1);color:#000}.menu-container li>a{border-top:1px solid rgba(119,119,119,.7)}.menu-container>li:last-child>a{border-bottom:1px solid rgba(119,119,119,.7)}.menu-container .sub-menu{display:block;margin-left:2em}.menu-container>li>a{font-weight:700}.menu-container li.menu-item-has-children>a::after{content:'';display:inline-block;position:relative;top:2px;left:2px;border:4px solid transparent;border-top-color:currentColor}.menu-overlay{position:fixed;top:0;width:100%;height:100vh}}.nav-toggle{-webkit-align-self:stretch;-ms-flex-item-align:stretch;align-self:stretch;position:relative;right:0;z-index:1000;width:50px;height:auto;border:0 transparent;background-color:transparent;cursor:pointer;transition:all .4s;-webkit-tap-highlight-color:transparent;-webkit-appearance:none}.nav-toggle .bottom,.nav-toggle .middle,.nav-toggle .top{position:absolute;top:50%;left:19%;z-index:1001;width:62%;height:1px;background:currentColor;-webkit-transition:all .4s;transition:all .4s}.nav-toggle .top{-webkit-transform:translateY(-10px);transform:translateY(-10px)}.nav-toggle .middle{-webkit-transform:rotate(0);transform:rotate(0)}.nav-toggle .bottom{-webkit-transform:translateY(10px);transform:translateY(10px)}.nav-toggle.open .top{height:1px;-webkit-transform:rotate(-45deg) translateY(0);transform:rotate(-45deg) translateY(0);background-color:#f8f8f8}.nav-toggle.open .middle{height:1px;opacity:0;visibility:hidden}.nav-toggle.open .bottom{height:1px;-webkit-transform:rotate(45deg) translateY(0);transform:rotate(45deg) translateY(0);background-color:#f8f8f8}.search-toggle{-webkit-align-self:stretch;-ms-flex-item-align:stretch;align-self:stretch;position:relative;top:0;width:0;height:auto;cursor:pointer;-webkit-transition:all .4s ease-in;transition:all .4s ease-in}.header-searchbar{position:absolute;top:calc(100% - 20px);right:6px;z-index:1001;max-width:320px;width:80%}.header-searchbar .search-form .search-inner{border-right-style:solid;border-radius:1px}@media screen and (min-width:981px){body.header-column:not(.header-menu-enabled) .search-toggle{height:100%}}@media screen and (min-width:768px){.header-searchbar,.nav-toggle{display:none}}.footer{position:relative;min-height:80px;padding:30px 20px;background:#44463B;color:rgba(255,255,255,.6);-webkit-transition:all .4s;transition:all .4s}.footer .container{-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;height:100%}.footer a{color:rgba(255,255,255,.9)}.footer a:hover{color:#fff}.footer .copyright{-webkit-flex-shrink:1;-ms-flex-negative:1;flex-shrink:1;font-weight:300;line-height:1.6}.footer .social-links{-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;padding:0 .7em;-webkit-box-pack:end;-webkit-justify-content:flex-end;-ms-flex-pack:end;justify-content:flex-end}@media screen and (min-width:640px) and (max-width:980px){.footer .container{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex}}@media screen and (max-width:640px){.footer .container{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-flow:column wrap;-ms-flex-flow:column wrap;flex-flow:column wrap}.footer .social-links{padding-top:.9em;-webkit-justify-content:space-around;-ms-flex-pack:distribute;justify-content:space-around}.footer .copyright{text-align:center}}.wp-caption{max-width:100%;margin-bottom:1em;padding:5px 5px 0}.wp-caption .wp-caption-text{margin:0;padding:.4em 4px .6em;font-size:.97em;line-height:1.4;font-style:italic}.aligncenter{display:block;max-width:100%;margin-left:auto;margin-right:auto}.alignright{float:right;max-width:100%;margin-left:1em}.alignleft{float:left;max-width:100%;margin-right:1em}.clearfix:after{content:"";display:block;clear:both}.gallery-columns-1,.gallery-columns-2{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox}html body .screen-reader-text{position:absolute;width:1px;height:1px;clip:rect(1px,1px,1px,1px);overflow:hidden}.gallery-columns-1{display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap}.gallery-columns-2,.gallery-columns-3{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap}.gallery-columns-1 .gallery-item{width:100%;margin-bottom:1em;padding:0 .1rem}.gallery-columns-2{display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap}.gallery-columns-3,.gallery-columns-4{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox}.gallery-columns-2 .gallery-item{width:50%;margin-bottom:1em;padding:0 .1rem}.gallery-columns-3{display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap}.gallery-columns-4,.gallery-columns-5{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap}.gallery-columns-3 .gallery-item{width:33.33333%;margin-bottom:1em;padding:0 .1rem}.gallery-columns-4{display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap}.gallery-columns-5,.gallery-columns-6{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox}.gallery-columns-4 .gallery-item{width:25%;margin-bottom:1em;padding:0 .1rem}.gallery-columns-5{display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap}.gallery-columns-6,.gallery-columns-7{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap}.gallery-columns-5 .gallery-item{width:20%;margin-bottom:1em;padding:0 .1rem}.gallery-columns-6{display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap}.gallery-columns-7,.gallery-columns-8{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox}.gallery-columns-6 .gallery-item{width:16.66667%;margin-bottom:1em;padding:0 .1rem}.gallery-columns-7{display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap}.gallery-columns-8,.gallery-columns-9{-webkit-flex-flow:row wrap;-webkit-box-orient:horizontal;-webkit-box-direction:normal}.gallery-columns-7 .gallery-item{width:14.28571%;margin-bottom:1em;padding:0 .1rem}.gallery-columns-8{display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap}.gallery-columns-8 .gallery-item{width:12.5%;margin-bottom:1em;padding:0 .1rem}.gallery-columns-9{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap}.gallery-columns-9 .gallery-item{width:11.11111%;margin-bottom:1em;padding:0 .1rem}.wp-caption img{margin:0 auto;padding:0;border:0}.gallery-caption{max-width:100%;padding:5px 5px 0;font-size:.94em;line-height:1.4}#back-to-top{display:none;position:fixed;bottom:0;right:10px;padding:12px 16px;background-color:#fff;border-radius:6px 6px 0 0;-webkit-box-shadow:0 0 4px 0 rgba(0,0,0,.6);box-shadow:0 0 4px 0 rgba(0,0,0,.6);-webkit-transition:padding .4s,-webkit-box-shadow .4s;transition:padding .4s,-webkit-box-shadow .4s;transition:box-shadow .4s,padding .4s;transition:box-shadow .4s,padding .4s,-webkit-box-shadow .4s}.chevron-up{display:inline-block;position:relative;top:8px;width:14px;height:14px;border-top:1px solid #44463B;border-left:1px solid #44463B;background:0 0;-webkit-transform:rotate(45deg);transform:rotate(45deg);-webkit-transition:all .4s;transition:all .4s}#back-to-top.abs{position:absolute}#back-to-top.clicked,#back-to-top:hover{padding-bottom:16px;-webkit-box-shadow:0 0 4px rgba(0,0,0,.6),0 3px 6px rgba(0,0,0,.4);box-shadow:0 0 4px rgba(0,0,0,.6),0 3px 6px rgba(0,0,0,.4)}.social-links{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap;-ms-flex-flow:row wrap;flex-flow:row wrap;-webkit-box-shadow:none;box-shadow:none;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}.social-links li{position:relative}.social-links i{font-size:1.55em}.social-links>li:not(:first-child){margin-left:.5em}.social-links a,.social-links a:hover{-webkit-box-shadow:none;box-shadow:none}.social-links a::after{content:attr(title);display:block;visibility:hidden;position:absolute;top:-35px;right:-5px;z-index:999;padding:.1875em .75em;border-radius:1px;background-color:#f8f8f8;color:#666;font-size:.88em;font-weight:300;white-space:nowrap;-webkit-box-shadow:0 0 6px 0 rgba(0,0,0,.2);box-shadow:0 0 6px 0 rgba(0,0,0,.2)}.clearfix::after,.social-links a::before{content:""}.social-links a::before{visibility:hidden;position:absolute;top:-10px;right:calc(50% - .55em);z-index:998;width:0;height:0;border:8px solid transparent;border-top-color:#f8f8f8;border-bottom-width:0;-webkit-box-shadow:0 0 6px 0 rgba(0,0,0,.2);box-shadow:0 0 6px 0 rgba(0,0,0,.2)}.social-links a:hover::after,.social-links a:hover::before{visibility:visible}.social-links .feedly .icon-feedly{display:block;bottom:-1px;line-height:1.06}.social-links .feedly .icon-feedly::before{font-size:1.06em}@media screen and (max-width:640px){.social-links i{font-size:2em}}ul.social-links{padding-left:0;list-style:none}.select-none{-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;user-select:none}.clearfix::after{display:block;clear:both}.fs15{font-size:.9375em}.fs17{font-size:1.0625em}.fs20{font-size:1.25em}.sans-serif{font-family:Helvetica,Arial,sans-serif}.serif{font-family:Georgia,serif}.bold{font-weight:700}.semibold{font-weight:600}.monospace{font-family:"Source Code Pro",Monaco,monospace}.info-box{display:block;margin:1.6em 0;padding:1.2em 1.4em;border:2px solid #39c;border-radius:3px;background-color:rgba(51,153,204,.1)}.attention-box{padding:1.4em;border:2px solid #ff5000;border-radius:3px;background:#ffd580}.link-box{display:block;padding:4px 6px;background-color:#f0f0f0}.link-box>a{display:block}@-webkit-keyframes fadeInLeft{0%{opacity:0;visibility:hidden;-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0)}100%{opacity:1;visibility:visible;-webkit-transform:none;transform:none}}@keyframes fadeInLeft{0%{opacity:0;visibility:hidden;-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0)}100%{opacity:1;visibility:visible;-webkit-transform:none;transform:none}}@-webkit-keyframes fadeOutleft{0%{opacity:1;visibility:visible;-webkit-transform:none;transform:none}100%{opacity:0;visibility:hidden;-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0)}}@keyframes fadeOutleft{0%{opacity:1;visibility:visible;-webkit-transform:none;transform:none}100%{opacity:0;visibility:hidden;-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0)}}@-webkit-keyframes fadeInRight{0%{opacity:0;visibility:hidden;-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0)}100%{opacity:1;visibility:visible;-webkit-transform:none;transform:none}}@keyframes fadeInRight{0%{opacity:0;visibility:hidden;-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0)}100%{opacity:1;visibility:visible;-webkit-transform:none;transform:none}}@-webkit-keyframes fadeOutRight{0%{opacity:1;visibility:visible;-webkit-transform:none;transform:none}50%{-webkit-transform:translate3d(50%,0,0);transform:translate3d(50%,0,0)}100%{opacity:0;visibility:hidden;-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0)}}@keyframes fadeOutRight{0%{opacity:1;visibility:visible;-webkit-transform:none;transform:none}50%{-webkit-transform:translate3d(50%,0,0);transform:translate3d(50%,0,0)}100%{opacity:0;visibility:hidden;-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0)}}@-webkit-keyframes fadeIn{0%{opacity:0;visibility:hidden}100%{opacity:1;visibility:visible}}@keyframes fadeIn{0%{opacity:0;visibility:hidden}100%{opacity:1;visibility:visible}}@-webkit-keyframes fadeOut{0%{opacity:1;visibility:visible}100%{opacity:0;visibility:hidden}}@keyframes fadeOut{0%{opacity:1;visibility:visible}100%{opacity:0;visibility:hidden}}:lang(ja) .bradcrumb,:lang(ko) .bradcrumb,:lang(zh) .bradcrumb{margin-bottom:.2em}:lang(ja) .comment-body,:lang(ja) .entry,:lang(ko) .comment-body,:lang(ko) .entry,:lang(zh) .comment-body,:lang(zh) .entry{line-height:1.8}:lang(ja) h1,:lang(ja) h2,:lang(ja) h3,:lang(ja) h4,:lang(ja) h5,:lang(ja) h6,:lang(ko) h1,:lang(ko) h2,:lang(ko) h3,:lang(ko) h4,:lang(ko) h5,:lang(ko) h6,:lang(zh) h1,:lang(zh) h2,:lang(zh) h3,:lang(zh) h4,:lang(zh) h5,:lang(zh) h6{line-height:1.5}:lang(ja) .related-posts .post-title,:lang(ko) .related-posts .post-title,:lang(zh) .related-posts .post-title{line-height:inherit}:lang(ja) .wp-caption .wp-caption-text,:lang(ko) .wp-caption .wp-caption-text,:lang(zh) .wp-caption .wp-caption-text{font-size:.92em}:lang(ja) h1{font-family:Lato,'Noto Sans CJK JP Light','Yu Gothic Light','Hiragino Sans',Arial,sans-serif}#toc_container{display:block;background:0 0;width:80%;min-width:80%;max-width:80%;margin:1.4em auto;padding:20px 0;border:1px solid #44463B;font-size:.95em;line-height:1.4}#toc_container a,#toc_container a:hover{text-decoration:none;-webkit-box-shadow:none;box-shadow:none}#toc_container p.toc_title{margin:0;text-align:center;font-weight:700}#toc_container a span{font-weight:300;font-family:Lato,Arial,sans-serif}#toc_container a span::after{content:".";padding-left:.1em}#toc_container ul{margin:0 0 0 1em;padding:0;list-style:none}#toc_container .toc_list a{display:block;padding:8px 10px;border-bottom:1px solid #44463B;-webkit-transition:all .4s,border .4s .4s;transition:all .4s,border .4s .4s}#toc_container .toc_list ul ul a{border-bottom-style:dotted}@media screen and (max-width:640px){#toc_container{width:95%;min-width:95%;max-width:95%;padding-top:15px;padding-bottom:15px;font-size:.95em}}.wpcf7 p{font-weight:600;margin-bottom:1.2em;position:relative}.wpcf7 p span{font-weight:400;color:#777}.wpcf7 div.wpcf7-validation-errors{border:none;margin:0;padding:0}.wpcf7 div.wpcf7-mail-sent-ng,.wpcf7 div.wpcf7-mail-sent-ok{border:none}.wpcf7 div.wpcf7-response-output{margin:0;padding:0}.wpcf7 span.wpcf7-form-control-wrap{display:block;position:relative}.wpcf7 span.wpcf7-not-valid-tip{background-color:#f2dede;border-color:#e3bfbf;color:#b94a48;padding:4px 14px;font-size:12px;line-height:20px;position:absolute;left:0;top:12px;width:auto;right:0;display:block}.wpcf7 input[type=date],.wpcf7 input[type=datetime-local],.wpcf7 input[type=datetime],.wpcf7 input[type=email],.wpcf7 input[type=month],.wpcf7 input[type=number],.wpcf7 input[type=password],.wpcf7 input[type=search],.wpcf7 input[type=tel],.wpcf7 input[type=text],.wpcf7 input[type=time],.wpcf7 input[type=url],.wpcf7 input[type=week],.wpcf7 select,.wpcf7 textarea{padding:8px 10px;background-color:#f8f8f8;margin-top:.4em}.wpcf7 input[type=submit]{font-size:1.2em}.wpcf7 textarea{width:100%}.hljs{color:#E5E5EB;background:#282b2e;display:block;padding:0}.hljs-bullet,.hljs-literal,.hljs-number,.hljs-symbol{color:#6897BB}.hljs-deletion,.hljs-keyword,.hljs-selector-tag{color:#cc7832}.hljs-link,.hljs-template-variable,.hljs-variable{color:#629755}.hljs-comment,.hljs-quote{color:grey}.hljs-meta{color:#bd4b40}.hljs-addition,.hljs-attribute,.hljs-string{color:#8cab7a}.hljs-section,.hljs-title,.hljs-type{color:#ffc66d}.hljs-name,.hljs-selector-class,.hljs-selector-id{color:#e66562}.lang-tag *{color:#fff}.hljs-strong{font-weight:700}
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
				"name": "<?php echo the_author_meta( 'display_name', $author_id ); ?>"
			},
			"publisher": {
				"@type": "Organization",
				"name": "<?php bloginfo( 'name' ); ?>",
				"logo": {
					"@type": "ImageObject",
					<?php
					if ( has_custom_logo() ) :
						?>
						"url": "<?php echo esc_url( $logo[0] ); ?>",
						<?php
					elseif ( has_site_icon() ) :
						?>
						"url": "<?php echo esc_url( get_site_icon_url( 500 ) ); ?>",
						<?php
					else :
						?>
						"url": "<?php echo esc_url( get_theme_file_uri( '/img/thumb-standard.png' ) ); ?>",
						<?php
					endif;
					?>

					"width": 500,
					"height": 500
				}
			},
			"image": {
				"@type": "ImageObject",
				<?php
				if ( has_post_thumbnail() ) :
					?>
					"url": "<?php echo esc_url( the_post_thumbnail_url( 'cd-medium' ) ); ?>",
					<?php
				else :
					?>
					"url": "<?php echo esc_url( get_theme_file_uri( '/img/thumb-medium.png' ) ); ?>",
					<?php
				endif;
				?>

				"height": 250,
				"width": 500
			}
		}
		</script>
	</head>

	<body <?php body_class(); ?>>

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
 * @param string $head_items Hook the filter to add contents to inside of head.
 * @return string
 */
function cd_addon_amp_ogp( $head_items ) {
	if ( has_post_thumbnail() ) :
		$thumbnail_src = get_the_post_thumbnail_url( 'cd-medium' );
	else :
		$thumbnail_src = get_theme_file_uri( '/img/thumb-medium.png' );
	endif;

	$head_items      .= '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '"/>
		<meta property="og:description" content="' . esc_attr( get_the_excerpt() ) . '"/>
		<meta property="og:type" content="article"/>
		<meta property="og:url" content="' . esc_url( get_the_permalink() ) . '"/>
		<meta property="og:site_name" content="' . esc_attr( get_bloginfo() ) . '"/>
		<meta property="og:image" content="' . $thumbnail_src . '"/>
		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:domain" content="' . esc_url( home_url() ) . '" />';
	$twitter_username = cd_twitter_username();
	if ( ! empty( $twitter_username ) ) {
		$head_items .= '<meta name="twitter:site" content="' . esc_attr( cd_twitter_username() ) . '" />
			<meta name="twitter:creator" content="' . esc_attr( cd_twitter_username() ) . '" />';
	}

	return $head_items;
}
add_action( 'cd_addon_amp_head', 'cd_addon_amp_ogp' );


/**
 * Output the footer parts of AMP HTML.
 *
 * @since 1.0.0
 */
function cd_addon_amp_footer() {
	?>
	<footer id="footer" class="footer">
		<div class="container">
			<div class="copyright">
				<p>&copy;<?php echo esc_html( date( 'Y' ) ); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></p>
				<p><a href="https://coldbox.miruc.co/">Coldbox WordPress theme</a> by <a href="https://miruc.co/">Mirucon</a></p>
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

	if ( cd_is_amp() ) {

		// Replace special charcters spaces to normal spaces.
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

		// Remove font tags.
		$content = preg_replace( '/<font[^>]+?>/i', '', $content );
		$content = preg_replace( '/<\/font>/i', '', $content );

		// Replace img tags to <amp-img>.
		$content = preg_replace( '/<img/i', '<amp-img layout="responsive"', $content );

		// Replace embeded tweets to <amp-twitter>.
		// @codingStandardsIgnoreStart
		$pattern = '/<blockquote class="twitter-tweet".*?>.+?<a href="https:\/\/twitter.com\/.*?\/status\/(.*?)">.+?<\/blockquote>.*?<script async src="\/\/platform.twitter.com\/widgets.js" charset="utf-8"><\/script>/is';
		$append  = '<p><amp-twitter width=592 height=472 layout="responsive" data-tweetid="$1"></amp-twitter></p>';
		$content = preg_replace( $pattern, $append, $content );
		// @codingStandardsIgnoreEnd

		// Replace embeded YouTube videos to <amp-youtube>.
		$pattern = '/<iframe.+?src="https:\/\/www.youtube.com\/embed\/(.+?)(\?feature=oembed)?".*?><\/iframe>/is';
		$append  = '<amp-youtube layout="responsive" data-videoid="$1" width="800" height="450"></amp-youtube>';
		$content = preg_replace( $pattern, $append, $content );

		// Replace iframe tags to <amp-iframe>.
		$pattern = '/<iframe/i';
		$append  = '<amp-iframe layout="responsive"';
		$content = preg_replace( $pattern, $append, $content );
		$pattern = '/<\/iframe>/i';
		$append  = '</amp-iframe>';
		$content = preg_replace( $pattern, $append, $content );

		// Remove script tags.
		$pattern = '/<script.+?<\/script>/is';
		$append  = '';
		$content = preg_replace( $pattern, $append, $content );

	} // End if().

	return $content;
}
add_filter( 'the_content', 'cd_addon_amp_img', 60 );


/**
 * Get the full post content.
 *
 * @since 1.0.0
 */
function cd_addon_amp_post_content() {
	if ( cd_is_amp() ) {
		global $post;
		setup_postdata( $post );
		$post_content = $post->post_content;
		wp_reset_postdata();
		return $post_content;
	}
}

/**
 * Check whether embedded tweets are used or not.
 *
 * @since 1.0.0
 */
function cd_addon_amp_embedded_tweets() {
	if ( cd_is_amp() ) {
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
	if ( cd_is_amp() ) {
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
	if ( cd_is_amp() ) {
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
 * Load required scripts when needed.
 *
 * @since 1.0.0
 * @param string $head_items Hook the filter to add contents to inside of head.
 * @return string
 */
function cd_addon_amp_requied_scripts( $head_items ) {

	// @codingStandardsIgnoreStart
	if ( cd_addon_amp_embeded_tweets() ) {
		$head_items .= '<script async custom-element="amp-twitter" src="https://cdn.ampproject.org/v0/amp-twitter-0.1.js"></script>';
	}
	if ( cd_addon_amp_embeded_youtube() ) {
		$head_items .= '<script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>';
	}
	if ( cd_addon_amp_iframe() ) {
		$head_items .= '<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>';
	}
	return $head_items;
	// @codingStandardsIgnoreEnd
}
add_action( 'cd_addon_amp_head', 'cd_addon_amp_requied_scripts' );


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
 * Replace related posts thumbnails to AMP HTML tag.
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
		if ( cd_is_amp() ) {
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
	if ( ! cd_is_amp() && is_single() && ! is_single( cd_addon_amp_no_generate() ) ) {
		?>
			<link rel="amphtml" href="<?php echo esc_url( get_the_permalink() ) . '?amp=1'; ?>">
		<?php
	}
}
add_action( 'wp_head', 'cd_addon_amp_meta' );
