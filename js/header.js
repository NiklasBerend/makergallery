var popped = false;
var initialURL = location.href;
var elevator_position = 4;
var first_page_load = true;
var elevator_speed = 500;
var paging_speed = 200;
var scrollPosition;

$(document).ready(function(e) {
		
	check_location();
	navigation_eventlistener();
	scroll_eventlistener();
	exhibits();
	responsive_listeners();
	
	$(window).bind("popstate",function(e) {
		
		// Ignore inital popstate that some browsers fire on page load
		var initialPop = !popped && location.href == initialURL;
		popped = true;
		if (initialPop) return;
		
		get_page_by_request_uri(location.pathname);
	});
});

function responsive_listeners() {
	
	responsive_design();
	
	$(window).resize(function() {
		
		responsive_design();
	});
}

function responsive_design() {
	
	window_width = $(this).width();
		
	/* Tablet */
	if (window_width < 980) {
	
		$("body").addClass("tablet");
		
		/* Smartphone */
		if (window_width < 640) {
			
			$("body").addClass("mobile");
		}
		else {
			
			$("body").removeClass("mobile");
		}
	}
	else {
		
		$("body").removeClass("tablet");
		$("body").removeClass("mobile");
	}
}

function exhibits() {
	
	$(document).on("click",".exhibits > .container ul li a", function(e) {
		
		e.preventDefault();
		
		href = $(this).attr("href");
		
		//lock scroll position
		scrollPosition = [
		  self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
		  self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
		];
		var html = jQuery('html'); // it would make more sense to apply this to body, but IE7 won't have that
		html.data('scroll-position', scrollPosition);
		html.data('previous-overflow', html.css('overflow'));
		html.css('overflow', 'hidden');
		window.scrollTo(scrollPosition[0], scrollPosition[1]);
		

		
		content = '<div class="wrapper"><h1>TEST</h1><p>Ein Text der nachgeladen wurde</p></div>';
		
		$(this).parents("section").find(">.container .room").html(content);
		$(this).parents("section").find(">.container").animate({
			
			left: "-100%"
		});
		$(".nav").animate({
			
			left: "-50px"
		});
	});
	
	$(".exhibits ul").each(function() {
		
		list_width = 0;
		
		$(this).find("li").each(function() {
			
			list_width+= $(this).outerWidth(true);
		});
		
		$(this).css("width",list_width + "px");
	});
	$(".exhibits ul").draggable({
		
		axis: 'x',
		stop: function(event,ui) {
			
			max_left = $(ui.helper).width() - $(ui.helper).parent().width();
			
			if (parseFloat($(ui.helper).css("left")) > 0) {
				
				$(ui.helper).animate({
					
					left: 0
				});
			}
			else if ((parseFloat($(ui.helper).css("left")) * (-1)) > max_left) {
				
				$(ui.helper).animate({
					
					left: "-" + max_left + "px"
				});
			}
		}
	});
	
	$(document).on("click",".exhibits .navi a", function() {
		
		max_left = $(this).parents(".exhibits").find("ul").width() - $(this).parents(".exhibits").width();
		li_width = $(this).parents(".exhibits").find("ul > li:nth-child(2)").outerWidth(true);
		
		switch($(this).attr("class")) {
			
			case "next":
			
				if ((parseFloat($(this).parents(".exhibits").find("ul").css("left")) * (-1)) < max_left) {
					
					current_elem = Math.floor((parseFloat($(this).parents(".exhibits").find("ul").css("left"))*(-1))/li_width);
					
					current_elem++;
					
					calc_width = (current_elem * li_width * (-1))+"px";
					
					$(this).parents(".exhibits").find("ul").animate({
						
						left: calc_width
					},paging_speed);
				}
				break;
				
			case "prev":
			
				if ((parseFloat($(this).parents(".exhibits").find("ul").css("left")) * (-1)) > 0) {
					
					current_elem = Math.ceil((parseFloat($(this).parents(".exhibits").find("ul").css("left"))*(-1))/li_width);
					
					current_elem--;
					
					calc_width = (current_elem * li_width * (-1))+"px";
					
					$(this).parents(".exhibits").find("ul").animate({
						
						left: calc_width
					},paging_speed);
				}
				break;
		}
	});
}

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