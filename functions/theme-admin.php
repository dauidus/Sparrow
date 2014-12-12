<?php
/**
* Init theme options to white list our options
*/
function thefirst_settings_init(){
register_setting( 'thefirst_settings', 'thefirst_theme_settings' );
}
function thefirst_scripts() {
wp_enqueue_script("theme-admin", get_bloginfo('stylesheet_directory')."/functions/functions.js", false, "1.0");
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_script('bbq', get_bloginfo('stylesheet_directory') . '/functions/jquery.ba-bbq.min.js');
}
function thefirst_style() {
wp_enqueue_style("theme-admin", get_bloginfo('stylesheet_directory')."/functions/functions.css", false, "1.0", "all");
wp_enqueue_style('thickbox');
}
function thefirst_echo_scripts()
{
?>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function() {

/** Tabs functionality **/
jQuery(function () {
var tabContainers = jQuery('div.adminTabs > div');
tabContainers.hide().filter(':first').show();

jQuery('div.adminTabs ul.tabsNavi a').click(function () {
tabContainers.hide();
tabContainers.filter(this.hash).show();
jQuery('div.adminTabs ul.tabsNavi a').removeClass('selected');
jQuery(this).addClass('selected');
return false;
}).filter(':first').click();
});

// Media Uploader
window.formfield = '';

jQuery('.upload_image_button').live('click', function() {
window.formfield = jQuery('.upload_field',jQuery(this).parent());
tb_show('', 'media-upload.php?type=image&TB_iframe=true');
return false;
});

window.original_send_to_editor = window.send_to_editor;
window.send_to_editor = function(html) {
if (window.formfield) {
imgurl = jQuery('img',html).attr('src');
window.formfield.val(imgurl);
tb_remove();
}
else {
window.original_send_to_editor(html);
}
window.formfield = '';
window.imagefield = false;
}

});
//]]> 
</script>
<?php
}
if (isset($_GET['page']) && $_GET['page'] == 'thefirst-settings')
{
add_action('admin_print_scripts', 'thefirst_scripts'); 
add_action('admin_print_styles', 'thefirst_style');
}
add_action('admin_head', 'thefirst_echo_scripts');

/************************************
* Load up the menu page
************************************/
function thefirst_add_settings_page() {
add_menu_page( __( 'The-First Settings','pwvintage' ), __( 'The-First Settings','pwvintage' ), 'manage_options', 'thefirst-settings', 'thefirst_theme_settings_page');
}

add_action( 'admin_init', 'thefirst_settings_init' );
add_action( 'admin_menu', 'thefirst_add_settings_page' );

/************************************
* set up all the select field options
************************************/
$home_sections = array("none", "slider", "intro", "services", "client", "text");
$yes_no_options = array("yes", "no");
$disable_options = array("enable", "disable");

// store all pages in an array for use in options
$list_pages = get_pages('hide_empty=0');
$wp_pages = array();
foreach ($list_pages as $pagg) {
$wp_pages[$pagg->ID] = htmlspecialchars($pagg->post_title);
$wp_pages_ids[] = $pagg->ID;
}
array_unshift($wp_pages, "Choose A Page");


// store all categories in an array for use in options
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
$wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose A Category"); 


