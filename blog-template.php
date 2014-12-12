<?php
/*
Template Name: Blog
*/
?>
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
        	<div class="tabs">
            	
				<?php query_posts( array( 'paged'=>$paged ) ); ?>
                <?php if (have_posts()) : ?>                
            	<?php while (have_posts()) : the_post(); ?>
                    <div class="blog-post" style="padding-bottom:25px; border-bottom:solid #000 1px;">
                    
	                    <h4 class="blog-post-title" style="width:610px; font-size:30px; line-height:36px; margin-top:20px; margin-bottom:5px; padding:3px 0 0 10px;"><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></h4>
	                    
	                    	<div class="blog-post-left" style="position:relative; z-index:51; margin-left:0px;">
	                        	<div class="blog-post-date">
	                            	<p><?php the_time('F') ?></p>
	                                <h4><?php the_time('jS') ?></h4>
	                                <p><?php the_time('Y') ?></p>
	                            </div>
	                            
	                            <div class="blog-post-comments" style="color:#fff;">
	                            	<?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
	                            </div>
	                        </div>
	                        
	                        <div class="blog-post-right" style="width:377px; height:240px; margin-left:-50px; position:relative; z-index:50; overflow:visible;">
	                        
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
	                            
	                            <div class="blog-post-categories" style="width:155px; left:307px; padding:10px 0 10px 10px;">
	                            	<span class="symbols">, </span><?php $category = get_the_category(); echo $category[0]->cat_name; ?>
	                            </div>
	                        
	                        </div>
	                        
	                        <div class="clear"></div>
	
                            <div class="blog-post-content">
                                <p>
                                    <?php if($options['blog_excerpt_length'] != '') { ?>
                                    <?php $options['blog_excerpt_length']; ?>
                                    <?php } else { ?>
                                    <?php $options['blog_excerpt_length'] = '30' ?>
                                    <?php } ?>
                                    <?php $excerpt = $options['blog_excerpt_length']; ?>
                                    <?php the_news_excerpt(''.$excerpt.'','','','plain','no'); ?>
                                </p>
                            </div>
	                    
                    </div>

                    <?php endwhile; ?>
				<?php endif; ?>
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
	
<?php get_footer(' '); ?>  