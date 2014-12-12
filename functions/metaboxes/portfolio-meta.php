<?php

/*-----------------------------------------------------------------------------------*/
/* Portfolio Custom Metabox For Slider */
/*-----------------------------------------------------------------------------------*/

function slider_settings_portfolio_metabox() {
	
	global $post;
	
	$img1 = get_post_meta( $post->ID, 'portfolio-image-1', true );
	$img2 = get_post_meta( $post->ID, 'portfolio-image-2', true );
	$img3 = get_post_meta( $post->ID, 'portfolio-image-3', true );
	$img4 = get_post_meta( $post->ID, 'portfolio-image-4', true );
	$img5 = get_post_meta( $post->ID, 'portfolio-image-5', true );
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="portfolio_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="portfolio-image-1"><?php _e( "Image 1:", 'pwvintage' ); ?></label></th>
			<td>
				<input id="portfolio-image-1" class="upload_field regular-text" type="text" name="portfolio-image-1" value="<?php echo $img1; ?>" />
				<input id="portfolio-image-1-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'pwvintage' ); ?>" />
				<br />
				<p>
					<?php _e( 'This image will be resized to 630x420 pixels.', 'pwvintage' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-2"><?php _e( "Image 2:", 'pwvintage' ); ?></label></th>
			<td>
				<input id="portfolio-image-2" class="upload_field regular-text" type="text" name="portfolio-image-2" value="<?php echo $img2; ?>" />
				<input id="portfolio-image-2-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'pwvintage' ); ?>" />
				<br />
				<p>
					<?php _e( 'This image will be resized to 630x420 pixels.', 'pwvintage' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-3"><?php _e( "Image 3:", 'pwvintage' ); ?></label></th>
			<td>
				<input id="portfolio-image-3" class="upload_field regular-text" type="text" name="portfolio-image-3" value="<?php echo $img3; ?>" />
				<input id="portfolio-image-3-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'pwvintage' ); ?>" />
				<br />
				<p>
					<?php _e( 'This image will be resized to 630x420 pixels.', 'pwvintage' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-4"><?php _e( "Image 4:", 'pwvintage' ); ?></label></th>
			<td>
				<input id="portfolio-image-4" class="upload_field regular-text" type="text" name="portfolio-image-4" value="<?php echo $img4; ?>" />
				<input id="portfolio-image-4-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'pwvintage' ); ?>" />
				<br />
				<p>
					<?php _e( 'This image will be resized to 630x420 pixels.', 'pwvintage' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-5"><?php _e( "Image 5:", 'pwvintage' ); ?></label></th>
			<td>
				<input id="portfolio-image-5" class="upload_field regular-text" type="text" name="portfolio-image-5" value="<?php echo $img5; ?>" />
				<input id="portfolio-image-5-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'pwvintage' ); ?>" />
				<br />
				<p>
					<?php _e( 'This image will be resized to 630x420 pixels.', 'pwvintage' ); ?>
				</p>
			</td>
		</tr>
	</table>
	
<?php
}



/*-----------------------------------------------------------------------------------*/
/* Portfolio Custom Metabox For Videos */
/*-----------------------------------------------------------------------------------*/

function video_portfolio_metabox() {
	
	global $post;
	
	$video_embed_code = get_post_meta( $post->ID, 'portfolio-video-embed', true );	
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="portfolio_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="portfolio-video-embed"><?php _e("Video Embed Code:", 'pwvintage'); ?></label></th>
			<td><textarea id="portfolio-video-embed" cols="60" rows="3" name="portfolio-video-embed"><?php echo $video_embed_code; ?></textarea>
				<br />
				
				<p>
				<?php _e( 'Add your video embed code (such as: youtube & vimeo). Resolution should be 640x360 pixels.', 'pwvintage' ); ?>
				</p>
			</td>
		</tr>
	</table>
	
<?php
}



/*-----------------------------------------------------------------------------------*/
/* Portfolio Custom Metabox For Additional Information */
/*-----------------------------------------------------------------------------------*/

function optional_portfolio_metabox() {
	
	global $post;
	
	$client = get_post_meta( $post->ID, 'copyright', true );
	$project_url = get_post_meta( $post->ID, 'project-url', true );
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="portfolio_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
    	
		<tr>
			<th><label for="copyright"><?php _e( "Copyright:", 'pwvintage' ); ?></label></th>
			<td>
				<input id="copyright" class="regular-text" type="text" name="copyright" value="<?php echo $client; ?>" />
				<br />
				<p>
					<?php _e( "The name of the owner for this portfolio item.", 'pwvintage' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="project-url"><?php _e( "Project URL:", 'pwvintage' ); ?></label></th>
			<td>
				<input id="project-url" class="regular-text" type="text" name="project-url" value="<?php echo $project_url; ?>" />
				<br />
				<p>
					<?php _e( 'The link/URL of this portfolio item.', 'pwvintage' ); ?>
				</p>
			</td>
		</tr>
		
	</table>
	
<?php
}



/*
 * Process the custom metabox fields
 */
function save_portfolio_meta_box_values( $post_id ) {
	global $post;
	
	// Verify nonce
    if ( !wp_verify_nonce( $_POST['portfolio_meta_box_nonce'], basename(__FILE__) ) ) {
        return $post_id;
    }
	
	// Skip auto save
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	
	//Check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        }
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
	
	//check for portfolio post type only
    if( $post->post_type == "portfolio" ) {
        if ( isset( $_POST['portfolio-image-1']) ) { update_post_meta( $post->ID, 'portfolio-image-1', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-1'] ) ) ) ); }
        if ( isset( $_POST['portfolio-image-2']) ) { update_post_meta( $post->ID, 'portfolio-image-2', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-2'] ) ) ) ); }
		if ( isset( $_POST['portfolio-image-3']) ) { update_post_meta( $post->ID, 'portfolio-image-3', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-3'] ) ) ) ); }
        if ( isset( $_POST['portfolio-image-4']) ) { update_post_meta( $post->ID, 'portfolio-image-4', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-4'] ) ) ) ); }
        if ( isset( $_POST['portfolio-image-5']) ) { update_post_meta( $post->ID, 'portfolio-image-5', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-5'] ) ) ) ); }
		if ( isset( $_POST['portfolio-video-embed']) ) { update_post_meta( $post->ID, 'portfolio-video-embed', stripslashes( htmlspecialchars( $_POST['portfolio-video-embed'] ) ) ); }
		if ( isset( $_POST['portfolio-image-1']) ) { update_post_meta( $post->ID, 'portfolio-image-1', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-1'] ) ) ) ); }
        if ( isset( $_POST['copyright']) ) { update_post_meta( $post->ID, 'copyright', stripslashes( htmlspecialchars( $_POST['copyright'] ) ) ); }
		if ( isset( $_POST['project-url']) ) { update_post_meta( $post->ID, 'project-url', stripslashes( htmlspecialchars( esc_url( $_POST['project-url'] ) ) ) ); }
    }	
}

// Add action
add_action( 'admin_init', 'add_portfolio_meta_boxes' );
add_action( 'save_post', 'save_portfolio_meta_box_values' );


/*
 * Add meta box
 */
function add_portfolio_meta_boxes() {
	add_meta_box( 'portfolio-img-settings-metabox', __( "Slider Settings", 'pwvintage' ), 'slider_settings_portfolio_metabox', 'portfolio', 'normal', 'high' );
	add_meta_box( 'portfolio-video-settings-metabox', __( "Video Settings", 'pwvintage' ), 'video_portfolio_metabox', 'portfolio', 'normal', 'high' );
	add_meta_box( 'portfolio-additional-info-metabox', __( "Additional Information", 'pwvintage' ), 'optional_portfolio_metabox', 'portfolio', 'normal', 'high' );
}

?>