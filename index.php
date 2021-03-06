<?php
/*
@package WordPress
@subpackage Basics
@author Bruno Bichet <bruno.bichet@gmail.com>
@version 0.2.2
@since Version 0.1.1
@todo Check the markup http://validator.w3.org/
For Those About to Rock. Fire!
*/
?>
<?php get_header(); ?>
        <div id="main">
			<section role="main">
			<?php if( ! is_singular() && ! is_paged() ) : ?>
				<?php if ( have_posts() ) : the_post() ?>
					<?php if( ! is_home() ) : ?> 
						<header class="section-header">
							<hgroup class="section-hgroup">
								<?php $section = basics_section_heading(); ?>
								<h1 class="section-title"><?php echo $section['section_title']; ?></h1>
								<h2 class="section-description"><?php echo $section['section_description']; ?></h2>
							</hgroup>
							<?php if ( is_author() ) : ?>
							<figure class="author-avatar">
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( '', 60 ) ); ?>
							</figure> <!-- .author-avatar -->
							<?php endif; ?>
						</header>
					<?php endif; ?>
					<?php endif; rewind_posts(); ?>
				<?php endif; ?>
				<?php //basics_content_nav( 'nav-above', 'menu' ); ?>			
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
				<?php //basics_content_nav( 'nav-below', 'menu' ); ?>
				<div class="navigation">
					<?php wp_pagenavi(); ?>
				</div>
			</section>
		<?php if( is_singular() ) : ?>
			<section role="complementary">
			<?php comments_template(); ?>
			</section>
		<?php endif; ?>
        </div> <!-- eo #main -->
		<div id="sidebar">
		<?php if ( is_active_sidebar( 'war-2' ) ) : ?>
			<div id="widget-area-2" class="widget">
				<?php dynamic_sidebar( 'war-2' ); ?>
			</div> <!-- eo #widget-area-2 .widget -->
		<?php endif; ?>
        <?php get_sidebar( '3' ); ?>
		</div> <!-- eo #sidebar -->
<?php get_footer(); /* We Salute You */ ?>   
