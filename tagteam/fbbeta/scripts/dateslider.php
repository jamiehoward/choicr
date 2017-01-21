<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Slider - Range with fixed maximum</title>
	<link rel="stylesheet" href="http://jqueryui.com/themes/base/jquery.ui.all.css">
	<script src="http://jqueryui.com/jquery-1.4.4.js"></script>
	<script src="http://jqueryui.com/ui/jquery.ui.core.js"></script>
	<script src="http://jqueryui.com/ui/jquery.ui.widget.js"></script>

	<script src="http://jqueryui.com/ui/jquery.ui.mouse.js"></script>
	<script src="http://jqueryui.com/ui/jquery.ui.slider.js"></script>
	<link rel="stylesheet" href="http://jqueryui.com/demos/demos.css">
	<style>
	#demo-frame > div.demo { padding: 10px !important; };
	</style>
	<script>
	$(function() {
		$( "#slider-range-max" ).slider({
			range: "max",
			min: 0:00,
			max: 11:59,
			value: 2,
			slide: function( event, ui ) {
				$( "#amount" ).val( ui.value );
			}
		});
		$( "#amount" ).val( $( "#slider-range-max" ).slider( "value" ) );
	});
	</script>
</head>
<body>

<div class="demo">

<p>
	<label for="amount">Minimum number of bedrooms:</label>
	<input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
</p>
<div id="slider-range-max"></div>

</div><!-- End demo -->



<div class="demo-description">
<p>Fix the maximum value of the range slider so that the user can only select a minimum.  Set the <code>range</code> option to "max."</p>

</div><!-- End demo-description -->

</body>
</html>
