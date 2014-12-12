<?php
/*
Template Name: FaQs
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
    	<?php get_sidebar('page'); ?>
        
        <div class="faq-wrapper">
			<?php
            // get custom post type ==> homepage-tabs
            global $post;
                $args = array(
                    'post_type'=>'FaQs',
                    'numberposts' => -1,
                    'orderby' => 'ASC'
                );
                $faqs_posts = get_posts($args);
            ?>
            <?php
            // load code if there are tab posts
            if($faqs_posts) {
            // hold post title in array
            $captions = array();
            ?>
            <div id="faq-accordion" class="faq-accordion">
                <ul>
                <?php 
                // temp loop for tab links
                foreach($faqs_posts as $post) : setup_postdata($post);
                // tab counter
                ?>
                    <li>
                        <a href="#"><?php the_title(); ?><span class="faq-arrow">Open or Close</span></a>
                        <div class="faq-content">
                            <p><?php the_content(' ') ?></p>
                        </div>
                        <?php comments_template(); ?>
                    </li>
                    <?php endforeach; ?> 
                </ul>
            </div>
            <?php } wp_reset_postdata(); ?>
        </div>
	</div>
<?php get_footer(' '); ?>  