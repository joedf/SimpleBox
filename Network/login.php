<?php
	//Start session
	session_start();

	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(isset($_SESSION['sess_user_id'])) {
		header("location: index.php");
	exit();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<link rel="icon" type="image/ico" href="favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=0.8">
		<title>SimpleBox - Login</title>
		<script src="src/sorttable.js"></script>
		<script src="src/ValidateForm.js"></script>
		<link type="text/css"  href="src/style.css" rel="stylesheet">
		<link type="text/css"  href="src/bg.css" rel="stylesheet">
	</head>

	<body>
		<div id="body_login">
		<form action="p_login.php" method="post" class="form_box_center">
			<div class="smoothbg form_title">Enter your account info:</div>
			<?php
			if(isset($_GET["i"])) {
			$i = strtolower($_GET["i"]);
			if ($i === "u")
			echo "<div class=\"fullw\" style=\"color:red;font-weight:bold\">User not found.</div>";
			if ($i === "p")
			echo "<div class=\"fullw\" style=\"color:red;font-weight:bold\">Incorrect password.</div>";
			if ($i === "n")
			echo "<div class=\"fullw\" style=\"color:red;font-weight:bold\">Please write your login information.</div>";
			}
			?>	
				<table class="form" >
					<tr>
						<td style="text-align:right">User Name:</td>
						<td><input type="text" name="username" placeholder="Username" 
							<?php if(isset($_GET["u"])) {echo "value=\"" . strtolower($_GET["u"]) . "\"";} ?> ></td>
					</tr>
					<tr>
						<td style="text-align:right">Password:</td>
						<td><input type="password" name="password" placeholder="********"></td>
					</tr>
				</table>
			<input type="Submit" value="Sign In" class="big" onclick="return ValidateForm(this.form)">
		</form>
		</div>
	</body>
</html>