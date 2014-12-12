<?php header("Content-type: text/css"); ?>
<?php
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
?>
<?php
// load the theme options
$options = get_option( 'thefirst_theme_settings' );
?>

<?php if(trim($options['top_line_color']) != ""){ echo'
#top-line{
	background-color:#'.$options["top_line_color"].' !important;
}';} 
?>

<?php if(trim($options['social_icon_color']) != ""){ echo'
#social-icon ul li a:hover{
	color:#'.$options["social_icon_color"].' !important;
}';} 
?>

<?php if(trim($options['menu_color']) != ""){ echo'
.sf-menu > li a:hover{
	color:#'.$options["menu_color"].' !important;
}
li.current-menu-item a, li.current_page_item a{
	color:#'.$options["menu_color"].' !important;
}';} 
?>

<?php if(trim($options['text_link_color']) != ""){ echo'
.sv-title a:hover, .sidebar-box a.project-url:hover, .project-url:hover, .portfolio-box h2 a:hover, .related-blog-posts h4 a:hover, .tagcloud a:hover, h4.blog-post-title a:hover, .blog-two-columns h2 a:hover, .sidebar-item-box a:hover{
	color:#'.$options["text_link_color"].' !important;
}';} 
?>

<?php if(trim($options['text_link_bg_color']) != ""){ echo'
.sv-title a:hover, .sidebar-box a.project-url:hover, .project-url:hover, .portfolio-box h2 a:hover, .related-blog-posts h4 a:hover, .tagcloud a:hover, h4.blog-post-title a:hover, .blog-two-columns h2 a:hover, .sidebar-item-box a:hover{
	background-color:#'.$options["text_link_bg_color"].' !important;
}';} 
?>

<?php if(trim($options['banner_color']) != ""){ echo'
#banner h2{
	color:#'.$options["banner_color"].' !important;
}';} 
?>

<?php if(trim($options['banner_bg_color']) != ""){ echo'
#banner{
	background-color:#'.$options["banner_bg_color"].' !important;
}';} 
?>

<?php if(trim($options['sidebar_color']) != ""){ echo'
h4.blog-sidebar-title span.sidebar-title{
	color:#'.$options["sidebar_color"].' !important;
}';} 
?>

<?php if(trim($options['sidebar_bg_color']) != ""){ echo'
h4.blog-sidebar-title span.sidebar-title{
	background-color:#'.$options["sidebar_bg_color"].' !important;
}';} 
?>

<?php if(trim($options['text_color']) != ""){ echo'
#text a{
	color:#'.$options["text_color"].' !important;
}';} 
?>

<?php if(trim($options['text_bg_color']) != ""){ echo'
#text a{
	background-color:#'.$options["text_bg_color"].' !important;
}';} 
?>

<?php if(trim($options['slider_color']) != ""){ echo'
.ei-slider-thumbs li a{
	background-color:#'.$options["slider_color"].' !important;
}';} 
?>

<?php if(trim($options['slider_bg_color']) != ""){ echo'
.ei-slider-thumbs li.ei-slider-element{
	background-color:#'.$options["slider_bg_color"].' !important;
}';} 
?>

<?php if(trim($options['intro_color']) != ""){ echo'
#intro h1, #intro p{
	color:#'.$options["intro_color"].' !important;
}';} 
?>

<?php if(trim($options['services_color']) != ""){ echo'
.sv-menu li:hover .sv-main{
	color:#'.$options["services_color"].' !important;
}';} 
?>

<?php if(trim($options['clients_color']) != ""){ echo'
.sidebar-box a.project-url, .project-url{
	color:#'.$options["clients_color"].' !important;
}';} 
?>