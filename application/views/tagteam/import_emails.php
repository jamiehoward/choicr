<html>
<head>
	<title> Choicr Import Emails </title>
</head>
<body>
	<form method="POST" action="/register/importEmails/tagteam" enctype="multipart/form-data">
		<label for="file">Upload .csv files</label>
		<input type="hidden" value="1" name="hidden" />
		<input type="file" name="file" />
		<input type="submit" value="Upload" />
	</form>
</body>
</html>