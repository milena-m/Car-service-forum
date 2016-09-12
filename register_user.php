<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once './DBconnect.php';
include_once 'User.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register user</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="container">
            <h2>User registration page</h2>
            <form method="POST">
                Name <input type="text" name="name"><br>
                Username <input type="text" name="username"><br>
                Password <input type="password" name="password"><br>
                E-mail <input type="text" name="email"><br>                            
                <input type="submit" class="btn" value="Create Profile" name="create_profile">       
            </form>
            <br>    
            <?php
            if (isset($_POST['create_profile'])) {
                try {
                    if (empty($_POST['name'])) {
                        throw new Exception("<br>Please, fill in all the fields!");
                    } else {
                        $name_input = htmlentities($_POST['name']);
                    }
                    if (empty($_POST['username'])) {
                        throw new Exception("<br>Please, fill in all the fields!");
                    } else {
                        $username_input = htmlentities($_POST['username']);
                    }
                    if (empty($_POST['password'])) {
                        throw new Exception("<br>Please, fill in all the fields!");
                    } else {
                        $password_input = htmlentities($_POST['password']);
                    }
                    if (empty($_POST['email'])) {
                        throw new Exception("<br>Please, fill in all the fields!");
                    } else {
                        $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

                        if (preg_match($pattern, $_POST['email']) === 1) {
                            $email_input = htmlentities($_POST['email']);
                        } else {
                            throw new Exception("<br>Invalid e-mail!");
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                if (!empty($name_input) && !empty($username_input) && !empty($password_input) && !empty($email_input)) {
                    $name = "'$name_input'";
                    $username = "'$username_input'";
                    $password = "'$password_input'";
                    $email = "'$email_input'";
                    $position = "'user'";

                    $user = new User($name, $username, $password, $email, $position);

                    $sql = "SELECT id FROM user WHERE username = $username";

                    $rs = $mysqli->query($sql);

                    if ($rs->num_rows === 0) {
                        $user->writeToDB($name, $username, $password, $email, $position);
                    } else {
                        echo "<br/>User with username $username already exists!";
                    }
                }
            } else {
                
            }
            ?>
            <button class="btn" onclick="location.href = 'service-index.php';">Start page</button>
        </div>
    </body>
