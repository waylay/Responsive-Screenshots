<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Multi Device Screenshot</title>
	<meta name="description" content="Take screenshot of a website and see how it looks like on desktop, laptop, ipad and iphone.">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" />

	<meta name="viewport" content="width=device-width">
</head>
<body>
	<div class="wrapper">

		<section class="display layout1">

			<div class="phone">
				<iframe id="phone" src="http://webcodesigner.com" scrolling="no"></iframe>
			</div>

			<div class="tablet">
				<iframe id="tablet" src="http://webcodesigner.com" scrolling="no"></iframe>
			</div>

			<div class="laptop">
				<iframe id="laptop" src="http://webcodesigner.com" scrolling="no"></iframe>
			</div>

			<div class="desktop">
				<iframe id="desktop" src="http://webcodesigner.com" scrolling="no"></iframe>
			</div>

		</section>

		<section class="controls">
			<h2>Controls</h2>
			<form id="website_url" name="website_url">

				<fieldset>
					<h4>Website URL:</h4>
					<input type="url" id="url" name="url" value="http://"  placeholder="http://">
					<a class="go button" href="#">GO!</a>
				</fieldset>

				<fieldset>
					<h4>Background Color:</h4>
					<div id="colorSelector"></div>
				</fieldset>

				<fieldset>
					<h4>Preset Layouts:</h4>
					<a class="button layout" href="#" data-layout="layout1">1</a>
					<a class="button layout" href="#" data-layout="layout2">2</a>
					<a class="button layout" href="#" data-layout="layout3">3</a>
					<a class="button layout" href="#" data-layout="layout4">4</a>
				</fieldset>

			</form>


		</section>


	</div>


	<script src="//code.jquery.com/jquery-latest.js"></script>
	<script src="//code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
	<script src="js/colorpicker.js"></script>

	<script>
	$(document).ready(function() {


		//
		// URL Button
		//

		$(".go.button").click(function(event){
			$("iframe").attr('src', $( '#url' ).val());
		});


		//
		// Draggable and z-index
		//

		var a = 3;
		$('.desktop,.laptop,.tablet,.phone').draggable({
			start: function(event, ui) { $(this).css("z-index", a++); }
		});

		$('.display div').click(function() {
			$(this).addClass('top').removeClass('bottom');
			$(this).siblings().removeClass('top').addClass('bottom');
			$(this).css("z-index", a++);
		});

		//
		// Toggle Controls
		//

		$(".display").click(function(event){
			if(event.target !== event.currentTarget) return;
			$(".controls").slideToggle( "up" );
		});

		//
		// Color Selector
		//

		$('#colorSelector').ColorPicker({
			color: '#dfe2e6',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('body').css('backgroundColor', '#' + hex);
			}
		});

		//
		// Layout Buttons
		//

		$(".layout.button").click(function(event){
			event.preventDefault();
			$(".display div").attr('style','');
			$(".display").attr('class','display').addClass(event.target.getAttribute('data-layout'));			
		});


	});
	</script>

	<script>

	function getUrlVars() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
		});
		return vars;
	}

	var first = getUrlVars()["url"];
	var first = decodeURIComponent(first);
	var first = first.replace(/\#$/, '');

	if(first !== "undefined") {
		$("iframe").attr('src',(first));
		$('#url').attr('value',(first));
	}

	</script>


</body>
</html>
