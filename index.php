<?php
// load the theme options
$options = get_option( 'thefirst_theme_settings' );
?>

<?php get_header(); ?>

    <div id="content-wrapper"> 
    	
        <!-- /////////////////////////    Begin <?php echo $options['home_section_1'] ?>    /////////////////////// -->
        <?php if($options['home_section_1'] != '') {
        include( TEMPLATEPATH . '/includes/home-modules/home-'. $options['home_section_1'] .'.php'); } ?>
        <!-- /////////////////////////    End <?php echo $options['home_section_1'] ?>     /////////////////////// -->
        
        <!-- /////////////////////////    Begin <?php echo $options['home_section_2'] ?>    /////////////////////// -->
        <?php if($options['home_section_2'] != '') {
        include( TEMPLATEPATH . '/includes/home-modules/home-'. $options['home_section_2'] .'.php'); } ?>
        <!-- /////////////////////////    End <?php echo $options['home_section_2'] ?>     /////////////////////// -->
    	
        <!-- /////////////////////////    Begin <?php echo $options['home_section_3'] ?>    /////////////////////// -->
        <?php if($options['home_section_3'] != '') {
        include( TEMPLATEPATH . '/includes/home-modules/home-'. $options['home_section_3'] .'.php'); } ?>
        <!-- /////////////////////////    End <?php echo $options['home_section_3'] ?>     /////////////////////// -->
        
        <!-- /////////////////////////    Begin <?php echo $options['home_section_4'] ?>    /////////////////////// -->
        <?php if($options['home_section_4'] != '') {
        include( TEMPLATEPATH . '/includes/home-modules/home-'. $options['home_section_4'] .'.php'); } ?>
        <!-- /////////////////////////    End <?php echo $options['home_section_4'] ?>     /////////////////////// -->
        
        <!-- /////////////////////////    Begin <?php echo $options['home_section_5'] ?>    /////////////////////// -->
        <?php if($options['home_section_5'] != '') {
        include( TEMPLATEPATH . '/includes/home-modules/home-'. $options['home_section_5'] .'.php'); } ?>
        <!-- /////////////////////////    End <?php echo $options['home_section_5'] ?>     /////////////////////// -->
	</div>
	
		<div class="clear"></div>


		<div class="footer-960" style="margin-top:25px;">
        	<div style="width:400px; height:250px; float:left;">
				<p style="font-size:32px; line-height:34px; margin-top:30px;">7451 Warner Ave, Ste. I<br>Huntington Beach, CA 92647</p>
				<p style="font-size:25px; line-height:27px; margin-top:25px;">Monday - Thursday 10:30 - 6:00<br>Friday & Saturday 10:30 - 5:00<br>Sunday 12:00 - 4:00</p>
			</div>
			
			
        	<div style="width:468px; height:250px; float:right;">
				<?php  
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Primary Home Sidebar') ) : endif;
				?>
			</div>
			
            <div class="clear"></div>
        </div>

    
    <div class="clear"></div>


        <div class="footer-960" style="margin-top:25px;">

        	<div class="tabs">
            	
				<?php query_posts( array( 'numberposts' => 2 ) ); ?>
                <?php if (have_posts()) : ?>                
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
                            
                            <div class="blog-post-comments" style="color:#fff;">
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
	                                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=215&amp;w=284&amp;zc=1&amp;q=75" alt="<?php the_title(); ?>" class="blog-post-image image-deco" alt=""/>
	                                </a>
	                            <?php endif; ?>
                            </div>

<!-- Begin Title Content Categories --> 
                            
                            <div style="float:left; width:460px;">
                                <h4 class="blog-post-title" style="margin-top:10px; padding:3px 0 0 10px;"><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></h4>
                            
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
	                            	<span class="symbols">, </span><?php $category = get_the_category(); echo $category[0]->cat_name; ?>
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


    
    <div class="clear" style="height:30px;"></div>	


	

    
<?php get_footer(); ?>