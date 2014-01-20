$(document).ready(function(e) {
		
	$(".nav li").bind("click", function() {
		
		to_element = $("#" + $(this).attr("rel"));
		
		$("html, body").animate({
			
			scrollTop: $(to_element).offset().top
			
		},1000,"easeOutQuint");
	});
	
	/*youtube-gallery Start*/
	$(".youtube-video-gallery").youtubeVideoGallery();
  
	/*youtube-gallery End*/
 
	
	/* Fancybox Start */
	$(".fancyzoom").fancybox({
		openEffect : 'elastic',
		closeEffect	: 'elastic',
		closeClick: true,
		helpers : {
			title : {
				type : 'inside'
			}
		}
	});
	/* Fancybox Ende */
	
	render_slideshow();
});

function render_slideshow() {
	
	$(document).on("click",".gallery .next",function() {
		
		slideshow_go_to($(this).parents(".gallery"),"next");
	});
	$(document).on("click",".gallery .prev",function() {
		
		slideshow_go_to($(this).parents(".gallery"),"prev");
	});
	$(document).on("click",".gallery .thumbs li",function() {
		
		slideshow_go_to($(this).parents(".gallery"),$(this).index());
	});
	
	$(".gallery").each(function() {
		
		html = '<ul>';
		
		$(this).find(".slides > ul > li .image img").each(function() {
			
			html+= '<li>' + $(this)[0].outerHTML + '</li>';
		});
		
		html+= '</ul>';
		
		$(this).find(".thumbs").html(html);
		
		$(this).find(".thumbs ul").css("width",$(this).find(".thumbs ul > li").length * 200 + "px");
	});
	
	$(".gallery .thumbs ul").draggable({
		
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
	
	$(".gallery .thumbs li:first-child, .gallery .slides > ul > li:first-child").addClass("current");
}

function slideshow_go_to(element,type) {
	
	switch (type) {
		
		case "next":
		
			if ($(element).find(".slides > ul > li:first-child").hasClass("current")) {
				
				count = $(element).find(".slides > ul > li").length -1;
				
				$(element).find(".slides ul").animate({
					
					left: "-" + (count * 100) + "%"
				});
				$(element).find(".slides ul > li, .thumbs li").removeClass("current");
				$(element).find(".slides ul > li:last-child, .thumbs li:last-child").addClass("current");
			}
			else {
				
				$(element).find(".slides ul").animate({
					
					left: "+=100%"
				});
				$(element).find(".slides ul > li.current, .thumbs li.current").prev().addClass("prev");
				$(element).find(".slides ul > li, .thumbs li").removeClass("current");
				$(element).find(".slides ul > li.prev, .thumbs li.prev").addClass("current").removeClass("prev");
			}
			break;
			
		case "prev":
		
			if ($(element).find(".slides > ul > li:last-child").hasClass("current")) {
				
				$(element).find(".slides ul").animate({
					
					left: "0"
				});
				$(element).find(".slides ul > li, .thumbs li").removeClass("current");
				$(element).find(".slides ul > li:first-child, .thumbs li:first-child").addClass("current");
			}
			else {
				
				$(element).find(".slides ul").animate({
					
					left: "-=100%"
				});
				$(element).find(".slides ul > li.current, .thumbs li.current").next().addClass("next");
				$(element).find(".slides ul > li, .thumbs li").removeClass("current");
				$(element).find(".slides ul > li.next, .thumbs li.next").addClass("current").removeClass("next");
			}
			break;
			
		default:
		
			$(element).find(".slides ul").animate({
					
				left: "-" + (type*100) + "%"
			});
			$(element).find(".slides ul > li, .thumbs li").removeClass("current");
			$(element).find(".slides ul li:nth-child(" + (type+1) + "), .thumbs li:nth-child(" + (type+1) + ")").addClass("current");
			break;
	}
	
	if (($(element).find(".thumbs li.current").index()+1)*200 > $(element).find(".thumbs").width()) {
		
		$(element).find(".thumbs ul").animate({
			
			left: parseInt($(element).find(".thumbs").width()) - ($(element).find(".thumbs li.current").index()+1)*200
		});
	}
	else {
		
		$(element).find(".thumbs ul").animate({
			
			left: 0
		});
	}
}