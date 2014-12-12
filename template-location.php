<?php
/*
Template Name: Location
*/
?>

<?php get_header(); ?>
    <script type="text/javascript">
    jQuery(document).ready(function(){
		
		// Make the directions popup draggable. // 2010-11-14.
		jQuery('#directions').css('cursor', 'move');
		jQuery('#directions').draggable();
		

		
	});
    </script>  
    
    <div id="banner">
    	<div class="wrapper-960">
    		<h2><?php the_title(); ?></h2>
        </div>
    </div>
    
     
    <div class="footer-960 location">
    
    	<div class="text">
    	
    		<h2 class="title"><?php _e('Location', 'woothemes'); ?></h2>
    		
    		<address><?php echo nl2br(get_option('woo_diner_address')); ?></address>
    		
    		<h3><?php _e('Directions', 'woothemes'); ?></h3>
    		
    		<p><?php _e('Enter your current location below to generate directions to The Nest.', 'woothemes'); ?></p>
    		
    		<form id="directions-form" name="directions-form" method="post" action="#">
    		
    			<input class="txt" type="text" name="address" style="margin-bottom:5px;" value="<?php _e('Enter your starting address', 'woothemes'); ?>" />
    			<span style="font-size:13px; margin-left:50px;">(we do not save your information)</span>
    			
    			<a class="button" href="#" ><?php _e('Get Directions', 'woothemes'); ?></a>
    		
    		</form>
    	
    		<script type="text/javascript">	

				var directionsDisplay;
				var directionsService = new google.maps.DirectionsService();
				var map;
				
				function initialize_directions(fromdir, todir) {
				  directionsDisplay = new google.maps.DirectionsRenderer();
				  var chicago = new google.maps.LatLng(41.850033, -87.6500523);
				  var myOptions = {
				    zoom:7,
				    mapTypeId: google.maps.MapTypeId.ROADMAP,
				    center: chicago
				  }
				  map = new google.maps.Map(document.getElementById("featured_overview"), myOptions);
				  directionsDisplay.setMap(map);
				  directionsDisplay.setPanel(document.getElementById("direction-result"));
				  calcRoute(fromdir, todir)
				}
				
				function calcRoute(fromdir, todir) {
				  var start = fromdir;
				  var end = todir;
				  var request = {
				    origin:start,
				    destination:end,
				    travelMode: google.maps.TravelMode.DRIVING
				  };
				  directionsService.route(request, function(response, status) {
				    if (status == google.maps.DirectionsStatus.OK) {
				      directionsDisplay.setDirections(response);
				    } else if (status == google.maps.DirectionsStatus.INVALID_REQUEST) {
 		  				jQuery('#direction-result').show().html('The request was invalid. Please try again.');
 					} else if (status == google.maps.DirectionsStatus.MAX_WAYPOINTS_EXCEEDED) {
   						jQuery('#direction-result').show().html('Too many Waypoints were provided in the request. The total allowed waypoints is 8, plus the origin and destination.');
 					} else if (status == google.maps.DirectionsStatus.OVER_QUERY_LIMIT) {
   						jQuery('#direction-result').show().html('The webpage has gone over the requests limit in too short a period of time.');
   					} else if (status == google.maps.DirectionsStatus.REQUEST_DENIED) {
   						jQuery('#direction-result').show().html('The webpage is not allowed to use the directions service.');
   					} else if (status == google.maps.DirectionsStatus.ZERO_RESULTS) {
   						jQuery('#direction-result').show().html('No route could be found between the origin and destination.');
 		 			} else if (status == google.maps.DirectionsStatus.NOT_FOUND) {
   						jQuery('#direction-result').show().html('At least one of the origin, destination, or waypoints could not be geocoded.');
 		 			} else {
 		 				jQuery('#direction-result').show().html('An unknown error occurred. Please try again');
					}
				  });
				}
  				
    	jQuery(document).ready(function(){
    		//DIRECTIONS LIGHTBOX
	
			jQuery('.location .text .button').click(function(){
    	
        		jQuery('.location #directions').toggle();
        		
        		var fromdir = jQuery('#directions-form input.txt').val();
        		var todir = '<?php echo get_option('woo_diner_map_latitude').', '.get_option('woo_diner_map_longitude'); ?>';
        		
        		jQuery('#direction-result').text('');
        		initialize_directions(fromdir, todir);
        		
        		if(jQuery('#overlay').length > 0){
        			jQuery('#overlay').remove();
        		} else {
        			jQuery('body').append('<div id="overlay"></div>');
        			var doc_height = jQuery(document).height();
        			jQuery('#overlay').height(doc_height);
        			jQuery('#overlay').click(function(){
        				jQuery('.location #directions').toggle();
        				jQuery(this).remove();
        			});
        		}
        
    
    		});
    		
    		//PRINT EVENT
    		jQuery('#print-directions').click(function(){
    			w=window.open();
				w.document.write(jQuery('#direction-result').html());
				w.print();
				w.close();
    		});
    		
    		

    	
		});
		</script>
		
    	</div><!-- /.text -->
    	
    	<div class="map">
    		
    		<div class="map-frame">
    			<div class="woo_map_single_output">
                    <?php
                            				
							$zoom = get_option('woo_diner_map_zoom_level');
							if(empty($zoom)) $zoom = '6';
							$type = get_option('woo_diner_map_type');
							switch ($type) {
								case 'G_NORMAL_MAP':
			  						$type = 'ROADMAP';
			  						break;
			  					case 'G_SATELLITE_MAP':
			  						$type = 'SATELLITE';
			  						break;
			  					case 'G_HYBRID_MAP':
			  						$type = 'HYBRID';
			  						break;
			  					case 'G_PHYSICAL_MAP':
			  						$type = 'TERRAIN';
			  						break;
			  					case 'Normal':
									$type = 'ROADMAP';
									break;
								case 'Satellite':
									$type = 'SATELLITE';
									break;
								case 'Hybrid':
									$type = 'HYBRID';
									break;
								case 'Terrain':
									$type = 'TERRAIN';
									break;
								default:
									$type = 'ROADMAP';
									break;
							}
							
							$center = get_option('woo_diner_map_latitude').', '.get_option('woo_diner_map_longitude');
		
							// No More API Key needed
							
							?>
							<div id="featured_overview" style="height:390px; width:540px"></div>
							<?php		
			
							/* Maps Bit */	
							if(!empty($center)) { $center_final = $center; }
		
							?>
							<script src="<?php bloginfo('template_url'); ?>/includes/js/markers.js" type="text/javascript"></script>
							<script type="text/javascript">
							// Creates a marker and returns
    						jQuery(document).ready(function(){
    							
								function initialize() {
								 
									var myLatlng = new google.maps.LatLng(<?php echo $center_final; ?>);
									var myOptions = {
									  zoom: <?php echo $zoom; ?>,
									  center: myLatlng,
									  mapTypeId: google.maps.MapTypeId.<?php echo $type; ?>
									};
									
									var map = new google.maps.Map(document.getElementById("featured_overview"),  myOptions);
									<?php if(get_option('woo_maps_scroll') == 'true'){ ?>
			  						map.scrollwheel = false;
			  						<?php } ?>
			  						
      								var point = new google.maps.LatLng(<?php echo $center; ?>);
	  								var root = "<?php bloginfo('template_url'); ?>";
	  								var the_link = '<?php echo get_permalink(); ?>';
	  								<?php $title = str_replace(array('&#8220;','&#8221;'),'"',get_the_title()); ?>
	  								<?php $title = str_replace('&#8211;','-',$title); ?>
	  								<?php $title = str_replace('&#8217;',"`",$title); ?>
	  								<?php $title = str_replace('&#038;','&',$title); ?>
	  								var the_title = '<?php echo html_entity_decode($title) ?>'; 
	  										
	  								var color = 'blue';
	  								createMarker(map,point,root,the_link,the_title,color); 
								 	 
							}
						initialize();
						});
						</script>
						
                    </div>
            </div>

    	
    	</div><!-- /.map -->
    	
    	<div id="directions">
    		
    		<h4>
    			<?php _e('Directions', 'woothemes'); ?>
    			<span>
    				<a id="print-directions" class="print" href="#" title="<?php _e('Print Directions', 'woothemes'); ?>"><?php _e('Print', 'woothemes'); ?></a>
       			</span>
    		</h4>
    		
    		<p id="direction-result"><?php _e('Directions go here', 'woothemes'); ?></p>
    		
    	</div>
    </div>
    
    <div class="clear"></div>
    
<?php get_footer(); ?>