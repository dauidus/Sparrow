<?php
	// load the theme options
	$options = get_option( 'thefirst_theme_settings' );
?>
<!-- BEGIN homepage-intro -->
<div id="intro">
	<div class="intro-left"></div>
	
	<div class="intro-rrr">			
		<div style="float:left;">
			<img src="<?php bloginfo( 'template_url' ) ?>/images/rrr.png">
		</div>
		<div style="float:left; line-height:22px; padding:18px 0 0 20px; color:#f8f5ed; font-family:'goudybookletter1911';">
			Reduce<br>&nbsp;&nbsp;Reuse<br>&nbsp;&nbsp;&nbsp;&nbsp;Refurnish
		</div>
	</div>
	
    <div class="intro-content">
        <h1><?php echo stripslashes($options['home_intro']);  ?></h1>
        <p><?php echo stripslashes($options['home_intro_author']);  ?></p>
   	</div>
   	
    <div class="intro-right"></div>
</div>
<!-- END homepage-intro -->