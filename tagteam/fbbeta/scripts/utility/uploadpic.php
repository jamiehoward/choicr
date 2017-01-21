<?php
	require("../connect.php");
	require("../session.php");
	$target_path = "uploadtest/";
	$dbUsrCnt = 999;

	//Check file extension 
  $allowedExtensions = array("jpg","jpeg","gif","png"); 
  foreach ($_FILES as $file) { 
    if ($file['tmp_name'] > '') { 
      if (!in_array(end(explode(".", 
            strtolower($file['name']))), 
            $allowedExtensions)) { 
       die($file['name'].' is an invalid file type!<br/>'. 
        '<a href="javascript:history.go(-1);">'. 
        '&lt;&lt Go Back</a>'); 
      } 
    } 
  } 
	//End check file extension

	//Rename image
			$imgstamp = date("ymdHis");
		  	$PhotoSQL = "SELECT * FROM `Choices` ORDER BY `dbChcPic` DESC LIMIT 1";
		  	$PhotoResult = mysql_query ($PhotoSQL, $dbconnect);
		  	$PhotoRow = mysql_fetch_array ($PhotoResult);
			$Photo1ID = $PhotoRow['dbChcPic'] + 1;
			$Photo2ID = $PhotoRow['dbChcPic'] + 2;	 
 			$newFileName1 = $Photo1ID . $imgstamp . $dbUsrCnt . ".jpg";
 			$newFileName2 = $Photo2ID . $imgstamp . $dbUsrCnt . ".jpg";
	//End rename image

//$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

$target_path = $target_path . $newFileName;
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
//	echo "The file ".  basename( $_FILES['uploadedfile']['name']). " has been uploaded";
	echo "The file ". $newFileName. " has been uploaded";
} else{
	echo $_FILES['uploadedfile']['error'];
	echo "There was an error uploading the file, please try again!";
}
?>