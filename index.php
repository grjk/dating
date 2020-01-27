<?php

// Start session
session_start();

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require("vendor/autoload.php");

// Instantiate Fat-Free
$f3 = Base::Instance();

// Define a default route (view)
$f3 -> route("GET /", function () {
    $view = new Template();
    echo $view->render("views/home.html");
});

// Define another route
$f3->route('GET /sign-up/1', function() {
    $view = new Template();
    echo $view->render('views/personal_info.html');
});

// Define another route
$f3->route('POST /sign-up/2', function() {
    // var_dump($_POST);
    $_SESSION['fname'] = $_POST['fname'];
    $_SESSION['lname'] = $_POST['lname'];
    $_SESSION ['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['customRadio'];
    $_SESSION['pnumber']= $_POST['pnumber'];
    $view = new Template();
    echo $view->render('views/profile_info.html');
});

// Define another route
$f3->route('POST /sign-up/3', function() {
    // var_dump($_POST);
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['seeking'] = $_POST['customRadio'];
    $_SESSION['bio'] = $_POST['bio'];
    $view = new Template();
    echo $view->render('views/interests_info.html');
});

// Define another route
$f3->route('POST /sign-up/summary', function() {
    // var_dump($_POST);
    $_SESSION['interests'] = $_POST['interests'];
    $view = new Template();
    echo $view->render('views/signup_summary.html');
});

// Define route
$f3->route('POST /order2', function() {
    // var_dump($_POST);
    $_SESSION['food'] = $_POST['orderInput'];
    $view = new Template();
    echo $view->render('views/form2.html');
});

// Run Fat-Free
$f3->run();