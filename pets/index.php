<?php

// This is our Controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');

$f3 = Base::instance();

/*
$f3->route('GET /', function ()
{
    echo "<h1>Pet Home</h1>";
});
*/

$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render("views/home.html");
});


$f3->run();

