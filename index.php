<?php
// Initialize the session
session_start();

// $_SESSION["user_id"] = $id;
// $_SESSION["username"] = $username;

require './config.php';

require './register.php';

$html = "";
 
// Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $html = str_ireplace("{register}", getRegister(), $html);
// }


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

    {register}

    <script src="/js/login.js"></script>

</body>
</html>