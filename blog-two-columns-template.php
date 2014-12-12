<?php
/*
Template Name: Blog Two Column
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
    	<?php get_sidebar('Blog Sidebar'); ?>
        
        <div class="blog-wrapper">
        	<div class="tabs" id="blog-two-columns-wrapper">
				<?php query_posts( array( 'paged'=>$paged ) ); ?>
                <?php if (have_posts()) : ?>   
                <?php $counter = 1; ?>             
            	<?php while (have_posts()) : the_post(); ?>
                
                <div class="post blog-two-columns<?php if($counter%2 == 0) echo ' blog-two-columns-last'; ?>">
                    <h2>
                        <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h2>  
                    <div class="post-meta">
                        <span class="author"><?php _e( 'post by ', 'pwvintage'); ?><?php the_author(); ?></span>               
                        <span class="date"><?php the_time('F jS, Y') ?></span>
                    </div>                      
					<?php if ( has_post_thumbnail()) : ?>
                    <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
					<?php $website_url = get_bloginfo('wpurl'); ?>
                    <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>
                    <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                    <a href="<?php the_permalink(' ') ?>" class="post-image" title="<?php the_title(); ?>">
						<img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=140&amp;w=300&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" class="blog-post-image image-deco" alt=""/>
                    </a>
                  	<?php endif; ?>
                        <p>
							<?php if($options['blog_excerpt_length'] != '') { ?>
                            <?php $options['blog_excerpt_length']; ?>
                            <?php } else { ?>
                            <?php $options['blog_excerpt_length'] = '30' ?>
                            <?php } ?>
                            <?php $excerpt = $options['blog_excerpt_length']; ?>
                            <?php the_news_excerpt(''.$excerpt.'','','','plain','no'); ?>
                        </p>
                        
                    <!-- END BLOG 2 COLUMNS -->
                    </div>
                    <?php if($counter%2 == 0) echo '<div class="blog-two-columns-space"></div>'; ?>
                    <?php $counter++; ?>
           		<?php endwhile; ?>
				<?php endif; ?>
            </div>
            <div style="height:10px;"></div>
            <?php if (function_exists("pagination")) { ?>
            <div class="tabs">
                <ul class="tabNavigation">
                    <?php pagination($additional_loop->max_num_pages); ?>
                </ul>
             </div> 
             <?php } ?>  
        </div>
	</div>
<?php get_footer(' '); ?>  