<?php

class Validation {

    private $_f3;

    public function __construct($_f3) {
        $this->_f3 = $_f3;
    }

    // -------------------------------Form 1 Validation Checker-------------------------------

    /* Validate the first form in the sign-up process
     * @return boolean
     */
    function validFormOne() {

        $isValid = true;

        if (!$this->validName($this->_f3->get('fname'))) {
            $isValid = false;
            $this->_f3->set("errors['fname']", "Please enter a valid first name");
        }

        if (!$this->validName($this->_f3->get('lname'))) {
            $isValid = false;
            $this->_f3->set("errors['lname']", "Please enter a valid last name");
        }

        if (!$this->validAge($this->_f3->get('age'))) {
            $isValid = false;
            $this->_f3->set("errors['age']", "Please enter a valid age (18-80)");
        }

        if (!$this->validGender($this->_f3->get('genderSelected'))) {
            $isValid = false;
            $this->_f3->set("errors['gender']", "Please select a gender");
        }

        if (!$this->validPN($this->_f3->get('pnumber'))) {
            $isValid = false;
            $this->_f3->set("errors['pnumber']", "Please enter a 10 digit number");
        }

        return $isValid;
    }

// -------------------------------Form 2 Validation Checker-------------------------------

    /* Validate the second form in the sign-up process
     * @return boolean
     */
    function validFormTwo() {

        $isValid = true;

        if (!$this->validEmail($this->_f3->get('email'))) {
            $isValid = false;
            $this->_f3->set("errors['email']", "Please enter a valid email");
        }

        if(!$this->validState($this->_f3->get('state'))) {
            $isValid = false;
            $this->_f3->set("errors['state']", "Please choose a state");
        }

        if (!$this->validGender($this->_f3->get('seeking'))) {
            $isValid = false;
            $this->_f3->set("errors['seeking']", "Please select a gender");
        }

        if (!$this->validBio($this->_f3->get('bio'))) {
            $isValid = false;
            $this->_f3->set("errors['bio']", "Please enter a short bio about yourself...");
        }

        return $isValid;
    }

// -------------------------------Form 3 Validation Checker-------------------------------

    /* Validate the third form in the sign-up process
     * @return boolean
     */
    function validFormThree() {

        $isValid = true;

        if ($this->_f3->get('interestsIn')) {
            if (!$this->validInterests($this->_f3->get('interestsIn'), $this->_f3->get('in_interests'))) {
                $isValid = false;
                $this->_f3->set("errors['in_interest']", "Oops... An option you chose is invalid. Please choose from the provided options");
            }
        }

        if ($this->_f3->get('interestsOut')) {
            if (!$this->validInterests($this->_f3->get('interestsOut'), $this->_f3->get('out_interests'))) {
                $isValid = false;
                $this->_f3->set("errors['out_interest']", "Oops... An option you chose is invalid. Please choose from the provided options");
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
}