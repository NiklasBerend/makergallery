var popped = false;
var initialURL = location.href;
var elevator_position = 3;
var first_page_load = true;
var elevator_speed = 200;
var paging_speed = 200;
var scrolling_speed = 1500;
var into_room_speed = 1000;
var page_is_locked = false;

$(document).ready(function(e) {
		
	responsive_listeners();
	check_location();
	navigation_eventlistener();
	scroll_eventlistener();
	exhibits();
	
	$(window).on('hashchange', function(){
		
		return false;
	});
	
	$(window).bind("popstate",function(e) {
		
		// Ignore inital popstate that some browsers fire on page load
		var initialPop = !popped && location.href == initialURL;
		popped = true;
		if (initialPop) return;
		
		get_page_by_request_uri(location.pathname);
	});
	$(document).on("click","#back_button",function() {
			
		urlparts = location.pathname.split("/");

		request = "";
		
		for(i=1;i<urlparts.length;i++) {
			
			if (global_url_prefix.indexOf(urlparts[i]) == -1) {
				
				request+= urlparts[i] + "/";
			}
		}
		
		section = request.substring(0,request.indexOf("/"));
		
		history.pushState({page:global_url_prefix + section}, null, global_url_prefix + section);
		
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
	if (window_width < 1025) {
	
		$("body").addClass("tablet");
		
		/* Smartphone */
		if (window_width <= 720) {
			
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
	
	/* Rearrange subpage vertical adjustment */
	if ($("section.in_room").length > 0) {
		
		/* Current section on subpage */
		$(document).scrollTop($("section.in_room").offset().top);
	}
}

function exhibits_list_calc() {
	
	$(".exhibits ul").each(function() {
		
		list_width = 0;
		
		$(this).find("li").each(function() {
			
			list_width+= $(this).outerWidth(true);
		});
		
		$(this).css("width",list_width + "px");
	});
}

function exhibits() {
	
	$(document).on("click",".exhibits > .container ul li a", function(e) {
		
		e.preventDefault();
		
		if (history && history.pushState) {
				
			history.pushState({page:$(this).attr("href")}, null, $(this).attr("href"));
			
			get_page_by_request_uri(location.pathname);
		}
	});
	
	exhibits_list_calc();
	
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
		
		if (!$("section").hasClass("in_room")) {
			
			position_top = parseInt($(document).scrollTop());
		  
			section_height = $("section").height();
			
			section_number = Math.floor(position_top/section_height);
			
			set_elevator_to(section_number);
		}
    });
}

function set_elevator_to(section) {
		
	if (section < 0) {
		
		section = 0;
	}
	
	if (elevator_position != section) {
		
		new_href = $(".nav ul li:nth-child(" + (section+1) + ") a").attr("href");
		
		if (history.state != null && history.state.page != new_href) {
		
			history.pushState({page:new_href}, null, new_href);
		}
		
		new_position = section * $(".nav ul li").height() + parseInt($(".nav .container ul").css("margin-top"));
		
		/* New position for elevator */
		$("#elevator").animate({
			
			top: new_position
		},elevator_speed);
		
		elevator_position = section;
	}
}

function check_location() {
	
	if (history && history.pushState) {
		
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
	$(document).on("click","#nav_lug",function(e) {
		
		if ($(".nav").css("left") == "0px") {
			
			$(".nav").animate({
				
				left: "-80px"
			},500);
		}
		else {
			$(".nav").animate({
				
				left: "0"
			},500);
		}
	});
	$(document).on("mouseenter",".nav ul li",function(e) {
		
		$(this).find(".label").addClass("show");
	});
	$(document).on("mouseleave",".nav ul li",function(e) {
		
		$(this).find(".label").removeClass("show");
	});
}

function social_listeners() {
	
	$('.twitter').sharrre({
	  share: {
		twitter: true
	  },
	  enableCounter: false,
	  enableHover: false,
	  enableTracking: true,
	  buttons: { twitter: {via: '_MLAB'}},
	  click: function(api, options){
		api.simulateClick();
		api.openPopup('twitter');
	  }
	});
	$('.facebook').bind("click", function() {
		
		FB.ui({
		  method: 'feed',
		  link: $(this).attr("data-url"),
		  caption: $(this).attr("data-text"),
		  description: $("#og_description").attr("content"),
		  picture: $("#og_image").attr("content"),
		}, function(response){});
		
	});
	
	$('.googleplus').bind("click", function() {
		
		url = $(this).attr("data-url").substr(0,$(this).attr("data-url").length-1);
	
		window.open("https://plus.google.com/share?url=" + url,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
	});

	if(typeof DISQUS == 'undefined') {
		
		window.setTimeout(function() {
			
			render_disqus();
			
		},1000);
	}
	else {
		render_disqus();
	}
}

function render_disqus() {
	
	/* CHECK IF DISQUS DIV EXISTS */
	if ($("#disqus_thread").length > 0) {
		
		DISQUS.reset({
		  reload: true,
		  config: function () {
			this.page.url = document.URL;
			this.page.title = document.title;
		  }
		});
	}
}

function get_page_by_request_uri(uri) {
	
	if (uri.indexOf("makergallery") != -1) {
		
		uri = uri.replace("/makergallery","");
	}
	
	urlparts = uri.split("/");
	
	request = "";
	
	for(i=1;i<urlparts.length;i++) {
		
		if (global_url_prefix.indexOf(urlparts[i]) == -1) {
			
			request+= urlparts[i] + "/";
		}
	}
	
	section = request.substring(0,request.indexOf("/"));
		
	if (request.replace(/[^\/]/g, "").length > 1) {
		
		/* There's a subpage */
		page_is_locked = true;
		
		$("section[ref='" + section + "']").find("> .container .room").html('<div class="waiter"><div class="icon"></div></div>');
		$("section[ref='" + section + "']").addClass("in_room");

		scroll_to(section);
		
		$.ajax({
		
			url: global_url_prefix + "pages/" + request.substr(0,request.length-1) + ".php",
			type: "GET",
			success: function(data) {
				
				$("section[ref='" + section + "'] .waiter").fadeOut(300, function() {
				
					$("section:not(.in_room)").hide();
				
					$("section[ref='" + section + "']").find("> .container .room").html(data);
					$("section[ref='" + section + "']").find("> .container .room").scrollTop(0);
					
					$("section[ref='" + section + "']").find("> .container .room .wrapper").css("opacity","0");
					$("section[ref='" + section + "']").find("> .container .room .wrapper").animate({
						
						opacity: 1
					});
					
					exhibit_title = $("section[ref='" + section + "']").find("> .container .room .wrapper > h1").text();
					exhibit_description = $("section[ref='" + section + "']").find("> .container .room .wrapper > p").text();
					
					social  = '<div class="social" style="display: none;">';
					social += '<div class="twitter" data-url="' + global_url_prefix + request + '" data-title="Tweet" data-text="' + exhibit_title + '"></div>';
					social += '<div class="facebook" data-url="' + global_url_prefix + request + '" data-title="Like" data-text="' + exhibit_title + '"></div>';
					social += '<div class="googleplus" data-url="' + global_url_prefix + request + '" data-title="+1" data-text="' + exhibit_title + '"></div>';
					social += '</div>';
					
					if (section == "makerspace" || section == "reflectorspace" ||  section == "collectorspace") {
						
						social += '<div id="disqus_thread"></div>';
					}
					
					$("section[ref='" + section + "']").find("> .container .room .wrapper").append(social);
					$("section[ref='" + section + "']").find("> .container .room .wrapper .social").slideDown(500);
					
					document.title = "Makergallery | " + exhibit_title;
					
					$('meta[name=description]').attr("content",exhibit_description);
					
					$(".exhibits li a").each(function() {
						
						if (window.location.href.indexOf($(this).attr("href")) != -1) {
							
							exhibit_image = $(this).find("img").attr("src");
							return true;
						}
					});
					
					$("#og_title").attr("content",exhibit_title);
					$("#og_description").attr("content",exhibit_description);
					$("#og_image").attr("content",exhibit_image);
					
					social_listeners();
					
					exhibits_list_calc();
					$("section[ref='" + section + "'] .absolute .exhibits ul").animate({
						
						left: 0
					});
					
					$("section[ref='" + section + "'] .absolute").animate({
						
						bottom: 0
					});
					
					$("#back_button").animate({
						
						left: "0"
					});
				});
			}
		});
	}
	else {
		
		if (page_is_locked) {
			
			$("section").show();
			
			$("section[ref='" + section + "'] .absolute").css("bottom", "");
			
			$(document).scrollTop($("section[ref='" + section + "']").offset().top);
			
			document.title = "Makergallery";
			
			page_is_locked = false;
		}
		else {
			
			scroll_to(section);
		}
		
		/* There's no subpage */
		if ($("body").hasClass("mobile")) {
			
			$(".nav").animate({
				
				left: "-80px"
			});
		}
		else {
			$(".nav").animate({
				
				left: "0"
			});
		}
		
		$("#back_button").animate({
			
			left: "-80px"
		});
		
		$("section").removeClass("in_room");
		exhibits_list_calc();
	}
}

function scroll_to(section) {
	
	if (first_page_load) {
		
		first_page_load = false;
		
		set_elevator_to($("section[ref='" + section + "']").index());
		$(document).scrollTop($("section[ref='" + section + "']").offset().top);
	}
	else {
		
		if (parseInt($("section[ref='" + section + "']").offset().top) != parseInt($(document).scrollTop())) {

			$('html, body').animate({ 
			   scrollTop: $("section[ref='" + section + "']").offset().top}, 
			   scrolling_speed, 
			   "easeOutQuint"
			);	
		}
	}
}