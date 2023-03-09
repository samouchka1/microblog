<?php

require "../config.php";

$input_data = json_decode(file_get_contents('php://input'));
$username = $input_data->username;
$password = $input_data->password;
$confirm_password = $input_data->confirm_password;

//validate data
$username = test_input($username);
$password = test_input($password);
$confirm_password = test_input($confirm_password);
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($confirm_password != $password ) {
    echo 'Password does not match.';
} else {
    $password = $confirm_password;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// $stmt = $mysqli->prepare("INSERT INTO CountryLanguage VALUES (?, ?, ?, ?)");
// $stmt->bind_param('sssd', $code, $language, $official, $percent);
// $stmt->execute();

$sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

if(mysqli_query($mysqli, $sql)){
    echo json_encode(array('success' => true));
} else {
  echo json_encode(array('success' => false, 'message' => 'Error with registration.'));
}

$mysqli->close();

?>