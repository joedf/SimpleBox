<!DOCTYPE html>
<html>

	<head>
		<title>SimpleBox</title>
		<link rel="icon" type="image/ico" href="favicon.ico">
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="src/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="src/style_m.css">
		
		<script src="src/sorttable.js"></script>
		<script src="src/jquery.min.js"></script>
		<script src="src/spoiler.js"></script>
		<script src="src/jquery.form.js"></script>
		<script src="src/bootstrap/js/bootstrap.min.js"></script>
		
		<script language="javascript" type="text/javascript">
			function resizeIframe(obj) {
				obj.style.height = (obj.contentWindow.document.body.scrollHeight+40) + 'px';
			}
		</script>
	</head>
	
	<body>
		<!-- START Fixed navbar -->
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">SimpleBox</a>
				</div>

				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
		<!-- END Fixed navbar -->

		<!-- START Main content -->
		<div class="container theme-showcase" role="main" id="content">

			<?php
			session_start();
			//unset($_SESSION["sess_user_id"]);
			session_destroy();
			//header("Location: home.php");
			echo "<h1>logged out.</h1><br>";
			?>

			<p>You will be redirected in <span id="counter">5</span> second(s).</p>
			<script type="text/javascript">
			function countdown() {
				var i = document.getElementById('counter');
				if (parseInt(i.innerHTML)<=0) {
					location.href = 'index.php';
				}
				var j = (parseInt(i.innerHTML)-1);
				i.innerHTML = (j>=0)?j:0;
			}
			setInterval(function(){ countdown(); },1000);
			</script>

		</div>
		<!-- END Main content -->
	</body>
	
</html>
