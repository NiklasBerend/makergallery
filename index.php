<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/youtube-video-gallery.css" type="text/css"/>
<link rel=”shortcut icon” href=”Makergallery/favicon.ico” type=”image/x-icon” />

<meta charset="utf-8" content="encoding"/>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="js/jquery_easing.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/jquery.youtubevideogallery.js"></script>
<script type="text/javascript" src="js/header.js"></script>
<link rel="stylesheet" href="css/jquery.fancybox.css"/>
<link rel="stylesheet" href="css/index.css"/>
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
