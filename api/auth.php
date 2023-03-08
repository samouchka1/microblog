<?php

require "../config.php";

$input_data = json_decode(file_get_contents('php://input'));
$username = $input_data->username;
$password = $input_data->password;

var_dump($username);
var_dump($password);

$sql = "SELECT id, username, password FROM users WHERE username = '$username'";

$result = $mysqli->query($sql);

if($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $id = $row["id"];
  $username = $row["username"];
  $hashed_password = $row["password"];

  if(password_verify($password, $hashed_password)) {
    $_SESSION["user_id"] = $id;
    $_SESSION["username"] = $username;

    echo json_encode(array('success' => true));
  } else {
    echo json_encode(array('success' => false, 'message' => 'The password you entered was not valid.'));
  }
} else {
  echo json_encode(array('success' => false, 'message' => 'No account found with that username.'));
}

$mysqli->close();

?>
