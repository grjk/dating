<?php

// -------------------------------Form 1 Validation Checker-------------------------------

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

// -------------------------------Form 2 Validation Checker-------------------------------

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

// -------------------------------Form 3 Validation Checker-------------------------------

/* Validate the third form in the sign-up process
 * @return boolean
 */
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

// -------------------------------Validation Functions-------------------------------

/* Function to validate if the variable passed in complies with the rules for what a name can have
 * @return boolean
 */
function validName($name) {
    return preg_match('/^[a-zA-Z]/', $name);
}

/* Function to validate age by making sure a value in between 18 and 80 exists
 * @return boolean
 */
function validAge($age) {
    return ($age >= 18 && $age <= 80);
}

/* Function to validate gender by checking if one of the radio buttons have been set
 * @return boolean
 */
function validGender($gender) {
    return $gender;
}

/* Function to validate the phone number by checking length and what characters were put in
 * @return boolean
 */
function validPN($PN) {
    return preg_match('/^[0-9]{9}/', $PN);
}

/* Function to validate email by checking if it complies with the email-standard
 * @return boolean
 */
function validEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/* Function to validate the state by checking if the value has been set
 * @return boolean
 */
function validState($state) {
    return $state != "";
}

/* Function to validate the bio by checking if it has been set
 * @return boolean
 */
function validBio($bio) {
    return $bio;
}

/* Function to validate interests by checking if the selected ones are one of the provided options
 * @return boolean
 */
function validInterests($chosen, $validOptions) {
    if (!array_intersect($chosen, $validOptions)) {
        return false;
    }

    return true;
}