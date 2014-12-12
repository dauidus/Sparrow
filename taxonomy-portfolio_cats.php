<?php
// load the theme options
$options = get_option( 'thefirst_theme_settings' );
?>
<?php get_header(' '); ?>
<div id="banner">
    <div class="wrapper-960">
        <h2>Portfolio: "<?php single_cat_title(); ?>"</h2>
    </div>
</div>
<div id="blog-wrapper" class="wrapper-960">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div id="portfolio-top">		
    	<?php echo category_description(); ?>
    	<?php endwhile; ?>
    </div>
    <!-- END portfolio-top -->
    <?php endif; ?>	
	<div id="portfolio-wrap">
        <div id="portfolio-three-column" class="clearfix">
            <ul id="portfolio-list">
                <?php while (have_posts()) : the_post(); ?>
                <?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');  ?>
                
               <li class="view view-first view-three">
                    
                        <?php if ( has_post_thumbnail()) : ?>
							<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                            <?php $website_url = get_bloginfo('wpurl'); ?>
                            <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>
                            <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                            <?php $portfolio_video_link = get_post_meta($post->ID, 'portfolio_video', true); ?>
                            <?php if ( stripslashes($portfolio_video_link) == '') { ?> 
                            <a href="<?php echo $thumbnail; ?>" class="post-image" title="<?php the_title(); ?>" rel="prettyPhoto">
                            <?php }else { ?>
                            <a href="<?php echo $portfolio_video_link; ?>" class="post-image" title="<?php the_title(); ?>" rel="prettyPhoto">
                            <?php } ?>
                                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=190&amp;w=280&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" alt=""/>
                            </a>
                        <?php endif; ?>
                    
                    <!-- END portfolio-box-image -->
                    <div class="mask">
					    
                        <h2><?php the_title(); ?></h2>
                        
                        <?php
                        // check if portfolio details are disabled, otherwise show them
                        if ($options['disable_portfolio_details'] == "enable") { ?>
                        <p class="portfolio-content"><?php the_news_excerpt('10','','','plain','no'); ?></p> 
                        <?php } ?>
                        <a href="<?php echo $thumbnail; ?>" title="<?php the_title(); ?>" class="info" rel="prettyPhoto">L</a>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="info">K</a>
                    </div>
                </li>
                <!-- END portfolio-box -->
                <?php endwhile; ?>
            </ul>
            <!-- END portfolio-list -->
        </div>
        <!-- END portfolio-three-column -->
	</div>
	<!-- END portfolio-wrap -->
    </div>
    </div></div>
<?php get_footer(' '); ?>