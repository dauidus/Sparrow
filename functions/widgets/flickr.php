<?php

// Flickr Widget

class pwvintage_flickr extends WP_Widget {
	
	function pwvintage_flickr() {
		
		// define widget title and description
		$widget_ops = array('classname' => 'ht_flickr_widget',
							'description' => __( 'Get images from your Flickr account.','pwvintage') );
		// register the widget
		$this->WP_Widget('pwvintage_flickr', __('PWvintage Flickr','pwvintage'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
	  	$number = (int) strip_tags($instance['number']);
	  	$id = strip_tags($instance['id']);
		
		echo $before_widget;
             if ( $title )
                 echo $before_title . $title . $after_title; ?>		
				<ul class="flickr no-bullets">
					<li class="clearfix"><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script></li>
				</ul>
			<?php
			
		echo $after_widget;
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) strip_tags($new_instance['number']);
		$instance['id'] = strip_tags($new_instance['id']);

		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'title' => 'Flickr Feed', 'id' => '', 'number'=> 6 ) );
	$id = strip_tags($instance['id']);
	$number = strip_tags($instance['number']);
	$title = strip_tags($instance['title']);
	
	
	
	// print the form fields
	?>

	<p><label for="<?php echo $this->get_field_id('title'); ?>">
	<?php _e('Title:','pwvintage'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo
		esc_attr($title); ?>" /></p>
	
	<p><label for="<?php echo $this->get_field_id('id'); ?>">
	<?php _e('Flickr ID ','pwvintage'); ?>(<a href="http://www.idgettr.com" target="_blank">idGettr</a>):</label>
	<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo
		esc_attr($id); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('number'); ?>">
	<?php _e('Number:','pwvintage'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo
		esc_attr($number); ?>" /></p>

	<?php
	}
}
// register Flickr widget
add_action('widgets_init', create_function('', 'return register_widget("pwvintage_flickr");'));	
?>