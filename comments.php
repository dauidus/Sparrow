<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ( __( 'Please do not load this page directly. Thanks!', 'pwvintage' ) );

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'pwvintage' ); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<?php if ( comments_open() ) : ?>
<div id="comment-wrapper">
    <h2 style="color:#8DD017; font-size:40px; font-weight:normal; margin:20px auto; font-family:Nilland;
text-shadow: 0px 1px 1px rgba(0, 0, 0, .3); line-height:50px; text-transform:uppercase; text-align:center;"><?php comments_number( __( 'No Comments Yet', 'pwvintage' ), __( 'Comments:', 'pwvintage' ), _n( '% comment', 'Comments:', get_comments_number(), 'pwvintage' ) ); ?></h2>
    <?php if ( have_comments() ) : ?>
    <ul id="comments">
    <?php wp_list_comments(
		array(
			'login_text' => 'Log in to Reply',
			'reply_text' => 'reply',
			'callback' => 'better_comments'
		));
	?>
    </ul>
    <?php endif; ?>
	<?php else :
    // comments are closed ?>
    <?php endif; ?>
    
    <?php if ( comments_open() ) : ?>
    <div id="respond">
    <h3><?php _e('Leave a Comment','pwvintage') ?></h3>
    <div class="cancel-comment-reply">
		<?php cancel_comment_reply_link(); ?>
    </div>	
    <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
    <p class="text-loged-in"><?php _e('You must be ','pwvintage') ?><a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in','pwvintage') ?></a><?php _e(' to post a comment.','pwvintage') ?></p>
    <?php else : ?>	
    <div id="post-comment">
        <form class="form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        
            <fieldset>
            <?php if ( is_user_logged_in() ) : ?>

            <p class="text-loged-in"><?php _e('Logged in as ','pwvintage') ?><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>"><?php _e('Log out &raquo; ','pwvintage') ?></a></p>
            
            <?php else : ?>
                <div>
                    <label for="name" id="form-name-label" class="label-title"><?php _e( 'Name (Required)', 'pwvintage'); ?></label>
                    <input type="text" name="author" size="30" class="text-input" id="form-comment-name"/>
                </div>
                <div>
                    <label for="email" id="form-email-label" class="label-title"><?php _e( 'Email (Required)', 'pwvintage'); ?></label>
                    <input type="text" name="email" size="30" class="text-input" id="form-comment-email"/>
                </div>
                <div>
                    <label for="website" id="form-website-label" class="label-title"><?php _e( 'Website', 'pwvintage'); ?></label>
                    <input type="text" name="url" size="30" class="text-input" id="form-comment-website"/>
                </div>
                <?php endif; ?>
                <label for="message" id="form-message-label" class="label-title"><?php _e( 'Message (Required)', 'pwvintage'); ?></label>						
                <textarea name="comment" id="form-comment-message" class="text-input-big"></textarea>
                <br />
                <input type="submit" value="Post Comment" class="button"/>	
                <?php comment_id_fields(); ?>
				<?php do_action('comment_form', $post->ID); ?>					
            </fieldset>
        </form>
        <?php endif;
		// registration required and not logged in ?>
    </div>
    </div>		
</div>
<?php else :?>
<?php endif;?>