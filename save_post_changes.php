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
        <button class="btn" onclick="location.href = 'logout.php';">Logout</button>
        <?php
        if (isset($_POST['save_changes'])) {
            $post_id = $_POST['post_id'];
            $edited_text_input = htmlentities($_POST['edited_text']);
            $edited_text = "'$edited_text_input'";

            $sql_post = "UPDATE forum_posts SET post_text = $edited_text WHERE post_id = $post_id";

            if ($mysqli->query($sql_post) === false) {
                trigger_error('Wrong SQL: ' . $sql_post . ' Error: ' . $mysqli->error, E_USER_ERROR);
            } else {
                echo "<br><br>Changes saved";
            }
        }
        ?>
        <p>
            <button class="btn" onclick="location.href = 'forum_page.php';">Back to forum index</button>
        </form>
    </p>
</body>
</html>