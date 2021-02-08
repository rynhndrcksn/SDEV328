<?php
/**
 * @authors Shawn Potter & Ryan Hendrickson
 * @version 1.0
 * https://github.com/ShawnPotter/pets3
 * revising pets to have a proper model layer and adding more data manipulation
 */

// This is our Controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//start a session
session_start();

// Require the autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');

$f3 = Base::instance();

// turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

$f3->route('GET /', function () {
	$view = new Template();
	echo $view->render("views/pet-home.html");
});

$f3->route('GET|POST /order', function($f3) {

  //Check to see if the form has been posted
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //validate the data
    if(empty($_POST['pet'])){
      return false;
    } else {
      return true;
    }
  }

  $f3->set('colors', getColors());

  $view = new Template();
  echo $view->render("views/pet-order.html");
});

$f3->route('POST /order2', function($f3) {
	// gather pet type and color
	if(isset($_POST['petType'])){
	  $_SESSION['petType'] = $_POST['petType'];
  }
  if(isset($_POST['petColor'])){
    $_SESSION['petColor'] = $_POST['petColor'];
  }

  $f3->set('sizes', getSizes());
  $f3->set('accessories', getAccessories());

  $view = new Template();
  echo $view->render("views/pet-order2.html");
});

$f3->route('POST /order3', function () {
	// gather pet size and accessories
	if(isset($_POST['petSize'])){
		$_SESSION['petSize'] = $_POST['petSize'];
	}
	if(isset($_POST['petAccessories'])){
		$_SESSION['petAccessories'] = $_POST['petAccessories'];
	}

	$view = new Template();
	echo $view->render("views/pet-order3.html");
});

$f3->route('POST /summary', function () {
	if(isset($_POST['petName'])){
		$_SESSION['petName'] = $_POST['petName'];
	}

	$view = new Template();
	echo $view->render("views/order-summary.html");
});

$f3->run();