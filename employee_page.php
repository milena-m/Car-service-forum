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
        <p> Profile page of employee <?php echo $_SESSION['user']; ?></p>
        <button onclick="location.href = 'service-index.php';" id="myButton" class="float-left submit-button" >Home</button>


        <button onclick="location.href = 'forum-index.php';">Forum</button><br/><br/>
        <button onclick="location.href = 'service-index.php';">Back to start page</button>

    </body>
</html>
