<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/youtube-video-gallery.css" type="text/css"/>
<link rel=”shortcut icon” href=”Makergallery/favicon.ico” type=”image/x-icon” />

<meta charset="utf-8" content="encoding"/>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery_easing.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/jquery.youtubevideogallery.js"></script>
<script type="text/javascript">

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
    });

</script>
<link rel="stylesheet" href="css/jquery.fancybox.css"/>
<style type="text/css">


	

	body {
		margin: 0;
		padding: 0;
	}
	

	#paging {
		margin: 0;
		padding: 40px 0 0 0;
		style-type: none;
		width: 100%;
		position: relative;
		left: 0;
		font-family: 'Quicksand', sans-serif;
	}
	
	#paging > li {
		width: 100%;
		min-height: 600px;
	}
	body .container {
		width: 100%;
		height: 100%;
	}
	.nav {
		position: fixed;
		top: 0;
		width: 100%;
		height: 40px;
		z-index: 500;
		background-color: #ccc;
		font-family: 'Quicksand', sans-serif;
		font-weight: bold;
	}
	.nav ul {
		margin: 0;
		padding: 0;
		list-style: none;
		margin: 0 auto;
		display: block;
		max-width: auto;
	}
	.nav ul li {
		display: inline-block;
		height: 40px;
		padding: 0 20px;
		line-height: 40px;
		background-color: #ccc;
		cursor: pointer;
		font-size: 16px;
	}
	.nav ul li:hover {
		background-color: #000;
		color: #fff;
	}
	
	
	#Mitwirkende {
		background-color: #0C9;
	}
	
	#Collectorspace {
		background-color: #748412;
	}
	
	#Makerspace {
		background-color: #dd7683;
	}
	
	#Reflectorspace {
		background-color: #2e4f68;
		color: white;
	}
	#supportspace {
		background-color: #a2abae;
	}
	
	
	.wrapper {
		max-width: 840px;
		padding: 20px 60px;
		margin: 0 auto;
	}
	.wrapper img {
		width: 180px;
		margin-right: 20px;
	}
	#player {
		width: 100%;
		height: 100%;
	}
	
	iframe {
		border:3px solid black;
		max-height: 600px;
		max-width:	840px;
	}
	
	.twitter-timeline {
		margin-left: 750px;
		margin-right: 50px;
		margin-top: -450px;
		heigth: 400px;
		width: 300px;
		position: relative;
		border: 1px dottet grey;
	}
		
		
</style>
</head>
<body>

	
       
	<div class="container">
    	<nav class="nav">
        	<ul>
            	<?php
				
					$navi_xml = simplexml_load_file("pages/navi.xml");
					
					foreach($navi_xml->children() as $elem) {
						
						print '<li rel="'.$elem->name.'">'.$elem->name.'</li>';
					}
				
				?>
            </ul>
        </nav>
        <ul id="paging">
			<?php
			
				$navi_xml = simplexml_load_file("pages/navi.xml");
					
				foreach($navi_xml->children() as $elem) {
					
					print '<li id="'.$elem->name.'">';
					
					include ("pages/".$elem->link);
							
					print '</li>';
				}
                
            ?>
            </li>
        </ul>
        

    </div>
</body>	
</html>
