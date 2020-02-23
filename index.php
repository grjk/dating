<?php

// Start session
session_start();

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require_once("vendor/autoload.php");
require_once("model/validation.php");

// Instantiate Fat-Free
$f3 = Base::Instance();

$f3->set('gender', array('Male', 'Female'));
$f3->set('states', array(
    'AL'=>'Alabama',
    'AK'=>'Alaska',
    'AZ'=>'Arizona',
    'AR'=>'Arkansas',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DE'=>'Delaware',
    'DC'=>'District of Columbia',
    'FL'=>'Florida',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'IA'=>'Iowa',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'ME'=>'Maine',
    'MD'=>'Maryland',
    'MA'=>'Massachusetts',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MS'=>'Mississippi',
    'MO'=>'Missouri',
    'MT'=>'Montana',
    'NE'=>'Nebraska',
    'NV'=>'Nevada',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NY'=>'New York',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VT'=>'Vermont',
    'VA'=>'Virginia',
    'WA'=>'Washington',
    'WV'=>'West Virginia',
    'WI'=>'Wisconsin',
    'WY'=>'Wyoming',
));

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
        $gender = $_POST["gender"];
        $pnumber = $_POST["pnumber"];

        $f3->set('fname', $fname);
        $f3->set('lname', $lname);
        $f3->set('age', $age);
        $f3->set('genderSelected', $gender);
        $f3->set('pnumber', $pnumber);

        // If data is valid
        if (validFormOne()) {

            // Write data to Session
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['age'] = $age;
            $_SESSION['gender'] = $gender;
            $_SESSION['pnumber'] = $pnumber;

            // Redirect to part 2
            $f3->reroute('/sign-up/2');
        }
    }

    $view = new Template();
    echo $view->render('views/personal_info.html');
});

// Define another route
$f3->route('GET|POST /sign-up/2', function($f3) {

    //var_dump($_SESSION);
    $f3->set('state', "Select a state");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email = $_POST["email"];
        $state = $_POST["state"];
        $seeking = $_POST["seeking"];
        $bio = $_POST["bio"];

        $f3->set('email', $email);
        $f3->set('email', $email);
        $f3->set('state', $state);
        $f3->set('seeking', $seeking);
        $f3->set('bio', $bio);

        if (validFormTwo()) {

            // Add to SESSION variable
            $_SESSION['email'] = $email;
            $_SESSION['state'] = $state;
            $_SESSION['seeking'] = $seeking;
            $_SESSION['bio'] = $bio;

            // Redirect to part 3
            $f3->reroute('/sign-up/3');
        }
    }

    $view = new Template();
    echo $view->render('views/profile_info.html');
});

// Define another route
$f3->route('GET|POST /sign-up/3', function($f3) {

    //var_dump($_SESSION);

    $f3->set('in_interests', array("Tv", "Movies", "Cooking", "Board games", "Puzzles", "Reading", "Playing cards", "Video games"));
    $f3->set('out_interests', array("Hiking", "Biking", "Swimming", "Collecting", "Walking", "Climbing"));

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $interestsIn = $_POST['interestsIn'];
        $interestsOut = $_POST['interestsOut'];

        $f3->set('interestsIn', $interestsIn);
        $f3->set('interestsOut', $interestsOut);

        if (validFormThree()) {

            // Add to SESSION variable
            $_SESSION['interestsIn'] = $interestsIn;
            $_SESSION['interestsOut'] = $interestsOut;

            // Redirect to summary
            $f3->reroute('/sign-up/summary');
        }
    }

    $view = new Template();
    echo $view->render('views/interests_info.html');
});

// Define another route
$f3->route('GET|POST /sign-up/summary', function() {
    // var_dump($_POST);
    /*while ($_SESSION['interests']) {
        $f3->set('interests', array('chocolate' => 'Chocolate Mousse', 'vanilla' => 'Vanilla Custard', 'strawberry' => 'Strawberry Shortcake'));
    }*/

    //var_dump($_SESSION);

    $view = new Template();
    echo $view->render('views/signup_summary.html');
    session_destroy();
    $_SESSION = array();
});

// Run Fat-Free
$f3->run();