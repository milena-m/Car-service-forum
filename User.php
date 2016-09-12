<?php

if (!isset($_SESSION)) {
    session_start();
}
include_once './DBconnect.php';

class User {

    private $name = null;
    private $username = null;
    private $password = null;
    private $email = null;
    private $position = null;

    function __construct($name, $username, $password, $email, $position) {
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->position = $position;
    }

    function writeToDB($name, $username, $password, $email, $position) {
        global $mysqli;
        $sql = "INSERT INTO user (name, username, password, email, position) VALUES ($name, $username, $password, $email, $position)";

        try {
            if ($mysqli->query($sql) === false) {
                throw new Exception('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->error, E_USER_ERROR);
                //    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->error, E_USER_ERROR);
            } else {
                $last_inserted_id = $mysqli->insert_id;
                //    echo "User with username $username, ID $last_inserted_id and position $position created";             
                $_SESSION['user'] = $username;
                header('Location: registered.php');
                exit;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
