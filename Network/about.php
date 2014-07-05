<?php
	//Start session
	session_start();

	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
	header("location: login.php");
	exit();
	}
?>
<!DOCTYPE html>
<html>

	<head>
		<title>SimpleBox</title>
		<link rel="icon" type="image/ico" href="favicon.ico">
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="src/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="src/style.css">
		
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
						<li><a href="index.php">Files</a></li>
						<li class="active"><a href="#">About</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
		<!-- END Fixed navbar -->

		<!-- START Main content -->
		<div class="container theme-showcase" role="main" id="content" style="padding-top:0">

			<a href="http://github.com/joedf/SimpleBox" style="color:black;text-decoration:none"><h1>SimpleBox</h1>
			<img src="src/logo.png"></a><br><br>
			<p><b>Version:</b> 1.0.0<br><b>Revision:</b> 01:12 2014-07-04</p>
			<p>By <a href="http://github.com/joedf">Joe DF</a>, made with laziness...</p>
			<p>Released under the <a href="http://opensource.org/licenses/MIT">MIT License</a></p>

		</div>
		<!-- END Main content -->
	</body>
	
</html>
