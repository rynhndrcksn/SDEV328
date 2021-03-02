<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Ajax, JSON, & JQuery</title>
</head>
<body>

<label for="name">Enter pet name</label>
<input type="text" id="name" name="name">

<button id="btnClick">Click me</button>

<div id="output"></div>

<script src="//code.jquery.com/jquery.js"></script>
<script>
	// populate a hello
	$('#btnClick').on('click', function() {
		// let name = document.getElementById('name').value;
		let name = $('#name').val();
		$('#output').load('result.php', {name:name});
	});
</script>
</body>
</html>