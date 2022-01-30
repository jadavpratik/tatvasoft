<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Test Form</title>
</head>
<body>

	<form method="POST" action="<?= url('/test') ?>" enctype="multipart/form-data">
		<input type="text" name="name" value="Name">
		<br>
		<br>
		<input type="file" name="image">			
		<br>
		<br>
		<button>Submit</button>
	</form>

</body>
</html>