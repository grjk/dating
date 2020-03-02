<?php

/*
 * Member table:
 * CREATE TABLE member (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    age TINYINT NOT NULL,
    gender TINYTEXT(255) NOT NULL,
    phone INT NOT NULL,
    email VARCHAR(255) NOT NULL,
    STATE CHAR(2) NOT NULL,
    seeking TINYTEXT NOT NULL,
    bio TEXT NOT NULL,
    premium BIT NOT NULL,
    image TINYTEXT
    )
 *
 * Interest table:
 * CREATE TABLE interest (
    interest_id INT AUTO_INCREMENT PRIMARY KEY,
    interest VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL
    )
 *
 * member-interest table:
 *CREATE TABLE `member-interest` (
    mi_id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NOT NULL,
    interest_id INT NOT NULL,

    FOREIGN KEY (member_id) REFERENCES member( member_id),
    FOREIGN KEY (interest_id) REFERENCES interest(interest_id)
    )
 */


class Database
{
    private $_dbh;

    function __construct()
    {
        $this->connect();
    }

    function connect()
    {
        try {
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function insertMember($member)
    {
        $temp = "temp";

        $sql = "INSERT INTO member (fname, lname, age, gender, phone, email, state, seeking, bio, premium, image)
                VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image);";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':fname', $_SESSION['member']->getFname());
        $statement->bindParam(':lname', $_SESSION['member']->getLname());
        $statement->bindParam(':age', $_SESSION['member']->getAge());
        $statement->bindParam(':gender', $_SESSION['member']->getGender());
        $statement->bindParam(':phone', $_SESSION['member']->getPhone());
        $statement->bindParam(':email', $_SESSION['member']->getEmail());
        $statement->bindParam(':state', $_SESSION['member']->getState());
        $statement->bindParam(':seeking', $_SESSION['member']->getSeeking());
        $statement->bindParam(':bio', $_SESSION['member']->getBio());
        $statement->bindParam(':premium', $_SESSION['member']->isPremium());
        $statement->bindParam(':image', $temp);

        $statement->execute();

        $lastID = $this->_dbh->lastInsertId();

        foreach ($member->getIndoorInterests() as $interestIn) {
            $sql = "INSERT INTO `member-interest` (member_id, interest_id) VALUES (:lastID, (
                        SELECT interest_id FROM interest WHERE interest.interest = :interestIn))";

            $statement = $this->_dbh->prepare($sql);

            $statement->bindParam(':interestIn', $interestIn);
            $statement->bindParam(':lastID', $lastID);

            $statement->execute();
        }

        foreach ($member->getOutdoorInterests() as $interestOut) {
            $sql = "INSERT INTO `member-interest` (member_id, interest_id) VALUES (:lastID, (
                        SELECT interest_id FROM interest WHERE interest.interest = :interestOut))";

            $statement = $this->_dbh->prepare($sql);

            $statement->bindParam(':interestOut', $interestOut);
            $statement->bindParam(':lastID', $lastID);

            $statement->execute();
        }
    }

    function getMembers()
    {

    }

    function getMember($member_id)
    {

    }

    function getInterests($member_id)
    {

    }
}