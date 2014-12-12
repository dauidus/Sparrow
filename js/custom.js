jQuery(document).ready(function(){
	jQuery("ul.sf-menu").supersubs({ 
	minWidth		: 12,		// requires em unit.
	maxWidth		: 27,		// requires em unit.
	extraWidth		: 0	// extra width can ensure lines don't sometimes turn over due to slight browser differences in how they round-off values
						   // due to slight rounding differences and font-family 
	}).superfish();  // call supersubs first, then superfish, so that subs are 
					 // not display:none when measuring. Call before initialising 
					 // containing tabs for same reason. 
});
jQuery(document).ready(function() {
	/*
	var defaults = {
		containerID: 'moccaUItoTop', // fading element id
		containerHoverClass: 'moccaUIhover', // fading element hover class
		scrollSpeed: 1200,
		easingType: 'linear' 
	};
	*/
	
	jQuery().UItoTop({ easingType: 'easeOutQuart' });
	
});
jQuery(document).ready(function(){
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		allow_resize: true,
	});
  });

jQuery(document).ready(function(){
	jQuery("a.highlight").hover(function(){
		jQuery(this).stop().animate({backgroundColor:"#444"},  400);
	},function(){
		jQuery(this).stop().animate({backgroundColor:"#60817A"},  400);
	});
});
jQuery(document).ready(function(){
	jQuery("img.image-deco, .avatar, .twtr-img a img").hover(function(){
		jQuery(this).stop().animate({backgroundColor:"#60817A"},  400);
	},function(){
		jQuery(this).stop().animate({backgroundColor:"#fff"},  400);
	});
});


function clearText(field){
	if (field.defaultValue==field.value)
	field.value = ""
} 




	//CLEAR FORM FIELD ON FOCUS
	
	var name = jQuery('.location .text input.txt').val();
	
	if (name == '') { jQuery('.location .text input.txt').val('Name') };
	
	jQuery('.location .text input.txt').focus(function() {
		var val = jQuery(this).val();
		if(val == 'Enter your starting address'){	jQuery(this).val(''); }
	});
	
	jQuery('.location .text input.txt').blur(function() {
		var val = jQuery(this).val();
		if(val == ''){	jQuery(this).val('Enter your starting address'); }
	});





