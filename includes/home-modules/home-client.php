<?php
	// load the theme options
	$options = get_option( 'thefirst_theme_settings' ); 
	if($options['home_client_count']) { $home_client_count = $options['home_client_count']; } else { $home_client_count = 8; }
?>
<?php
	global $post;
	$args = array(
	'post_type' =>'Clients',
	'numberposts' => $home_client_count,
	'orderby' => 'ASC'
	);
	$client_posts = get_posts($args);
?>
<?php if($client_posts) { ?>
<!-- BEGIN homepage-portfolio -->
	<div id="home-intro-2">
	 	<?php if($options['home_client_title'] != '') { ?>
        <h1><?php echo stripslashes($options['home_client_title']);  ?></span></h1>
        <?php } else { ?>
        <h1><?php _e( 'Our Trusted Clients', 'pwvintage'); ?></span></h1>
        <?php } ?>
	</div>
    <div id="ca-container" class="ca-container">
        <div class="ca-wrapper">
        <?php
        foreach($client_posts as $post) : setup_postdata($post); ?>
            <div class="ca-item ca-item-1">
                <div class="ca-item-main">
                	
                    <?php if ( has_post_thumbnail() ) {  ?>
                    <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
					<?php $website_url = get_bloginfo('wpurl'); ?>
                    <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>
                    <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                    <a href="<?php echo $thumbnail; ?>" class="post-image" title="<?php the_title(); ?>" rel="prettyPhoto">
                    	<img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=110&amp;w=201&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" style="margin-left:-3px;" alt=""/>
                   </a>
                    <?php } else { ?>
                    <span><img src="<?php bloginfo('template_directory') ?>/images/demo.png" width="201" height="110" /></span>
                    <?php } ?>
     				<a href="#" class="ca-more"><h3><?php the_title(); ?></h3></a>
                </div>
                <div class="ca-content-wrapper">
                    <div class="ca-content">
                        <h6><?php the_title(' '); ?></h6>
                        <a href="#" class="ca-close">close</a>
                        <div class="ca-content-text">
                            <p><?php the_content(''); ?></p>
                            <?php if(trim(get_post_meta($post->ID, 'client-url', true)) != ""){ ?>
                            <?php _e( 'Client URL: ', 'pwvintage'); ?><a href="<?php echo stripslashes(htmlspecialchars_decode(get_post_meta($post->ID, 'client-url', true))) ?>" class="project-url"><?php echo stripslashes(htmlspecialchars_decode(get_post_meta($post->ID, 'client-url', true))) ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php } wp_reset_postdata(); ?>
        </div>
    </div>
<!-- END homepage-portfolio -->