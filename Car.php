<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include_once './DBconnect.php';

class Car {
    private $brand = null;
    private $model = null;
    private $production_year = null;
    private $user_id = null;
    
    function __construct($brand, $model, $production_year, $user_id) {
        $this->brand = $brand;
        $this->model = $model;
        $this->production_year = $production_year;
        $this->user_id = $user_id;
    }
    
    function writeToDB($brand, $model, $production_year, $user_id, $username) {
        global $mysqli;
        $sql = "INSERT INTO car (brand, model, production_year, user_id) VALUES ($brand, $model, $production_year, $user_id)";

            if ($mysqli->query($sql) === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->error, E_USER_ERROR);
            } else {
                $last_inserted_id = $mysqli->insert_id;
                echo "<br/>Car with brand $brand, ID $last_inserted_id and owner $username created";
            }
    }
}
