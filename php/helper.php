<?php

	global $path_up;

	$contents = simplexml_load_file($path_up."xml/content.xml");

	if ($_SERVER["HTTP_HOST"] == "localhost") {
	
		$global_url_prefix = "http://localhost/makergallery/";
	}
	else {
		
		$global_url_prefix = "http://".$_SERVER["HTTP_HOST"]."/";
	}
	
	function innerXML($xml) {
		
		$innerXML= '';
		foreach (dom_import_simplexml($xml)->childNodes as $child) {
			
			$innerXML .= $child->ownerDocument->saveXML( $child );
		}
		return $innerXML;
	}

?>