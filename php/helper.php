<?php

	if ($_SERVER["HTTP_HOST"] == "localhost") {
	
		$global_url_prefix = "http://localhost/makergallery/";
	}
	else {
		
		$global_url_prefix = "http://".$_SERVER["HTTP_HOST"]."/";
	}

?>