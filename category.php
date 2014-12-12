<?php
	$options = get_option( 'thefirst_theme_settings' );
?>
<?php get_header(' '); ?>
	<div id="banner">
    	<div class="wrapper-960">
        	<?php if (have_posts()) : ?>
			<?php $post = $posts[0]; ?>
			<?php if (is_category()) { ?>
			<h2 id="archive-title"><?php _e('Category: ','pwvintage') ?>"<?php single_cat_title(); ?>"</h1>

            <?php } ?>
            
    		
        </div>
    </div>
        <div class="footer-960" style="margin-top:0px;">

        	<div class="tabs">
            	
				<?php query_posts( array( 'numberposts' => 2 ) ); ?>
              
            	<?php while (have_posts()) : the_post(); ?>
            	<div style="float:left; margin-bottom:25px;">
                    <div class="blog-post" style="width:900px;">
                    
<!-- Begin Date & Comments -->                    
                    
                    	<div class="blog-post-left" style="position:relative; z-index:51;">
                        	<div class="blog-post-date">
                            	<p><?php the_time('F') ?></p>
                                <h4><?php the_time('jS') ?></h4>
                                <p><?php the_time('Y') ?></p>
                            </div>
                            
                            <div class="blog-post-comments">
                            	<?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
                            </div>
                        </div>
                        
<!-- End Date & Comments -->                        
                        
                        <div class="blog-post-right" style="width:770px; height:240px;margin-left:-50px; position:relative; z-index:50;">
                        
                        	<div style="position:absolute; z-index:44; height:237px; width:305px; background:url(<?php echo get_bloginfo('template_directory');?>/images/bloglistbg.png); top:1px;"></div>
                        	
                            <div style="float:left; width:300px; position:relative; padding:0 0 0 8px; z-index:45;">
	                            <?php if ( has_post_thumbnail()) : ?>
	                                <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
									<?php $website_url = get_bloginfo('wpurl'); ?>
	                                <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>
	                                <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
	                                <a href="<?php the_permalink(' ') ?>" class="post-image" title="<?php the_title(); ?>">
	                                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=215&amp;w=284&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" class="blog-post-image image-deco" alt=""/>
	                                </a>
	                            <?php endif; ?>
                            </div>

<!-- Begin Title Content Categories --> 
                            
                            <div style="float:left; width:460px;">
                                <h4 class="blog-post-title" style="width:450px; padding:10px 0 0 10px;"><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></h4>
                            
	                            <div class="blog-post-content" style="width:450px; padding:0px 0 0 10px; margin-top:-15px;">
	                                <p>
	                                    <?php if($options['blog_excerpt_length'] != '') { ?>
	                                    <?php $options['blog_excerpt_length']; ?>
	                                    <?php } else { ?>
	                                    <?php $options['blog_excerpt_length'] = '29' ?>
	                                    <?php } ?>
	                                    <?php $excerpt = $options['blog_excerpt_length']; ?>
	                                    <?php the_news_excerpt(''.$excerpt.'','','','plain','no'); ?>
	                                </p>
	                            </div>
	                        
		                        <div class="blog-post-categories" style="width:438px;">
	                            	<span class="symbols">, </span><?php the_category(' '); ?>
	                            </div>
	                            
	                        </div>

<!-- End Title Content Categories --> 
	                                                      
                        </div>
                    </div>
            	</div>
                    <?php endwhile; ?>
				<?php endif; ?>

        </div>

        </div>
            <?php if (function_exists("pagination")) { ?>
            <div class="tabs">
                <ul class="tabNavigation">
                    <?php pagination(); ?>
                </ul>
             </div>   
             <?php } ?> 
        </div>
	</div>
	
	<div class="clear" style="height:30px;"></div>
	
<?php get_footer(' '); ?>  