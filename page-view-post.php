<?php

require './config.php';

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

if(isset($_SESSION['username'])){
    $commenting_user = $_SESSION['username'];
    $liking_user = $_SESSION['username'];
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
    <link rel="stylesheet" type="text/css" href="/css/post.css">
    <link rel="stylesheet" type="text/css" href="/css/comment.css">

    <title>Microblog - View Post</title>
</head>
<body>
    <div class="component-area-styles">
        <?php include './components/navbar.php'; ?>
    </div>
    <div class="component-area-styles">
        <?php include './components/post.php'; ?>
        <?php include './components/comments.php';?>
    </div>
    
    <script src="/js/new_comment.js"></script>
    <script src="/js/handle_like.js"></script>
</body>
</html>

