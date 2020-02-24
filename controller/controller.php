<?php


class controller
{

    private $_f3;

    public function __construct($f3)
    {
        $this->_f3 = $f3;

        $this->_f3->set('gender', array('Male', 'Female'));
        $this->_f3->set('states', array(
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
    }

    public function home()
    {
        $view = new Template();
        echo $view->render("views/home.html");
    }

    public function su1()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $age = $_POST["age"];
            $gender = $_POST["gender"];
            $pnumber = $_POST["pnumber"];

            $this->_f3->set('fname', $fname);
            $this->_f3->set('lname', $lname);
            $this->_f3->set('age', $age);
            $this->_f3->set('genderSelected', $gender);
            $this->_f3->set('pnumber', $pnumber);

            // If data is valid
            if (validFormOne()) {

                // Write data to Session
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['age'] = $age;
                $_SESSION['gender'] = $gender;
                $_SESSION['pnumber'] = $pnumber;

                if (!empty($_POST["premium"])) {
                    $member = new PremiumMember($fname, $lname, $age, $gender, $pnumber);
                }
                else {
                    $member = new Member($fname, $lname, $age, $gender, $pnumber);
                }

                $_SESSION['member'] = $member;
                // Redirect to part 2
                $this->_f3->reroute('/sign-up/2');
            }
        }

        $view = new Template();
        echo $view->render('views/personal_info.html');
    }

    public function su2() {
        //var_dump($_SESSION);
        $this->_f3->set('state', "Select a state");

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST["email"];
            $state = $_POST["state"];
            $seeking = $_POST["seeking"];
            $bio = $_POST["bio"];

            $this->_f3->set('email', $email);
            $this->_f3->set('email', $email);
            $this->_f3->set('state', $state);
            $this->_f3->set('seeking', $seeking);
            $this->_f3->set('bio', $bio);

            if (validFormTwo()) {

                // Add to SESSION variable
                $_SESSION['email'] = $email;
                $_SESSION['state'] = $state;
                $_SESSION['seeking'] = $seeking;
                $_SESSION['bio'] = $bio;



                // Redirect to part 3
                $this->_f3->reroute('/sign-up/3');
            }
        }

        $view = new Template();
        echo $view->render('views/profile_info.html');
    }

    public function su3() {
        //var_dump($_SESSION);

        $this->_f3->set('in_interests', array("Tv", "Movies", "Cooking", "Board games", "Puzzles", "Reading", "Playing cards", "Video games"));
        $this->_f3->set('out_interests', array("Hiking", "Biking", "Swimming", "Collecting", "Walking", "Climbing"));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $interestsIn = $_POST['interestsIn'];
            $interestsOut = $_POST['interestsOut'];

            $this->_f3->set('interestsIn', $interestsIn);
            $this->_f3->set('interestsOut', $interestsOut);

            if (validFormThree()) {

                // Add to SESSION variable
                $_SESSION['interestsIn'] = $interestsIn;
                $_SESSION['interestsOut'] = $interestsOut;

                // Redirect to summary
                $this->_f3->reroute('/sign-up/summary');
            }
        }

        $view = new Template();
        echo $view->render('views/interests_info.html');
    }

    public function sum() {
        // var_dump($_POST);
        $view = new Template();
        echo $view->render('views/signup_summary.html');
    }
}