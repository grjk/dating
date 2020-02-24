<?php

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require_once("vendor/autoload.php");
require_once("model/validation.php");

// Start session
session_start();

// Instantiate Fat-Free
$f3 = Base::Instance();

$controller = new controller($f3);

// Define a default route (view)
$f3 -> route("GET /", function () {
    $GLOBALS['controller']->home();
});

// Define another route
$f3->route('GET|POST /sign-up/1', function($f3) {
    $GLOBALS['controller']->su1();
});

// Define another route
$f3->route('GET|POST /sign-up/2', function($f3) {
    $GLOBALS['controller']->su2();
});

// Define another route
$f3->route('GET|POST /sign-up/3', function($f3) {
    $GLOBALS['controller']->su3();
});

// Define another route
$f3->route('GET|POST /sign-up/summary', function() {
    $GLOBALS['controller']->sum();
    session_destroy();
    $_SESSION = array();
});

// Run Fat-Free
$f3->run();