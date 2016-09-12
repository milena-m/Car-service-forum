<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include_once './DBconnect.php'; ?>

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
        if (isset($_POST['search'])) {
            $salary = $_POST['salary'];

            $sql = "SELECT username, name, profession, salary FROM user WHERE salary = $salary";

            $rs = $mysqli->query($sql);

            if ($rs->num_rows === 0) {
                echo "<br><br>No results found!";
            } else {
                while ($row = $rs->fetch_assoc()) {
                    echo "<br><br>FOUND EMPLOYEE WITH:<br> Username: " . $row['username'];
                    echo "<br>Name: " . $row['name'];
                    echo "<br>Profession: " . $row['profession'];
                    echo "<br>Salary: " . $row['salary'];
                }
            }
        }
        ?>
        <br>
        <br>
        <button onclick="location.href = 'user_page.php';">Back to profile</button><br/><br/>
    </body>
</html>
