<?php
/*
Template Name: Home
*/
?>
<?php
// load the theme options
$options = get_option( 'thefirst_theme_settings' );
?>
<?php get_header(); ?>

    <div class="wrapper" id="content-wrapper"> 
    	
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
    </div>
    
<?php get_footer(); ?>