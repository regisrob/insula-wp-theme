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
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> about="<?php the_permalink() ?>" typeof="sioctype:BlogPost">
				<!-- Coins metadata -->
				<span class="Z3988" title="ctx_ver=Z39.88-2004&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Adc&amp;rfr_id=info%3Asid%2Focoins.info%3Agenerator&amp;rft.title=<?php the_title(); ?>&amp;rft.aulast=<?php the_author_lastname(); ?>&amp;rft.aufirst=<?php the_author_firstname();?><?php 
				if(get_post_type() == 'post'){
					$posttags = get_the_tags();
					if ($posttags){ 
						foreach($posttags as $tag){
							echo '&amp;rft.subject=' . $tag->name . '';
						}
					} ?>&amp;rft.source=<?php bloginfo('name'); ?>&amp;rft.date=<?php the_time('Y-m-d'); ?>&amp;rft.type=blogPost&amp;rft.format=text&amp;rft.identifier=<?php the_permalink(); ?>&amp;rft.language=fr"></span>
				<?php
				}
				?>
				<!-- eo Coins metadata -->
                <header>		
                    <h1 class="entry-title" property="dc:title" content="<?php the_title(); ?>">
					<?php if ( ! is_singular() ) : // Don't display links when not in singular context ?>
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'basics' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?>
						</a>
					<?php else : ?>
						<?php the_title(); ?>
					<?php endif; ?>
					</h1>
                    <?php if ( 'post' == $post->post_type ) : ?>                                     
                    <div class="entry-meta">
                        <?php echo basics_posted_on(); ?>
                    </div>
                    <?php endif; ?>
                </header>
                
                <?php echo basics_toolbar(); ?>
                
				<?php 
				/* Print a thumbnail of different size regarding the context.
				* Display a placeholder image if thumbnail is missing
				* Thanks to @piouPiouM 
				*/
				$is_search   = is_search();
				$is_singular = is_singular();
				$is_none     = !( $is_search || $is_singular );
				/*if ( $is_none ) {
					$thumb_size = 'medium';
					$thumb_class = 'entry-thumbnail thumb-medium';
				} else if ( $is_singular ) {
					$thumb_size = 'large';
					$thumb_class = 'entry-thumbnail thumb-large';
				} else {
					$thumb_size = 'thumbnail';
					$thumb_class = 'entry-thumbnail thumb-small';
				}*/
				?>
				<?php
				/* On recupere l'ID du dernier post (celui qui n'est pas tronqué par balise more, donc celui pour lequel on n'affichera pas l'image à la une */
					$args = array( 'numberposts' => '1', 'post_status' => 'publish' );
					$last_post = wp_get_recent_posts( $args );
					$last_post_id = $last_post[0]['ID'];
					$postid = get_the_ID();
				?>
				<?php if ( ! is_singular() ) { ?>
					<?php if ( has_post_thumbnail() ) { ?>
						<?php if ( $postid != $last_post_id ) { ?>
						<figure class="entry-thumbnail thumb-small">
							<?php the_post_thumbnail( thumbnail ); /* Check Media settings for default value */ ?>
						</figure>
						<?php } ?>
					<?php } /* eo Print a thumbnail */ ?>
				<?php } ?>
			<?php if ( $is_none || $is_singular ): ?>
				<div class="entry-content clearfix" property="sioc:content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'basics') ); ?>
					<?php wp_link_pages(array( 'before' => '<div class="page-link">' . __('Pages:', 'basics' ), 'after' => '</div>') ); ?>
					<?php echo basics_cite_post(); ?>
				</div> <!-- eo .entry-content -->
			<?php elseif ( $is_search ): ?>
				<div class="entry-summary clearfix">
					<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'basics' ) ); ?>
				</div> <!-- eo .entry-summary -->
			<?php endif; /* eo Print a thumbnail */ ?>
                <footer class="entry-meta">
                    <?php echo basics_posted_in(); ?>
					<?php if (! is_single() ) : ?>
						<div class="post-comments"><?php comments_popup_link('Laisser un commentaire', '<span class="one_comment">1 commentaire</span>', '<span class="more_comments">% commentaires</span>'); ?></div>
					<?php endif; ?>
					
                </footer> <!-- eo #entry-meta -->
				<?php if (is_single() ){ ?>
					<div class="navLinks clearfix">
						<div class="prev"><?php previous_post_link('&larr; %link'); ?></div>
						<div class="next"><?php next_post_link('%link &rarr;'); ?></div>
					</div>
				<?php } ?>
            </article> <!-- eo #post-<?php the_ID(); ?> -->
<?php /* We Salute You */ ?>
