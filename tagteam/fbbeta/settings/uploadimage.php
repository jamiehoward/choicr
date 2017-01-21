<?php
	require("../scripts/connect.php");
	$target_path = "../public/img/";

	//Check file extension 
 	$allowedExtensions = array("jpg","jpeg","gif","png"); 
	foreach ($_FILES as $file) 
	{ 
		if ($file['tmp_name'] > '') 
		{ 
			if (!in_array(end(explode(".", 
				strtolower($file['name']))), 
				$allowedExtensions)) 
			{ 
			die($file['name'].' is an invalid file type!<br/>'. 
				'<a href="javascript:history.go(-1);">'. 
				'&lt;&lt Go Back</a>'); 
			} 
		} 
	} 
	//End check file extension

	//Rename image
			$imgstamp = date("ymdHis");
 			$newFileName = "u_". $imgstamp . $dbUsrCnt . ".JPG";
	//End rename image

//$target_path = $target_path . basename( $_FILES['profileimg']['name']); 

$target_path = $target_path . $newFileName;
if(move_uploaded_file($_FILES['profileimg']['tmp_name'], $target_path)) 
	{
	$PicError = 0;
	$ChoiceSQL = "UPDATE `Users` SET `dbUsrPic` = '$newFileName' WHERE `dbUsrCnt` = '$dbUsrCnt'";
	mysql_query ($ChoiceSQL, $dbconnect);
	header("Location: ./index.php?note=2");
	} 
else
	{
	echo $_FILES['profileimg']['error'] . "<br />";
	echo "There was an error uploading the file, please try again!";
	}

	//End image upload////////////////////////////////////

	
?>


