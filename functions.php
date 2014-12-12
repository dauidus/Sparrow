<?php
// load the theme options
$options = get_option( 'thefirst_theme_settings' );

// localization
$lang = TEMPLATEPATH . '/languages';
load_theme_textdomain('pwvintage', $lang);


// Set path to WooFramework and theme specific functions
$functions_path = get_template_directory() . '/functions/';
$includes_path = get_template_directory() . '/includes/';

// WooFramework
require_once ($functions_path . 'admin-init.php' );			// Framework Init

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/

$includes = array(
				'includes/theme-options.php', 			// Options panel settings and custom settings
				'includes/theme-functions.php', 		// Custom theme functions
				'includes/theme-actions.php', 			// Theme actions & user defined hooks				
				'includes/theme-js.php', 				// Load JavaScript via wp_enqueue_script
				'includes/sidebar-init.php', 			// Initialize widgetized areas
				'includes/theme-widgets.php'			// Theme widgets
				);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'woo_includes', $includes );
				
foreach ( $includes as $i ) {
	locate_template( $i, true );
}

// general includes
include('functions/theme-admin.php');
include('functions/pagination.php');
include('functions/better-excerpts.php');
include('functions/better-comments.php');
include('functions/shortcodes/link-button.php');
include('functions/shortcodes/highlight-link.php');
include('functions/shortcodes/columns.php');
include('functions/shortcodes/shortcode.php');
include('functions/shortcodes/service.php');
include('functions/shortcodes/intro.php');
include('functions/shortcodes/intro_2.php');

// widgets
include('functions/widgets/recent-posts.php');
include('functions/widgets/recent-portfolio.php');
include('functions/widgets/recent-comments.php');
include('functions/widgets/flickr.php');
include('functions/widgets/home-services.php');
include('functions/widgets/custom-menu.php');
include('functions/widgets/tweets.php');

// metaboxes
include('functions/metaboxes/sliders-meta.php');
include('functions/metaboxes/portfolio-meta.php');
include('functions/metaboxes/clients-meta.php');

// remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator'); // remove WordPress Version For Security Reasons
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

// get scripts
add_action('wp_enqueue_scripts','thefirst_scripts_function');
function thefirst_scripts_function() {
global $options; //get options outside of function
	

   
// include all JS to the WP hook
	wp_enqueue_script('easing', get_stylesheet_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '1.3', false);
	wp_enqueue_script('prettyPhoto', get_stylesheet_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), '3.3.1', false);
	wp_enqueue_script('jquery-ui', get_stylesheet_directory_uri() . '/js/jquery-ui-1.8.17.custom.min.js', array('jquery'), '1.8.17', false);
	wp_enqueue_script('supersubs', get_stylesheet_directory_uri() . '/js/supersubs.js', array('jquery'), '1.0', false);
	wp_enqueue_script('superfish', get_stylesheet_directory_uri() . '/js/superfish.js', array('jquery'), '1.0', false);
	wp_enqueue_script('jquery.ui.totop', get_stylesheet_directory_uri() . '/js/jquery.ui.totop.js', array('jquery'), '1.1', false);
	wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), '1.0', false);
	
	if(is_front_page()) :
	wp_enqueue_script('eislideshow', get_stylesheet_directory_uri() . '/js/jquery.eislideshow.js', array('jquery'), '1.0', false);
	wp_enqueue_script('contentcarousel', get_stylesheet_directory_uri() . '/js/jquery.contentcarousel.js', array('jquery'), '1.0', false);
	endif;
	
	if (is_page_template( 'portfolio-2-columns-template.php' ) || is_page_template( 'portfolio-3-columns-template.php' ) || is_page_template( 'portfolio-4-columns-template.php' )) : 
		wp_enqueue_script('filterable', get_stylesheet_directory_uri() . '/js/filterable.js', array('jquery'), '1.0', false);
	endif;
	
	if (is_page_template( 'faqs-template.php' )) : 
		wp_enqueue_script('accordion', get_stylesheet_directory_uri() . '/js/jquery.accordion.js', array('jquery'), '1.0', false);
	endif;
	
	if (is_single()) : 
	wp_enqueue_script('localscroll', get_stylesheet_directory_uri() . '/js/jquery.localscroll-1.2.7-min.js', array('jquery'), '1.2.7', false);
	endif;
}
if (!current_user_can('edit_posts')) {
	add_filter('show_admin_bar', '__return_false');
}

