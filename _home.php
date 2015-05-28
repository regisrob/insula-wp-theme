<?php
/*
@package WordPress
@subpackage Basics
@author Bruno Bichet <bruno.bichet@gmail.com>
@version 0.2.2
@since Version 0.1
@todo Check the markup http://validator.w3.org/
For Those About to Rock. Fire!
*/
?>
<?php get_header(); ?>
        <div id="main">
			<section role="main">
				<header>
					<hgroup>
						<?php $section = basics_section_heading(); ?>
						<h1 class="section-title"><?php echo $section['section_title']; ?></h1>
						<h2 class="section-description"><?php echo $section['section_description']; ?></h2>
					</hgroup>
				</header>
				<!-- First loop: display the last Sticky Post or the last post published if none -->
				<?php 
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					$sticky = get_option( 'sticky_posts' );
					$args = array(
						'post__in'  => $sticky,
						'ignore_sticky_posts' => 1,
						'posts_per_page' => 1,
						'paged'          => $paged
					);                
					$featured_query = new WP_Query( $args ); 
				?>
				<?php if ( ! $featured_query->have_posts() ) : ?>           
					<p class="info error"><?php _e( 'Posts not found. Tell the administrator that the category requested not exists.', 'basics' ); ?></p>
				<?php endif; ?>
				<?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); 
					$do_not_duplicate = $post->ID; ?>    
					<?php get_template_part( 'content', get_post_format() ); ?>            
				<?php endwhile; wp_reset_postdata(); ?>
			</section>
			<section role="complementary">
				<header>
					<hgroup>
						<h1 class="section-title"><?php _e( 'Do you want to know more?', 'basics' ); ?></h1>
						<h2 class="section-description"><?php _e( 'Find here all the latest news about Basics', 'basics' ); ?></h2>
					</hgroup>
				</header>
				<!-- Second loop: display the posts from the Uncategorized category -->
				<?php 
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					$args = array(
						/*'category_name'  => 'news',*/
						'cat' => 1,
						'posts_per_page' => 3,
						'paged'          => $paged
					);                
					$featured_query = new WP_Query( $args ); 
				?>
				<?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); 
					if( $post->ID == $do_not_duplicate ) continue; update_post_caches($posts); ?>            
					<?php get_template_part( 'content', 'news' ); ?>            
				<?php endwhile; wp_reset_postdata(); ?>
			</section>
        </div> <!-- eo #main -->
		<div id="sidebar">
		<?php if ( is_active_sidebar( 'war-3' ) ) : ?>
			<div id="widget-area-3" class="widget">
				<?php dynamic_sidebar( 'war-3' ); ?>
			</div> <!-- eo #widget-area-3 .widget -->
		<?php endif; ?>
            <?php get_sidebar( '1' ); ?>
            <?php //get_sidebar( '2' ); ?>
		<?php if ( is_active_sidebar( 'war-4' ) ) : ?>
			<div id="widget-area-4" class="widget">
				<?php dynamic_sidebar( 'war-4' ); ?>
			</div> <!-- eo #widget-area-4 .widget -->
		<?php endif; ?>
		</div> <!-- eo #sidebar -->
<?php get_footer(); /* We Salute You */ ?>      
