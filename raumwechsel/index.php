<html>
<head>
<meta charset="utf-8" content="encoding"/>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">

	$(document).ready(function(e) {
		
		$(document).on("click",".button",function() {
			
			if (!$(this).hasClass("animated")) {
				
				button = $(this);
				$(button).addClass("animated");
				
				$(".container .current").addClass("hide");
				$(".container .next").addClass("now");
				
				window.setTimeout(function() {
					
					$(".container .now").attr("class","current");
					$(".container .hide").attr("class","next");
					
					$(button).removeClass("animated");
				},1000);
			}
		});
    });

</script>
<link rel="stylesheet" href="css/jquery.fancybox.css"/>
<style type="text/css">

	body {
		margin: 0;
		padding: 0;
	}
	.container {
		width: 100%;
		height: 100%;
		overflow: hidden;
	}
	.wrapper {
		max-width: 860px;
		padding: 20px 50px;
		margin: 0 auto;
	}
	.container .current,
	.container .next {
		position: absolute;
		width: 100%;
		height: 100%;
		-webkit-transform-origin: center;
		-moz-transform-origin: center;
		-ms-transform-origin: center;
		-o-transform-origin: center;
		transform-origin: center;
	}
	.container .current {
		background-color: #09F;
		z-index: 100;
	}
	.container .current.hide {
		opacity: 0;
		transition: all 1s;
		-moz-transition: all 1s;
		-webkit-transition: all 1s;
		-o-transition: all 1s;
		-webkit-transform: scale(1.5);  /* Saf3.1+, Chrome */
		-moz-transform: scale(1.5);  /* FF3.5+ */
		-ms-transform: scale(1.5);  /* IE9 */
		-o-transform: scale(1.5);  /* Opera 10.5+ */
		transform: scale(1.5);
	}
	.container .next {
		background-color: #F00;
		-webkit-transform: scale(0.2);  /* Saf3.1+, Chrome */
		-moz-transform: scale(0.2);  /* FF3.5+ */
		-ms-transform: scale(0.2);  /* IE9 */
		-o-transform: scale(0.2);  /* Opera 10.5+ */
		transform: scale(0.2);
		
		transition: all 1s;
		-moz-transition: all 1s;
		-webkit-transition: all 1s;
		-o-transition: all 1s;
	}
	.container .next.now {
		background-color: #F00;
		-webkit-transform: scale(1);  /* Saf3.1+, Chrome */
		-moz-transform: scale(1);  /* FF3.5+ */
		-ms-transform: scale(1);  /* IE9 */
		-o-transform: scale(1);  /* Opera 10.5+ */
		transform: scale(1);
		background-color: #09F;
	}
	.button {
		width: 200px;
		height: 50px;
		background-color: #ccc;
		color: #1e1e1e;
		cursor: pointer;
		display: block;
		position: absolute;
		bottom: 50px;
		left: 50%;
		margin-left: -100px;
		line-height: 50px;
		text-align: center;
		z-index: 200;
	}
	
	
</style>
</head>
<body>
	<div class="container">
    	<div class="current">
        	<div class="wrapper">
                <h1>Das ist ein Raum mit einem Exponat</h1>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                <p>Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
        <div class="next">
        	<div class="wrapper">
                <h1>Das ist ein anderer Raum mit einem anderen Exponat</h1>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
        <a class="button">Raumwechsel</a>
    </div>
</body>
</html>
