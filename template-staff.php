<?php
/*
Template Name: Staff
*/

get_header();
?>

	<div id="banner">
    	<div class="wrapper-960">
    		<h2><?php the_title(); ?></h2>
        </div>
    </div>
    <div id="page-wrapper" class="wrapper-960">
    	
        
        <div class="blog-wrapper">


   			<?php if ( have_posts() ) : $count = 0; ?>
   			<?php while ( have_posts() ) : the_post(); $count++; ?>
   			    <?php
//custom field
$menu_additional_info = get_post_meta( $post->ID, 'menu_additional_info', true );
$menu_pdf = get_post_meta( $post->ID, 'menu_pdf', true );
?>
                        <div class="blog-post-content">
                           	<?php the_content(); ?> 
                        </div>

   			<?php endwhile; endif; ?>

   		</div>


   			<table>

   			    <thead>
   			    	<tr>
   			    		<th colspan="3"></th>
   			    	</tr>
   			    </thead>
   			    <?php if ( $term->description != '' ) { ?>
   			    <tfoot>
   			    	<tr class="asterix-info">
   			    		<td  colspan="3"><span id="info-1">*</span> <?php echo $term->description; ?></td>
   			    	</tr>
   			    </tfoot>
   			    <?php } ?>
   			    <tbody>


				<?php
			$owner = get_users(array( 'role' => 'MamaBird', 'exclude' => '4', 'order' => 'desc' ) );
			$manager = get_users(array( 'role' => 'BabyBird' ) );
			$display_admins = false;
			$authors = array_merge($owner, $manager);
?> 

         <?php
         $c = 0; // set up a counter so we know which post we're currently showing
         $extra_class = 'even' // set up a variable to hold an extra CSS class
         ?>
    
<?php foreach( $authors as $author ) {  ?>   

<?php
         $c++; // increment the counter
         if( $c % 2 != 0) {
	  // we're on an odd post
	   $extra_class = 'odd';
         } else {
         $extra_class = 'even'; }
         ?>
         

   			    	<tr <?php post_class($extra_class) ?>>
   			    		<td class="image" style="height:195px; width:190px;"> <?php echo get_avatar( $author->ID, '170' ); ?></td>
   			    		<td class="details">
   			    			<h3 style="color: #F8F5ED;background: url(<?php bloginfo( 'template_url' ) ?>/images/social_media_bg.jpeg);border-bottom: 1px solid #302929;border-right: 1px solid #302929;padding: 0px 10px;margin-left: -10px;margin-bottom:10px;margin-top:5px;width: 360px !important;display: block;font-family: Nilland; font-size:20px;text-shadow: 0px 1px 1px rgba(0, 0, 0, .2);"><?php the_author_meta( 'user_firstname', $author->ID ); ?> <?php the_author_meta( 'user_lastname', $author->ID ); ?></h3>
   			    			<?php the_author_meta( 'description', $author->ID ); ?>
   			    		</td>
   			    	</tr>

   			    <?php } ?>


        		
   			    </tbody>


   			</table>



    </div><!-- /#content -->

<?php get_footer(); ?>