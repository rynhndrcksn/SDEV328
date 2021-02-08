<?php
// this is the CONTROLLER

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// required files
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');

// create an instance of the base class (fat-free framework)
$f3 = Base::instance();

// define a default route (home page)
$f3->route('GET /', function($f3) {
	// assign variables
	$f3->set('username', 'jshmo');
	$f3->set('password', sha1('Password01'));
	$f3->set('title', 'Working with Templates');
	$f3->set('ftemp', 67);
	$f3->set('color', 'purple');
	$f3->set('radius', 10);
	$f3->set('pi', pi());
	$f3->set('fruits', getFruits());
	$f3->set('salaries', getSalaries());
	$f3->set('num', 10);
	$f3->set('preferredCustomer', true);

	// load template
	$view = new Template();
	echo $view->render('views/info.html');

	// alternate syntax for loading template
	// echo Template::instance()->render('views/info.html');
});

// run fat free HAS TO BE THE LAST THING IN FILE
$f3->run();
