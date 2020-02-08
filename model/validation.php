<?php

/* Validate the first form in the sign-up process
 * @return boolean
 */
function validFormOne() {

    global $f3;
    $isValid = true;

    if (!validName($f3->get('fname'))) {
        $isValid = false;
        $f3->set("errors['fname']", "Please enter a valid first name");
    }

    if (!validName($f3->get('lname'))) {
        $isValid = false;
        $f3->set("errors['lname']", "Please enter a valid last name");
    }

    if (!validAge($f3->get('age'))) {
        $isValid = false;
        $f3->set("errors['age']", "Please enter a valid age (18-80)");
    }

    if (!validGender($f3->get('gender'))) {
        $isValid = false;
        $f3->set("errors['gender']", "Please select a gender");
    }

    if (!validPN($f3->get('pnumber'))) {
        $isValid = false;
        $f3->set("errors['pnumber']", "Please enter a 10 digit number");
    }

    return $isValid;
}

function validName($name) {
    return preg_match('/^[a-zA-Z]/', $name);
}

function validAge($age) {
    return ($age >= 18 && $age <= 80);
}

function validGender($gender) {
    return $gender;
}

function validPN($PN) {
    return preg_match('/^[0-9]{9}/', $PN);
}

// -------------------------------Form 2-------------------------------

/* Validate the second form in the sign-up process
 * @return boolean
 */
function validFormTwo() {

    global $f3;
    $isValid = true;

    if (!validEmail($f3->get('email'))) {
        $isValid = false;
        $f3->set("errors['email']", "Please enter a valid email");
    }

    if(!validState($f3->get('state'))) {
        $isValid = false;
        $f3->set("errors['state']", "Please choose a state");
    }

    if (!validGender($f3->get('seeking'))) {
        $isValid = false;
        $f3->set("errors['seeking']", "Please select a gender");
    }

    if (!validBio($f3->get('bio'))) {
        $isValid = false;
        $f3->set("errors['bio']", "Please enter a short bio about yourself...");
    }

    return $isValid;
}

function validEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validState($state) {
    return $state != "";
}

function validBio($bio) {
    return $bio;
}

// -------------------------------Form 3-------------------------------

function validFormThree() {

    global $f3;
    $isValid = true;

    if ($f3->get('interestsIn')) {
        if (!validInterests($f3->get('interestsIn'), $f3->get('in_interests'))) {
            $isValid = false;
            $f3->set("errors['in_interest']", "Oops... An option you chose is invalid. Please choose from the provided options");
        }
    }

    if ($f3->get('interestsOut')) {
        if (!validInterests($f3->get('interestsOut'), $f3->get('out_interests'))) {
            $isValid = false;
            $f3->set("errors['out_interest']", "Oops... An option you chose is invalid. Please choose from the provided options");
        }
    }

    return $isValid;
}

function validInterests($chosen, $validOptions) {
    if (!array_intersect($chosen, $validOptions)) {
        return false;
    }

    return true;
}