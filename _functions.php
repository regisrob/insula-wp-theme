<?php
/*
@package WordPress
@subpackage Basics
@author Bruno Bichet <bruno.bichet@gmail.com>
@version 0.2.6
@since Version 0.1
@todo Check the markup http://validator.w3.org/
For Those About to Rock. Fire!
*/
 
/**
 * Note: 
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override the functions
 * wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. 
 *
 * The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 */
 
 /**
 * Disable the wpautop function so that WordPress makes no attempt to correct your markup.
 * http://nicolasgallagher.com/using-html5-elements-in-wordpress-post-content/
 */
//remove_filter('the_excerpt', 'wpautop');
//remove_filter('the_content', 'wpautop'); 
 
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
    $content_width = 623; /* pixels */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 * If you're building a theme based on Basics, use a find and replace
 * to change 'basics' to the name of your theme in all the template files
 */
load_theme_textdomain( 'basics', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
    require_once( $locale_file );

/**
 * This theme uses wp_nav_menu() in four locations.
 */
register_nav_menus( array(
    'first' => __( 'First navigation', 'basics' ),
    'second' => __( 'Second navigation', 'basics' ),
    'third' => __( 'Third navigation', 'basics' ),
    'fourth' => __( 'Fourth navigation', 'basics' )
) );

/**
 * Add default posts and comments RSS feed links to head
 * Don't forget to remove the feed link in header.php if you decomment this line
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Add support for all Post Formats. 
 * Simply comment line(s) associated with the Post formats you want to kick off 
 */
add_theme_support( 
	'post-formats', array( 
		'aside', 
		'gallery', 
		'link', 
		'image', 
		'quote', 
		'status', 
		'video', 
		'audio', 
		'chat' 
	)
);

/**
 * Add support for custom backgrounds
 */
add_custom_background();

/**
 * Add support for Thumbnails
 */
add_theme_support( 'post-thumbnails' );

/**
 * Add support to styles the visual editor with editor-style.css to match the front theme style
 */
add_editor_style('markup');

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
add_filter( 'wp_page_menu_args', 'basics_page_menu_args' );
if ( ! function_exists( 'basics_page_menu_args' ) ) :
	function basics_page_menu_args($args) {
		$args['show_home'] = false; /* Do not show home link in wp_nav_menu */
		return $args;
	}
endif;
	
/**
 * Sets the post excerpt length to 52 characters.
 */
add_filter( 'excerpt_length', 'basics_excerpt_length' );
if ( ! function_exists( 'basics_excerpt_length' ) ) :
	function basics_excerpt_length( $length ) {
		return 52;
	}
endif;

/**
 * Returns a "Continue Reading" link for excerpts
 */
if ( ! function_exists( 'basics_continue_reading_link' ) ) :
	function basics_continue_reading_link() {
		return ' <a href="'. get_permalink() . '" rel="nofollow">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'basics' ) . '</a>';
	}
endif;

/**
 * Replaces "[...]" (appended to automatically generated excerpts) 
 * with an ellipsis and basics_continue_reading_link().
 */
add_filter( 'excerpt_more', 'basics_auto_excerpt_more' );
if ( ! function_exists( 'basics_auto_excerpt_more' ) ) :
	function basics_auto_excerpt_more( $more ) {
		return ' &hellip;' . basics_continue_reading_link();
	}
endif;

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
add_filter( 'get_the_excerpt', 'basics_custom_excerpt_more' );
if ( ! function_exists( 'basics_custom_excerpt_more' ) ) :
	function basics_custom_excerpt_more( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= basics_continue_reading_link();
		}
		return $output;
	}
endif;

/**
 * Register widgetized area and update sidebar with default widgets
 */
