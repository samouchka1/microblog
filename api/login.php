<?php

require "../config.php";

$input_data = json_decode(file_get_contents('php://input'));
$username = $input_data->username;
$password = $input_data->password;

//validate data
$username = test_input($username);
$password = test_input($password);
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$sql = "SELECT id, username, password FROM users WHERE username = '$username'";

$result = mysqli_query($mysqli, $sql);

if($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $id = $row["id"];
  $username = $row["username"];
  $hashed_password = $row["password"];

  if(password_verify($password, $hashed_password)) {
    session_start();

    $_SESSION["user_id"] = $id;
    $_SESSION["username"] = $username;
    $_SESSION["loggedin"] = true;

    echo json_encode(array('success' => true));
  } else {
    echo json_encode(array('success' => false, 'message' => 'The password you entered was not valid.'));
  }
} else {
  echo json_encode(array('success' => false, 'message' => 'No account found with that username.'));
}

$mysqli->close();

?>
