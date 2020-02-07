<?php

/* Validate the form
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

function validPN($PN) {
    return preg_match('/^[0-9]{9}/', $PN);
}