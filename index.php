<?php

	$path_up = "";

	include("php/helper.php");
?>
<html prefix="og: http://ogp.me/ns#">
<head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="<?php print $global_url_prefix?>files/imagesfavicon.ico" type="image/x-icon"/>
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
<?php

	/* STANDARD VALUES FOR OPEN GRAPH */
	$og_title = 'Makergallery';
	$og_image = '';

	$request = $_SERVER["REQUEST_URI"];
	
	if (strpos($request,"makergallery/") !== FALSE) {
		
		$request = substr($request,13,strlen($request));
	}
	
	$request = substr($request,1);
	
	$exhibit = $contents->xpath("//exhibit[href='".$request."']");
	
	if (isset($exhibit[0])) {
		
		$og_title = $exhibit[0]->title;
		$og_image = $global_url_prefix.$exhibit[0]->thumbnail;
	}
	
?>
<meta id="og_title" property="og:title" content="<?php print $og_title?>"/>
<meta id="og_description" property="og:description" content="Description makergallery"/>
<meta id="og_image" property="og:image" content="<?php print $og_image?>"/>
<link rel="canonical" href="<?php print "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>">
<title><?php print $og_title?></title>
<meta name="description" content="Die Makergallery.de wurde im Rahmen des pMOOCs Kinderzimmer Productions, veranstaltet vom Medialiteracylab (MLab), erstellt. Sie enthält unter anderem Exponate zu MaKeyMaKey, Minecraft, LEGO Mindstorms und die mlabtalks, unter anderem den mit Eric Rosenbaum vom MIT Media Lab und mit Tara Tiger Brown vom LA Makerspace."/>
</head>
<body>
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '1403784016550586',
          status     : true,
          xfbml      : false
        });
      };
    
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/all.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
	<div class="container">
    	<nav class="nav">
        	<div class="container">
                <ul>
                    <?php
                        
                        foreach($contents->children() as $elem) {
                            
                            print '<li class="'.strtolower($elem->name).'"><a href="'.$global_url_prefix.$elem->link.'"></a><span class="label">'.$elem->name.'</span></li>';
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
        <div id="back_button" title="Zurück zur Übersicht"></div>
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
							
							print '<p class="label">'.$exhibit->title.'</p>';
							print '<a href="'.$global_url_prefix.$exhibit->href.'"><img class="thumbnail" src="'.$global_url_prefix.$exhibit->thumbnail.'" alt="'.$exhibit->title.'"></a>';
							
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
    <div class="imprint">
    	<div class="button">
            <p>i</p>
        </div>
        <div class="hide">
            <p>
            <strong>Impressum</strong><br/>
            Media Literacy Lab<br/>
            AG Medienpädagogik<br/>
            Institut für Erziehungswissenschaft<br/>
            Johannes Gutenberg-Universität Mainz<br/>
            Jakob-Welder-Weg 12<br />
            55 128 Mainz<br/>
            Weitere <a href="http://makergallery.de/team">Informationen</a><br/>
            <br/>
            <span>E-Mail</span> <a href="mailto:kontakt@medialiteracylab.de">kontakt@medialiteracylab.de</a><br/>
            <span>Tel</span> 06131-39-26718<br/>
            </p>
        </div>
    </div>
	<script type="text/javascript" src="<?php print $global_url_prefix?>js/header.js"></script>
</body>	
</html>
