<?php
// ~/public_html/328/login/logout.php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// destroy the session
session_start();
session_unset();
session_destroy();
header('location: login.php');