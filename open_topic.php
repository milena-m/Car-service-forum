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
        <button class="btn" onclick="location.href = 'forum_page.php';">Back to forum index</button>
        <button class="btn" onclick="location.href = 'logout.php';">Logout</button><br><br>
        <?php
        if (isset($_POST['open'])) {
            $username = $_SESSION['user'];
            $topic_id = $_POST['topic_id'];

            $mysqli->real_query("SELECT topic_name FROM forum_topics WHERE forum_topics.topic_id = $topic_id");

            $result = $mysqli->use_result();

            if (!$result) {
                echo "<p>No results found!</p>";
            } else {
                while ($row = $result->fetch_assoc()) {
                    $topic_name = $row['topic_name'];
                }
            }
            ?>
            <table class="forum-table">
                <tr class="forum-tr">
                    <th class="forum-th">User</th>
                    <th class="forum-th"><?php echo "Topic: $topic_name"; ?></th>
                    <th class="forum-th">Date posted</th>
                    <?php
                    if ($username === 'admin') {
                        echo '<th class="forum-th" colspan="2">Options</th>';
                    } 
                    
                    $mysqli->real_query("SELECT forum_topics.topic_name, forum_topics.topic_id, forum_topics.topic_by, forum_posts.post_text, forum_posts.post_date, forum_posts.post_by, forum_posts.post_id, 
                user.username FROM forum_topics INNER JOIN forum_posts ON forum_topics.topic_id = forum_posts.topic_id INNER JOIN user ON forum_posts.post_by = user.id WHERE forum_topics.topic_id = $topic_id ORDER BY post_date ASC");

                    $rs = $mysqli->use_result();

                    if (!$rs) {
                        echo "<p>No results found!</p>";
                    } else {
                        while ($row = $rs->fetch_assoc()) {
                            $topic_name = $row['topic_name'];
                            $topic_by = $row['topic_by'];
                            $topic_id = $row['topic_id'];
                            $post_text = $row['post_text'];
                            $post_date = $row['post_date'];
                            $post_by = $row['post_by'];
                            $post_id = $row['post_id'];
                            $post_by_username = $row['username'];
                            ?>
                        <tr class="forum-tr">
                            <td class="forum-td" id="post_by_username"><?php echo $post_by_username ?></td>
                            <td class="forum-td"><?php echo $post_text ?></td>
                            <td class="forum-td" id="post_date"><?php echo $post_date ?></td>
                            <?php
                            if ($username === 'admin') {
                                ?>
                                <td class="forum-td">
                                    <form action="edit_post.php" method="post">
                                        <input type="hidden" name="post_text" value="<?php echo $post_text; ?>"> 
                                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>"> 
                                        <input type="hidden" name="post_by_username" value="<?php echo $post_by_username; ?>">
                                        <input class="btn" type="submit" name="edit_post" value="Edit post">
                                    </form>
                                </td>
                                <td class="forum-td">
                                    <form action="delete_post.php" method="post">
                                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                        <input class="btn" type="submit" name="delete_post" value="Delete post">
                                    </form>
                                </td>
                                <?php
                            } 
                            ?>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
        </table>
        <br>
        <h4>Post a reply:</h4>
        <form action="new_post.php" method="post">
            <textarea name="reply_text" rows="5" cols="55"></textarea>
            <br>
            <input type="hidden" name= "topic_id" value="<?php echo $topic_id ?>">
            <input type="submit" class="btn" name="post_reply" value="Submit">
        </form>
    </body>
</html>



