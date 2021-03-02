<?php
/*
 * @author: Ryan H.
 * @version: https://github.com/rynhndrcksn/food-two
 * index.php is the controller for our F3 MVC
 */

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require autoload file
require_once ('vendor/autoload.php');
require $_SERVER['DOCUMENT_ROOT'] . "/../includes/config.php";

// create a session
session_start();

// instantiate the classes
$f3 = Base::instance();
$dataLayer = new DataLayer($dbh);
$validator = new Validate($dataLayer);
$order = new Order();
$controller = new Controller($f3);

// turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

// define a default route (home page)
$f3->route('GET /', function() use ($controller) {
	$controller->home();
});

// define an order route
$f3->route('GET|POST /order', function() use ($controller) {
	$controller->order();
});

// we can only use POST if the form method is POST, otherwise we need to use GET as GET is used for typing in the
// URL, hyperlinks, and most other things
// define an order2 route
$f3->route('GET|POST /order2', function() use ($controller) {
	$controller->order2();
});

// define a summary route
$f3->route('GET|POST /summary', function() use ($controller) {
	$controller->summary();
});

//Define an order summary route
$f3->route('GET /order-summary', function() use ($controller) {
	$controller->orderSummary();
});

// run fat free HAS TO BE THE LAST THING IN FILE
$f3->run();
