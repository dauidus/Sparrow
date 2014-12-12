$(document).ready(function() {
	//When page loads...
	$(".tab-content").hide(); //Hide all content
	$("ul.tabs-services li:first").addClass("active").show(); //Activate first tab
	$(".tab-content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs-services li").click(function() {

		$("ul.tabs-services li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab-content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});