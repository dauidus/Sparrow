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
        
        <div class="blog-wrapper" style="width:900px;">
        <?php if (have_posts()) : ?>                
            <?php while (have_posts()) : the_post(); ?>
        	<div class="tabs" style="width:900px;">
			
                    <div class="blog-post" style="width:900px;">
                    	                        
                        <div class="clear"></div>
                        
                        <div class="blog-post-content" style="margin:0 auto 60px auto; width:600px;">
                            <p>
                                <?php the_content(); ?>
                            </p>
                        </div>
                        
                    </div>
                    
                   
            </div>
            <div class="deco" style="margin:0 auto 60px auto;"></div>
            <?php endwhile; ?>
			<?php endif; ?>
            
            
        </div>
	</div>
<?php get_footer(' '); ?>  