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
    <link rel="stylesheet" type="text/css" href="/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="/css/new_post.css">
    <link rel="stylesheet" type="text/css" href="/css/posts.css">

    <title>Microblog - Profile</title>
</head>
<body>
    <div class="component-area-styles">
        <?php include './components/navbar.php'; ?>
    </div>
    <div class="component-area-styles">
        <?php include './components/new_post.php'; ?>
    </div>
    <div class="component-area-styles">
        <h3 class="center">My Posts</h3>
        <div class="grid-container">
            <?php include './components/my_posts.php'; ?>
        </div>
    </div>

    <script src="/js/new_post.js"></script>
</body>
</html>