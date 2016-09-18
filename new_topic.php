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
        <style>

        </style>
    </head>
    <body>
        <div class="container">
            <button class="btn" onclick="location.href = 'logout.php';">Logout</button><br/>
            <p>Publish new topic:
            <form method="post">
                Topic name: <input type="text" name="topic_name"><br/>
                Description: 
                <br>
                <textarea name="description" rows="5" cols="55"></textarea>
                <br>
                <input type="submit" class="btn" name="submit" value="Post">
            </form>
        </p>
        <p>
            <button class="btn" onclick="location.href = 'forum_page.php';">Back to forum index</button>
        </p>
        <?php
        if (isset($_POST['submit'])) {
            $topic_name_input = $_POST['topic_name'];
            $description_input = $_POST['description'];

            $topic_name = "'$topic_name_input'";
            $post_text = "'$description_input'";
            $username_input = $_SESSION['user'];
            $username = "'$username_input'";

            $mysqli->real_query("SELECT id FROM user where username = $username");
            $res = $mysqli->use_result();

            while ($row = $res->fetch_assoc()) {
                $user_id = $row['id'];
            }

            $sql = "INSERT INTO forum_topics (topic_name, topic_by) VALUES ($topic_name, $user_id)";

            if ($mysqli->query($sql) === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->error, E_USER_ERROR);
            } else {
                $new_topic_id = $mysqli->insert_id;
                echo "<p>Topic with name $topic_name has been created.</p>";
            }

            $sql_post = "INSERT INTO forum_posts (post_text, topic_id, post_by) VALUES ($post_text, $new_topic_id, $user_id)";

            if ($mysqli->query($sql_post) === false) {
                trigger_error('Wrong SQL: ' . $sql_post . ' Error: ' . $mysqli->error, E_USER_ERROR);
            } else {
                $new_post_id = $mysqli->insert_id;
                echo "<p>Post to topic $topic_name has been submitted.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