add_action( 'init', 'basics_widgets_init' );
if ( ! function_exists( 'basics_widgets_init' ) ) :
	function basics_widgets_init() {
		register_sidebar( array (
			'name' => __( 'One', 'basics' ),
			'id' => 'war-1',
			'description' => __( 'Widgets Area One', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'Two', 'basics' ),
			'id' => 'war-2',
			'description' => __( 'Widgets Area Two', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'Three', 'basics' ),
			'id' => 'war-3',
			'description' => __( 'Widgets Area Three', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'Four', 'basics' ),
			'id' => 'war-4',
			'description' => __( 'Widgets Area Four', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'Five', 'basics' ),
			'id' => 'war-5',
			'description' => __( 'Widgets Area Five', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'Six', 'basics' ),
			'id' => 'war-6',
			'description' => __( 'Widgets Area Six', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'Seven', 'basics' ),
			'id' => 'war-7',
			'description' => __( 'Widgets Area Seven', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'Eight', 'basics' ),
			'id' => 'war-8',
			'description' => __( 'Widgets Area Eight', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'Nine', 'basics' ),
			'id' => 'war-9',
			'description' => __( 'Widgets Area Nine', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'Ten', 'basics' ),
			'id' => 'war-10',
			'description' => __( 'Widgets Area Ten', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'Eleven', 'basics' ),
			'id' => 'war-11',
			'description' => __( 'Widgets Area Eleven', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
	}
endif;

/**
 * Add custom body classes
 */
add_filter( 'body_class', 'basics_body_class' );
if ( ! function_exists( 'basics_body_class' ) ) :
	function basics_body_class($classes) {
		if ( is_singular() )
			$classes[] = 'singular';
		return $classes;
	}
endif;

/**
 * Display navigation to next/previous pages when applicable. (Adapted from Duster theme's functions.php).
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
	// Add the blog description only in home page
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
		global $post;
		if ( is_home() || is_front_page() ) {
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
		//Prevent shortcode to appear "as is"
		$description = preg_replace('#\[(.+)\]#','', $basics_description);
		return $description;
	}
endif;

/*
 * Return the the section heading (title and description) regarding the context.
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
	
	/*if ( is_home() || is_front_page() ) {
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
		$section['section_title'] = sprintf( esc_attr__( 'Archives de l\'auteur :  %s', 'basics' ), '<span>'. get_the_author() .'</span>' );
		
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
 * Remove p in category or tag description
 */
remove_filter('term_description','wpautop');

/*
 * Remove p in excerpt
 */
//remove_filter('the_excerpt', 'wpautop');

/*
 * Print the post meta in the post's header
 */
if ( ! function_exists( 'basics_posted_on' ) ) :
	function basics_posted_on() {
		/*printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'basics' ),
			'meta-prep meta-prep-author',
			sprintf( '<time title="%1$s published at %2$s" class="%3$s" datetime="%4$s" pubdate><span property="dcterms:created"  datatype="xsd:date" content="%4$s">%5$s</span></time>',
				'[ ' . get_permalink() . ' ]',
				esc_attr( get_the_time() ),
				'entry-date',
				get_the_date('c'),
				get_the_date()
			),
			sprintf( '<span class="author vcard" rel="sioc:has_creator"><span typeof="sioc:UserAccount"><span property="dc:creator" content="%3$s"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span></span></span>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'basics' ), get_the_author() ),
				get_the_author()
			)
		);*/
		printf( '<span class="dot"></span> Par <span class="author vcard" rel="sioc:has_creator" typeof="sioc:UserAccount" property="dc:creator" content="%3$s"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span> le %4$s %5$s',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'basics' ), get_the_author() ),
			get_the_author(),
			/* %4$s -> Date */
			sprintf( '<time class="%3$s" datetime="%4$s" pubdate><span property="dcterms:created"  datatype="xsd:date" content="%4$s">%5$s</span></time>',
				'[ ' . get_permalink() . ' ]',
				esc_attr( get_the_time() ),
				'entry-date',
				get_the_date('c'),
				get_the_date()
			),
			/* %5$s -> Categories  */
			sprintf( '<span class="dot"></span> Publié dans %1$s',
				get_the_category_list( ', ' )
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
		/*$tag_list = get_the_tag_list( '', ' &middot; ' );
		if ( $tag_list ) {
			$posted_in = __( 'Posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark nofollow">permalink</a>.', 'basics' );
		} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
			$posted_in = __( 'Posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark tag nofollow">permalink</a>.', 'basics' );
		} else {
			$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark nofollow">permalink</a>.', 'basics' );
		}*/
		
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
 * The Caption shortcode.
 */
if ( ! function_exists( 'basics_img_caption_shortcode' ) ) :
	function basics_img_caption_shortcode($attr, $content = null) {

		// Allow plugins/themes to override the default caption template.
		$output = apply_filters('img_caption_shortcode', '', $attr, $content);
		if ( $output != '' )
			return $output;

		extract(shortcode_atts(array(
			'id'	=> '',
			'align'	=> 'alignnone',
			'width'	=> '',
			'caption' => ''
		), $attr));

		if ( 1 > (int) $width || empty($caption) )
			return $content;

		if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

		return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . (0 + (int) $width) . 'px">'
		. do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $caption . '</figcaption></figure>';
	}
endif;
add_shortcode('wp_caption', 'basics_img_caption_shortcode');
add_shortcode('caption', 'basics_img_caption_shortcode');

/**
 * Add support for iframe element in wysiwyg editor 
 * http://wpengineer.com/1963/customize-wordpress-wysiwyg-editor/
 */
add_filter('tiny_mce_before_init', 'basics_change_mce_options');
if ( ! function_exists( 'basics_change_mce_options' ) ) :
	function basics_change_mce_options( $initArray ) {
		// Comma separated string od extendes tags
		// Command separated string of extended elements
		$ext = 'pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src]';
		if ( isset( $initArray['extended_valid_elements'] ) ) {
			$initArray['extended_valid_elements'] .= ',' . $ext;
		} else {
			$initArray['extended_valid_elements'] = $ext;
		}
		// maybe; set tiny paramter verify_html
		//$initArray['verify_html'] = false;
		return $initArray;
	}
endif;

/**
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
if ( ! function_exists( 'basics_comments' ) ) :
	function basics_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<footer>
					<div class="comment-author vcard">
						<?php echo get_avatar( $comment, 40 ); ?>
						<?php printf( __( '%s <span class="says">says:</span>', 'basics' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div><!-- eo .comment-author .vcard -->
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 'basics' ); ?></em>
					<?php endif; ?>

					<div class="comment-meta commentmetadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time pubdate datetime="<?php comment_time( 'c' ); ?>">
							<?php
								/* translators: 1: date, 2: time */
								printf( __( '%1$s at %2$s', 'basics' ), get_comment_date(),  get_comment_time() ); ?>
							</time>
						</a>
						<?php printf( __( '<span class="%1$s">%2$s</span>', 'basics' ), 'meta-sep', __( ' | ', 'basics' ) ); ?>				
						<?php edit_comment_link( __( '(Edit)', 'basics' ), ' ' ); ?>
					</div><!-- eo .comment-meta .commentmetadata -->
				</footer>
				
				<div class="comment-content"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply!', 'basics' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- eo .reply -->
			</article><!-- eo #comment-##  -->

		<?php
					break;
			case 'pingback'  :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'basics' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'basics'), ' ' ); ?></p>
		<?php
					break;
		endswitch;
	}
endif; // ends check for basics_comments()

/*
 * Customise the comments fields with HTML5 form elements
 */
add_filter('comment_form_defaults', 'basics_respond');
if ( ! function_exists( 'basics_respond' ) ) :
	function basics_respond( $post_id = null ) {
		global $user_identity, $id;
		
		if ( null === $post_id )
			$post_id = $id;
		else
			$id = $post_id;
			
		$commenter = wp_get_current_commenter();
		
		$req = get_option('require_name_email');
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$fields = array( 
			'open_tag' => '<ul id="comment_form_basics_fields">',
			'author' => '<li class="comment-form-author">' . '<label for="author">' . __( 'Name', 'basics' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder = "' . __( 'What can we call you?', 'basics' ) . '"' . ( $req ? ' required' : '' ) . '></li>',
			'email'  => '<li class="comment-form-email"><label for="email">' . __( 'Email', 'basics' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
						'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'How can we reach you?', 'basics' ) . '"' . ( $req ? ' required' : '' ) . '></li>',
			'url'    => '<li class="comment-form-url"><label for="url">' . __( 'Website', 'basics' ) . '</label>' .
						'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . __('Have you got a website?', 'basics') .'"></li>',
			'close_tag' => '</ul>'
		);
		
		$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );
		
		$defaults = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<div class="comment-form-comment"><p><label for="comment">' . _x( 'Votre commentaire', 'noun','basics' ) . '</label></p><p><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p></div>',
			'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.','basics' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','basics' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.','basics' ) . ( $req ? $required_text : '' ) . '</p>',
			'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'basics' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => __( 'Leave a Reply','basics' ),
			'title_reply_to'       => __( 'Leave a Reply to %s','basics' ),
			'cancel_reply_link'    => __( 'Cancel reply','basics' ),
			'label_submit'         => __( 'Post Comment','basics' ),
		);
		
		return $defaults;
	}
endif;

/*
 ************* Fonctions ajoutees a Basics (issues de l'ancien theme)
 */

/*
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
 * Disable anchor on More link
 */
function remove_more_jump_link($link) { 
$offset = strpos($link, '#more-');
if ($offset) {
$end = strpos($link, '"',$offset);
}
if ($end) {
$link = substr_replace($link, '', $offset, $end-$offset);
}
return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

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
 echo "<link rel='stylesheet' type='text/css' href='$url' media='screen' />\n";}
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
function encart_clean_content( $content ) {

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
$content = encart_clean_content( $content );
	return '<div class="encart" style="width:'."{$largeur}".'%; float:'."{$align}".';"><h4 class="titreEncart">' . "{$titre}" . '</h4>' . '<div class="contenuEncart">' . $content . '</div>' . '</div>';
}
add_shortcode('encart', 'encart');

?>
