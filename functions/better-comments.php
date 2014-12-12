<?php
function better_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div class="comment" id="comment-<?php comment_ID(); ?>">
            <div class="comment-meta">
                <p><strong><?php comment_author_link() ?></strong> on <span><?php comment_date('n-j-Y'); ?></span> at <span><?php comment_time() ?></span></p>
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>						
            </div>
            <div class="comment-content">					
                <?php echo get_avatar($comment, $size = '60'); ?>	
                <div>
                    <p><?php comment_text() ?></p>
					<?php if ($comment->comment_approved == '0') : ?>
                        <p style="font-style:italic;"><?php _e('Your comment is awaiting moderation.','pwvintage') ?></p>
                        <br />
                    <?php endif; ?>
					<?php edit_comment_link(__('(Edit)'),'  ','') ?>
                </div>
            </div>
        </div>

<?php
}
?>