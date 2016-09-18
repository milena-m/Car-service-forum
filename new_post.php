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
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="container">
            <button class="btn" onclick="location.href = 'logout.php';">Logout</button>
            <br>
            <?php
            if (isset($_POST['post_reply'])) {
                $reply_text_input = $_POST['reply_text'];
                $reply_text = "'$reply_text_input'";
                $topic_id = $_POST['topic_id'];
                $username_post = $_SESSION['user'];
                $username = "'$username_post'";

                $mysqli->real_query("SELECT id FROM user where username = $username");
                $res = $mysqli->use_result();

                while ($row = $res->fetch_assoc()) {
                    $user_id = $row['id'];
                }

                $sql_post = "INSERT INTO forum_posts (post_text, topic_id, post_by) VALUES ($reply_text, $topic_id, $user_id)";

                if ($mysqli->query($sql_post) === false) {
                    trigger_error('Wrong SQL: ' . $sql_post . ' Error: ' . $mysqli->error, E_USER_ERROR);
                } else {
                    $last_inserted_id = $mysqli->insert_id;
                    //   echo "<br/>Post with ID $last_inserted_id created";
                    ?>
                    <h3>Your post has been submitted.</h3>
                    <?php
                }
            }
            ?>
            <p>
                <button class="btn" onclick="location.href = 'forum_page.php';">Back to forum index</button>
            </p>
        </div>
    </body>
</html>
