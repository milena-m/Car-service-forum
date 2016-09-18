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
        <?php
        if (isset($_POST['edit_post'])) {
            $post_id = $_POST['post_id'];
            $post_text = $_POST['post_text'];
            $post_by_username = $_POST['post_by_username'];
            ?>
                 <h3>Edit post by user <?php echo $post_by_username; ?></h3>
                <form action="save_post_changes.php" method="post">
                    <textarea name="edited_text" rows="5" cols="55"><?php echo $post_text; ?></textarea>
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>"> 
                    <br>
                    <input type="submit" name="save_changes" value="Save" class="btn">    
                </form>
                <?php
            }
            ?>
            <p>
                <button class="btn" onclick="location.href = 'forum_page.php';">Back to forum index</button>
            </p>  
        </div>
    </body>
</html>