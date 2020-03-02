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

    function insertMember()
    {

    }

    function getMembers()
    {

    }

    function getMember($smember_id)
    {

    }

    function getInterests($member_id)
    {

    }
}