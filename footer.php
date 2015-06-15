<?php
/*
@package WordPress
@subpackage Basics
@author Bruno Bichet <bruno.bichet@gmail.com>
@version 0.2.4
@since Version 0.1
@todo Check the markup http://validator.w3.org/
For Those About to Rock. Fire!
*/
?>
    </div> <!-- eo #content -->
	<div id="content-info">
		<footer role="contentinfo">
		
			<?php if ( is_active_sidebar( 'war-11' ) ) : ?>
			<section id="widget-area-11" class="widget">
				<h1 class="section-title"><?php _e('Widget Area 11', 'basics' ); ?></h1>
				<?php dynamic_sidebar( 'war-11' ); ?>
			</section> <!-- eo #widget-area-11 -->
			<?php endif; ?>
			
			<section id="colophon" class="clearfix">
				<h1 class="section-title visuallyhidden"><?php _e( 'Colophon', 'basics' ); ?></h1>
					<div id="licence">
						<a rel="license" property="cc:license" href="http://creativecommons.org/licenses/by-nc-nd/2.0/fr/" title="Licence Creative Commons BY-NC-ND 2.0">
							<img alt="Creative Commons by-nc-nd" src="<?php bloginfo('template_directory'); ?>/img/by-nc-nd-88x31.png" width="88" height="31">
						</a>
					</div>
				<small>
					<span id="copyright" class="source-org vcard copyright">
						<em><?php bloginfo( 'name' ); ?></em>, <?php bloginfo( 'description' ); ?>
					</span> <!-- eo #copyright -->

					<?php //printf( __( '<span class="%1$s">%2$s</span>', 'basics' ), 'meta-sep', __( ' &mdash; ', 'basics' ) ); ?>				
					<!--<span id="credits">
						<a href="http://wordpress.org/"><?php // _e( 'Proudly powered by WordPress', 'basics' ); ?></a>
						<?php //printf( __( '<span class="%1$s">%2$s</span>', 'basics' ), 
							//'meta-sep', __( ' &mdash; ', 'basics' ) ); ?>
							
						<?php //printf( __( 'Theme: %1$s', 'basics' ), 
							//'<a href="http://wp4design.com" title="Blank Theme for those about to rock with WordPress!">Basics</a>' ); ?>
					</span>--> <!-- eo #credits -->
					<br />
					<a href="<?php bloginfo('url'); ?>/contact/">
						<?php _e( 'Contact the administrator ', 'basics' ); ?>
					</a>
					 &mdash; 
					<a href="<?php bloginfo('rss2_url'); ?>" title="S'abonner au flux de syndication des articles (RSS 2.0)">Flux RSS des billets</a>
					 &mdash; 
					<a href="<?php bloginfo('comments_rss2_url'); ?>" title="S'abonner au flux de syndication des commentaires (RSS 2.0)">Derniers commentaires</a>
					 <!--&mdash; 
					<a href="<?php //bloginfo('url'); ?>/plan-du-site/" title="Tous les billets du blog, class&eacute;s par cat&eacute;gorie">Plan du site</a>-->
				</small>
			</section> <!-- eo #colophon -->
		</footer>
	</div> <!-- eo #content-info -->
	
	<p id="w3c"><a href="http://www.w3.org/TR/html5/" title="HTML5 Powered with CSS3 / Styling, and Semantics"><img src="<?php bloginfo('template_directory'); ?>/img/html5-badge-h-css3-semantics.png" width="64" height="25" alt="HTML5"></a> <a href="http://www.w3.org/TR/rdfa-syntax/" title="Resource Description Framework – in – attributes"><img src="<?php bloginfo('template_directory'); ?>/img/valid-rdfa.png" width="80" height="15" alt="RDFa"></a></p>
	
</div> <!-- eo #page -->

<!-- Note: see basics_jquery() and basics_scripts() functions [inc/functions-filter-action.php] to manage jQuery and other scripts -->
<?php wp_footer(); ?>

<script>
//<![CDATA[
$(function(){
	$(".wp-caption a:not(.nofancy), .gallery-icon a").fancybox({
		'overlayShow'	: true,
		'titleFromAlt' : true,
		'titlePosition'	: 'inside',
		'transitionIn'	: 'fade',
		'transitionOut'	: 'none'
	});
});
$(function(){
	$(".cite-link").fancybox({
		'modal' : false,
		'titleShow' : false,
		'showCloseButton' : true,
		'hideOnOverlayClick' : true,
		'autoDimensions' : false,
		'width' : 480,
		'height' : 'auto',
		'transitionIn'	: 'fade',
		'transitionOut'	: 'none'
	});
});
//]]>
</script>
<?php if (is_single() ){ ?>
	<script>
	//<![CDATA[
		jQuery(document).ready(function($){
			var ul = document.createElement("ul");
			$(ul).addClass("listCitations").insertAfter(".titreCitations");
			$(this).find("a[class='citation']").each(function(){
				var title = $(this).attr("title");
				var href = $(this).attr("href");
				var rel = $(this).attr("rel");
				var li = document.createElement("li");
				$(li).appendTo(".listCitations").text(title);
				$(li).wrapInner("<a href='"+href+"' rel='"+rel+"' />");
			});
			
		});
	//]]>
	</script>
<?php } else{ ?>
	<script>
	//<![CDATA[
		jQuery(document).ready(function($){
			$("h3.titreCitations").remove();
		});
	//]]>
	</script>
<?php } ?>

<!-- GA -->
<script>
var _gaq = [['_setAccount','UA-1432511-4'],['_setAllowAnchor', true],['_trackPageview'],['_trackPageLoadTime']];
(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
			<div id="bookLinkerCollection"></div>
			<div id="perioLinkerCollection"></div>
</body>
</html>
<?php /* We Salute You */ ?>
