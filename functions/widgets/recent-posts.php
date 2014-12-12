<?php
/******************************************
/* Recent Posts Widget
******************************************/
class thefirst_recent_posts extends WP_Widget {
    /** constructor */
    function thefirst_recent_posts() {
        parent::WP_Widget(false, $name = 'PWvintage RecentPosts');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $number = apply_filters('widget_title', $instance['number']);
        $offset = apply_filters('widget_title', $instance['offset']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							<div id="recent-box">
							<?php
								global $post;
								$tmp_post = $post;
								$args = array( 'numberposts' => $number, 'offset'=> $offset );
								$myposts = get_posts( $args );
								foreach( $myposts as $post ) : setup_postdata($post); ?>
                                <?php if ( has_post_thumbnail() ) {  ?>
									<div class="sidebar-item-box">
										<?php if ( has_post_thumbnail()) : ?>
											<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                            <?php $website_url = get_bloginfo('wpurl'); ?>
                                            <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>
                                            <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                            <a href="<?php echo $thumbnail; ?>" class="post-image" title="<?php the_title(); ?>" rel="prettyPhoto">
                                                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=50&amp;w=50&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" class="image-deco" alt=""/>
                                            </a>
                                        <?php endif; ?>
										<a href="<?php the_permalink(); ?>" class="sidebar-item-title"><?php the_title(); ?></a><br/>
										<p class="sidebar-item-date">Posted: <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></p>
									</div>
                                    <?php } ?>
								<?php endforeach; ?>
								<?php $post = $tmp_post; ?>
							</div>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['number'] = strip_tags($new_instance['number']);
	$instance['offset'] = strip_tags($new_instance['offset']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
        $number = esc_attr($instance['number']);
        $offset = esc_attr($instance['offset']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','pwvintage'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number to Show:','pwvintage'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Offset (the number of posts to skip):','pwvintage'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>" type="text" value="<?php echo $offset; ?>" />
        </p>
        <?php 
    }


} // class thefirst_recent_posts
// register Recent Posts widget
add_action('widgets_init', create_function('', 'return register_widget("thefirst_recent_posts");'));	
?>