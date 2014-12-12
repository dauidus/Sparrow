<?php get_header(' '); ?>
	<div id="banner">
    	<div class="wrapper-960">
    		<h2>Search Results For: "<?php the_search_query(); ?>"</h2>
        </div>
    </div>
    <div id="blog-wrapper" class="wrapper-960">
    	<?php get_sidebar('page'); ?>
        
        <div class="blog-wrapper">
        	<div class="tabs">
			<?php if (have_posts()) : ?>                
            	<?php while (have_posts()) : the_post(); ?>
                    <div class="blog-post">
                    	<div class="blog-post-left">
                        	<div class="blog-post-date">
                            	<p><?php the_time('F') ?></p>
                                <h4><?php the_time('jS') ?></h4>
                                <p><?php the_time('Y') ?></p>
                            </div>
                            <div class="blog-post-categories">
                            	<span class="symbols">, </span><?php the_category(' '); ?>
                            </div>
                            <div class="blog-post-comments">
                            	<span class="symbols">c </span><?php comments_popup_link('0 Comment', '1 Comment', '% Comments'); ?>
                            </div>
                        </div>
                        <div class="blog-post-right">
                            <div class="blog-post-header">
                                <h4 class="blog-post-title"><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></h4>
                            </div>
                            <?php if ( has_post_thumbnail()) : ?>
                                <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
								<?php $website_url = get_bloginfo('wpurl'); ?>
                                <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>
                                <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                <a href="<?php echo $thumbnail; ?>" class="post-image" title="<?php the_title(); ?>" rel="prettyPhoto">
                                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=230&amp;w=522&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" class="blog-post-image image-deco" alt=""/>
                                </a>
                            <?php endif; ?> 
                            <div class="blog-post-content">
                                <p>
                                    <?php the_news_excerpt('30','','','plain','no'); ?>
                                </p>
                            </div>
                    	</div>
                    </div>
                    <div class="slash blog-width"></div>
                    <?php endwhile; ?>
                    <?php else : ?>
                    <h4 class="blog-post-title" style="width:660px;"><?php _e('Sorry, nothing found for that search. Try another search:','pwvintage') ?></h4>
                    <form method="get" id="searchbar" action="<?php bloginfo('url'); ?>/" >
                    <input type="text" style="min-height:33px;max-height:33px;min-width:332px;max-width:332px;margin:20px;" class="text-input" name="s" id="search" value=""/>
                    <input type="submit" value="" id="searchsubmit" />
                    </form>
				<?php endif; ?>
            </div>
            <?php if (function_exists("pagination")) { ?>
            <div class="tabs">
                <ul class="tabNavigation">
                    <?php pagination(); ?>
                </ul>
             </div> 
             <?php } ?> 
        </div>
	</div>
<?php get_footer(' '); ?>  