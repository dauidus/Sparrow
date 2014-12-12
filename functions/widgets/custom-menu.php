<?php
/******************************************
/* Custom Menu Widget
******************************************/

class pwvintage_custom_menu extends WP_Widget {
    /** constructor */
    function pwvintage_custom_menu() {
        parent::WP_Widget(false, $name = 'PWvintage CustomMenu');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
		// Get menu
		$nav_menu = wp_get_nav_menu_object( $instance['nav_menu'] );
		$nav_menu1 = wp_get_nav_menu_object( $instance['nav_menu1'] );

		if ( !$nav_menu || !$nav_menu1 )
			return;

		$instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu ) );
		wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu1 ) );

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		$instance['nav_menu1'] = (int) $new_instance['nav_menu1'];
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
		$nav_menu1 = isset( $instance['nav_menu1'] ) ? $instance['nav_menu1'] : '';

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		$menus1 = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus || !$menus1 ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','pwvintage') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:','pwvintage'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php
			foreach ( $menus as $menu ) {
				$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
			}
		?>
			</select>
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('nav_menu1'); ?>"><?php _e('Select Menu:','pwvintage'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu1'); ?>" name="<?php echo $this->get_field_name('nav_menu1'); ?>">
		<?php
			foreach ( $menus as $menu1 ) {
				$selected = $nav_menu1 == $menu1->term_id ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu1->term_id .'">'. $menu1->name .'</option>';
			}
		?>
			</select>
		</p>
		<?php
	}
}


// register Recent Comments widget
add_action('widgets_init', create_function('', 'return register_widget("pwvintage_custom_menu");'));
?>