/**********************************
* Create the options page
*********************************/
function thefirst_theme_settings_page() {
global $wp_pages, $home_sections, $yes_no_options, $disable_options, $sidebar_positions;

if ( ! isset( $_REQUEST['updated'] ) )
$_REQUEST['updated'] = false;
?>

<div class="wrap">
  <div id="options-header">
  <h2><?php _e( 'The-First Theme Settings', 'pwvintage' ); ?></h2>
</div>
<!-- END header -->

<div id="panel-content">

<form method="post" action="options.php">

<?php settings_fields( 'thefirst_settings' ); ?>
<?php $options = get_option( 'thefirst_theme_settings' ); ?>

<div id="wrap-left">
<ul class="tabs">
<li class="no-margin-top"><a href="#tab1" id="thefirst-main"><?php _e( 'Main', 'pwvintage' ); ?></a></li>
<li><a href="#tab2" id="thefirst-fonts"><?php _e( 'Styling & Font', 'pwvintage' ); ?></a></li>
<li><a href="#tab3" id="thefirst-fonts"><?php _e( 'SEO', 'pwvintage' ); ?></a></li>
<li><a href="#tab4" id="thefirst-home"><?php _e( 'Homepage', 'pwvintage' ); ?></a></li>
<li><a href="#tab5" id="thefirst-portfolio"><?php _e( 'Portfolio', 'pwvintage' ); ?></a></li>
<li><a href="#tab6" id="thefirst-blog"><?php _e( 'Blog', 'pwvintage' ); ?></a></li>
<li><a href="#tab7" id="thefirst-social"><?php _e( 'Social', 'pwvintage' ); ?></a></li>
<li><a href="#tab8" id="thefirst-footer"><?php _e( 'Footer', 'pwvintage' ); ?></a></li>
<li><a href="#tab9" id="thefirst-tracking"><?php _e( 'Tracking Code', 'pwvintage' ); ?></a></li>
</ul>
<!-- END tabs -->
</div>
<!-- END wrap-left -->

<div id="wrap-right">
<div class="tab_container">
<div id="tab1" class="tab_content"><!--main tab-->

<ul>
<h2><?php _e('Logo Settings','pwvintage'); ?></h2>
<li><h3><?php _e( 'Main Logo','pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[upload_mainlogo]" class="regular-text upload_field" type="text" size="36" name="thefirst_theme_settings[upload_mainlogo]" value="<?php esc_attr_e( $options['upload_mainlogo'] ); ?>" />
<input class="upload_image_button button" type="button" value="Upload Image" />
<?php if(trim($options['upload_mainlogo']) != "") { ?>
<div class="logo-preview">
<img src="<?php echo $options['upload_mainlogo']; ?>" alt="Current Logo" />
</div>
<?php } ?>
</li>

<h2><?php _e( 'Favicon Settings','pwvintage'); ?></h2>

<li><h3><?php _e( 'Favicon','pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[upload_favicon]" class="regular-text upload_field" type="text" size="36" name="thefirst_theme_settings[upload_favicon]" value="<?php esc_attr_e( $options['upload_favicon'] ); ?>" />
<input class="upload_image_button button" type="button" value="Upload Image" />
<label class="description" for="thefirst_theme_settings[upload_favicon]"><?php _e( 'Enter the URL of your .ico favicon file', 'pwvintage' ); ?></label>
</li>

<h2><?php _e( 'Main Menu Settings','pwvintage'); ?></h2>

<li><h3><?php _e( 'Padding among Main Menu elements','pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[padding__menu_element]" class="regular-text" type="text" style="width:50px" name="thefirst_theme_settings[padding__menu_element]" value="<?php esc_attr_e( $options['padding__menu_element'] ); ?>" />px
<label class="description" for="thefirst_theme_settings[padding__menu_element]"><?php _e( 'Default is 14px', 'pwvintage' ); ?></label>
</li>

</ul>

</div>
<!--END main tab-->

<!-- Register path of custom font -->
<?php
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	$theme_path = get_bloginfo('template_directory');
	$website_url = get_bloginfo('wpurl').'/';
	$theme_path = str_replace($website_url,'', $theme_path);
	$fonts_path = $path_to_wp.$theme_path.'/font/custom/';
	$fonts = array();
	
	if ( is_dir($fonts_path) )
	{
		$k = 0;
		$fonts_path = $fonts_path.'*.ttf';
		if ( glob($fonts_path) )
		{
			foreach(glob($fonts_path) as $font)
			{
				$font_name = pathinfo($font);
				$font_title = str_replace('-webfont.ttf', '',$font_name['basename']);
				$font_title = ereg_replace("[^A-Za-z0-9]", " ", $font_title);
				$font_title = ucwords($font_title);
				$font_title = trim($font_title);
				$font_name = str_replace('-webfont.ttf', '',$font_name['basename']);
				$fonts[$k]['name'] = $font_name;
				$fonts[$k]['title'] = $font_title;
				$k++;
			}
		}
	}
?>

<div id="tab2" class="tab_content"><!--Styling tab-->
<ul>

<h2><?php _e( 'Heading Font Settings','pwvintage'); ?></h2>

<li><h3><?php _e( 'Choose font', 'pwvintage' ); ?></h3>
<select name="thefirst_theme_settings[font]">
	<?php $font = $options['font'] ?>
	<?php if ( count($fonts) > 0 ): ?>
		<?php foreach($fonts as $newfont): ?>
            <option value="<?php echo 'custom/'.$newfont['name']; ?>" <?php if ($font == 'custom/'.$newfont['name']) { echo 'selected="selected"'; } ?> ><?php echo $newfont['title']; ?></option>   
        <?php endforeach; ?>
    <?php endif;?>
</select>
<p><?php _e( 'The Heading Fonts based on @font-face. To generate them, please upload your font onto <a href="http://www.fontsquirrel.com/fontface/generator" target="_blank">Font Squirrel</a>, wait for a second and then download your font-face kit (.zip file). Extract the downloaded .zip file, upload four files: -webfont.eot, -webfont.woff, -webfont.ttf, -webfont.svg to "<b><i>wp-content / themes / thefirst / font / custom /</i></b>", refresh this page and your font will appear in the drop-down list above.', 'pwvintage' ); ?></p>
</li>

<h2><?php _e( 'Top Color Settings','pwvintage'); ?></h2>

<li><h3><?php _e( 'Top-line Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[top_line_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[top_line_color]" value="<?php esc_attr_e( $options['top_line_color'] ); ?>" />
<?php if($options['top_line_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['top_line_color'] ); ?>;" ></div>
<?php } ?>
</li>

<li><h3><?php _e( 'Social icon on hover Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[social_icon_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[social_icon_color]" value="<?php esc_attr_e( $options['social_icon_color'] ); ?>" />
<?php if($options['social_icon_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['social_icon_color'] ); ?>;" ></div>
<?php } ?>

<li><h3><?php _e( 'Menu on hover Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[menu_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[menu_color]" value="<?php esc_attr_e( $options['menu_color'] ); ?>" />
<?php if($options['menu_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['menu_color'] ); ?>;" ></div>
<?php } ?>
</li>

<h2><?php _e( 'Text Link On Hover Color','pwvintage'); ?></h2>

<li><h3><?php _e( 'Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[text_link_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[text_link_color]" value="<?php esc_attr_e( $options['text_link_color'] ); ?>" />
<?php if($options['text_link_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['text_link_color'] ); ?>;" ></div>
<?php } ?>

<li><h3><?php _e( 'Background Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[text_link_bg_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[text_link_bg_color]" value="<?php esc_attr_e( $options['text_link_bg_color'] ); ?>" />
<?php if($options['text_link_bg_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['text_link_bg_color'] ); ?>;" ></div>
<?php } ?>
</li>

<h2><?php _e( 'Text Module Color Settings','pwvintage'); ?></h2>

<li><h3><?php _e( 'Text Module Link Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[text_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[text_color]" value="<?php esc_attr_e( $options['text_color'] ); ?>" />
<?php if($options['text_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['text_color'] ); ?>;" ></div>
<?php } ?>

<li><h3><?php _e( 'Text Module Link BackgroundColor', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[text_bg_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[text_bg_color]" value="<?php esc_attr_e( $options['text_bg_color'] ); ?>" />
<?php if($options['text_bg_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['text_bg_color'] ); ?>;" ></div>
<?php } ?>
</li>

<h2><?php _e( 'Slider Module Color Settings','pwvintage'); ?></h2>

<li><h3><?php _e( 'Navigation Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[slider_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[slider_color]" value="<?php esc_attr_e( $options['slider_color'] ); ?>" />
<?php if($options['slider_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['slider_color'] ); ?>;" ></div>
<?php } ?>

<li><h3><?php _e( 'Navigation BackgroundColor', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[slider_bg_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[slider_bg_color]" value="<?php esc_attr_e( $options['slider_bg_color'] ); ?>" />
<?php if($options['slider_bg_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['slider_bg_color'] ); ?>;" ></div>
<?php } ?>
</li>

<h2><?php _e( 'Intro Module Color Settings','pwvintage'); ?></h2>

<li><h3><?php _e( 'Text Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[intro_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[intro_color]" value="<?php esc_attr_e( $options['intro_color'] ); ?>" />
<?php if($options['intro_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['intro_color'] ); ?>;" ></div>
<?php } ?>
</li>

<h2><?php _e( 'Services Module Color Settings','pwvintage'); ?></h2>

<li><h3><?php _e( 'Title on hover Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[services_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[services_color]" value="<?php esc_attr_e( $options['services_color'] ); ?>" />
<?php if($options['services_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['services_color'] ); ?>;" ></div>
<?php } ?>
</li>

<h2><?php _e( 'Clients Module Color Settings','pwvintage'); ?></h2>

<li><h3><?php _e( 'ClientURL Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[clients_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[clients_color]" value="<?php esc_attr_e( $options['clients_color'] ); ?>" />
<?php if($options['clients_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['clients_color'] ); ?>;" ></div>
<?php } ?>
</li>

<h2><?php _e( 'Banner Color Settings','pwvintage'); ?></h2>

<li><h3><?php _e( 'Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[banner_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[banner_color]" value="<?php esc_attr_e( $options['banner_color'] ); ?>" />
<?php if($options['banner_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['banner_color'] ); ?>;" ></div>
<?php } ?>

<li><h3><?php _e( 'Background Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[banner_bg_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[banner_bg_color]" value="<?php esc_attr_e( $options['banner_bg_color'] ); ?>" />
<?php if($options['banner_bg_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['banner_bg_color'] ); ?>;" ></div>
<?php } ?>
</li>

<h2><?php _e( 'Sidebar Title Color Settings','pwvintage'); ?></h2>

<li><h3><?php _e( 'Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[sidebar_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[sidebar_color]" value="<?php esc_attr_e( $options['sidebar_color'] ); ?>" />
<?php if($options['sidebar_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['sidebar_color'] ); ?>;" ></div>
<?php } ?>

<li><h3><?php _e( 'Background Color', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[sidebar_bg_color]" class="regular-text color-picker" type="text" name="thefirst_theme_settings[sidebar_bg_color]" value="<?php esc_attr_e( $options['sidebar_bg_color'] ); ?>" />
<?php if($options['sidebar_bg_color']) { ?>
<div class="color-preview" style="background: #<?php esc_attr_e( $options['sidebar_bg_color'] ); ?>;" ></div>
<?php } ?>
</li>

</ul>
</div>


<div id="tab3" class="tab_content"><!--meta tab-->
<ul>

<h2><?php _e( 'Meta keywords', 'pwvintage' ); ?></h2>
<li>
<textarea id="thefirst_theme_settings[meta_keywords]" class="regular-text" name="thefirst_theme_settings[meta_keywords]"><?php esc_attr_e( $options['meta_keywords'] ); ?></textarea>
<label class="description" for="thefirst_theme_settings[meta_keywords]"><?php _e( 'Enter your meta-keywords', 'pwvintage' ); ?></label>
</li> 

<h2><?php _e( 'Meta description', 'pwvintage' ); ?></h2>
<li>
<textarea id="thefirst_theme_settings[meta_description]" class="regular-text" name="thefirst_theme_settings[meta_description]"><?php esc_attr_e( $options['meta_description'] ); ?></textarea>
<label class="description" for="thefirst_theme_settings[meta_description]"><?php _e( 'Enter your meta-description', 'pwvintage' ); ?></label>
</li> 

<h2><?php _e( 'Google verify code', 'pwvintage' ); ?></h2>
<li>
<textarea id="thefirst_theme_settings[google_code]" class="regular-text" name="thefirst_theme_settings[google_code]"><?php esc_attr_e( $options['google_code'] ); ?></textarea>
<label class="description" for="thefirst_theme_settings[google_code]"><?php _e( 'Enter your Google verify code', 'pwvintage' ); ?></label>
</li> 

</ul>
</div>
<!-- END meta tab-->


<div id="tab4" class="tab_content"><!--homepage tab-->
<ul>

<h2>Homepage Modules</h2>

<li><h3><?php _e( 'Homepage Section 1', 'pwvintage' ); ?></h3>
<select name="thefirst_theme_settings[home_section_1]">
<?php foreach ($home_sections as $option) { ?>
<option <?php if ($options['home_section_1'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</li>

<li><h3><?php _e( 'Homepage Section 2', 'pwvintage' ); ?></h3>
<select name="thefirst_theme_settings[home_section_2]">
<?php foreach ($home_sections as $option) { ?>
<option <?php if ($options['home_section_2'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>	
</li>

<li><h3><?php _e( 'Homepage Section 3', 'pwvintage' ); ?></h3>
<select name="thefirst_theme_settings[home_section_3]">
<?php foreach ($home_sections as $option) { ?>
<option <?php if ($options['home_section_3'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</li>

<li><h3><?php _e( 'Homepage Section 4', 'pwvintage' ); ?></h3>
<select name="thefirst_theme_settings[home_section_4]">
<?php foreach ($home_sections as $option) { ?>
<option <?php if ($options['home_section_4'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</li>
<li><h3><?php _e( 'Homepage Section 5', 'pwvintage' ); ?></h3>
<select name="thefirst_theme_settings[home_section_5]">
<?php foreach ($home_sections as $option) { ?>
<option <?php if ($options['home_section_5'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</li>

<h2>Text Module Settings</h2>

<li><h3><?php _e( 'Homepage Text Content', 'pwvintage' ); ?></h3>
<textarea id="thefirst_theme_settings[home_text]" class="regular-text" name="thefirst_theme_settings[home_text]"><?php esc_attr_e( $options['home_text'] ); ?></textarea>
<label class="description" for="thefirst_theme_settings[home_text]"><?php _e( 'Enter your text for the homepage Text Module', 'pwvintage' ); ?></label>
</li>

<h2>Slider Module Settings</h2>

<li><h3><?php _e( 'Allow Slider to display the latest Portfolios', 'pwvintage' ); ?></h3>
<select name="thefirst_theme_settings[slider_portfolio]">
<?php foreach ($yes_no_options as $option) { ?>
<option <?php if ($options['slider_portfolio'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</li>

<li><h3><?php _e( 'Slider Background','pwvintage'); ?></h3>
<input id="thefirst_theme_settings[slider_bg]" class="regular-text upload_field" type="text" size="36" name="thefirst_theme_settings[slider_bg]" value="<?php esc_attr_e( $options['slider_bg'] ); ?>" />
<input class="upload_image_button button" type="button" value="Upload Image" />
<?php if(trim($options['slider_bg']) != "") { ?>
<div class="logo-preview">
<img src="<?php echo $options['slider_bg']; ?>" alt="Current Background" />
</div>
<?php } ?>
</li>

<h2>Intro Module Settings</h2>

<li><h3><?php _e( 'Homepage Intro Text', 'pwvintage' ); ?></h3>
<textarea id="thefirst_theme_settings[home_intro]" class="regular-text" name="thefirst_theme_settings[home_intro]"><?php esc_attr_e( $options['home_intro'] ); ?></textarea>
<label class="description" for="thefirst_theme_settings[home_intro]"><?php _e( 'Enter your text for the homepage intro', 'pwvintage' ); ?></label>
</li>

<li><h3><?php _e( 'Homepage Intro Author', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[home_intro_author]" class="regular-text" type="text" name="thefirst_theme_settings[home_intro_author]" value="<?php esc_attr_e( $options['home_intro_author'] ); ?>" />
</li>

<h2>Services Module Settings</h2>

<li><h3><?php _e( 'Services Title', 'pwvintage' ); ?></h3>
<textarea id="thefirst_theme_settings[home_services_title]" class="regular-text" name="thefirst_theme_settings[home_services_title]"><?php esc_attr_e( $options['home_services_title'] ); ?></textarea>
<label class="description" for="thefirst_theme_settings[home_services_title]"><?php _e( 'Enter the title for your services module <small>Default is "Our services".</small>', 'pwvintage' ); ?></label>
</li>

<li><h3><?php _e( 'Services Link Text', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[home_services_link_text]" class="regular-text" type="text" name="thefirst_theme_settings[home_services_link_text]" value="<?php esc_attr_e( $options['home_services_link_text'] ); ?>" />
<label class="description" for="thefirst_theme_settings[home_services_link_text]"><?php _e( 'Enter the title for your services module <small>Default is "More details".</small>', 'pwvintage' ); ?></label>
</li>

<li><h3><?php _e( 'Services Link', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[home_services_link]" class="regular-text" type="text" name="thefirst_theme_settings[home_services_link]" value="<?php esc_attr_e( $options['home_services_link'] ); ?>" />
<label class="description" for="thefirst_theme_settings[home_services_link]"></label>
</li>


<h2>Clients Module Settings</h2>

<li><h3><?php _e( 'Client Title', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[home_client_title]" class="regular-text" type="text" name="thefirst_theme_settings[home_client_title]" value="<?php esc_attr_e( $options['home_client_title'] ); ?>" />
<label class="description" for="thefirst_theme_settings[home_client_title]"><?php _e( 'Enter the title for your Clients module <small>. Default is "Our trusted Clients".</small>', 'pwvintage' ); ?></label>
</li>

<li><h3><?php _e( 'Number of Items', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[home_client_count]" class="regular-text" type="text" name="thefirst_theme_settings[home_client_count]" value="<?php esc_attr_e( $options['home_client_count'] ); ?>" />
<label class="description" for="thefirst_theme_settings[home_client_count]"><?php _e( 'Enter the number of items to display in the homepage Clients module <small>. Default is 8.</small>', 'pwvintage' ); ?></label>
</li>

<li><h3><?php _e( 'Carousel Speed', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[home_client_carousel_speed]" class="regular-text" type="text" name="thefirst_theme_settings[home_client_carousel_speed]" value="<?php esc_attr_e( $options['home_client_carousel_speed'] ); ?>" />
<label class="description" for="thefirst_theme_settings[home_client_carousel_speed]"><?php _e( 'Enter the moving transition speed in milliseconds <small>. Default is 500.</small>', 'pwvintage' ); ?></label>
</li>

<li><h3><?php _e( 'Carousel Move Quantity', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[home_client_carousel_quantity]" class="regular-text" type="text" name="thefirst_theme_settings[home_client_carousel_quantity]" value="<?php esc_attr_e( $options['home_client_carousel_quantity'] ); ?>" />
<label class="description" for="thefirst_theme_settings[home_client_carousel_quantity]"><?php _e( 'Enter the number of items you want to scroll by when users click the arrows on the Clients module carousel<small>. Default is 1</small>', 'pwvintage' ); ?></label>
</li>

</ul>
</div>
<!-- END homepage tab--> 

<div id="tab5" class="tab_content"><!--portfolio tab-->
<ul>

<h2>Portfolio Settings</h2>

<li><h3><?php _e( 'Portfolio excerpt content', 'pwvintage' ); ?></h3>
<select name="thefirst_theme_settings[disable_portfolio_details]">
<?php foreach ($disable_options as $option) { ?>
<option <?php if ($options['disable_portfolio_details'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</li>

<h2>Portfolio Single Post Settings</h2>

<li><h3><?php _e( 'Related Portfolio Section', 'pwvintage' ); ?></h3>
<select name="thefirst_theme_settings[disable_related_portfolio]">
<?php foreach ($disable_options as $option) { ?>
<option <?php if ($options['disable_related_portfolio'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</li>

<li><h3><?php _e( 'Related Portfolio Title', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[related_portfolio_title]" class="regular-text" type="text" name="thefirst_theme_settings[related_portfolio_title]" value="<?php esc_attr_e( $options['related_portfolio_title'] ); ?>" />
</li> 

<li><h3><?php _e( 'Comment Form', 'pwvintage' ); ?></h3>
<select name="thefirst_theme_settings[disable_portfolio_comment]">
<?php foreach ($disable_options as $option) { ?>
<option <?php if ($options['disable_portfolio_comment'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</li>

</ul>
</div>
<!-- END portfolio tab-->

<div id="tab6" class="tab_content"><!--blog tab-->
<ul>

<h2>Blog Settings</h2>

<li><h3><?php _e( 'Excerpt Length', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[blog_excerpt_length]" class="regular-text" type="text" name="thefirst_theme_settings[blog_excerpt_length]" value="<?php esc_attr_e( $options['blog_excerpt_length'] ); ?>" />
<label class="description" for="thefirst_theme_settings[blog_excerpt_length]"><?php _e( 'Enter a character length for the blog posts excerpts<small>Default is 60.</small>', 'pwvintage' ); ?></label>
</li>

<li><h3><?php _e( 'Featured Image on top of single blog', 'pwvintage' ); ?></h3>
<select name="thefirst_theme_settings[disable_blog_featured_image]">
<?php foreach ($disable_options as $option) { ?>
<option <?php if ($options['disable_blog_featured_image'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</li>

<li><h3><?php _e( 'Related Posts', 'pwvintage' ); ?></h3>
<select name="thefirst_theme_settings[disable_related_posts]">
<?php foreach ($disable_options as $option) { ?>
<option <?php if ($options['disable_related_posts'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</li>

<li><h3><?php _e( 'Author Bio Section', 'pwvintage' ); ?></h3>
<select name="thefirst_theme_settings[disable_author_bio]">
<?php foreach ($disable_options as $option) { ?>
<option <?php if ($options['disable_author_bio'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</li>
             
</ul>
</div>
<!-- END blog tab-->

<div id="tab7" class="tab_content"><!--Social tab-->
<ul>         

<h2>Social Settings</h2>

<li><h3><?php _e( 'Twitter URL', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[twitter]" class="regular-text" type="text" name="thefirst_theme_settings[twitter]" value="<?php esc_attr_e( $options['twitter'] ); ?>" />
</li>

<li><h3><?php _e( 'Facebook Page URL', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[facebook]" class="regular-text" type="text" name="thefirst_theme_settings[facebook]" value="<?php esc_attr_e( $options['facebook'] ); ?>" />
</li>

<li><h3><?php _e( 'MySpace', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[myspace]" class="regular-text" type="text" name="thefirst_theme_settings[myspace]" value="<?php esc_attr_e( $options['myspace'] ); ?>" />
</li>
<li><h3><?php _e( 'LinkedIn URL', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[linkedin]" class="regular-text" type="text" name="thefirst_theme_settings[linkedin]" value="<?php esc_attr_e( $options['linkedin'] ); ?>" />
</li>

<li><h3><?php _e( 'deviantArt URL', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[deviant]" class="regular-text" type="text" name="thefirst_theme_settings[deviant]" value="<?php esc_attr_e( $options['deviant'] ); ?>" />
</li>

<li><h3><?php _e( 'Dribble URL', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[dribbble]" class="regular-text" type="text" name="thefirst_theme_settings[dribbble]" value="<?php esc_attr_e( $options['dribbble'] ); ?>" />
</li>

<li><h3><?php _e( 'RSS URL', 'pwvintage' ); ?></h3>
<input id="thefirst_theme_settings[rss]" class="regular-text" type="text" name="thefirst_theme_settings[rss]" value="<?php esc_attr_e( $options['rss'] ); ?>" />
</li>

</ul>
</div>
<!-- END end social tab-->

<div id="tab8" class="tab_content"><!--footer tab-->
<ul>

<h2>Footer Settings</h2>

<h2><?php _e('Footer Background','pwvintage'); ?></h2>
<li><h3><?php _e( 'Footer Background','pwvintage'); ?></h3>
<input id="thefirst_theme_settings[footer_bg]" class="regular-text upload_field" type="text" size="36" name="thefirst_theme_settings[footer_bg]" value="<?php esc_attr_e( $options['footer_bg'] ); ?>" />
<input class="upload_image_button button" type="button" value="Upload Image" />
<?php if(trim($options['footer_bg']) != "") { ?>
<div class="logo-preview">
<img src="<?php echo $options['footer_bg']; ?>" alt="Current Background" />
</div>
<?php } ?>

<li><h3><?php _e( 'Copyright Text', 'pwvintage' ); ?></h3>
<textarea id="thefirst_theme_settings[copyright_text]" class="regular-text" name="thefirst_theme_settings[copyright_text]"><?php esc_attr_e( $options['copyright_text'] ); ?></textarea>
<label class="description" for="thefirst_theme_settings[copyright_text]"><?php _e( 'Enter the text at the bottom-left of page', 'pwvintage' ); ?></label>
</li>

</ul>
</div>
<!-- END end footer tab-->  

<div id="tab9" class="tab_content"><!--tracking tab-->
<ul>

<h2>Analytics Tracking Settings</h2>

<li><h3 class="nofloat"><?php _e( 'Header Tracking Code', 'pwvintage' ); ?></h3>
<textarea id="thefirst_theme_settings[tracking_header]" class="regular-text" name="thefirst_theme_settings[tracking_header]"><?php esc_attr_e( $options['tracking_header'] ); ?></textarea>
<label class="description" for="thefirst_theme_settings[tracking_header]"><?php _e( 'Enter your analytics tracking code to insert it in the head tag of your site','pwvintage' ); ?></label>
</li>

<li><h3 class="nofloat"><?php _e( 'Footer Tracking Code', 'pwvintage' ); ?></h3>
<textarea id="thefirst_theme_settings[tracking_footer]" class="regular-text" name="thefirst_theme_settings[tracking_footer]"><?php esc_attr_e( $options['tracking_footer'] ); ?></textarea>
<label class="description" for="thefirst_theme_settings[tracking_footer]"><?php _e( 'Enter your analytics tracking code to insert it in the footer of your site right before the end body tag', 'pwvintage' ); ?></label>
</li>

</ul>
</div>
<!-- END tracking tab-->    
</div>
<!-- END tab container-->

</div><!-- END wrap-right -->
<div class="clear"></div>

<p class="submit-changes">
<input type="submit" class="options-panel-save-btn button" value="<?php _e( 'Save Options', 'pwvintage' ); ?>" />
</p>
</form>
</div>
<!-- END panel-content -->
</div>
<!-- END wrap -->
<?php
}
/************************************
* Sanitize and validate input. Accepts an array, return a sanitized array.
************************************/
function thefirst_options_validate( $input ) {
global $select_options, $radio_options;

// Our checkbox value is either 0 or 1
if ( ! isset( $input['option1'] ) )
$input['option1'] = null;
$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

// Say our text option must be safe text with no HTML tags
$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );


// Our radio option must actually be in our array of radio options
if ( ! isset( $input['radioinput'] ) )
$input['radioinput'] = null;
if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
$input['radioinput'] = null;

// Say our textarea option must be safe text with the allowed tags for posts
$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

return $input;
}
?>
<?php
/***********************
* color picker
***********************/
function mfields_color_picker_js() {
wp_enqueue_script('mfields-colorpicker', get_bloginfo('stylesheet_directory') . '/functions/colorpicker.js',
array( 'jquery' ),
false,
true
);
}
add_action( 'admin_print_scripts', 'mfields_color_picker_js' );

function mfields_color_picker_script() {
print <<<EOF
<script>
jQuery( document ).ready( function( $ ) {

/* Apply color picker to classes */
$( '.color-picker' ).ColorPicker( {
onSubmit: function( hsb, hex, rgb, el ) {
$( el ).val( hex );
$( el ).css( 'color', '#' + hex );
$( el ).ColorPickerHide();
},
onBeforeShow: function () {
$( this ).ColorPickerSetColor( this.value );
},
onShow: function ( box ) {
$( box ).fadeIn( 230 );
return false;
},
onHide: function ( box ) {
$( box ).fadeOut( 230 );
return false;
},
} );

} );
</script>
EOF;
}

add_action( 'admin_head', 'mfields_color_picker_script' );

function mfields_color_picker_css() {
wp_enqueue_style(
'mfields-colorpicker', get_bloginfo('stylesheet_directory') . '/functions/colorpicker.css'
);
}
add_action( 'admin_print_styles', 'mfields_color_picker_css' );
?>
