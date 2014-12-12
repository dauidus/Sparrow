<style>
<?php if( trim($options['slider_bg']) != "") {?>
.ei-slider-bg{
	background:url(<?php echo $options['slider_bg']?>) !important;
}
<?php } ?>
.ei-title h2{
	<?php if(trim(get_theme_mod( 'background_image' )) == ""){ ?>
	background: url(<?php bloginfo( 'template_url' ) ?>/images/body-bg.png);
	<?php }else{ ?>
		<?php if(trim(get_theme_mod( 'background_color' )) != ""){ ?> 
		background: url(<?php echo get_theme_mod('background_image'); ?>) #<?php echo get_theme_mod( 'background_color' ); ?>;
		<?php }else{ ?>
		background: url(<?php echo get_theme_mod('background_image'); ?>);
		<?php } ?>
	<?php } ?>
}
.sf-menu a{
	<?php if(trim($options['padding__menu_element']) == ""){ ?>
	padding:23px 14px !important;
	<?php }else{ ?>
	padding:23px <?php echo $options['padding__menu_element']?>px !important;
	<?php } ?>
}
<?php if( trim($options['footer_bg']) != "") {?>
.footer{
	background:url(<?php echo $options['footer_bg']?>) !important;
}
<?php } ?>
</style>