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
                First name <input type="text" name="first_name"><br>
                Last name <input type="text" name="last_name"><br>
                Username <input type="text" name="username"><br>
                Password <input type="password" name="password"><br>
                Town <input type="text" name="town"><br>
                E-mail <input type="text" name="email"><br>                            
                <input type="submit" class="btn" value="Create Profile" name="create_profile">       
            </form>
            <?php
            if (isset($_POST['create_profile'])) {
                try {

                    if (empty($_POST['first_name'])) {
                        throw new Exception("<p>Please, fill in all the fields!</p>");
                    } else {
                        $first_name_input = htmlentities($_POST['first_name']);
                    }

                    if (empty($_POST['last_name'])) {
                        throw new Exception("<p>Please, fill in all the fields!</p>");
                    } else {
                        $last_name_input = htmlentities($_POST['last_name']);
                    }

                    if (empty($_POST['username'])) {
                        throw new Exception("<p>Please, fill in all the fields!</p>");
                    } else {
                        $user_name = "'" . ($_POST['username']) . "'";
                        $result = $mysqli->query("SELECT username FROM user WHERE username = $user_name");
                        $row_cnt = $result->num_rows;
                        if ($row_cnt === 0) {
                            $username_input = htmlentities($_POST['username']);
                        } else {
                            throw new Exception("<p>This username is already taken!</p>");
                        }
                    }

                    if (empty($_POST['password'])) {
                        throw new Exception("<p>Please, fill in all the fields!</p>");
                    } elseif (strlen($_POST['password']) < 4) {
                        throw new Exception("<p>Password should contain at least 4 characters!</p>");
                    } else {
                        $password_input = htmlentities($_POST['password']);
                    }

                    if (empty($_POST['town'])) {
                        throw new Exception("<p>Please, fill in all the fields!</p>");
                    } else {
                        $town_input = htmlentities($_POST['town']);
                    }
                    $town_input = htmlentities($_POST['town']);

                    if (empty($_POST['email'])) {
                        throw new Exception("<p>Please, fill in all the fields!</p>");
                    } else {
                        $email = "'" . ($_POST['email']) . "'";
                        $result = $mysqli->query("SELECT email FROM user WHERE email = $email");
                        $row_cnt = $result->num_rows;
                        if ($row_cnt === 0) {
                            $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

                            if (preg_match($pattern, $_POST['email']) === 1) {
                                $email_input = htmlentities($_POST['email']);
                            } else {
                                throw new Exception("<p>Invalid e-mail!</p>");
                            }
                        } else {
                            throw new Exception("<p>There is a user with the same e-mail!</p>");
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                if (!empty($first_name_input) && !empty($last_name_input) && !empty($username_input) && !empty($password_input) && !empty($town_input) && !empty($email_input)) {
                    $first_name = "'$first_name_input'";
                    $last_name = "'$last_name_input'";
                    $username = "'$username_input'";
                    $password = "'$password_input'";
                    $town = "'$town_input'";
                    $email = "'$email_input'";
                    $role = "'user'";

                    $user = new User($first_name, $last_name, $username, $password, $town, $email, $role);

                    $sql = "SELECT id FROM user WHERE username = $username";

                    $rs = $mysqli->query($sql);

                    if ($rs->num_rows === 0) {
                        $user->writeToDB($first_name, $last_name, $username, $password, $town, $email, $role);
                    } else {
                        echo "<p>User with username $username already exists!</p>";
                    }
                }
            } else {
                
            }
            ?>
            <button class="btn" onclick="location.href = 'homepage.php';">Home page</button>
        </div>
    </body>
