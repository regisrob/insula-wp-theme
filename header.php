<?php
/*
@package WordPress
@subpackage Basics
@author Bruno Bichet <bruno.bichet@gmail.com>
@version 0.2.6
@since Version 0.1
*/
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head prefix="og: http://ogp.me/ns#">
	<meta charset="<?php echo strtolower( get_bloginfo( 'charset' ) ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo basics_title(); ?></title>
	<meta name="description" content="<?php echo basics_description(); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if (is_page('6427')){ ?>
		<!-- Contact page not indexed -->
		<meta name="robots" content="noindex,nofollow" />
	<?php }else {?>
		<meta name="robots" content="index,follow" />
	<?php }?>
	<?php if (is_singular('post')){ ?>
		<!-- OGP metadata -->
		<meta property="og:title" content="<?php the_title(); ?>">
		<meta property="og:type" content="article">
		<meta property="og:url" content="<?php the_permalink() ?>">
		<?php if ( has_post_thumbnail() ) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
		$url = $thumb['0']; ?>
		<meta property="og:image" content="<?php echo $url; ?>">
		<?php } ?>
		<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
		<meta property="og:description" content="<?php echo basics_description(); ?>">
	<?php } ?>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/apple-touch-icon.png">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/print.css" media="print">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen">
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr-2.0.6.custom.min.js"></script>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="alternate" type="application/rss+xml" title="<?php printf( __( 'Subscribe to %1$s via RSS', 'basics' ), get_bloginfo( 'name' ) ); ?>" href="<?php echo home_url( '/feed/' ); ?>">
	<link rel="alternate" type="application/rdf+xml" title="<?php bloginfo('name'); ?> RDF Version"  href="<?php bloginfo('rdf_url'); ?>">
	<?php echo basics_rdf_feeds(); ?>
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> prefix="cc: http://creativecommons.org/ns# rdf: http://www.w3.org/1999/02/22-rdf-syntax-ns# rdfs: http://www.w3.org/2000/01/rdf-schema# xsd: http://www.w3.org/2001/XMLSchema# dc: http://purl.org/dc/elements/1.1/ dcterms: http://purl.org/dc/terms/ sioc: http://rdfs.org/sioc/ns# sioctype: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# foaf: http://xmlns.com/foaf/0.1/">
<div id="page" class="container hfeed" role="document">
	<div id="banner">
		<header role="banner">
			<div id="search-in">
					<?php basics_searchform(); ?>
			</div>
			<nav id="site-navigation" role="navigation">
				<h1 class="visuallyhidden"><?php _e( 'Site navigation', 'basics' ); ?></h1>
				<div class="visuallyhidden focusable">
					<a href="#content" title="<?php esc_attr_e( 'Skip to content', 'basics' ); ?>"><?php _e( 'Skip to content', 'basics' ); ?></a>
				</div>
				<?php wp_nav_menu( 
						array( 
							'theme_location' => 'second',
							'container' => 'div',
							'menu_class' => 'site-navigation',
							'exclude' => 2854
							) 
						); ?>
			</nav> <!-- eo #site-navigation -->	
			<hgroup id="branding" class="vcard">
				<h1 id="site-title" class="fn org"><a class="url home bookmark" rel="home" property="sioc:has_container" href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup> <!-- eo #branding -->
			<div id="bottombar" class="clearfix">
				<div id="logos">
					<div class="rss"><a href="<?php bloginfo('rss2_url'); ?>" title="S'abonner au flux RSS">Flux RSS</a></div>
					<div class="twitter"><a href="http://twitter.com/bsaLille3" title="Suivre la BSA sur Twitter">Twitter</a></div>
				</div>
				<?php if ( is_active_sidebar( 'war-1' ) ) : ?>
					<div id="widget-area-1" class="widget">
						<?php if ( ! dynamic_sidebar( 'war-1' ) ) : ?>
							<p><?php _e( 'Widget Area 1: try "First navigation" in custom menus', 'basics' ); ?></p>
						<?php endif; ?>
					</div> <!-- eo #widget-area-1 .widget -->
				<?php endif; ?>
			</div>
		</header>
	</div> <!-- eo #banner -->
<?php if ( is_active_sidebar( 'war-2' ) ) : ?>
	<div id="widget-area-2" class="widget">
		<?php dynamic_sidebar( 'war-2' ); ?>
	</div> <!-- eo #widget-area-2 .widget -->
<?php endif; ?>
    <div id="content">
<?php /* We Salute You */ ?>
