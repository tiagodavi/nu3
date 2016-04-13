<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Weather Forecast Application</title>
	<?php echo Asset::css('bootstrap.css'); ?>	
	</style>

	 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  	 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	 <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
	<input type="hidden" id="app_url" value="<?php echo Uri::base(); ?>">
	<header>
		<div class="container">
			<div id="logo">
				<?php echo Asset::img('nu3.png', array('width' => '200')); ?>
			</div>
		</div>
	</header>
	<div class="container">
		<div class="jumbotron">
			<h3>Enter your city here to find informations about weather.</h3>
			<small>The first is city name then comma then country. Example - Lon, UK or Lon, GB or London, GB or Lon, England.</small>
			<p><input type="text" name="city" id="city" placeholder="City name, Country code"></p>
			<p id="message"></p>
		</div>
		<div class="row" id="result">
				
		</div>
		<hr/>
		<footer>
			<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>			
		</footer>
	</div>
	<?php echo Asset::js('app.js'); ?>
</body>
</html>
