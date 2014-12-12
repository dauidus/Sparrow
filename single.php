<?php
// load the theme options
$options = get_option( 'thefirst_theme_settings' );
?>
<?php get_header(' '); ?>
	<div id="banner">
    	<div class="wrapper-960">
    		<h2><?php the_title(); ?></h2>
        </div>
    </div>
    <div id="blog-wrapper" class="wrapper-960">
    	<?php get_sidebar(); ?>
        
        <div class="blog-wrapper" style="border-right:solid #000 1px;">
        <?php if (have_posts()) : ?>                
            <?php while (have_posts()) : the_post(); ?>
        	<div class="tabs">
			
                    <div class="blog-post">
                    	
                    	<div class="blog-post-left" style="position:relative; z-index:51; margin-left:30px;">
                        	<div class="blog-post-date">
                            	<p><?php the_time('F') ?></p>
                                <h4><?php the_time('jS') ?></h4>
                                <p><?php the_time('Y') ?></p>
                            </div>
                            
                            <div class="blog-post-comments" style="color:#fff;">
                            	<?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
                            </div>
                        </div>
                        
                        <div class="blog-post-right" style="width:377px; height:295px; margin-left:-50px; position:relative; z-index:50;">
                        
                        	<div style="position:absolute; z-index:44; height:293px; width:377px; background:url(<?php echo get_bloginfo('template_directory');?>/images/blogimgbkg.png); top:1px;"></div>
                    	
	                    	<?php if ($options['disable_blog_featured_image'] == "enable") { ?>
	                        <?php if ( has_post_thumbnail()) : ?>
	                        	<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
								<?php $website_url = get_bloginfo('wpurl'); ?>
	                            <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>
	                            <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
	                            <a href="<?php echo $thumbnail; ?>" class="post-image" title="<?php the_title(); ?>" rel="prettyPhoto">
	                                <img style="margin-left:8px; position:relative; z-index:45;" src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=271&amp;w=356&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" class="blog-post-image image-deco" alt=""/>
	                            </a>
	                        <?php endif; ?>
	                        <?php } ?>
                        
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="blog-post-content" style="margin-bottom:60px;">
                            <p>
                                <?php the_content(); ?>
                            </p>
                            
                            <?php if(function_exists('selfserv_shareaholic')) { selfserv_shareaholic(); } ?>
                            
                        </div>
                        <?php if ( has_tag()) : ?>
                        <h3 class="h3-tags"><?php _e( 'Tags: ', 'pwvintage'); ?></h3><?php the_tags('<ul id="portfolio-filter" class="clearfix"><li><div class="filterable-bg"></div>','</li><li><div class="filterable-bg"></div>', '</li></ul>'); ?>
                        <?php endif; ?>
                        <?php if ($options['disable_author_bio'] == "enable") { ?>
                        <div class="deco"></div>
                        <div class="author-bio">
                            <div class="small-post" style="width:630px; padding:0 20px;">
                                <?php echo get_avatar( get_the_author_meta('email'), '110' ); ?>
                                <h4 class="small-post-title" style="width:450px;"><?php _e( 'Posted by ', 'pwvintage'); ?><?php the_author_posts_link(); ?></h4>
                                <p class="author-description" style="width:450px;"><?php the_author_meta('description'); ?></p>
                            </div>
                    	</div>
                        <?php } ?>
                        <?php
						// check if the related posts are disabled
						if ($options['disable_related_posts'] == "enable") { ?>
                        <div class="related-blog-posts">
                            <h4><?php _e( 'Related Posts', 'pwvintage'); ?></h4>
                            <?php
								$category = get_the_category(); //get first current category ID
								$this_post = $post->ID; // get ID of current post
								$posts = get_posts('numberposts=3&orderby=rand&category=' . $category[0]->cat_ID . '&exclude=' . $this_post);
								?>
							<?php
							foreach($posts as $post) {
							?>
                            <div class="small-post" style="width:600px; margin-top:10px;">
								<?php
								// check if post has a thumbnail
								if ( has_post_thumbnail() ) { ?>
									<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                    <?php $website_url = get_bloginfo('wpurl'); ?>
                                    <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>
                                    <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                    <a href="<?php echo $thumbnail; ?>" class="post-image" title="<?php the_title(); ?>" rel="prettyPhoto">
                                        <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=50&amp;w=50&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" class="small-post-img image-deco" alt=""/>
                                    </a>
                                    <h4 class="small-post-title related-title" style="width:510px;"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                                <?php the_news_excerpt('25','','','plain','no'); ?>
                                <?php }else { //show this if post doesn't have thumbnail ?>
                                <h4 class="small-post-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                                <?php the_news_excerpt('25','','','plain','no'); ?>
                                <?php } ?>
                            </div>
                            <?php } wp_reset_postdata(); ?>
                    	</div>
                        <?php } ?>
                    </div>
                    
                   
            </div>
            <div class="deco" style="margin-bottom:60px;"></div>
            <?php comments_template(); ?>
            <?php endwhile; ?>
			<?php endif; ?>
            
            
        </div>
	</div>
<?php get_footer(' '); ?>  