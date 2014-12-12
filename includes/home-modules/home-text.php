<?php
	// load the theme options
	$options = get_option( 'thefirst_theme_settings' );
?>
<!-- BEGIN homepage-text -->
<div id="text">
    <?php echo stripslashes($options['home_text'] ); ?>
</div> 
<!-- END homepage-text -->