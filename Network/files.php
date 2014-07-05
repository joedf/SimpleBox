<?php
//Start session
session_start();

//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
header("location: login.php");
exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>SimpleBox</title>
		<link rel="icon" type="image/ico" href="favicon.ico">
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<meta name="viewport" content="width=device-width, initial-scale=0.8">
		<link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="src/bootstrap/css/bootstrap-theme.min.css">
		
		<script src="src/sorttable.js"></script>
		<script src="src/jquery.min.js"></script>
		<script src="src/bootstrap/js/bootstrap.min.js"></script>
		
		<style>
			a { color:#0088cc;text-decoration:none; }
			a:active { position:relative;top:1px; }
			#list { margin:auto;font-family:Consolas,Courier New,Courier,serif;font-size:12px;width:100%; }
			#list td { padding:4px; border: solid 0px #ddd; border-bottom-width: 1px;}
			#list thead { color:blue;text-decoration:underline;cursor:pointer; }
			tr td:first-child { word-break:break-all; }
			tr:hover { background-color:#EFEFEF; }
		</style>
		
		<script language="javascript" type="text/javascript">
			function confirmDelete(f) {
				if (confirm('Are you sure you want to delete this file?\n\n\t' + '"' + f + '"')) {
					var p = window.location.pathname.replace(/^.*\/([^/]*)/, "$1");
					window.location.replace("./" + p + '?d=' + f);
				} else {
					// Do nothing!
				}
			}
		</script>
	</head>

	<body>
		<div style="padding: 0 15px;">
		
			<?php
				if (isset($_REQUEST['s']))
					echo '<h2>Files Search</h2><p>Search results for: <i><q>'.$_REQUEST['s'].'</q></i></p>';
				else
					echo "<h2>Files</h2>";
			?>

			<table id="list" class="sortable">
				<?php
				date_default_timezone_set("America/New_York"); // EST vs EDT time => EST with Daylight Savings Time
				$timetype = date("I")?"EDT":"EST";
				echo '<thead><tr><td>Filename</td><td>Last modified '.'('.$timetype.')'.'</td><td>Size</td><td>Options</td></tr></thead>';
				?>
				<tbody>
					<?php
					$i = 0;
					
					if(!file_exists('./files') || !is_dir('./files'))
						mkdir('./files');
						
					chdir('./files');
					
					if (isset($_REQUEST["d"])) {
						$tmp = basename($_REQUEST["d"]);
						if (file_exists($tmp))
							unlink($tmp);
					}
					
					if (isset($_REQUEST['s'])) { //filename search
						$queries = explode(" ",$_REQUEST['s']);
						if ($handle = opendir("./")) {
							while (false !== ($file = readdir($handle))) {
								if ($file != "." && $file != "..") {
									foreach($queries as $tag) {
										if (stripos($file, trim($tag)) !== false) {
											echo '<tr><td><a href="files/'.$file.'" target="_blank">'.$file.'</a></td><td>'.date("Y-m-d H:i",filemtime($file)).'</td><td>'.formatSizeUnits(filesize($file)).'</td><td><a href="javascript:confirmDelete(\''.$file.'\')">Delete</a></td></tr>';
											$i = $i + 1;
										}  
									}
								}
							}
							closedir($handle);
						}
						if (!$i)
							echo '<tr><td>No results</td><td>-</td><td>-</td><td>-</td></tr>';
					} else { //normal listing
						if ($handle = opendir("./")) {
							while (false !== ($file = readdir($handle))) {
								if ($file != "." && $file != "..") {
									echo '<tr><td><a href="files/'.$file.'" target="_blank">'.$file.'</a></td><td>'.date("Y-m-d H:i",filemtime($file)).'</td><td>'.formatSizeUnits(filesize($file)).'</td><td><a href="javascript:confirmDelete(\''.$file.'\')">Delete</a></td></tr>';
									$i = $i + 1;
								}
							}
							closedir($handle);
						}
						if (!$i)
							echo '<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</body>
	
	<?php
	function formatSizeUnits($bytes) {
		if ($bytes >= 1073741824)
		$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		elseif ($bytes >= 1048576)
		$bytes = number_format($bytes / 1048576, 2) . ' MB';
		elseif ($bytes >= 1024)
		$bytes = number_format($bytes / 1024, 2) . ' KB';
		elseif ($bytes > 1)
		$bytes = $bytes . ' bytes';
		elseif ($bytes == 1)
		$bytes = $bytes . ' byte';
		else
		$bytes = '0 bytes';
		return $bytes;
	}
	?>
</html>