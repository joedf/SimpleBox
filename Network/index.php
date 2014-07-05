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
		
		<script src="src/jquery.min.js"></script>
		<script src="src/spoiler.js"></script>
		<script src="src/jquery.form.js"></script>
		<script src="src/bootstrap/js/bootstrap.min.js"></script>
		
		<script language="javascript" type="text/javascript">
			function resizeIframe(obj) {
				obj.style.height = (obj.contentWindow.document.body.scrollHeight+40) + 'px';
			}
			
			function clearbtn() {
				$('.progress').css("display","none");
				$('.bar').width('0%');
				$('.percent').html('0%');
				$('#status').css("display","none");
				$('#clearbutton').css("display","none");
				$("#file").replaceWith($("#file").clone());
				$('#file').val('');
			}
			
			function search() {
				var q = document.getElementById("query").value;
				if (q.length == 0)
					return
				document.getElementById('loader').style.display='block';
				var filelist = document.getElementById("filelist");
				filelist.src = "files.php?s=" + q;
			}
			
			function clearsearch() {
				document.getElementById("query").value = "";
				document.getElementById('loader').style.display='block';
				var filelist = document.getElementById("filelist");
				filelist.src = "files.php";
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
						<li class="active"><a href="#">Files</a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
		<!-- END Fixed navbar -->

		<!-- START Main content -->
		<div class="container theme-showcase" role="main" id="content">

			<div id="toolbar">
				<div> <!--upload-->
					<input type="button" value="Upload" onclick="spoiler(this);">
					<div style="display:none">
						<h2 style="display:none">Upload</h2>
						<div style="display:inline-block;">
							<form action="submit.php" method="post" enctype="multipart/form-data">
								<div>
									
									<div style="display:inline-block;">
										<input type="file" name="file" id="file" style="display:inline-block;">
										<input type="submit" value="Submit">
										<div class="progress" style="display:none;">
											<div class="bar"></div>
											<div class="percent">0%</div>
										</div>
										<input type="button" id="clearbutton" value="clear" style="display:none" onclick="clearbtn()"><br>
									</div>
									
									<code id="status" style="display:none;"></code>
								</div>
							</form>
							<script type="text/javascript">
								(function() {
									
									var bar = $('.bar');
									var progress = $('.progress');
									var percent = $('.percent');
									var status = $('#status');
									
									//var bt = Ladda.create( document.querySelector( 'button' ) ); 
									$('form').ajaxForm({
										beforeSend: function() {
											progress.css("display","inline-block");
											status.html("Please wait...");
											var percentVal = '0%';
											bar.width(percentVal)
											percent.html(percentVal);
										},
										uploadProgress: function(event, position, total, percentComplete) {
											var percentVal = percentComplete + '%';
											bar.width(percentVal)
											percent.html(percentVal);
										},
										success: function() {
											var percentVal = '100%';
											bar.width(percentVal)
											percent.html(percentVal);
										},
										complete: function(xhr) {
											status.html(xhr.responseText);
											status.css("display","block");
											$('#clearbutton').css("display","inline-block");
											document.getElementById('loader').style.display='block';
											var filelist = document.getElementById("filelist");
											filelist.src = filelist.src;
										}
									}); 

								})();
							</script>
						</div>
					</div>
				</div>
				<div> <!--search-->
					<input type="button" value="Search" onclick="spoiler(this);">
					<div style="display:none">
						<h2 style="display:none">Search</h2>
						<div style="display:inline-block;">
							<form action="javascript:search()">
								<div>
									
									<div style="display:inline-block;">
										<input type="text" name="query" id="query" style="display:inline-block;width:300px" placeholder="Search text here...">
										<input type="button" value="Search" onclick="search()">
										<input type="button" value="Clear" onclick="clearsearch()">
									</div>
									
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<div id="filediv">
				<img src="src/loading.gif" id="loader">
				<iframe src="files.php" id="filelist" onload="javascript:resizeIframe(this);document.getElementById('loader').style.display='none';" style="max-width:100%;"></iframe>
			</div>

		</div>
		<!-- END Main content -->
	</body>
	
</html>
