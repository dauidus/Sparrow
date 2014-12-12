<?php

	class pw_recent_tweets_widget extends WP_Widget {

// Constructor //

	function pw_recent_tweets_widget() {
		$widget_ops = array( 'classname' => 'pw_recent_tweets_widget', 'description' => 'Displays your recent tweets using the Twitter profile tool' ); // Widget Settings
		$control_ops = array( 'id_base' => 'pw_recent_tweets_widget' ); // Widget Control Settings
		$this->WP_Widget( 'pw_recent_tweets_widget', 'PWvintage RecentTweets', $widget_ops, $control_ops ); // Create the widget
	}

// Extract Args //

		function widget($args, $instance) {
			extract( $args );
			$title 		= apply_filters('widget_title', $instance['title']); // the widget title
			$tweetnumber 	= $instance['tweet_number']; // the number of tweets to show
			$twitterusername 	= $instance['twitter_username']; // the type of posts to show
			$width = $instance['width'];
			$height = $instance['height'];
			$tweetslinks 	= $instance['tweets_links']; // Tweets links color
			$hashtags   = isset($instance['hashtags']) ? $instance['hashtags'] : false ; // whether or not to show hashtags
			$timestamp   = isset($instance['timestamp']) ? $instance['timestamp'] : false ; // whether or not to show timestamp
			$avatars   = isset($instance['avatars']) ? $instance['avatars'] : false ; // whether or not to show avatars

// Before widget //

		echo $before_widget;

// Title of widget //

		if ( $title ) { echo $before_title . $title . $after_title; }

// Widget output //

		?>
		<script src="http://widgets.twimg.com/j/2/widget.js"></script>
			<script>
			new TWTR.Widget({
				version: 2,
				type: 'profile',
				width: <?php echo $width; ?>,
				height: <?php echo $height; ?>,
				rpp: <?php echo $tweetnumber; ?>,
				theme: {
					shell: {
						background: 'transparent',
						color: 'transparent'
					},
					tweets: {
						background: 'transparent',
						color: '#666666',
						links: '<?php echo $tweetslinks; ?>'
					}
				},
				features: {
					scrollbar: false,
					loop: false,
					live: true,
					<?php if ($hashtags) {
						echo 'hashtags: true,';
					}
					else {
						echo 'hashtags: false,';
					}
					if ($timestamp) {
						echo 'timestamp: true,';
					}
					else {
						echo 'timestamp: false,';
					}
					if ($avatars) {
						echo 'avatars: true,';
					}
					else {
						echo 'avatars: false,';
					} ?>
					behavior: 'all'
  				}
			}).render().setUser('<?php echo $twitterusername; ?>').start();
			</script>
			<?php

// After widget //

		echo $after_widget;
		}

// Update Settings //

 		function update($new_instance, $old_instance) {
 			$instance['title'] = ($new_instance['title']);
 			$instance['tweet_number'] = ($new_instance['tweet_number']);
 			$instance['twitter_username'] = ($new_instance['twitter_username']);
			$instance['width'] = ($new_instance['width']);
			$instance['height'] = ($new_instance['height']);
 			$instance['tweets_links'] = ($new_instance['tweets_links']);
 			$instance['hashtags'] = ($new_instance['hashtags']);
 			$instance['timestamp'] = ($new_instance['timestamp']);
 			$instance['avatars'] = ($new_instance['avatars']);
 			return $instance;
 		}

// Widget Control Panel //

 		function form($instance) {

 		$defaults = array( 'title' => 'Recent Tweets', 'tweet_number' => 3, 'twitter_username' => '', 'tweets_links' => '#60817A', 'hashtags' => 'on', 'timestamp' => 'on', 'avatars' => false );
 		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

 		<p>
 			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
 			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
 		</p>
        <p>
 			<label for="<?php echo $this->get_field_id('width'); ?>">Width</label>
 			<input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>'" type="text" value="<?php echo $instance['width']; ?>" />
 		</p>
        <p>
 			<label for="<?php echo $this->get_field_id('height'); ?>">Height</label>
 			<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>'" type="text" value="<?php echo $instance['height']; ?>" />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id('tweet_number'); ?>"><?php _e('Number of tweets to display','pwvintage'); ?></label>
 			<input class="widefat" id="<?php echo $this->get_field_id('tweet_number'); ?>" name="<?php echo $this->get_field_name('tweet_number'); ?>" type="text" value="<?php echo $instance['tweet_number']; ?>" />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id('twitter_username'); ?>"><?php _e('Twitter username','pwvintage'); ?></label>
 			<input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo $instance['twitter_username']; ?>" />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id('tweets_links'); ?>"><?php _e('Tweets links color','pwvintage'); ?></label>
 			<input class="widefat" id="<?php echo $this->get_field_id('tweets_links'); ?>" name="<?php echo $this->get_field_name('tweets_links'); ?>" type="text" value="<?php echo $instance['tweets_links']; ?>" />
 		</p>
		<p>
			<label for="<?php echo $this->get_field_id('hashtags'); ?>"><?php _e('Show hashtags?','pwvintage'); ?></label>
            <input type="checkbox" class="checkbox" <?php checked( $instance['hashtags'], 'on' ); ?> id="<?php echo $this->get_field_id('hashtags'); ?>" name="<?php echo $this->get_field_name('hashtags'); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('timestamp'); ?>"><?php _e('Show timestamp?','pwvintage'); ?></label>
            <input type="checkbox" class="checkbox" <?php checked( $instance['timestamp'], 'on' ); ?> id="<?php echo $this->get_field_id('timestamp'); ?>" name="<?php echo $this->get_field_name('timestamp'); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('avatars'); ?>"><?php _e('Show avatars?','pwvintage'); ?></label>
            <input type="checkbox" class="checkbox" <?php checked( $instance['avatars'], 'on' ); ?> id="<?php echo $this->get_field_id('avatar'); ?>" name="<?php echo $this->get_field_name('avatars'); ?>" />
		</p>
        <?php }

}

// End class pw_recent_tweets_widget

add_action('widgets_init', create_function('', 'return register_widget("pw_recent_tweets_widget");'));
?>