<?php
/*
@package WordPress
@subpackage Basics
@author Bruno Bichet <bruno.bichet@gmail.com>
@version 0.2.7
@since Version 0.2.7
For Those About to Rock. Fire!
*/

/*
TOC:
basics_content_nav()		Display navigation to next/previous pages when applicable.
basics_title()				Print the <title> tag based on what is being viewed.				#!edited
basics_description()		Print the <meta description> of the web page regarding the context
basics_section_heading()	Return the section heading (title and description) regarding the context.	#!edited
basics_posted_on()			Print the post meta in the post's header	#!edited
basics_posted_in()			Print the post meta in the post's footer	#!edited
basics_favicons()			Print Meta tags for favicon
basics_extra_head()			Print extra meta tags into <head>
basics_i_love_wordpress()	Print WordPress icon to the footer
basics_search_autofocus()	Print autofocus attribute to search form when is_search()
*/

/**
 * Display navigation to next/previous pages when applicable.
 */
if ( ! function_exists( 'basics_content_nav' ) ) :
function basics_content_nav($nav_id, $nav_class) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 0 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>" role="navigation">
			<h1 class="visuallyhidden"><?php _e( 'Post navigation', 'basics' ); ?></h1>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'basics' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'basics' ) ); ?></div>
		</nav><!-- eo #<?php echo $nav_id; ?> .<?php echo $nav_class; ?> -->
	<?php endif;
}
endif;

/*
 * Print the <title> tag based on what is being viewed.
 */
if ( ! function_exists( 'basics_title' ) ) :
function basics_title() {
	global $page, $paged;
	wp_title( '|', true, 'right' );
	// #! Add the blog name and description only in home page
	if ( is_home() ) {
		bloginfo( 'name' );
		echo ', ';
		bloginfo( 'description' );
	}else{
		bloginfo( 'name' );
	}
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'basics' ), max( $paged, $page ) );
}
endif;

/*
 * Print the <meta description> of the web page regarding the context
 */
if ( ! function_exists( 'basics_description' ) ) :
function basics_description() {
	global $post, $wp_query;
	if ( is_404() ) {
		$basics_description = __('404 page not found: fish is gone, try again');
	} else if ( is_search() && '' != $wp_query->found_posts ) {
		$basics_description = __('No result found: try again!');
	} else if ( is_home() || is_front_page() ) {
		$basics_description = get_bloginfo( 'description', 'display' );
	} else if ( '' !== $post->post_excerpt ) { 
		$basics_description = strip_tags( $post->post_excerpt );
	} else if ( is_category() ) {
		$basics_description = wptexturize( category_description() );
	} else if ( is_tag() ) {
		$basics_description = wptexturize( tag_description() );
	} else if ( is_author() ) {
		$basics_description = wptexturize( get_the_author_meta( 'description' ) );
	} else { 
		$basics_description = wp_html_excerpt( $post->post_content, 200 ); 
	}
	//Prevent shortcode to appear "as is" and convert special caracters to html entities
	$description = preg_replace('#\[(.+)\]#','', htmlspecialchars($basics_description) );
	return $description;
}
endif;
/*
 * Return the section heading (title and description) regarding the context.
 */
if ( ! function_exists( 'basics_section_heading' ) ) :
function basics_section_heading() {
	global $post;
	$category_description = wptexturize( category_description() );
	$tag_description = wptexturize( tag_description() );
	$author_description = wptexturize( get_the_author_meta( 'description' ) );
	$section = array(
		'section_title' => '',
		'section_description' => ''
	);
	
	/* #! Pas de section heading sur la page d'accueil
	 * #! Pas de else pour les autres templates
	 * 
	if ( is_home() || is_front_page() ) {
		$section['section_title'] = __('Hi! What can Basics do for you?', 'basics' );
		$section['section_description'] = __('See how Basics could help you as a starter theme for your own developpments with WordPress', 'basics' );
	}
	else*/ 
	if ( is_category() ) {
		$section['section_title'] = sprintf( __( 'Category Archives: %s', 'basics' ), '<span>' . single_cat_title( '', false ) . '</span>' );
		if ( ! empty( $category_description ) ) {
			$section['section_description'] = category_description();
		} /*else {
			$section['section_description'] = sprintf( __( 'No description for category %s. Suggest the administrator to fill a helping description.', 'basics' ), '<mark>' . single_cat_title( '', false ) . '</mark>' );
		}*/
	} 
	else if (is_tag() ) {
		$section['section_title'] = $section_title = sprintf( __( 'Tag Archives: %s', 'basics' ), '<span>' . single_tag_title( '', false ) . '</span>' );
		if ( ! empty( $tag_description ) ) {
			$section['section_description'] = tag_description();
		} /*else {
			$section['section_description'] = sprintf( __( 'No description for tag %s. Suggest the administrator to fill a helping blurb.', 'basics' ), '<mark>' . single_cat_title( '', false ) . '</mark>' );
		}*/
	} 
	else if ( is_author() ) {
		$section['section_title'] = sprintf( esc_attr__( 'Archives author for: %s', 'basics' ), '<span>' . get_the_author() . '<span>' );
		if ( ! empty( $author_description ) ) {
			$section['section_description'] = $author_description;
		} /*else {
			$section['section_description'] = sprintf( __( 'Sorry, there is no description for author %s. If it\'s you, feel free to write a consistent description. It is a gook way to promote yourself.', 'basics' ), '<mark>' . get_the_author() . '</mark>' );
		}*/
	} 
	else if (is_date() ) {
	
		if ( is_day() ) {
			$section['section_title'] = __( 'Daily Archives:', 'basics' );
			$section['section_description'] = get_the_date();
		}
		elseif ( is_month() ) {
			$section['section_title'] = __( 'Monthly Archives:', 'basics' );
			$section['section_description'] = get_the_date('F Y');
		}
		elseif ( is_year() ) {
			$section['section_title'] = __( 'Yearly Archives:', 'basics' );
			$section['section_description'] = get_the_date('Y');
		}
		else {
			$section['section_title'] = __( 'Blog Archives', 'basics' );
			$section['section_description'] = __( 'Blog Archives description', 'basics' );
		}
	} 
	else if ( is_search() ) {
		if ( have_posts() ) {
			$section['section_title'] = __('Search results for:', 'basics' );
			$section['section_description'] = sprintf( __( '%s', 'basics' ), '<mark>' . get_search_query() . '</mark>' );
		}
	}
	else if ( is_404() ) {
		$section['section_title'] = __( 'Hi! This is somewhat embarrassing, isn&rsquo;t it?', 'basics' );
		$section['section_description'] = __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'basics' );
	}
	return $section;
}
endif;

