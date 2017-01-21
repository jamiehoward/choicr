<?php
	include ("../connect.php");
	$UserSQL = "SELECT * FROM Users";
	$UserResult = mysql_query($UserSQL, $dbconnect);
	$TotalUsers = mysql_num_rows($UserResult);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-style-type" content="text/css" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>INVOTICUS | Ask, Decide, Repeat!</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link type="text/css" rel="stylesheet" href="../../style/reset.css" />
	<link type="text/css" rel="stylesheet" href="../../style/base.css" />
    <link type="text/css" rel="stylesheet" href="../../style/colorbox/colorbox.css" />
</head>
<body>
		<div class="content">
			<div class="listing">
				<h1><span>Total Users:</span> <?php echo $TotalUsers;?></h1>
			</div>
		</div>
</body>
</html>