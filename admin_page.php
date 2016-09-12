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
        <title></title>
        <link class="btn" rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="container">
        <button class="btn" onclick="location.href = 'logout.php';">Logout</button><br/>
        <h2> Profile page of <?php echo $_SESSION['user']; ?></h2>
        <p>Change user data: <br/>
        <form action="changeUserData.php" method="post">
            First name: <input type="text" name="fname"><br/>
            Last name: <input type="text" name="lname"><br/>
            New password: <input type="password" name="pass"><br/>
            Repeat new password: <input type="password" name="rep_pass"><br/>
            <input type="submit" class="btn" value="Save" name="change_data">
        </form>
    </p>     
    <button class="btn" onclick="location.href = 'forum-index.php';">Forum</button><br/><br/>
    </div>
</body>
</html>
