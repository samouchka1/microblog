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

    <title>Microblog - Home</title>
</head>
<body>

<?php include './components/navbar.php'; ?>

<div class="divider"></div>

<?php include './components/new_post.php'; ?>

<div class="divider"></div>

<?php include './components/posts.php'; ?>
    
<script src="/js/new_post.js"></script>
</body>
</html>