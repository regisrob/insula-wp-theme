<?php
/*
Instructions perso ajoutees a Basics (issues de l'ancien theme)
*/
 
/**
 * Disabling Admin bar
 */
add_filter( 'show_admin_bar', '__return_false' );

/*
 * Deregistering WP scripts jQuery and l10n.js, except in admin
 */
if ( !is_admin() ) {
	function my_init_method() {
	wp_deregister_script( 'l10n' ); /* l10n.js -> moved to js/common.js */
	wp_deregister_script('jquery'); /* jquery WP -> custom call in footer.php */
}
add_action('init', 'my_init_method'); 
}

/*
 * Allow contributors to upload files (buttons above Wysiwyg editor)
 */
if ( current_user_can('contributor') && !current_user_can('upload_files') )
add_action('admin_init', 'allow_contributor_uploads');
function allow_contributor_uploads() {
	$contributor = get_role('contributor');
	$contributor->add_cap('upload_files');
}

/*
 * Disable login error messages (Source : 10 Useful WordPress Security Tweaks, Smashing Magazine)
 */
add_filter('login_errors',create_function('$a', "return null;"));

/*
 * Delete meta generator in <head>
 */
remove_action('wp_head', 'wp_generator');

/*
 * Add custom css for admin panel
 */
function css_admin() {
	$siteurl = get_bloginfo('template_url');
	$url = $siteurl . '/style-admin.css';
	echo "<link rel='stylesheet' type='text/css' href='$url' media='screen' />\n";
}
add_action('admin_head', 'css_admin');

/*
 * Exclude pictures in rss feed
 */
function nocaption_content_rss( $content ){
	//$content = apply_filters('the_content_feed', $content);
	//$content = preg_replace("/\[caption.*\[\/caption\]/", '',$content);
	$content = preg_replace("#<div(.+)(wp-caption){1,}(.+)><img(.+)></div>#", '',$content);
	return $content;
}
add_filter('the_content_feed', 'nocaption_content_rss');

/*
 * Custom blocks in post contents
 */

/* Cleaning function */
function shortcode_clean_content( $content ) {

    /* Parse nested shortcodes and add formatting. */
    $content = trim( wpautop( do_shortcode( $content ) ) );

    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );

    /* Remove '<p>' from the end of the string. */
   if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );

    return $content;
}
/* Shortcode to insert custom blocks */
function encart($atts, $content=null) {
  extract(shortcode_atts(array(
          'titre' => '',
      'largeur' => '100',
      'align' => 'left',
      ), $atts));
  $content = shortcode_clean_content( $content );
    return '<div class="encart" style="width:'."{$largeur}".'%; float:'."{$align}".';"><h4 class="titreEncart">' . "{$titre}" . '</h4>' . '<div class="contenuEncart">' . $content . '</div>' . '</div>';
}
add_shortcode('encart', 'encart');

/* Shortcode to insert custom short blockquotes */
function quote($atts, $content=null) {
  extract(shortcode_atts(array(
      'largeur' => '45',
      'align' => 'right',
      ), $atts));
  $content = shortcode_clean_content( $content );
    return '<div class="quote" style="width:'."{$largeur}".'%; float:'."{$align}".';"><blockquote>' . $content . '</blockquote>' . '</div>';
}
add_shortcode('quote', 'quote');


/*
 * Customize Read More link
 */
//add_filter( 'excerpt_more', 'custom_read_more_link' );
//add_filter( 'get_the_content_more_link', 'custom_read_more_link' );
add_filter( 'the_content_more_link', 'custom_read_more_link' );
function custom_read_more_link() {
    return '<a class="more-link" href="' . get_permalink() . '" rel="nofollow">Lire la suite &rarr;</a>';
}

/*
 * Display social tools
 */
if ( ! function_exists( 'basics_social_tools' ) ) :
function basics_social_tools() {
	if (is_single() ){ ?>
		<div class="sociable">
			<a class="icon" id="connotea" href="http://www.connotea.org/addpopup?continue=confirm&amp;uri=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" title="Partager sur Connotea"></a>
			<a class="icon" id="delicious" href="http://delicious.com/post?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" title="Partager sur Delicious"></a>
			<a class="icon" id="netvibes" href="http://www.netvibes.com/share?title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" title="Partager sur Netvibes"></a>
		</div>
	<?php }
}
endif;

