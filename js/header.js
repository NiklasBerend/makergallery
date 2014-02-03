var popped = false;
var initialURL = location.href;

$(document).ready(function(e) {
		
	check_location();
	navigation_eventlisteners();
	
	$(window).bind("popstate",function(e) {
		
		// Ignore inital popstate that some browsers fire on page load
		var initialPop = !popped && location.href == initialURL;
		popped = true;
		if (initialPop) return;
		
		get_page_by_request_uri(location.pathname);
	});
});

function check_location() {
	
	if (history && history.pushState) {
			
		history.pushState({page:location.pathname}, null, location.pathname);
		
		get_page_by_request_uri(location.pathname);
	}
}

function navigation_eventlisteners() {
	
	$(document).on("click",".nav a",function(e) {
		
		e.preventDefault();
		
		if (history && history.pushState) {
				
			history.pushState({page:$(this).attr("href")}, null, $(this).attr("href"));
			
			get_page_by_request_uri(location.pathname);
		}
	});
}

function get_page_by_request_uri(uri) {
	
	urlparts = uri.split("/");
	
	request = "";
	
	for(i=1;i<urlparts.length;i++) {
		
		if (global_url_prefix.indexOf(urlparts[i]) == -1) {
			
			request+= urlparts[i] + "/";
		}
	}
	
	section = request.substring(0,request.indexOf("/"));
	
	/* SCROLLEVENT */
	scroll_to(section);
}

function scroll_to(section) {

	$('html, body').animate({ 
	   scrollTop: $("section[ref='" + section + "']").offset().top}, 
	   1000, 
	   "easeOutQuint"
	);	
}