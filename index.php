<?php

	$path_up = "";

	include("php/helper.php");
?>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="<?php print $global_url_prefix?>files/imagesfavicon.ico" type="image/x-icon"/>
<title>Makergallery</title>
<meta charset="utf-8" content="encoding"/>
<meta name="viewport" content="width=device-width, maximum-scale=1"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<script type="text/javascript">
<?php
	
	print 'var global_url_prefix = "'.$global_url_prefix.'";';
?>
</script>
<script type="text/javascript" src="<?php print $global_url_prefix?>js/jquery.js"></script>
<script type="text/javascript" src="<?php print $global_url_prefix?>js/jquery.sharrre.min.js"></script>
<script type="text/javascript" src="<?php print $global_url_prefix?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php print $global_url_prefix?>js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php print $global_url_prefix?>js/jquery_easing.js"></script>
<script type="text/javascript">
	/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
	var disqus_shortname = 'makergallery'; // required: replace example with your forum shortname

	/* * * DON'T EDIT BELOW THIS LINE * * */
	(function() {
		var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
		dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
		(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	})();
</script>
<link rel="stylesheet" href="<?php print $global_url_prefix?>css/index.css"/>
</head>
<body> 
	<div class="container">
    	<nav class="nav">
        	<div class="container">
                <ul>
                    <?php
                        
                        foreach($contents->children() as $elem) {
                            
                            print '<li class="'.strtolower($elem->name).'"><a title="'.$elem->name.'" href="'.$global_url_prefix.$elem->link.'"></a></li>';
                        }
                    
                    ?>
                </ul>
                <div id="elevator"></div>
            </div>
            <div id="elevator_bg"></div>
            <div id="nav_lug">
            	<span></span>
            	<span></span>
            	<span></span>
            	<span></span>
            </div>
        </nav>
        <div id="back_button"></div>
        <div id="paging">
			<?php
					
				foreach($contents->children() as $elem) {
					
					print '<section ref="'.$elem->link.'">';
					print '<div class="container">';
					print '<div class="floor">';
					print innerXML($elem->content->info);
					
					if (isset($elem->content->exhibits)) {
						
						print '<div class="absolute">';
						print '<div class="exhibits">';
						print '<div class="container">';
						print '<ul>';
					
						foreach($elem->content->exhibits->children() as $exhibit) {
							
							print '<li class="'.$exhibit->attributes()->type.'">';
							print '<div class="container">';
							
							print '<a href="'.$exhibit->href.'"><img class="thumbnail" src="'.$global_url_prefix.$exhibit->thumbnail.'" alt="'.$exhibit->title.'"></a>';
							
							print '</div>';
							print '</li>';
						}
						
						print '</ul>';
						print '</div>';
						print '<div class="navi">';
						print '<a class="next"></a>';
						print '<a class="prev"></a>';
						print '</div>';
						print '</div>';
						print '</div>';
						print '</div>';
						print '<div class="room">';
						print '</div>';
						print '</div>';
					}
					
					print '</section>';
				}
                
            ?>
        </div>
        

    </div>
	<script type="text/javascript" src="<?php print $global_url_prefix?>js/header.js"></script>
</body>	
</html>
