<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include_once './DBconnect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <h3>User with username <?php echo $_SESSION['user']; ?> created</h3>
        <br><br>
        <button onclick="location.href = 'service-index.php';">Login</button>
    </body>
</html>
