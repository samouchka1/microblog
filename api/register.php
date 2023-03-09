<?php

require "../config.php";

$input_data = json_decode(file_get_contents('php://input'));
$username = $input_data->username;
$password = $input_data->password;
$confirm_password = $input_data->confirm_password;

var_dump($username);
var_dump($password);
var_dump($confirm_password);


$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if(mysqli_query($mysqli, $sql)){
    echo json_encode(array('success' => true));
} else {
  echo json_encode(array('success' => false, 'message' => 'Error with registration.'));
}

$mysqli->close();

?>