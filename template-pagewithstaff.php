<?php
/*
Template Name: Page with Staff
*/
?>

<?php get_header(); ?>
	<div id="banner">
    	<div class="wrapper-960">
    		<h2><?php the_title(); ?></h2>
        </div>
    </div>
    <div id="page-wrapper" class="wrapper-960">
    	<?php get_sidebar('pagewithstaff'); ?>
        
        <div class="blog-wrapper" style="border-right:solid #000 1px;">
        	<div class="tabs">
            	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>               
                    <div class="blog-post">
                        <?php if ( has_post_thumbnail()) : ?>
                        	<a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('blog', array('class' => 'blog-post-image image-deco','alt'	=> 'img')); ?></a>
                        <?php endif; ?>
                        <div class="blog-post-content">
                           	<?php the_content(); ?> 
                        </div>
                    </div>
                    <?php endwhile; ?>
				<?php endif; ?>
            </div> 
        </div>
	</div>
<?php get_footer(' '); ?>  
