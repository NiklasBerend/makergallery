<?php

	include("php/helper.php");
?>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="<?php print $global_url_prefix?>files/imagesfavicon.ico" type="image/x-icon"/>

<meta charset="utf-8" content="encoding"/>
<script type="text/javascript">
<?php
	
	print 'var global_url_prefix = "'.$global_url_prefix.'";';
?>
</script>
<script type="text/javascript" src="<?php print $global_url_prefix?>js/jquery.js"></script>
<script type="text/javascript" src="<?php print $global_url_prefix?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php print $global_url_prefix?>js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php print $global_url_prefix?>js/jquery_easing.js"></script>
<link rel="stylesheet" href="<?php print $global_url_prefix?>css/index.css"/>
</head>
<body> 
	<div class="container">
    	<nav class="nav">
        	<ul>
            	<?php
					
					foreach($contents->children() as $elem) {
						
						print '<li class="'.strtolower($elem->name).'"><a title="'.$elem->name.'" href="'.$global_url_prefix.$elem->link.'"></a></li>';
					}
				
				?>
            </ul>
            <div id="elevator"></div>
        </nav>
        <div id="paging">
			<?php
					
				foreach($contents->children() as $elem) {
					
					print '<section ref="'.$elem->link.'">';
					print innerXML($elem->content->info);
					
					if (isset($elem->content->exhibits)) {
						
						print '<div class="exhibits">';
						print '<ul>';
					
						foreach($elem->content->exhibits->children() as $exhibit) {
							
							print '<li class="'.$exhibit->attributes()->type.'">';
							print '<div class="container">';
							
							print '<a href="'.$exhibit->href.'"><img class="thumbnail" src="'.$exhibit->thumbnail.'" alt="'.$exhibit->title.'"></a>';
							
							print '</div>';
							print '</li>';
						}
						
						print '</ul>';
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
