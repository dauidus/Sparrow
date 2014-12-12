<?php
// load the theme options
$options = get_option( 'thefirst_theme_settings' );
?>
<?php
/*
Template Name: Portfolio 4 columns
*/
?>
<?php get_header(' '); ?>
<div id="banner">
    <div class="wrapper-960">
        <h2><?php the_title(' '); ?></h2>
    </div>
</div>
<div id="blog-wrapper" class="wrapper-960">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div id="portfolio-top">		
    	<?php the_content(' '); ?>
    	<?php endwhile; ?>
    </div>
    <!-- END portfolio-top -->
    <?php endif; ?>	
    <div id="portfolio-wrap">
    	<h3><?php _e( 'Filter By: ', 'pwvintage'); ?></h3>
        <ul id="portfolio-filter" class="clearfix">
			
            <li><div class="filterable-bg"></div><a href="#all"><?php _e( 'All', 'pwvintage'); ?></a></li>
            <?php 
            $cats = get_terms('portfolio_cats');
            foreach ($cats as $cat ) : ?>
            <li><div class="filterable-bg"></div><a href="#<?php echo $cat->slug; ?>" rel="<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></a></li>
            <?php endforeach; ?>
            
        </ul>
    	<!-- END portfolio-navigation -->	
        <div id="portfolio-four-column" class="clearfix">
            <ul id="portfolio-list">
                <?php
                    $portfolio_posts = new WP_Query(array(
                        'post_type' =>'portfolio',
                        'posts_per_page' => -1,
                        'orderby' => 'ASC'
                    ));
                ?>
                <?php
                    while($portfolio_posts->have_posts()) : $portfolio_posts->the_post();
                ?>
                <?php
                    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); 
                    $terms = get_the_terms (get_the_ID(), 'portfolio_cats');
                ?>
                <li class="view view-first view-four <?php if($terms) {  foreach ($terms as $term) { echo $term->slug . ' '; } } ?>">
                    
                        <?php if ( has_post_thumbnail()) : ?>
							<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                            <?php $website_url = get_bloginfo('wpurl'); ?>
                            <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>
                            <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                            <?php $portfolio_video_link = get_post_meta($post->ID, 'portfolio_video', true); ?>
                            <a href="<?php echo $thumbnail; ?>" class="post-image" title="<?php the_title(); ?>" rel="prettyPhoto">
                                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=130&amp;w=210&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>"/>
                            </a>
                        <?php endif; ?>
                   
                   <div class="mask">
					    
                        <h2><?php the_title(); ?></h2>
                        
                        <a href="<?php echo $thumbnail; ?>" class="info" title="<?php the_title(); ?>" rel="prettyPhoto">L</a>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="info">K</a>
                    </div>
                </li>
                <!-- END portfolio-box -->
                <?php endwhile; ?>
            </ul>
            <!-- END portfolio-list -->
        </div>
        <!-- END portfolio-four-column -->
</div>
</div>
<!-- END portfolio-wrap -->
<?php get_footer(' '); ?>