/*
 * Print the post meta in the post's header
 */
if ( ! function_exists( 'basics_posted_on' ) ) :
function basics_posted_on() {
	// #! Ajout RDFa + modifs des donnees a afficher
	printf( '<span class="dot"></span> Par <span property="dc:creator" content="%3$s"></span><span rel="sioc:has_creator"><span class="author vcard"><a class="url fn n" typeof="sioc:UserAccount" href="%1$s" title="%2$s"><span property="foaf:name">%3$s</span></a></span></span> le %4$s %5$s',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'basics' ), get_the_author() ),
			get_the_author(),
			/* %4$s -> Date */
			sprintf( '<time class="%3$s" datetime="%4$s"><span property="dcterms:created" datatype="xsd:date" content="%4$s">%5$s</span></time>',
				'[ ' . get_permalink() . ' ]',
				esc_attr( get_the_time() ),
				'entry-date',
				get_the_date('c'),
				get_the_date()
			),
			/* %5$s -> Categories  */
			sprintf( '<span class="dot"></span> Publi&eacute; dans %1$s',
				get_the_category_list( ' | ' )
			)
		);
}
endif;

/*
 * Print the post meta in the post's footer
 */
if ( ! function_exists( 'basics_posted_in' ) ) :
function basics_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	// #! Ajout RDFa + modifs donnees a fficher
	$post_tags = get_the_tags();
		$posted_in = '<div class="post-tags"><span></span> Mots cl&eacute;s : ';
		if ( $post_tags ) {
			foreach($post_tags as $tag) {
				$tag_link = get_tag_link($tag->term_id);
				$tag_name_clean = esc_attr($tag->name);
				$posted_in .= "<span property='dc:subject' content='$tag_name_clean'><a href='{$tag_link}' title='Billets publi&eacute;s avec le mot-cl&eacute; $tag_name_clean' rel='tag'>";
				$posted_in .= "{$tag->name}</a></span>";
			}
		}
		$posted_in .= '</div>';
		
		// Prints the string, replacing the placeholders.
		printf(
			$posted_in
			//get_the_category_list( ', ' ),
			//$tag_list,
			//get_permalink(),
			//the_title_attribute( 'echo=0' )
		);
	}
endif;

/**
 * Print Meta tags for favicon
 * 
 * Note : instead you can place favicon.ico and apple-touch-icon.png in the root directory
 * In this case, don't forget to remove basics_favicons() in header.php
 */
if ( ! function_exists( 'basics_favicons' ) ) :
function basics_favicons() {
	$favicon1_path = get_stylesheet_directory_uri() . '/img/icons/favicon.ico';
	$favicon2_path = get_stylesheet_directory_uri() . '/img/icons/apple-touch-icon.png';
	$favicons = 
	'<link rel="shortcut icon" href="' . $favicon1_path . '">' . "\n" . 
	'<link rel="apple-touch-icon" href="' . $favicon2_path . '">' . "\n";
	return $favicons;
}
endif;

/**
 * Print extra meta tags into <head>
 * Signup on Google Webmaster Tools : https://www.google.com/webmasters/tools/
 * Signup on Alexa : http://www.alexa.com/siteowners/claim
 *
 * Don't forget to fill the "content" attributes, 
 * or duplicate this function in your Child theme functions.php file
 */
if ( ! function_exists( 'basics_extra_head' ) ) :
function basics_extra_head() {
	$extra_head = 
	'<meta name="google-site-verification" content="">' . "\n" . 
	'<meta name="alexaVerifyID" content="">' . "\n" .
	'<link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml">'. "\n";
	return $extra_head;
}
endif;

/**
 * Print WordPress icon to the footer
 */
if ( ! function_exists( 'basics_i_love_wordpress' ) ):	
function basics_i_love_wordpress() {
?>
<img id="wpjt" alt="Logo WordPress je thème" src="<?php echo get_template_directory_uri(); ?>/img/icons/wordpress-je-theme.png">
<?php  
}    
endif;

/**
 * Print autofocus attribute to search form when is_search()
 */
if ( ! function_exists( 'basics_search_autofocus' ) ):	
function basics_search_autofocus() {
	global $wp_query;
	if ( is_search() ) {
		echo 'autofocus';
	}
} 
endif;

?>
