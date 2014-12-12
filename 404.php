<?php get_header(); ?>
	<div id="banner">
    	<div class="wrapper-960">
    		<h2><?php _e('404 Error - Page Not Found!', 'pwvintage') ?></h2>
        </div>
    </div>
    <div id="page-wrapper" class="wrapper-960">
    	<?php get_sidebar('page'); ?>
        
        <div class="blog-wrapper">
        	<div class="tabs">            
                <div class="blog-post">
                    <h2><?php _e('The page you try to looking for couldn\'t be retrieved. Try another search, please:', 'pwvintage')?></h2>
                    <form method="get" id="searchbar" action="<?php bloginfo('home'); ?>/" >
                    <input type="text" style="min-height:33px;max-height:33px;min-width:332px;max-width:332px;margin:20px;" class="text-input" name="s" id="search" value=""/>
                    <input type="submit" value="" id="searchsubmit" />
                    </form>
                </div>     
            </div> 
        </div>
	</div>
<?php get_footer(' '); ?>  