/*
 * Citation link and block (Fancybox)
 */
/* Lien texte en bas de billet */
if ( ! function_exists( 'basics_cite_post' ) ) :
function basics_cite_post() {
	if (is_single() ){ ?>
		<p class="cite"><a class="cite-link" href="#cite-post" title="Comment citer ce billet ?">Citer ce billet</a></p>
		<div id="cite-post">
			<p><span property="dcterms:bibliographicCitation"><?php the_author_firstname();?> <?php the_author_lastname();?>, &laquo;&nbsp;<?php the_title(); ?>&nbsp;&raquo;, <em><?php bloginfo('name'); ?></em> [En ligne], ISSN 2427-8297, mis en ligne le <?php the_time('j F Y'); ?>. URL : &lt;<a rel="bookmark" title="Lien permanent vers <?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a>&gt;. Consult&eacute; le <?php setlocale(LC_TIME, "fr_FR"); echo utf8_encode(strftime("%e %B %Y")); ?>.</span></p>
		</div>
	<?php }
}
endif;

/*
 * Display toolbar
 */
if ( ! function_exists( 'basics_toolbar' ) ) :
function basics_toolbar() {
	if (is_single() ){ ?>
		<div class="toolbar clearfix">
			<ul>
				<li><a class="icon read" href="javascript:(function(){_readableOptions={'text_font':'quote(Palatino%20Linotype),%20Palatino,%20quote(Book%20Antigua),%20Georgia,%20serif','text_font_monospace':'quote(Courier%20New),%20Courier,%20monospace','text_font_header':'quote(Times%20New%20Roman),%20Times,%20serif','text_size':'18px','text_line_height':'1.5','box_width':'40em','color_text':'#111111','color_background':'#FFFEF0','color_links':'#EE4545','text_align':'justified','base':'blueprint','custom_css':''};if(document.getElementsByTagName('body').length>0);else{return;}if(window.$readable){if(window.$readable.bookmarkletTimer){return;}}else{window.$readable={};}window.$readable.bookmarkletTimer=true;window.$readable.options=_readableOptions;if(window.$readable.bookmarkletClicked){window.$readable.bookmarkletClicked();return;}_readableScript=document.createElement('script');_readableScript.setAttribute('src','http://readable-static.tastefulwords.com/target.js?rand='+encodeURIComponent(Math.random()));document.getElementsByTagName('body')[0].appendChild(_readableScript);})()" title="Lire &agrave; l'&eacute;cran (version optimis&eacute;e pour la lecture)"></a></li>
				<li><a class="icon cite-link" href="#cite-post" title="Citer ce billet"></a></li>
				<li><a class="icon mail" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>" title="Envoyer le lien par email"></a></li>
				<li><a class="icon printer" href="javascript:window.print();" title="Imprimer (version optimis&eacute;e pour l'impression)"></a></li>
			</ul>
		</div>
	<?php }
}
endif;

/*
 * RDF version for each post or category
 */
if ( ! function_exists( 'basics_rdf_feeds' ) ) :
function basics_rdf_feeds() {
	$url = site_url();
	if ( is_single() ){
		foreach(( get_the_category() ) as $cat){
			echo '<link rel="alternate" type="application/rdf+xml" title="RDF Version of the category ' . $cat->cat_name . '"  href="'. $url .'/category/'. $cat->category_nicename .'/feed/rdf">';
		}
	}
	if ( is_category() ){
		$category = get_the_category();
		$cat_name = $category[0]->category_nicename;
		echo '<link rel="alternate" type="application/rdf+xml" title="RDF Version of the category ' . $cat_name . '"  href="'. $url .'/category/'. $cat_name .'/feed/rdf">';
	}
}
endif;

/*
 * Deregister Contact Form 7 scripts and stylesheet, except on Contact page
 */
add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );
function my_deregister_javascript() {
  if ( !is_page('6427') ) {
    wp_deregister_script( 'contact-form-7' );
  }
}

add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
function my_deregister_styles() {
  if ( !is_page('6427') ) {
    wp_deregister_style( 'contact-form-7' );
  }
}
