<?php
// load the theme options
$options = get_option( 'thefirst_theme_settings' );
?>
<div id="ei-slider-wrapper">
<?php if($options['slider_portfolio'] == "no") { ?>
	<?php
    // get custom post type ==> sliders
    global $post;
    $args = array(
        'post_type' =>'sliders',
        'numberposts' => 8,
        'orderby' => 'ASC'
    );
    $slider_posts = get_posts($args);
    ?>
    
    <?php
    // show slider only if slides exist
    if($slider_posts) {
    ?>
    
    <div class="ei-slider-bg-top"></div>
    <div class="ei-slider-bg"></div>
    <div class="ei-slider-bg-bottom"></div>
    <!-- BEGIN homepage-slider -->
    <div id="ei-slider" class="ei-slider">
    	
    	<div class="slider-box"></div>
    	<div class="slider-desc"><p>Now Hatching</p><p style="font-size:50px; margin-top:-40px; margin-left:50px;">at the nest</p><span>Fly by to see all the great new items in The Nest!</span></div>
    	
        <ul class="ei-slider-large">
        <?php
        // start the loop
        foreach($slider_posts as $post) : setup_postdata($post);
        // get image
        $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
        $website_url = get_bloginfo('wpurl');
        $thumbnail_src = str_replace($website_url,'', $thumbnail_src);
        // get metabox data
        $sliderlink = get_post_meta($post->ID, 'sliders_url', TRUE);
        ?>
            <?php
            // show link with slide if meta exists
            if($sliderlink != '') { ?>
            
                <li><a href="<?php echo $sliderlink ?>">
                	<?php if(stripslashes($thumbnail_src) != ""){ ?>
                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=350&amp;w=350&amp;zc=1&amp;q=100" alt="<?php the_title(' ') ?>" class="image-deco"/>
                    <?php }else{ ?>
                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_bloginfo('template_directory');?>/images/no-image.jpg&amp;h=350&amp;w=350&amp;zc=1&amp;q=100" alt="<?php the_title(' ') ?>" class="image-deco"/>
                    <?php }?>
                    </a>
                    <!--
<div class="ei-title">
                        <h2><?php the_title(' ') ?></h2>
                    </div>
-->
                </li>
            
            <?php } else { ?>
            
                <li>
                	<?php if(stripslashes($thumbnail_src) != ""){ ?>
                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=350&amp;w=350&amp;zc=1&amp;q=100" alt="<?php the_title(' ') ?>" class="image-deco"/>
                    <?php }else{ ?>
                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_bloginfo('template_directory');?>/images/no-image.jpg&amp;h=350&amp;w=350&amp;zc=1&amp;q=100" alt="<?php the_title(' ') ?>" class="image-deco"/>
                    <?php }?>
                    <!--
<div class="ei-title">
                        <h2><?php the_title(' ') ?></h2>
                    </div>
-->
                </li>
    
            <?php } ?>
         <?php endforeach; ?>
        <?php wp_reset_postdata(); ?>    
        </ul><!-- ei-slider-large -->
        <ul class="ei-slider-thumbs">
            <li class="ei-slider-element">Current</li>
            <?php
            // start the loop
            foreach($slider_posts as $post) : setup_postdata($post);
            // get image
            $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
            $website_url = get_bloginfo('wpurl');
            $thumbnail_src = str_replace($website_url,'', $thumbnail_src);
            ?>
            <li>
            	<a href="#"><?php the_title(' ') ?></a>
                <?php if(stripslashes($thumbnail_src) != ""){ ?>
                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=1&amp;w=1&amp;zc=1&amp;q=100" alt="<?php the_title(' ') ?>"/>
                <?php }else{ ?>
                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_bloginfo('template_directory');?>/images/no-image.jpg&amp;h=1&amp;w=1&amp;zc=1&amp;q=100" alt="<?php the_title(' ') ?>"/>
                <?php }?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- END homepage-slider -->
    <?php } ?>
<?php }else{ ?>

	<?php
    // get custom post type ==> portfolio
    global $post;
    $args = array(
        'post_type' =>'Portfolio',
        'numberposts' => 8,
        'orderby' => 'ASC'
    );
    $portfolio_posts = get_posts($args);
    ?>
    
    <?php
    // show slider only if slides exist
    if($portfolio_posts) {
    ?>
    <div class="ei-slider-bg-top"></div>
    <div class="ei-slider-bg"></div>
    <div class="ei-slider-bg-bottom"></div>
    <!-- BEGIN homepage-slider -->
    <div id="ei-slider" class="ei-slider">
        <ul class="ei-slider-large">
        <?php
        // start the loop
        foreach($portfolio_posts as $post) : setup_postdata($post);
        // get image
        $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
        $website_url = get_bloginfo('wpurl');
        $thumbnail_src = str_replace($website_url,'', $thumbnail_src);
        ?>
   
            <li><a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=1&amp;w=1&amp;zc=1&amp;q=100" alt="<?php the_title(' ') ?>" class="image-deco"/></a>
                <div class="ei-title">
                    <h2><?php the_title(' ') ?></h2>
                </div>
            </li>
            
            
         <?php endforeach; ?>
        <?php wp_reset_postdata(); ?>    
        </ul><!-- ei-slider-large -->
        <ul class="ei-slider-thumbs">
            <li class="ei-slider-element">Current</li>
            <?php
            // start the loop
            foreach($portfolio_posts as $post) : setup_postdata($post);
            // get image
            $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
            $website_url = get_bloginfo('wpurl');
            $thumbnail_src = str_replace($website_url,'', $thumbnail_src);
            ?>
            <li><a href="#"><?php the_title(' ') ?></a><img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=1&amp;w=1&amp;zc=1&amp;q=100" alt="<?php the_title(' ') ?>" /></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="tri-line"></div>
    <!-- END homepage-slider -->
    <?php } ?>

<?php } ?>
</div>