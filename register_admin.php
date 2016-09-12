<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once './DBconnect.php';
include_once './User.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register admin</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="container">
            <h2>Admin registration page</h2>
            <form method="POST">
                Name <input type="text" name="name"><br/>
                Username <input type="text" name="username"><br/>
                Password <input type="password" name="password"><br/>
                E-mail <input type="text" name="email"><br/>
                <input type="submit" class="btn" value="Create Profile" name="create_profile">       
            </form>
            <br>    
            <?php
            if (isset($_POST['create_profile'])) {

                $name_input = htmlentities($_POST['name']);
                $username_input = htmlentities($_POST['username']);
                $password_input = htmlentities($_POST['password']);
                $email_input = htmlentities($_POST['email']);

                $name = "'$name_input'";
                $username = "'$username_input'";
                $password = "'$password_input'";
                $email = "'$email_input'";
                $position = "'admin'";

                $user = new User($name, $username, $password, $email, $position);

                $sql = "SELECT id FROM user WHERE username = $username";

                $rs = $mysqli->query($sql);
                var_dump($rs);
                if ($rs->num_rows === 0) {
                    $user->writeToDB($name, $username, $password, $email, $position);
                } else {
                    echo "<br/>User with username $username already exists!";
                }
            }
            ?>
            <button class="btn" onclick="location.href = 'service-index.php';">Start page</button>
        </div>
    </body>
