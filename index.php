<?php

session_start();

// $_SESSION["user_id"] = $id;
// $_SESSION["username"] = $username;

require './config.php';
require './api/auth.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/css/index.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
    <?php include 'register.php' ?>

    <title>Microblog</title>
</head>
<body>

<?php
    if(!isset($_SESSION["user_id"])){
        include './register.php';
    } else {
        include './login.php';
    }
?>

    <script src="/js/login.js"></script>

</body>
</html>