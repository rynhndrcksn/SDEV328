<?php
/**
 * @authors Shawn Potter & Ryan Hendrickson
 * @version https://github.com/rynhndrcksn/pets2
 * more pets
 */

// This is our Controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//start a session
session_start();

// Require the autoload file
require_once('vendor/autoload.php');

$f3 = Base::instance();

// turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

$f3->route('GET /', function () {
	$view = new Template();
	echo $view->render("views/pet-home.html");
});

$f3->route('GET /order', function () {
	$view = new Template();
	echo $view->render("views/pet-order.html");
});

$f3->route('POST /order2', function () {
	if(isset($_POST['petType'])){
	  $_SESSION['petType'] = $_POST['petType'];
  }
  if(isset($_POST['petColor'])){
    $_SESSION['petColor'] = $_POST['petColor'];
  }
	$view = new Template();
	echo $view->render("views/pet-order2.html");
});

$f3->route('POST /order3', function () {
  if(isset($_POST['petName'])){
    $_SESSION['petName'] = $_POST['petName'];
  }
	$view = new Template();
	echo $view->render("views/pet-order3.html");
});

$f3->route('POST /summary', function () {
	if(isset($_POST['petSize'])){
		$_SESSION['petSize'] = $_POST['petSize'];
	}
	$view = new Template();
	echo $view->render("views/order-summary.html");
});

$f3->run();

