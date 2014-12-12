<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(' '); ?>
	<div id="banner">
    	<div class="wrapper-960">
    		<h2><?php the_title(); ?></h2>
        </div>
    </div>
    <div id="full-width-wrapper" class="wrapper-960">	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
    		<?php the_content(); ?>
    	<?php endwhile; ?>
    	<?php endif; ?>	   
	</div>
<?php get_footer(' '); ?>  