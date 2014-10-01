<?php
//Start session
session_start();

//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
header("location: login.php");
exit();
}

//$GLOBALS['currentdir_abs'] = "./files"; //basedir_absolutepath
$REQ_DIR = (isset($_REQUEST['d']))?$_REQUEST['d']:"";
$REQ_DIR = get_safe_subdir($REQ_DIR);
chdir($REQ_DIR);

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
			#list thead:first-child { color:blue;text-decoration:underline;cursor:pointer; }
			tr td:nth-child(26) { word-break:break-all; }
			tr:hover { background-color:#EFEFEF; }
			/*
			.w150 { width:150px; }
			.w100 { width:100px; }
			tr td:nth-child(3), tr td:nth-child(4) { text-align:right; }
			*/
			#loader {
				z-index:998;
				width:31px;
				height:31px;
				display:table-cell;
				text-align:center;
				vertical-align:middle;
				position:absolute;
				top:30%;
				left:50%;
				margin-top:-16px;
				margin-left:-16px;
			}
		</style>
		
		<script language="javascript" type="text/javascript">
			var abs_p = "<?php echo $GLOBALS['currentdir_abs']; ?>";
			function confirmDelete(f) {
				if (confirm('Are you sure you want to delete this file?\n\n\t' + '"' + f + '"')) {
					var p = window.location.pathname.replace(/^.*\/([^/]*)/, "$1");
					var req = "./" + p + '?d=' + abs_p + '&r=' + f;
					alert(req);
					window.location.replace(req);
				} else {
					// Do nothing!
				}
			}
			function confirmDeleteDir(f) {
				if (confirm('Are you sure you want to delete this folder?\n\n\t' + '"' + f + '"')) {
					var p = window.location.pathname.replace(/^.*\/([^/]*)/, "$1");
					var req = "./" + p + '?d=' + abs_p + '&r=' + f;
					alert(req);
					window.location.replace(req);
				} else {
					// Do nothing!
				}
			}
			function navigate(f) {
				document.getElementById('loader').style.display='block';
				if (f == "..") {
					var a = abs_p.substr(0,abs_p.length-1).lastIndexOf("/");
					if (a > 0)
						f = abs_p.substr(0,a);
					else
						f = "";
				} else {
					f = abs_p + f;
				}
				var p = window.location.pathname.replace(/^.*\/([^/]*)/, "$1");
				var req = "./" + p + '?d=' + f;
				//alert(req);
				window.location.replace(req);
			}
		</script>
	</head>

	<body>
		<div style="padding: 0 15px;">
		
			<img src="src/loading.gif" id="loader" style="display:none">
		
			<?php
				if (isset($_REQUEST['s']))
					echo '<h2>Files Search</h2><p>Search results for: <i><q>'.$_REQUEST['s'].'</q></i></p>';
				else
					echo "<h2>Files</h2>";
				
				echo '<p><b>Path: '.$GLOBALS['currentdir_abs']."</b></p>";
			?>

			<table id="list" class="sortable">
				<?php
				date_default_timezone_set("America/New_York"); // EST vs EDT time => EST with Daylight Savings Time
				$timetype = date("I")?"EDT":"EST";
				
				echo '';
				echo '<thead><tr><td>Filename</td><td class="w150">Last modified '.'('.$timetype.')'.'</td><td>Type</td><td class="w100">Size</td><td>Options</td></tr></thead>';
				
				if (strlen($GLOBALS['currentdir_abs']) > 1) {
					echo '<thead><tr><td><a href="javascript:navigate(\'..\')">Parent folder</a></td><td>-</td><td>-</td><td>-</td><td>-</td></tr></thead>';
				}
				echo '';
				
				?>
				<tbody>
					<?php
					$i = 0;
					
					if (isset($_REQUEST["r"])) {
						$tmp = basename($_REQUEST["r"]);
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
											list_display($file);
											$i = $i + 1;
										}  
									}
								}
							}
							closedir($handle);
						}
						if (!$i)
							echo '<tr><td>No results</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>';
					} else { //normal listing
						if ($handle = opendir("./")) {
							while (false !== ($file = readdir($handle))) {
								if ($file != "." && $file != "..") {
									list_display($file);
									$i = $i + 1;
								}
							}
							closedir($handle);
						}
						if (!$i)
							echo '<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>';
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
	function get_safe_subdir($r_dir) {
		if (strlen($r_dir) > 0) {
			$r_dir = preg_replace("/\/+/","/",$r_dir);
			$z = strrpos($r_dir,"./");
			$z = ($z)?$z:0;
			$xp = substr($r_dir,$z);
			$x = "./files/" . $xp;
			if (is_dir($x)) {
				$GLOBALS['currentdir_abs'] = $xp . "/";
				return $x;
			}
		}
		$GLOBALS['currentdir_abs'] = "/";
		return "./files";
	}
	function list_display($file) {
		if (is_dir($file))
			echo '<tr><td><a href="javascript:navigate(\''.$file.'\')">'.$file.'/</a>';
		else
			echo '<tr><td><a href="files'.$GLOBALS['currentdir_abs'].$file.'" target="_blank">'.$file.'</a>';
		
		echo '</td><td>'.date("Y-m-d H:i",filemtime($file)).'</td>';
		
		if (is_dir($file)) {
			echo '<td>Folder</td><td>'.formatSizeUnits(filesize($file)).'</td><td><a href="javascript:confirmDeleteDir(\''.$file.'\')">Delete</a></td></tr>';
		} else {
			$ext = strtoupper(pathinfo($file, PATHINFO_EXTENSION));
			echo '<td>'.$ext.' File</td><td>'.formatSizeUnits(filesize($file)).'</td><td><a href="javascript:confirmDelete(\''.$file.'\')">Delete</a></td></tr>';
		}
	}
	?>
</html>