<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once './DBconnect.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register employee</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="container">
            <h2>Employee registration page</h2>
            <form method="POST">
                Name <input type="text" name="name"><br/>
                Username <input type="text" name="username"><br/>
                Password <input type="password" name="password"><br/>
                E-mail <input type="text" name="email"><br/>
                Profession <input type="text" name="profession"><br/>
                Salary <input type="text" name="salary"><br/>
                <input type="submit" class="btn" value="Create Profile" name="create_profile">       
            </form>
            <br>
            <?php
            if (isset($_POST['create_profile'])) {

                $name_input = htmlentities($_POST['name']);
                $username_input = htmlentities($_POST['username']);
                $password_input = htmlentities($_POST['password']);
                $email_input = htmlentities($_POST['email']);
                $profession_input = htmlentities($_POST['profession']);
                $salary_input = htmlentities($_POST['salary']);

                $name = "'$name_input'";
                $username = "'$username_input'";
                $password = "'$password_input'";
                $email = "'$email_input'";
                $profession = "'$profession_input'";
                $salary = "'$salary_input'";
                $position = "'employee'";

                $user = new User($name, $username, $password, $email, $position);

                $sql = "SELECT id FROM user WHERE username = $username";

                $rs = $mysqli->query($sql);

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
