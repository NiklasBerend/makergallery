<?php

	header('Content-type: image/svg+xml');
	
	if (isset($_GET["color"]) and $_GET["color"] != "") {
	
		$color = $_GET["color"];

		print '<?xml version="1.0" encoding="utf-8"?>
				<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
				<g>
					<g>
						<path fill="#'.$color.'" d="M50-0.002C22.429-0.002,0,22.429,0,50c0,27.57,22.429,50.002,50,50.002c27.57,0,50-22.432,50-50.002
							C100,22.429,77.57-0.002,50-0.002z M50,94.232C25.61,94.232,5.77,74.391,5.77,50C5.77,25.609,25.61,5.768,50,5.768
							C74.391,5.768,94.23,25.61,94.23,50C94.23,74.391,74.391,94.232,50,94.232z"/>
					</g>
					<g>
						<path fill="#'.$color.'" d="M44.783,24.502c-1.127-1.127-2.952-1.127-4.079,0c-1.127,1.126-1.127,2.952,0,4.079L62.122,50
							L40.704,71.418c-1.127,1.127-1.127,2.952,0,4.079c0.563,0.563,1.302,0.845,2.04,0.845c0.738,0,1.476-0.281,2.04-0.845
							L68.24,52.039c1.127-1.127,1.127-2.952,0-4.079L44.783,24.502z"/>
					</g>
				</g>
				</svg>';
	}
?>