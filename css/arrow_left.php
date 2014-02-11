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
						<path fill="#'.$color.'" d="M50,100.002c27.57,0,50-22.432,50-50.002S77.57-0.002,50-0.002S0,22.43,0,50S22.43,100.002,50,100.002z
							 M50,5.768c24.39,0,44.229,19.842,44.229,44.232S74.39,94.231,50,94.231C25.609,94.231,5.77,74.39,5.77,50
							C5.77,25.609,25.609,5.768,50,5.768z"/>
					</g>
					<g>
						<path fill="#'.$color.'" d="M55.217,75.498c1.127,1.127,2.952,1.127,4.079,0c1.127-1.126,1.127-2.952,0-4.079L37.878,50l21.418-21.418
							c1.127-1.127,1.127-2.952,0-4.079c-0.563-0.563-1.302-0.845-2.04-0.845s-1.477,0.281-2.04,0.845L31.76,47.961
							c-1.127,1.127-1.127,2.952,0,4.079L55.217,75.498z"/>
					</g>
				</g>
				</svg>';
	}
?>