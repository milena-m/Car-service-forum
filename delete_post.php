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
        <title>Delete post</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="container">
            <button class="btn" onclick="location.href = 'logout.php';">Logout</button><br><br>      
            <?php
            if (isset($_POST['delete_post'])) {
                $post_id = $_POST['post_id'];

                $sql_post = "DELETE FROM forum_posts WHERE post_id = $post_id";

                if ($mysqli->query($sql_post) === false) {
                    trigger_error('Wrong SQL: ' . $sql_post . ' Error: ' . $mysqli->error, E_USER_ERROR);
                } else {
                    echo "Post deleted.";
                }
            }
            ?>
            <p>
                <button class="btn" onclick="location.href = 'forum_page.php';">Back to forum index</button>
            </p>
        </div>
    </body>
</html>