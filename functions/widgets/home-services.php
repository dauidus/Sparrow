<?php
/******************************************
/* Home Services Widget
******************************************/
class thefirst_home_services extends WP_Widget {
    /** constructor */
    function thefirst_home_services() {
        parent::WP_Widget(false, $name = 'PWvintage HomeServices');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $link = apply_filters('widget_title', $instance['link']);
		$icon = apply_filters('widget_title', $instance['icon']);
        $content1 = apply_filters('widget_title', $instance['content1']);
		$content2 = apply_filters('widget_title', $instance['content2']);
		$content3 = apply_filters('widget_title', $instance['content3']);
		$content4 = apply_filters('widget_title', $instance['content4']);
		$content5 = apply_filters('widget_title', $instance['content5']);
        ?>
              <?php echo $before_widget; ?>
                  <a href="<?php echo $link; ?>">
                      <div class="sv-icon"><p><?php echo $icon; ?></p></div>
                      <div class="sv-content">
                          <h2 class="sv-main"><?php echo $title; ?></h2>
                          <p class="sv-sub"><?php echo $content1; ?></p>
                          <p class="sv-sub"><?php echo $content2; ?></p>
                          <p class="sv-sub"><?php echo $content3; ?></p>
                          <p class="sv-sub"><?php echo $content4; ?></p>
                          <p class="sv-sub"><?php echo $content5; ?></p>
                      </div>
                  </a>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['link'] = strip_tags($new_instance['link']);
	$instance['icon'] = strip_tags($new_instance['icon']);
	$instance['content1'] = strip_tags($new_instance['content1']);
	$instance['content2'] = strip_tags($new_instance['content2']);
	$instance['content3'] = strip_tags($new_instance['content3']);
	$instance['content4'] = strip_tags($new_instance['content4']);
	$instance['content5'] = strip_tags($new_instance['content5']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
        $link = esc_attr($instance['link']);
		$icon = esc_attr($instance['icon']);
        $content1 = esc_attr($instance['content1']);
		$content2 = esc_attr($instance['content2']);
		$content3 = esc_attr($instance['content3']);
		$content4 = esc_attr($instance['content4']);
		$content5 = esc_attr($instance['content5']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','pwvintage'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link to:','pwvintage'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Icon:','pwvintage'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo $icon; ?>" maxlength="1" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('content1'); ?>"><?php _e('Content:','pwvintage'); ?></label> 
          <textarea class="widefat" id="<?php echo $this->get_field_id('content1'); ?>" name="<?php echo $this->get_field_name('content1'); ?>"><?php echo $content1; ?></textarea>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('content2'); ?>"><?php _e('Content:','pwvintage'); ?></label> 
          <textarea class="widefat" id="<?php echo $this->get_field_id('content2'); ?>" name="<?php echo $this->get_field_name('content2'); ?>"><?php echo $content2; ?></textarea>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('content3'); ?>"><?php _e('Content:','pwvintage'); ?></label> 
          <textarea class="widefat" id="<?php echo $this->get_field_id('content3'); ?>" name="<?php echo $this->get_field_name('content3'); ?>"><?php echo $content3; ?></textarea>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('content4'); ?>"><?php _e('Content:','pwvintage'); ?></label> 
          <textarea class="widefat" id="<?php echo $this->get_field_id('content4'); ?>" name="<?php echo $this->get_field_name('content4'); ?>"><?php echo $content4; ?></textarea>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('content5'); ?>"><?php _e('Content:','pwvintage'); ?></label> 
          <textarea class="widefat" id="<?php echo $this->get_field_id('content5'); ?>" name="<?php echo $this->get_field_name('content5'); ?>"><?php echo $content5; ?></textarea>
        </p>
        <?php 
    }


} // class thefirst_home_services
// register Home Services widget
add_action('widgets_init', create_function('', 'return register_widget("thefirst_home_services");'));	
?>