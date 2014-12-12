<?php
/*---------------------------------------------------------------------------------*/
/* Staff Widget */
/*---------------------------------------------------------------------------------*/


class Woo_Staff extends WP_Widget {

	function Woo_Staff() {
		$widget_ops = array( 'description' => __( 'Display your Restaurant Staff', 'woothemes' ) );
		parent::WP_Widget( false, __( 'Woo - Staff', 'woothemes' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = $instance['title'];
		$pageid = $instance['pageid'];
?>
		
		<div class="sidebar-box">
			<h4 class="blog-sidebar-title">
				<span class="sidebar-title">
					<?php echo $title; ?>
				</span>
			</h4>
       		
	        	<?php
	
			global $wpdb;
	
			$owner = get_users(array( 'role' => 'MamaBird', 'exclude' => '4', 'order' => 'desc' ) );
			$manager = get_users(array( 'role' => 'BabyBird' ) );
			$display_admins = false;
			$user = array_merge($owner);
	
			foreach( $user as $user ) { ?>
	
				<div style="line-height:12px !important; height:115px; overflow:hidden;">
	        		
	        		<span class="details" style="line-height:13px !important;">
	        			<h4><?php if ( $pageid > 0 ) { ?><a href="<?php echo get_permalink( $pageid ).'#'.$user->ID; ?>" title="<?php the_author_meta( 'user_firstname', $user->ID ); ?> <?php the_author_meta( 'user_lastname', $user->ID ); ?>"><?php } ?><?php the_author_meta( 'user_firstname', $user->ID ); ?> <?php the_author_meta( 'user_lastname', $user->ID ); ?><?php if ( $pageid > 0 ) { ?></a><?php } ?></h4>
	        			<span class="description" style="line-height:12px !important;"><?php if ( $pageid > 0 ) { ?><a href="<?php echo get_permalink( $pageid ).'#'.$user->ID; ?>" style="float:left;" title="<?php the_author_meta( 'user_firstname', $user->ID ); ?> <?php the_author_meta( 'user_lastname', $user->ID ); ?>"><?php } ?><?php echo get_avatar( $user->ID, '75' ); ?><?php if ( $pageid > 0 ) { ?></a><?php } ?><?php the_author_meta( 'description', $user->ID, '10' ); ?></span>
	        		</span>
	        		
	        	</div>
	        	
	        	<div class="clear" style="height:20px;"></div>
	
				<?php } ?>
	

		</div>

        <div class="clear"></div>

        <?php if ( $pageid > 0 ) { ?><a class="widget-footlink" href="<?php echo get_permalink( $pageid ); ?>" title="Meet the Team"><?php _e( 'Meet the Rest of the Family', 'woothemes' ); ?></a><?php } ?>

        <?php

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	function form( $instance ) {

		$title = esc_attr( $instance['title'] );
		$pageid = esc_attr( $instance['pageid'] );
?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'woothemes' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" />
        </p>
        <p>
			<label for="<?php echo $this->get_field_id( 'pageid' ); ?>"><?php _e( 'Staff Page Template:', 'woothemes' ); ?></label>
			<?php $args = array(
			'show_option_none'  => __( 'Select a Page:', 'woothemes' ),
			'depth'            => 0,
			'child_of'         => 0,
			'selected'         => $pageid,
			'echo'             => 1,
			'name'             => $this->get_field_name( 'pageid' ),
			'id'               => $this->get_field_name( 'pageid' ),
		); ?>
    		<?php wp_dropdown_pages( $args ); ?>

		</p>
        <?php

	}
}

register_widget( 'Woo_Staff' );


?>