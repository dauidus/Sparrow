<?php
// load the theme options
$options = get_option( 'thefirst_theme_settings' );
?>
<?php get_header(' '); ?>
<script type="text/javascript">
	/*
	the images preload plugin
	*/
	(function($) {
		$.fn.preload = function(options) {
			var opts 	= $.extend({}, $.fn.preload.defaults, options),
				o		= $.meta ? $.extend({}, opts, this.data()) : opts;
			return this.each(function() {
				var $e	= $(this),
					t	= $e.attr('rel'),
					i	= $e.attr('href'),
					l	= 0;
				$('<img/>').load(function(i){
					++l;
					if(l==2) o.onComplete();
				}).attr('src',i);	
				$('<img/>').load(function(i){
					++l;
					if(l==2) o.onComplete();
				}).attr('src',t);	
			});
		};
		$.fn.preload.defaults = {
			onComplete	: function(){return false;}
		};
	})(jQuery);
</script>
<script type="text/javascript">
	$(function() {
		//some elements..
		var $ps_container		= $('#ps_container'),
			$ps_image_wrapper 	= $ps_container.find('.ps_image_wrapper'),
			$ps_next			= $ps_container.find('.ps_next'),
			$ps_prev			= $ps_container.find('.ps_prev'),
			$ps_nav				= $ps_container.find('.ps_nav'),
			$tooltip			= $ps_container.find('.ps_preview'),
			$ps_preview_wrapper = $tooltip.find('.ps_preview_wrapper'),
			$links				= $ps_nav.children('li').not($tooltip),
			total_images		= $links.length,
			currentHovered		= -1,
			current				= 0,
			$loader				= $('#loader');
		
		/*check if you are using a browser*/	
		var ie 				= false;
		if ($.browser.msie) {
			ie = true;//you are not!Anyway let's give it a try
		}
		if(!ie)
			$tooltip.css({
				opacity	: 0
			}).show();
			
			
		/*first preload images (thumbs and large images)*/
		var loaded	= 0;
		$links.each(function(i){
			var $link 	= $(this);
			$link.find('a').preload({
				onComplete	: function(){
					++loaded;
					if(loaded == total_images){
						//all images preloaded,
						//show ps_container and initialize events
						$loader.hide();
						$ps_container.show();
						//when mouse enters the pages (the dots),
						//show the tooltip,
						//when mouse leaves hide the tooltip,
						//clicking on one will display the respective image	
						$links.bind('mouseenter',showTooltip)
							  .bind('mouseleave',hideTooltip)
							  .bind('click',showImage);
						//navigate through the images
						$ps_next.bind('click',nextImage);
						$ps_prev.bind('click',prevImage);
					}
				}
			});
		});
		
		function showTooltip(){
			var $link			= $(this),
				idx				= $link.index(),
				linkOuterWidth	= $link.outerWidth(),
				//this holds the left value for the next position
				//of the tooltip
				left			= parseFloat(idx * linkOuterWidth) - $tooltip.width()/2 + linkOuterWidth/2,
				//the thumb image source
				$thumb			= $link.find('a').attr('rel'),
				imageLeft;
			
			//if we are not hovering the current one
			if(currentHovered != idx){
				//check if we will animate left->right or right->left
				if(currentHovered != -1){
					if(currentHovered < idx){
						imageLeft	= 75;
					}
					else{
						imageLeft	= -75;
					}
				}
				currentHovered = idx;
				
				//the next thumb image to be shown in the tooltip
				var $newImage = $('<img/>').css('left','0px')
										   .attr('src',$thumb);
				
				//if theres more than 1 image 
				//(if we would move the mouse too fast it would probably happen)
				//then remove the oldest one (:last)
				if($ps_preview_wrapper.children().length > 1)
					$ps_preview_wrapper.children(':last').remove();
				
				//prepend the new image
				$ps_preview_wrapper.prepend($newImage);
				
				var $tooltip_imgs		= $ps_preview_wrapper.children(),
					tooltip_imgs_count	= $tooltip_imgs.length;
					
				//if theres 2 images on the tooltip
				//animate the current one out, and the new one in
				if(tooltip_imgs_count > 1){
					$tooltip_imgs.eq(tooltip_imgs_count-1)
								 .stop()
								 .animate({
									left:-imageLeft+'px'
								  },150,function(){
										//remove the old one
										$(this).remove();
								  });
					$tooltip_imgs.eq(0)
								 .css('left',imageLeft + 'px')
								 .stop()
								 .animate({
									left:'0px'
								  },150);
				}
			}
			//if we are not using a "browser", we just show the tooltip,
			//otherwise we fade it
			//
			if(ie)
				$tooltip.css('left',left + 'px').show();
			else
			$tooltip.stop()
					.animate({
						left		: left + 'px',
						opacity		: 1
					},150);
		}
		
		function hideTooltip(){
			//hide / fade out the tooltip
			if(ie)
				$tooltip.hide();
			else
			$tooltip.stop()
					.animate({
						opacity		: 0
					},150);
		}
		
		function showImage(e){
			var $link				= $(this),
				idx					= $link.index(),
				$image				= $link.find('a').attr('href'),
				$currentImage 		= $ps_image_wrapper.find('img'),
				currentImageWidth	= $currentImage.width();
			
			//if we click the current one return
			if(current == idx) return false;
			
			//add class selected to the current page / dot
			$links.eq(current).removeClass('selected');
			$link.addClass('selected');
			
			//the new image element
			var $newImage = $('<img/>').css('left',currentImageWidth + 'px')
									   .attr('src',$image);
			
			//if the wrapper has more than one image, remove oldest
			if($ps_image_wrapper.children().length > 1)
				$ps_image_wrapper.children(':last').remove();
			
			//prepend the new image
			$ps_image_wrapper.prepend($newImage);
			
			//the new image width. 
			//This will be the new width of the ps_image_wrapper
			var newImageWidth	= $newImage.width();
		
			//check animation direction
			if(current > idx){
				$newImage.css('left',-newImageWidth + 'px');
				currentImageWidth = -newImageWidth;
			}	
			current = idx;
			//animate the new width of the ps_image_wrapper 
			//(same like new image width)
			$ps_image_wrapper.stop().animate({
				width	: newImageWidth + 'px'
			},350);
			//animate the new image in
			$newImage.stop().animate({
				left	: '0px'
			},350);
			//animate the old image out
			$currentImage.stop().animate({
				left	: -currentImageWidth + 'px'
			},350);
		
			e.preventDefault();
		}				
		
		function nextImage(){
			if(current < total_images){
				$links.eq(current+1).trigger('click');
			}
		}
		function prevImage(){
			if(current > 0){
				$links.eq(current-1).trigger('click');
			}
		}
	});
