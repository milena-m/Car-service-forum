<?php
include_once './DBconnect.php';

class User {

    private $first_name = null;
    private $last_name = null;
    private $username = null;
    private $password = null;
    private $town = null;
    private $email = null;
    private $role = null;

    function __construct($first_name, $last_name, $username, $password, $town, $email, $role) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->username = $username;
        $this->password = $password;
        $this->town = $town;
        $this->email = $email;
        $this->role = $role;
    }

    function writeToDB($first_name, $last_name, $username, $password, $town, $email, $role) {
        global $mysqli; 
        $sql = "INSERT INTO user (first_name, last_name, username, password, town, email, role) VALUES ($first_name, $last_name, $username, $password, $town, $email, $role)";

        try {
            if ($mysqli->query($sql) === false) {
                throw new Exception('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->error, E_USER_ERROR);
                //    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->error, E_USER_ERROR);
            } else {
             //   $last_inserted_id = $mysqli->insert_id;
                //    echo "User with username $username, ID $last_inserted_id and role $role created";             
                $_SESSION['user'] = $username;
                header('Location: registered.php');
                exit;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
