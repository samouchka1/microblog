<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "microblog";

$mysqli = mysqli_connect($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>