//using Shortcode in Text Widget
add_filter('widget_text', 'do_shortcode');

//exclude page from search
function SearchFilter($query) {
    if ($query->is_search) {
    	$query->set('post_type', 'post');
    }
    return $query;
    }
add_filter('pre_get_posts','SearchFilter');

// get permalink by title
function get_permalink_by_name($page_name) {
        global $post;
        global $wpdb;
        $pageid_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $page_name . "' LIMIT 0, 1");
        return get_permalink($pageid_name);
}

// replace general excerpt length
function thefirst_new_excerpt_more($more) {
       global $post;
	return '...';
}
add_filter('excerpt_more', 'thefirst_new_excerpt_more');


// activate post-image function
if ( function_exists( 'add_theme_support' ) )
add_theme_support( 'post-thumbnails' );

// enable custom background support
add_custom_background();

// register navigation menus
register_nav_menus(
	array(
	'left nav'=>__('Left Nav'),
	)
);
register_nav_menus(
	array(
	'right nav'=>__('Right Nav'),
	)
);
register_nav_menus(
	array(
	'footer nav'=>__('Footer Nav'),
	)
);

// register sidebars
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'HomePage Services',
'description' => 'Widgets in this area will be shown in the HomePage.',
'before_widget' => '<li>',
'after_widget' => '</li>',
'before_title' => '',
'after_title' => '',
));
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Blog Sidebar',
'description' => 'Widgets in this area will be shown in the sidebar.',
'before_widget' => '<div class="sidebar-box">',
'after_widget' => '</div>',
'before_title' => '<h4 class="blog-sidebar-title"><span class="sidebar-title">',
'after_title' => '</span></h4>',
));
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Pages Sidebar',
'description' => 'Widgets in this area will be shown in the sidebar.',
'before_widget' => '<div class="sidebar-box">',
'after_widget' => '</div>',
'before_title' => '<h4 class="blog-sidebar-title"><span class="sidebar-title">',
'after_title' => '</span></h4>',
));
register_sidebar(array(
'name' => 'Portfolio Sidebar',
'description' => 'Widgets in this area will be shown in the sidebar.',
'before_widget' => '<div class="sidebar-box">',
'after_widget' => '</div>',
'before_title' => '<h4 class="blog-sidebar-title"><span class="sidebar-title">',
'after_title' => '</span></h4>',
));
register_sidebar(array(
'name' => 'First Footer Area',
'description' => 'Widgets in this area will be shown in the footer - left side.',
'before_widget' => '<div class="footer-box">',
'after_widget' => '</div>',
'before_title' => '<h4 class="footer-heading">',
'after_title' => '</h4><div class="dashed"></div>',
));
register_sidebar(array(
'name' => 'Second Footer Area',
'description' => 'Widgets in this area will be shown in the footer - middle.',
'before_widget' => '<div class="footer-box">',
'after_widget' => '</div>',
'before_title' => '<h4 class="footer-heading">',
'after_title' => '</h4><div class="dashed"></div>',
));
register_sidebar(array(
'name' => 'Third Footer Area',
'description' => 'Widgets in this area will be shown in the footer - right side.',
'before_widget' => '<div class="footer-box">',
'after_widget' => '</div>',
'before_title' => '<h4 class="footer-heading">',
'after_title' => '</h4><div class="dashed"></div>',
));

