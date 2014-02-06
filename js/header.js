var popped = false;
var initialURL = location.href;
var elevator_position = 4;
var first_page_load = true;
var elevator_speed = 500;

$(document).ready(function(e) {
		
	check_location();
	navigation_eventlistener();
	scroll_eventlistener();
	
	$(window).bind("popstate",function(e) {
		
		// Ignore inital popstate that some browsers fire on page load
		var initialPop = !popped && location.href == initialURL;
		popped = true;
		if (initialPop) return;
		
		get_page_by_request_uri(location.pathname);
	});
});

function scroll_eventlistener() {

	$(window).bind("scroll", function() {
    
      position_top = parseInt($(document).scrollTop());
    
      window_height = $(window).height();
	  
	  section_number = Math.floor(position_top/window_height);
	  
	  set_elevator_to(section_number);
	  
    });
}

function set_elevator_to(section) {
		
	if (section < 0) {
		
		section = 0;
	}
	
	if (elevator_position != section) {
		
		new_href = $(".nav ul li:nth-child(" + (section+1) + ") a").attr("href");
		
		if (history.state.page != new_href) {
		
			history.pushState({page:new_href}, null, new_href);
		}
		
		new_position = section * $(".nav ul li").height();
		
		/* New position for elevator */
		$("#elevator").animate({
			
			top: new_position
		},elevator_speed);
		
		elevator_position = section;
	}
}

function check_location() {
	
	if (history && history.pushState) {
			
		history.pushState({page:location.pathname}, null, location.pathname);
		
		get_page_by_request_uri(location.pathname);
	}
}

function navigation_eventlistener() {
	
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
	
	if (first_page_load) {
		
		first_page_load = false;
		
		set_elevator_to($("section[ref='" + section + "']").index());
		$(document).scrollTop($("section[ref='" + section + "']").offset().top);
	}
	else {

		$('html, body').animate({ 
		   scrollTop: $("section[ref='" + section + "']").offset().top}, 
		   1000, 
		   "easeOutQuint"
		);	
	}
}