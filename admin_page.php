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
        <?php
        // To be written
        ?>
    </p>     
    <button class="btn" onclick="location.href = 'forum_page.php';">Forum</button><br/><br/>
    </div>
</body>
</html>