</script>
<div id="banner">
    <div class="wrapper-960">
        <h2><?php the_title(' '); ?></h2>
    </div>
</div>    
<?php if (have_posts()) : ?>                
	<?php while (have_posts()) : the_post(); ?>
    <div id="blog-wrapper" class="wrapper-960">
    	<div class="sidebar-wrapper">
        	<div class="sidebar-box">
            	<h4 class="blog-sidebar-title"><span class="sidebar-title"><?php _e( 'Category', 'pwvintage'); ?></span></h4>
                <h4>
                    <span class="sidebar-portolio-cats"><?php the_terms($post->ID, 'portfolio_cats', '<div class="home-page-terms"><div class="filterable-bg"></div>', '</div><div class="home-page-terms"><div class="filterable-bg"></div>', '</div>'); ?></span>
                </h4>
            </div>
            <?php 
				if(trim(get_post_meta($post->ID, 'copyright', true)) != ""){
			?>
            <div class="sidebar-box">
            	<h4 class="blog-sidebar-title"><span class="sidebar-title"><?php _e( 'Copyright', 'pwvintage'); ?></span></h4>
                <?php echo get_post_meta($post->ID, 'copyright', true); ?>
            </div>
            <?php } ?>
            <?php 
				if(trim(get_post_meta($post->ID, 'project-url', true)) != ""){
			?>
            <div class="sidebar-box">
            	<h4 class="blog-sidebar-title"><span class="sidebar-title"><?php _e( 'Project URL', 'pwvintage'); ?></span></h4>
                <a href="<?php echo get_post_meta($post->ID, 'project-url', true); ?>" target="_blank" class="project-url"><?php echo get_post_meta($post->ID, 'project-url', true); ?></a>
            </div>
            <?php } ?>
            <div class="sidebar-box">
            	<h4 class="blog-sidebar-title"><span class="sidebar-title"><?php _e( 'Content', 'pwvintage'); ?></span></h4>
                <p>
					<?php the_content(); ?>
                </p>
            </div> 
            <?php get_sidebar('portfolio'); ?>
        </div>
        
        <div class="portfolio-wrapper">
        
        	<div class="tabs">
                    <div class="blog-post">
                    	<div id="ps_container" class="ps_container">
                            <div class="ps_image_wrapper">
                                <!-- First initial image -->
                                <?php if(trim(get_post_meta($post->ID, 'portfolio-image-1', true)) != ""){ ?>
                                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-1', true); ?>&amp;h=419&amp;w=628&amp;zc=1&amp;q=100" alt="" />
                                <?php }else if(trim(get_post_meta($post->ID, 'portfolio-image-2', true)) != ""){ ?>
                                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-2', true); ?>&amp;h=419&amp;w=628&amp;zc=1&amp;q=100" alt="" />
                                <?php }else if(trim(get_post_meta($post->ID, 'portfolio-image-3', true)) != ""){ ?>
                                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-3', true); ?>&amp;h=419&amp;w=628&amp;zc=1&amp;q=100" alt="" />
                                <?php }else if(trim(get_post_meta($post->ID, 'portfolio-image-4', true)) != ""){ ?>
                                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-4', true); ?>&amp;h=419&amp;w=628&amp;zc=1&amp;q=100" alt="" />
                                <?php }else if(trim(get_post_meta($post->ID, 'portfolio-image-5', true)) != ""){ ?>
                                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-5', true); ?>&amp;h=419&amp;w=628&amp;zc=1&amp;q=100" alt="" />
                                <?php } ?>
                            </div>
                            
                            <!-- Dot list with thumbnail preview -->
                            <ul class="ps_nav">
                            	<?php if(trim(get_post_meta($post->ID, 'portfolio-image-1', true)) != ""){ ?>
                                <li class="selected"><a href="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-1', true); ?>&amp;h=419&amp;w=628&amp;zc=1&amp;q=100" rel="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-1', true); ?>&amp;h=75&amp;w=75&amp;zc=1&amp;q=100"><?php the_title('') ?></a></li>
                                <?php } ?>
                                <?php if(trim(get_post_meta($post->ID, 'portfolio-image-2', true)) != ""){ ?>
                                <li><a href="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-2', true); ?>&amp;h=419&amp;w=628&amp;zc=1&amp;q=100" rel="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-2', true); ?>&amp;h=75&amp;w=75&amp;zc=1&amp;q=100"><?php the_title('') ?></a></li>
                                <?php } ?>
                                <?php if(trim(get_post_meta($post->ID, 'portfolio-image-3', true)) != ""){ ?>
                                <li><a href="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-3', true); ?>&amp;h=419&amp;w=628&amp;zc=1&amp;q=100" rel="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-3', true); ?>&amp;h=75&amp;w=75&amp;zc=1&amp;q=100"><?php the_title('') ?></a></li>
                                <?php } ?>
                                <?php if(trim(get_post_meta($post->ID, 'portfolio-image-4', true)) != ""){ ?>
                                <li><a href="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-4', true); ?>&amp;h=419&amp;w=628&amp;zc=1&amp;q=100" rel="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-4', true); ?>&amp;h=75&amp;w=75&amp;zc=1&amp;q=100"><?php the_title('') ?></a></li>
                                <?php } ?>
                                <?php if(trim(get_post_meta($post->ID, 'portfolio-image-5', true)) != ""){ ?>
                                <li><a href="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-5', true); ?>&amp;h=419&amp;w=628&amp;zc=1&amp;q=100" rel="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo get_post_meta($post->ID, 'portfolio-image-5', true); ?>&amp;h=75&amp;w=75&amp;zc=1&amp;q=100"><?php the_title('') ?></a></li>
                                <?php } ?>
                                
                                <li class="ps_preview">
                                    <div class="ps_preview_wrapper">
                                        <!-- Thumbnail comes here -->
                                    </div>
                                    <!-- Little triangle -->
                                    <span></span>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Get portfolio video embbed -->
                        <?php 
							if(trim(get_post_meta($post->ID, 'portfolio-video-embed', true)) != ""){
						?>
                        <div class="portfolio-video-embbed">
                        	<?php echo stripslashes(htmlspecialchars_decode(get_post_meta($post->ID, 'portfolio-video-embed', true))) ?>
                        </div>
                        <?php } ?>                        
                        <!-- End portfolio video embbed -->
                        
                        
                        <div class="blog-post-content">
                            
                        </div>
                        <?php if ( has_tag()) : ?>
                        <h3 class="h3-tags">Tags: </h3><?php the_tags('<ul id="portfolio-filter" class="clearfix"><li><div class="filterable-bg"></div>','</li><li><div class="filterable-bg"></div>', '</li></ul>'); ?>
                        <?php endif; ?>
                        <?php
						// check if the related posts are disabled
						if ($options['disable_related_portfolio'] == "enable") { ?>
                        <?php 
						$cats = wp_get_post_terms($post->ID, 'portfolio_cats');
						if ($cats) { ?>
						
                        <div class="related-blog-posts">
							<?php
                            // check if user has added a custom title
                            if($options['related_portfolio_title'] != '') { ?>
                            <h4><?php echo stripslashes($options['related_portfolio_title']);  ?></h4>
                            <?php } else { ?>
                            <h4><?php _e( 'Related Projects','pwvintage'); ?></h4>
                            <?php } ?> 
							<?php
							$args = array(
								'post__not_in' => array( $post->ID ),
								'orderby'=> 'post_date',
								'order' => 'rand',
								'post_type' => 'portfolio',
								'posts_per_page' => 4,
								'tax_query' => array(
									'relation' => 'OR',
									array(
										'taxonomy' => 'portfolio_cats',
										'terms' => $cats[0]->term_id
									),
								)
							);
							$my_query = new WP_Query($args);
							
							if( $my_query->have_posts() ) {
							while ($my_query->have_posts()) : $my_query->the_post();
							
							?>
                            <div class="small-post" style="width:650px; margin-top:10px;">
								<?php
								// check if post has a thumbnail
								if ( has_post_thumbnail() ) { ?>
                                	<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                    <?php $website_url = get_bloginfo('wpurl'); ?>
                                    <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>
                                    <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                    <a href="<?php echo $thumbnail; ?>" class="post-image" title="<?php the_title(); ?>" rel="prettyPhoto">
                                        <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=62&amp;w=100&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" class="small-post-img image-deco" alt=""/>
                                    </a>
                                <h4 class="small-post-title" style="width:510px;"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                                <?php the_news_excerpt('20','','','plain','no'); ?>
                                <?php }else { //show this if post doesn't have thumbnail ?>
                                <h4 class="small-post-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                                <?php the_news_excerpt('20','','','plain','no'); ?>
                                <?php } ?>
                            </div>
                            <?php
							endwhile; 
							wp_reset_query(); } } ?>
                    	</div>
                        <div class="deco"></div>
                        <?php } ?>
                    </div>
                    
                    
            </div>
            
            <!-- Check whether comment disabled -->
            <?php if($options['disable_portfolio_comment'] == "enable"){ ?>
            <?php comments_template(); ?>
            <?php } ?>
            
            <?php endwhile; ?>
		<?php endif; ?>
        </div>
	</div>
<?php get_footer(' '); ?>  
