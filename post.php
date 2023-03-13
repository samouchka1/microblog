<?php

require './config.php';

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/css/index.css">
    <link rel="stylesheet" type="text/css" href="/css/page.css">
    <link rel="stylesheet" type="text/css" href="/css/posts.css">

    <title>Microblog - View Post</title>
</head>
<body>

    <div class="component-area-styles">
        <?php 
            $post_id = $_GET['post_id'];

            // Retrieve the post from the database
            $sql = "SELECT * FROM posts WHERE id = $post_id";
            $result = $mysqli->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $username = $row["username"];
                    $post = $row["post"];
                    $timestamp = $row["timestamp"];
            
                    $post = json_encode($post);
                    // $post_id = $id;
            
                    // Decode the JSON string and replace \n with line breaks
                    $post = str_replace(array('\r\n', '\r', '\n'), '<br/>', $post);
                    $post = str_replace('\\', '', $post);
                    $post = trim($post, '"');
            
                    echo <<<POST
                        <div class="post-styles">
                            <p style="font-weight: 600;">$username</p>
                            <div style="padding: 15px;">
                                <p>$post</p>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <p style="font-size: 13px;">$timestamp</p>
                                <p>Like</p>
                            </div>
                        </div>
                    POST;
                }
            
            } else {
            
                echo <<<ERROR
                    <div class="post-styles">
                        No posts found.
                    </div>
            
                ERROR;
            }
        ?>
    </div>


    <div class="component-area-styles">
        <!-- add comments -->
        <div style="
            margin: 20px auto; 
            width: 400px;
            padding: 15px;
            border: solid 1px #000;
            border-radius: 4px;
            box-shadow: 0px 3px 1px -2px #00000033,0px 2px 2px 0px #00000024,0px 1px 5px 0px #0000001f;
            background-color: #fcfcfc; 
        ">
            <form id="comment-form" class="comment-form-styles">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <textarea style="height: 19px;" placeholder="Comment..." name="comment" rows="1" cols="42"></textarea>
                <button type="submit" style="margin-top: 10px;">Submit Comment</button>
            </form>
            <div id="comment-response"></div>
        </div>
    </div>
    <script src="/js/new_comment.js"></script>
</body>
</html>

