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
        <div class="forum-div">
        <button class="btn" onclick="location.href = 'logout.php';">Logout</button><br/>
        <p> Welcome to the Service forum, <?php echo $_SESSION['user']; ?></p>
        <table class="forum-table">
            <tr class="forum-tr">
                <th class="forum-th">Topic</th>
                <th class="forum-th">Published</th>
                <th class="forum-th">User</th>
                <th class="forum-th"></th>
            </tr>
            <?php
            $mysqli->real_query("SELECT forum_topics.topic_id, forum_topics.topic_name, forum_topics.topic_date, user.username FROM forum_topics INNER JOIN user ON forum_topics.topic_by = user.id");
            $res = $mysqli->use_result();

            while ($row = $res->fetch_assoc()) {
                $topic_name = $row['topic_name'];
                $topic_date = $row['topic_date'];
                $publisher = $row['username'];
                $topic_id = $row['topic_id'];
                ?>  
                <tr>
                    <td class="forum-td"><?php echo $topic_name; ?></td>
                    <td class="forum-td"><?php echo $topic_date; ?></td>
                    <td class="forum-td"><?php echo $publisher; ?></td>
                    <td class="forum-td"><form action="open_topic.php" method="post">
                            <input type="hidden" name= "topic_id" value="<?php echo $topic_id ?>">
                            <input class="btn" type="submit" name="open" value="Open">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <p>
            <button class="btn" onclick="location.href = 'new_topic.php';">Publish new topic</button>
        </p>     
        <button class="btn" onclick="location.href = 'user_page.php';">Back to profile</button>
        </div>
    </body>
</html>
