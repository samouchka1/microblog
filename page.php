<?php 

    session_start();

    if(!isset($_SESSION["user_id"])) {
        echo "Not authorized.";
        header('./index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/css/page.css">

    <title>Microblog - Home</title>
</head>
<body>

<?php include './components/navbar.php'; ?>

<div class="divider"></div>

<?php include './components/new_post.php'; ?>

<div class="divider"></div>

<?php include './components/posts.php'; ?>
    
</body>
</html>