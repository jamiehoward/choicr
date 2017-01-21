<?php
	require("../../scripts/connect.php");

	$ChoiceCnt = $_REQUEST['choicecnt'];
	$target_path = "../../ask/img/";

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
 			$newFileName = $ChoiceCnt . $imgstamp . $dbUsrCnt . ".JPG";
	//End rename image

//$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

$target_path = $target_path . $newFileName;
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	$PicError = 0;
} else{
	echo $_FILES['uploadedfile']['error'] . "<br />";
	echo "There was an error uploading the file, please try again!";
}

	//End image upload////////////////////////////////////

	$ChoiceSQL = "UPDATE `Choices` SET `dbChcPic` = '$newFileName' WHERE `dbChcCnt` = '$ChoiceCnt'";
	mysql_query ($ChoiceSQL, $dbconnect);

?>
<script language="JavaScript">
<!--
function refreshParent() {
  window.opener.location.href = window.opener.location.href;

  if (window.opener.progressWindow)
		
 {
    window.opener.progressWindow.close()
  }
  window.close();
}
//-->
</script>

