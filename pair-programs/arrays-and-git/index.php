<?php
/*
 * author: Ryan Hendrickson
 * date: January 15th, 2020.
 * filename: index.php
 * url: https://rhendrickson.greenriverdev.com/328/pair-programs/arrays-and-git/index.php
 * description: a pair program for learning git and we make/manipulate some arrays
 */

// error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

require ('functions.php');
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Arrays and Git!</title>
</head>
<body>
	<h1>Pair Program 2</h1>
	<?php
	echo '<h2>PHP Array Practice!</h2>';

	// create a $numbers array to manipulate
	$numbers = array(7, 9, 8, 9, 8, 8, 6);

	// use our new function to print our $numbers array
	printArr($numbers);

	// print the largest number in the array
	echo '<p>The largest number in our array is: ' . largest($numbers) . '</p>';

	// remove duplicate numbers and prove it
	$numbers2 = $numbers;
	$numbers = removeDups($numbers);
	echo '<p>We have removed all duplicate numbers: ';
	printArr($numbers);

	// combines multiple elements into 1 via associative array
	echo '<p>Here we will var dump the array after turning it into an associate array:';
	$numbers2 = distribution($numbers2);
	echo '<pre>';
	var_dump($numbers2);
	echo '</pre>';

	?>
</body>
</html>
