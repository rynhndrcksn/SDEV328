<?php

/*
 * Names: Joanna Folk & Ryan Hendrickson
 * Date: January 8th, 2021.
 * File: validation.php
 * Purpose: validates what the user entered and ajax will grab the output and print it to index.php
 */

// error reporting
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

// I couldn't figure out how to snag this from the index.php without jumping through a bunch of hoops, and even then
// I broke it repeatedly, so this is what I did
$cupcakes = array(
	'grasshopper' => 'The Grasshopper',
	'maple' => 'Whiskey Maple Bacon',
	'carrot' => 'Carrot Walnut',
	'caramel' => 'Salted Caramel Cupcake',
	'velvet' => 'Red Velvet',
	'lemon' => 'Lemon Drop',
	'tiramisu' => 'Tiramisu'
);

// set a success flag
$success = true;

// get the name
if (isset($_POST['name']) && !empty($_POST['name'])) {
	$name = prepInput($_POST['name']);
} else {
	echo '<p>Please enter a name</p>';
	$success = false;
}

// get the order[]
if (isset($_POST['order']) && validOrder($_POST['order'])) {
	$order = prepArrays($_POST['order']);
} else {
	echo '<p>Please select at least one valid cupcake</p>';
	$success = false;
}

// if everything is successful, we print out their order
if ($success) {
	echo "<p>Thank you $name for your order:</p>";
	echo "<p>Order Summary:</p>";
	echo '<ul>';
	foreach ($order as $item) {
		echo "<li>$cupcakes[$item]</li>";
	}
	echo '</ul>';
	$orderTotal = 0;
	foreach ($order as $item) {
		$orderTotal += 3.5;
	}
	echo "Order Total: $$orderTotal";
}

/**
 * prepares the data we received from user by ensuring it's DB/server safe
 * @param $data - the string we want to prep
 * @return string - return the prepared string
 */
function prepInput($data): string {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

/**
 * takes an array, implode's it, passes it to prepInput, explode's the result and returns it
 * @param $data - the array we want to prep
 * @return array - return the prepared array
 */
function prepArrays($data): array {
	$data = implode(', ', $data);
	prepInput($data);
	$data = explode(', ', $data);
	return $data;
}

/**
 * takes an array and validates the values in it to prevent spoofing
 * @param $data - the array we want to validate
 * @return bool - true if the values we received from the user are valid, false if any value isn't valid
 */
function validOrder($data): bool {
	$data = prepArrays($data);
	$valid = false;
	$validOrders[] = array('grasshopper', 'maple', 'carrot', 'caramel', 'velvet', 'lemon', 'tiramisu');
	foreach ($validOrders as $haystack) {
		foreach ($data as $needle) {
			// by assuming we're getting bad data, we can mitigate spoofing, because even if the first cupcake is valid, we
			// need to ensure the second, third, etc is valid too and we did this by making $valid false before attempting
			// to make it true
			if (!array_search($needle, $haystack)) {
				$valid = false;
			} else {
				$valid = true;
			}
		}
	}
	return $valid;
}