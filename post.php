<?php

require './config.php';

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

if(isset($_SESSION['username'])){
    $commenting_user = $_SESSION['username'];
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
    <link rel="stylesheet" type="text/css" href="/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="/css/posts.css">
    <link rel="stylesheet" type="text/css" href="/css/comment.css">

    <title>Microblog - View Post</title>
</head>
<body>
    <div class="component-area-styles">
        <?php include './components/navbar.php'; ?>
    </div>
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
                            <div style="
                                margin: 20px auto 15px; 
                                width: 400px;
                                background-color: #fcfcfc; 
                            ">
                                <form id="comment-form" class="comment-form-styles">
                                    <input type="hidden" name="post_id" value="$post_id">
                                    <input type="hidden" name="commenting_user" value="$commenting_user">
                                    <textarea style="height: 19px;" placeholder="Comment..." name="comment" rows="1" cols="42"></textarea>
                                    <button type="submit" style="margin-top: 10px;">Submit Comment</button>
                                </form>
                                <div id="comment-response" class="response-styles"></div>
                                <div id="comment-response-success" class="response-success-styles"></div>
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
        <?php include './components/comments.php';?>
    </div>
    <script src="/js/new_comment.js"></script>
</body>
</html>

