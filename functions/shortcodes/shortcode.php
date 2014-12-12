<?php
// registers the buttons for use
function thefirst_register_friendly_buttons($buttons) {
	// inserts a separator between existing buttons and our new one
	// "friendly_button" is the ID of our button
	array_push($buttons,"link_button","highlight_link","service","intro", "intro_2");
	return $buttons;
}

// filters the tinyMCE buttons and adds our custom buttons
function thefirst_friendly_shortcode_buttons() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;
	 
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		// filter the tinyMCE buttons and add our own
		add_filter("mce_external_plugins", "thefirst_add_friendly_tinymce_plugin");
		add_filter('mce_buttons', 'thefirst_register_friendly_buttons');
	}
}
// init process for button control
add_action('init', 'thefirst_friendly_shortcode_buttons');

// add the button to the tinyMCE bar
function thefirst_add_friendly_tinymce_plugin($plugin_array) {
	$plugin_array['link_button'] = get_bloginfo('stylesheet_directory') . '/functions/shortcodes/link-button.js';
	$plugin_array['highlight_link'] = get_bloginfo('stylesheet_directory') . '/functions/shortcodes/highlight-link.js';
	$plugin_array['service'] = get_bloginfo('stylesheet_directory') . '/functions/shortcodes/service.js';
	$plugin_array['intro'] = get_bloginfo('stylesheet_directory') . '/functions/shortcodes/intro.js';
	$plugin_array['intro_2'] = get_bloginfo('stylesheet_directory') . '/functions/shortcodes/intro_2.js';
	return $plugin_array;
}
?>