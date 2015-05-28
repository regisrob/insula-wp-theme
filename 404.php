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
				<?php get_template_part( 'content', '404' ); ?>
			</section>
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
  
