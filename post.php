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
                                <div id="comment-response"></div>
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


    <!-- <div class="component-area-styles">
       
    </div> -->

    <div class="component-area-styles">
        <?php
            $sql = "SELECT * FROM comments WHERE post_id = " . $post_id . " ORDER BY timestamp DESC";
            $result = $mysqli->query($sql);

            if (!$result) {
                die('Error executing query: ' . $mysqli->error);
            }
        
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $username = $row["username"];
                    $comment = $row["comment"];
                    $timestamp = $row["timestamp"];
        
                    $comment = json_encode($comment);

                    // Decode the JSON string and replace \n with line breaks
                    $comment = str_replace(array('\r\n', '\r', '\n'), '<br/>', $comment);
                    $comment = str_replace('\\', '', $comment);
                    $comment = trim($comment, '"');

                    echo <<<COMMENT
                        <div class="post-styles">
                            <p style="font-weight: 600;">$username</p>
                            <div style="padding: 15px;">
                                <p>$comment</p>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <p style="font-size: 13px;">$timestamp</p>
                                <p>Like</p>
                            </div>
                        </div>
                    COMMENT;
                }
            } else {
        
                echo <<<ERROR
                    <div class="post-styles">
                        No comments found.
                    </div>
            
                ERROR;
            }
        ?>
    </div>
    <script src="/js/new_comment.js"></script>
</body>
</html>

