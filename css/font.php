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
<?php $font = $options['font'] ?>
<?php if ( $font != '' ): ?>
	<?php $fontfamily = str_replace('custom/','',$font); ?>
@font-face {
    font-family: '<?php echo $fontfamily; ?>';
    src: url('<?php echo get_bloginfo( 'template_url' ); ?>/font/<?php echo $font; ?>-webfont.eot');
    src: url('<?php echo get_bloginfo( 'template_url' ); ?>/font/<?php echo $font; ?>-webfont.eot?iefix') format('eot'),
         url('<?php echo get_bloginfo( 'template_url' ); ?>/font/<?php echo $font; ?>-webfont.woff') format('woff'),
         url('<?php echo get_bloginfo( 'template_url' ); ?>/font/<?php echo $font; ?>-webfont.ttf') format('truetype'),
         url('<?php echo get_bloginfo( 'template_url' ); ?>/font/<?php echo $font; ?>-webfont.svg#webfont') format('svg');
    font-weight: normal;
    font-style: normal;
}
<?php endif; ?>
h1,h2,h3,h4,h5,h6,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a,
#banner h2,
#text,
#text a,
.ei-slider-loading,
#intro p,
.sv-main,
.sv-sub,
.ca-container h2 span,
.ca-item h3,
.ca-content h6,
h4.footer-heading, h4.footer-heading a,
.sidebar-box a,
.cat-item,
h4.blog-sidebar-title span.sidebar-title,
.sidebar-item-title,
.label-title,
.faq-accordion ul li > a,
.twtr-tweet-text p a.twtr-user,
.sf-menu a
{
	font-family:<?php if ( $font != '' ) echo $fontfamily; ?> !important;
}