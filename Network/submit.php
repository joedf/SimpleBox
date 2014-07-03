<?php
//Start session
session_start();

//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
header("location: login.php");
exit();
}

// http://www.php.net/manual/en/features.file-upload.php#114004
// http://www.php.net/manual/en/function.mime-content-type.php#87856

//header('Content-Type: text/plain; charset=utf-8');

	if ($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
	} else {
		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		echo "Type: " . $_FILES["file"]["type"] . "<br>";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		if (move_uploaded_file($_FILES['file']['tmp_name'], "./files/" . $_FILES["file"]['name'])) {
			echo "<br>File successfully uploaded";
		} else {
			echo "<br>Error: File was not uploaded";
		}
	}

/*
try {
	
	// Undefined | Multiple Files | $_FILES Corruption Attack
	// If this request falls under any of them, treat it invalid.
	if (
		!isset($_FILES['file']['error']) ||
		is_array($_FILES['file']['error'])
	) {
		throw new RuntimeException('Invalid parameters.');
	}

	// Check $_FILES['file']['error'] value.
	switch ($_FILES['file']['error']) {
		case UPLOAD_ERR_OK:
			break;
		case UPLOAD_ERR_NO_FILE:
			throw new RuntimeException('No file sent.');
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			throw new RuntimeException('Exceeded filesize limit.');
		default:
			throw new RuntimeException('Unknown errors.');
	}

	// You should also check filesize here. 
	if ($_FILES['file']['size'] > 15744000) {
		throw new RuntimeException('Exceeded filesize limit. (15 MB)');
	}
	//echo "filename:".$_FILES['file']['name']."\n";
	//echo "tmp_name:".$_FILES['file']['tmp_name']."\n";
	

	
    if (move_uploaded_file($_FILES['file']['tmp_name'],"./files/test.pdf"))
	{
        echo 'File is uploaded successfully.';
    } else {
        throw new RuntimeException('FileMove error.');
    };
} catch (RuntimeException $e) {
	echo $e->getMessage();
}
*/

?>