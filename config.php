<?php

$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "microblog";

$mysqli = mysqli_connect($servername, $db_username, $db_password, $db_name);

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

?>