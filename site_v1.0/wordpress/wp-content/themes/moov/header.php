<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <title><?php
        if ( is_single() ) { single_post_title(); }       
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
        else { bloginfo('name'); wp_title('|'); get_page_number(); }
    ?></title>
	
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/jquery-1.4.2.min.js"></script>
	<script src="<?php bloginfo( 'template_url' ) ?>/js/cufon-yui.js" type="text/javascript"></script>
	<script src="<?php bloginfo( 'template_url' ) ?>/js/LeagueGothic_400_full.font.js" type="text/javascript"></script>
	<script type="text/javascript">
		Cufon.replace('h1,h2,h3,caption,button,#blogTitle,.postDate,#navBelow,.dropCap');
	</script>
	
	<link rel="shortcut icon" href="<?php echo get_option('moov_favicon'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ) ?>/styles/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ) ?>/styles/<?php echo strtolower(get_option('moov_color_scheme','dark')); ?>.css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ) ?>/styles/<?php echo strtolower(get_option('moov_sidebar_position','right')); ?>.css" />
	<!--[if IE 8]><link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ) ?>/styles/style_ie8.css" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ) ?>/styles/style_ie7.css" /><![endif]-->
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_directory' ) ?>/styles/jquery.lightbox-0.5.css" media="screen" />
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php wp_head(); ?>
	
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'moov' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'moov' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<style type="text/css">
	
		<?php echo get_option('moov_custom_css'); ?>

	</style>
	
</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">

	<div id="header">
		
		<div class="bubbleTop"></div>
		
		<?php $logo = get_option('moov_logo'); ?>
	
		<div id="branding">
		
			<div id="blogTitle"><span><a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php if($logo) { echo '<img src="'. $logo .'" alt="'. get_bloginfo( 'name' ) .'" title="'. get_bloginfo( 'name' ) .'" />'; } else { bloginfo( 'name' ); } ?></a></span></div>
	    	
		</div>
		
		<div class="skipLink"><a href="#content" title="<?php _e( 'Skip to content', 'moov' ) ?>"><?php _e( 'Skip to content', 'moov' ) ?></a></div>
		
		<ul class="socialLinks">
			<?php if( get_option('moov_facebook') ) { ?>
			<li><a href="<?php echo get_option('moov_facebook'); ?>" class="icon iconFacebook" title="Facebook"><span>Facebook</span></a></li>
			<?php } ?>
			<?php if( get_option('moov_twitter') ) { ?>
			<li><a href="http://twitter.com/<?php echo get_option('moov_twitter'); ?>" title="Twitter" class="icon iconTwitter"><span>Twitter</span></a></li>
			<?php } ?>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="RSS Feed" class="icon iconRss"><span>RSS</span></a></li>
		</ul>
		
	</div>

	<div id="main">

		<?php get_sidebar(); ?>