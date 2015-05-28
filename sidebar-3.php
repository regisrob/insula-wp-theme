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
	<aside id="sidebar-3" class="sidebars" role="complementary">
		<h1 class="section-title hidden"><?php _e('Aside Sidebar 3', 'basics' ); ?></h1>
		
		<?php if ( is_active_sidebar( 'war-3' ) ) : ?>
			<section id="widget-area-3" class="widget">
				<h1 class="section-title hidden"><?php _e('Section widget area 3', 'basics' ); ?></h1>
				<?php dynamic_sidebar( 'war-3' ); ?>
			</section> <!-- eo #widget-area-3 .widget -->
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'war-4' ) ) : ?>
			<section id="widget-area-4" class="widget">
				<h1 class="section-title hidden"><?php _e('Section widget area 4', 'basics' ); ?></h1>
				<?php dynamic_sidebar( 'war-4' ); ?>
			</section> <!-- eo #widget-area-4 .widget -->
		<?php endif; ?>	
		
		<?php if ( is_active_sidebar( 'war-5' ) ) : ?>
			<section id="widget-area-5" class="widget">
				<h1 class="section-title hidden"><?php _e('Section widget area 5', 'basics' ); ?></h1>
				<?php dynamic_sidebar( 'war-5' ); ?>
			</section> <!-- eo #widget-area-5 .widget -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'war-6' ) ) : ?>
			<section id="widget-area-6" class="widget">
				<h1 class="section-title hidden"><?php _e('Section widget area 6', 'basics' ); ?></h1>
				<?php dynamic_sidebar( 'war-6' ); ?>
			</section> <!-- eo #widget-area-6 .widget -->
		<?php endif; ?>
		
		<section id="widget-area-7" class="widget">
			<h1 class="section-title hidden"><?php _e('Section widget area 7', 'basics' ); ?></h1>
			<?php if ( ! dynamic_sidebar( 'war-7' ) ) : ?>
				<div id="basics-categories">
					<h2><?php _e( 'Categories', 'basics' ) ; ?></h2>
					<?php $args = array(
					'use_desc_for_title' => 0,
					'title_li' => ''
					); ?>
					<ul><?php wp_list_categories( $args ); ?></ul>
				</div>
			<?php endif; ?>
		</section> <!-- eo #widget-area-7 .widget -->
			
		<?php if ( is_active_sidebar( 'war-8' ) ) : ?>
			<section id="widget-area-8" class="widget">
				<h1 class="section-title hidden"><?php _e('Section widget area 8', 'basics' ); ?></h1>
				<?php dynamic_sidebar( 'war-8' ); ?>
			</section> <!-- eo #widget-area-8 .widget -->
		<?php endif; ?>
		
	</aside> <!-- eo #sidebar-3 .sidebars -->
<?php /* We Salute You */ ?>
