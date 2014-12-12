<?php
	// load the theme options
	$options = get_option( 'thefirst_theme_settings' );
?>
<!-- BEGIN homepage-service -->
<div id="services">
	<div class="sv-title">
    	<?php if($options['home_services_title'] != '') { ?>
        <h2><?php echo stripslashes($options['home_services_title']);  ?></h2>
        <?php } else { ?>
        <h2><?php _e( 'Our services','pwvintage' ); ?></h2>
        <?php } ?>
        
        <?php if($options['home_services_link_text'] != '') { ?>
        <a href="<?php echo stripslashes($options['home_services_link']);  ?>"><?php echo stripslashes($options['home_services_link_text']);  ?> &rarr;</a>
        <?php } else { ?>
        <a href="<?php echo stripslashes($options['home_services_link']);  ?>"><?php _e( 'More details ','pwvintage' ); ?> &rarr;</a>
        <?php } ?>
    </div>
    <ul class="sv-menu">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('HomePage Services') ) : ?><?php endif; ?>
    </ul>
    <div class="clearboth"></div>
</div>
<!-- END homepage-service -->