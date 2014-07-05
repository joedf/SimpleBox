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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SimpleBox - Login</title>
		<script src="src/ValidateForm.js"></script>
		<link type="text/css"  href="src/login.css" rel="stylesheet">
	</head>

	<body>
		<div id="body_login">
		<form action="p_login.php" method="post">
			<h2>SimpleBox</h2>
			<img src="http://simplebox.tk/src/logo48.png">
			<table class="form">
				<thead><td colspan="2" style="font-size:11px">Enter your account information</td></thead>
				<tbody>
				<tr>
					<td style="text-align:right">User Name:</td>
					<td><input type="text" name="username" placeholder="Username" 
						<?php if(isset($_GET["u"])) {echo "value=\"" . strtolower($_GET["u"]) . "\"";} ?> ></td>
				</tr>
				<tr>
					<td style="text-align:right">Password:</td>
					<td><input type="password" name="password" placeholder="********"></td>
				</tr>
				</tbody>
			</table>
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
			<input type="Submit" value="Sign In" class="big" onclick="return ValidateForm(this.form)">
		</form>
		</div>
	</body>
</html>