add_action( 'init', 'create_post_types' );
function create_post_types() {
// Define Post Type For Slider
  register_post_type( 'sliders',
    array(
      'labels' => array(
		'name' => _x( 'Sliders', 'post type general name' ), // Tip: _x('') is used for localization
		'singular_name' => _x( 'Slider', 'post type singular name' ),
		'add_new' => _x( 'Add New', 'Slider' ),
		'add_new_item' => __( 'Add New Slider' ),
		'edit_item' => __( 'Edit Slider' ),
		'new_item' => __( 'New Slider' ),
		'view_item' => __( 'View Slider' ),
		'search_items' => __( 'Search Sliders' ),
		'not_found' =>  __( 'No Slider found' ),
		'not_found_in_trash' => __( 'No Slider found in Trash' ),
		'parent_item_colon' => ''
      ),
      'public' => true,
	  'exclude_from_search' => true,
	  'supports' => array('title','thumbnail'),
	  'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/slides.png',
    )
  );
/*
// Define Post Type For Services
register_post_type( 'Clients',
    array(
      'labels' => array(
        'name' => __( 'Clients' ),
        'singular_name' => __( 'Client' ),		
		'add_new' => _x( 'Add New', 'Client' ),
		'add_new_item' => __( 'Add New Client' ),
		'edit_item' => __( 'Edit Client' ),
		'new_item' => __( 'New Client' ),
		'view_item' => __( 'View Client' ),
		'search_items' => __( 'Search Clients' ),
		'not_found' =>  __( 'No Clients found' ),
		'not_found_in_trash' => __( 'No Clients found in Trash' ),
		'parent_item_colon' => ''
		
      ),
      'public' => true,
	  'exclude_from_search' => true,
	  'supports' => array('title','editor','thumbnail'),
	  'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/clients.png',
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'clients' ),
    )
  );
// Define Post Type For FaQs
register_post_type( 'FaQs',
    array(
      'labels' => array(
        'name' => __( 'FaQs' ),
        'singular_name' => __( 'FaQ' ),		
		'add_new' => _x( 'Add New', 'FaQ' ),
		'add_new_item' => __( 'Add New FaQ' ),
		'edit_item' => __( 'Edit FaQ' ),
		'new_item' => __( 'New FaQ' ),
		'view_item' => __( 'View FaQ' ),
		'search_items' => __( 'Search FaQs' ),
		'not_found' =>  __( 'No FaQs found' ),
		'not_found_in_trash' => __( 'No FaQs found in Trash' ),
		'parent_item_colon' => ''
		
      ),
      'public' => true,
	  'exclude_from_search' => true,
	  'supports' => array('title','editor','comments'),
	  'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/faq.png',
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'faqs' ),
    )
  );
// Define Post Type For Portfolio
register_post_type( 'Portfolio',
    array(
      'labels' => array(
        'name' => __( 'Portfolio' ),
        'singular_name' => __( 'Portfolio' ),		
		'add_new' => _x( 'Add New', 'Portfolio Project' ),
		'add_new_item' => __( 'Add New Portfolio Project' ),
		'edit_item' => __( 'Edit Portfolio Project' ),
		'new_item' => __( 'New Portfolio Project' ),
		'view_item' => __( 'View Portfolio Project' ),
		'search_items' => __( 'Search Portfolio Projects' ),
		'not_found' =>  __( 'No Portfolio Projects found' ),
		'not_found_in_trash' => __( 'No Portfolio Projects found in Trash' ),
		'parent_item_colon' => ''
		
      ),
      'public' => true,
	  'supports' => array('title','editor','thumbnail', 'comments' ),
	  'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/portfolio.png',
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'portfolio' ),
    )
  );
  
*/
  
}

//Create project taxonomies
add_action( 'init', 'create_taxonomies' );
function create_taxonomies() {
	$cat_labels = array(
		'name' => __( 'Categories' ),
		'singular_name' => __( 'Category' ),
		'search_items' =>  __( 'Search Categories' ),
		'all_items' => __( 'All Categories' ),
		'parent_item' => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item' => __( 'Edit Category' ),
		'update_item' => __( 'Update Category' ),
		'add_new_item' => __( 'Add New Category' ),
		'new_item_name' => __( 'New Category Name' ),
		'choose_from_most_used'	=> __( 'Choose from the most used categories' )
	); 	

	register_taxonomy('portfolio_cats','portfolio',array(
		'hierarchical' => true,
		'labels' => $cat_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-category' ),
	));	
	
	$tag_labels = array(
		'name' => __( 'Tags' ),
		'singular_name' => __( 'Tag' ),
		'search_items' =>  __( 'Search Tags' ),
		'all_items' => __( 'All Tags' ),
		'parent_item' => __( 'Parent Tag' ),
		'parent_item_colon' => __( 'Parent Tag:' ),
		'edit_item' => __( 'Edit Tag' ),
		'update_item' => __( 'Update Tag' ),
		'add_new_item' => __( 'Add New Tag' ),
		'new_item_name' => __( 'New Tag Name' )
	); 	

	register_taxonomy('portfolio_tags','portfolio',array(
		'hierarchical' => false,
		'labels' => $tag_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-tag' ),
	));
	
}




?>