<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include_once './DBconnect.php';
include_once 'Car.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <button onclick="location.href = 'logout.php';">Logout</button><br/>
        <?php
        if (isset($_POST['submit'])) {

            $brand_input = htmlentities($_POST['brand']);
            $model_input = htmlentities($_POST['model']);
            $production_year_input = htmlentities($_POST['production_year']);

            $brand = "'$brand_input'";
            $model = "'$model_input'";
            $production_year = "'$production_year_input'";

            $username_input = $_SESSION['user'];
            $username = "'$username_input'";
                      
            $mysqli->real_query("SELECT id FROM user WHERE username = $username");
            $res = $mysqli->use_result();

            while ($row = $res->fetch_assoc()) {
                $user_id = $row['id'];
            }
            
            $car = new Car($brand, $model, $production_year, $user_id);
            $car->writeToDB($brand, $model, $production_year, $user_id, $username);
        }
        ?>
        <p>
            <button onclick="location.href = 'user_page.php';" id="myButton" class="float-left submit-button">Back to profile</button>
        </p>
    </body>
