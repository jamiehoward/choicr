<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Choicr Image Upload</title>
    <link type="text/css" rel="stylesheet" href="../../style/reset.css" />
    <link type="text/css" rel="stylesheet" href="../../style/popup.css" />
</head>
<body>
	<div class="content">
	<div class="ask">
		<form enctype="multipart/form-data" action="uploadimage.php" method="POST">
			<table>
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			<tr>
			<td>
			<h1>Choose a file to upload:</h1></td></tr><tr><td> <div><input name="uploadedfile" type="file" /></div></td></tr><br />
			<input type="hidden" text-align="center" name="choicecnt" value="<?php echo $_REQUEST['c'];?>" />
			<tr><td><h3>File Types: *.jpg, *.jpeg, *.png, *.gif</h3></td></tr>
			<tr><td><h3>Size: Below 1mb</h3></td></tr>
			<tr><td><input type="submit" value="Upload File" /></td></tr>
			</table>
		</form>
	</div>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery.base.js"></script>
</body>
</html>