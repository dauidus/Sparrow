<?php
// load the theme options
$options = get_option( 'thefirst_theme_settings' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
	<title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
    <?php echo $options['google_code'] ?>
    <meta http-equiv="X-UA-Compatible" content="IE=9" >
    <meta name="keywords" content="<?php echo $options['meta_keywords'] ?>" />
    <meta name="description" content="<?php echo $options['meta_description'] ?>" />
    <link rel="icon" type="image/png" href="<?php echo $options['upload_favicon']; ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ) ?>/reset.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ) ?>/css/jquery.jscrollpane.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ) ?>/css/menu.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ) ?>/css/prettyphoto.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ) ?>/css/ui.totop.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ) ?>/css/font.php" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ) ?>/css/custom-color.php" media="all" />
    
    <!--[if lt IE 8]>
    	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ) ?>/css/ie.css" media="all" />
    <![endif]-->
    
    <!-- WP Head -->
    
<?php
if( ( is_home() || is_page_template('template-location.php') || is_active_widget( false,false,'woo_location', true ) ) ){ ?>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>   
<?php } ?>    
    
<?php
//loads comment reply JS on single posts and pages
if ( is_single() || is_page() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<?php if(trim($options['home_client_carousel_quantity']) == ""){
	$options['home_client_carousel_quantity'] = 1;}
?>
<?php if(trim($options['home_client_carousel_speed']) == ""){
	$options['home_client_carousel_speed'] = 500;}
?>

<?php 

	if(is_front_page()) :
	echo '<script>

						
			jQuery().ready(function() {
				jQuery("#ca-container").contentcarousel({
					scroll          :' .$options['home_client_carousel_quantity']. ',
					sliderSpeed     :' .$options['home_client_carousel_speed']. ',
				});
			});
			
			

			jQuery().ready(function() {
				jQuery("#ei-slider").eislideshow({
					animation			: "center",
					autoplay			: true,
					slideshow_interval	: 5000,
					titlesFactor		: 0
				});
			});
		
		</script>';
	endif;

	
	if (is_page_template( 'faqs-template.php' )) : 
		echo '<script>
		
			jQuery(function() {
						
				jQuery("#faq-accordion").accordion({
					oneOpenedItem	: true
				});
				
			});
		
		</script>';
	endif;

?>
<script type="text/javascript">
	<?php echo $options['tracking_header'] ?>
</script>



<?php
// get the file that outputs all custom colors
include( TEMPLATEPATH . '/includes/custom-css.php'); ?>
</head>

<body class="custom-background">
	<div id="top-line">
    </div>
	<div class="wrapper" id="top-wrapper">
		<div id="top">
			<div id="social-icon">
            	<ul>
                	<?php if (trim($options['twitter']) != "") { ?>
                		<li><a href="<?php echo $options["twitter"]; ?>" title="twitter" target="_blank">t</a></li>
                    <?php } ?>
                    <?php if (trim($options['facebook']) != "") { ?>
                		<li><a href="<?php echo $options["facebook"]; ?>" title="facebook" target="_blank">f</a></li>
                    <?php } ?>
					<?php if (trim($options['myspace']) != "") { ?>
                		<li><a href="<?php echo $options["myspace"]; ?>" title="myspace" target="_blank">m</a></li>
                    <?php } ?>
                    <?php if (trim($options['linkedin']) != "") { ?>
                		<li><a href="<?php echo $options["linkedin"]; ?>" title="linkedin" target="_blank">i</a></li>
                    <?php } ?>
                    <?php if (trim($options['deviant']) != "") { ?>
                		<li><a href="<?php echo $options["deviant"]; ?>" title="deviant-art" target="_blank">j</a></li>
                    <?php } ?>
                    <?php if (trim($options['dribbble']) != "") { ?>
                		<li><a href="<?php echo $options["dribbble"]; ?>" title="dribbble" target="_blank">d</a></li>
                    <?php } ?>
                    <?php if (trim($options['rss']) != "") { ?>
                		<li><a href="<?php echo $options["rss"]; ?>" title="rss" target="_blank">r</a></li>
                    <?php } ?>
                </ul>
            </div>
            
            <div id="top-container">
				<div id="animation"></div>
				<a href="<?php bloginfo('url'); ?>"><div id="logo"></div></a>
			</div>
			
		</div>
	</div>


<div class="slash-top" style="width:auto;"></div>
    <div class="main_nav" style="height:50px;">
        <div class="footer-960-menu" style="width:900px; margin:0 auto;">            
			<div id="main-menu">
				<?php
				//define main navigation
				wp_nav_menu( array(
					'container' => 'false',
					'menu_class' => 'sf-menu',
					'menu_id' => 'Main',
				)); ?>
			</div>
		</div>
	</div>
<div class="slash-top-rv" style="width:auto;"></div>

