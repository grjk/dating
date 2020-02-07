<?php

// Start session
session_start();

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require("vendor/autoload.php");
require("model/validation.php");

// Instantiate Fat-Free
$f3 = Base::Instance();

// Define a default route (view)
$f3 -> route("GET /", function () {
    $view = new Template();
    echo $view->render("views/home.html");
});

// Define another route
$f3->route('GET|POST /sign-up/1', function($f3) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $age = $_POST["age"];
        $pnumber = $_POST["pnumber"];

        $f3->set('fname', $fname);
        $f3->set('lname', $lname);
        $f3->set('age', $age);
        $f3->set('pnumber', $pnumber);

        // If data is valid
        if (validFormOne()) {

            // Write data to Session
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['age'] = $age;
            $_SESSION['pnumber'] = $pnumber;

            // Redirect to Summary
            $f3->reroute('/sign-up/2');
        }
    }

    $view = new Template();
    echo $view->render('views/personal_info.html');
});

// Define another route
$f3->route('GET|POST /sign-up/2', function() {
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
$f3->route('POST /sign-up/3', function($f3) {
    // var_dump($_POST);
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['seeking'] = $_POST['customRadio'];
    $_SESSION['bio'] = $_POST['bio'];

    $f3->set('in_interests', array("Tv", "Movies", "Cooking", "Board games", "Puzzles", "Reading", "Playing cards", "Video games"));
    $f3->set('out_interests', array("Hiking", "Biking", "Swimming", "Collecting", "Walking", "Climbing"));
    $view = new Template();
    echo $view->render('views/interests_info.html');
});

// Define another route
$f3->route('POST /sign-up/summary', function() {
    // var_dump($_POST);
    $_SESSION['interests'] = $_POST['interests'];
    /*while ($_SESSION['interests']) {
        $f3->set('interests', array('chocolate' => 'Chocolate Mousse', 'vanilla' => 'Vanilla Custard', 'strawberry' => 'Strawberry Shortcake'));
    }*/

    $view = new Template();
    echo $view->render('views/signup_summary.html');
});

// Run Fat-Free
$f3->run();