<?php
// path: ~/public_html/328/login/login.php

// error reporting:
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

$valid = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// check the login
	if ($_POST['username'] == 'jshmo' && $_POST['password'] == 'shmo123') {
		$_SESSION['loggedIn'] = $_POST['username'];
		header('location: index.php');
	} else {
		$valid = true;
	}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
	<style>
      .err {
          color: darkred;
      }
	</style>
</head>
<body>
<div class="container">

	<h1>Login Page</h1>

	<form action="#" method="post">
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" id="username" name="username" value="">
		</div>

		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" name="password" >
		</div>

		<?php
		if ($valid) {
			echo '<p class="err">Login is incorrect!</p>';
		}?>

		<button type="submit" class="btn btn-primary">Login</button>
	</form>

</div>

<script src="//code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>