<?php

require "../config.php";

$input_data = json_decode(file_get_contents('php://input'));
$username = $input_data->username;
$password = $input_data->password;
$confirm_password = $input_data->confirm_password;

// Validate
if(empty(trim($username)) || empty(trim($password))){
    echo json_encode(array('success' => false, 'message' => 'Please fill in all fields.'));
} elseif(strlen($username) < 5 || strlen($password) < 5) {
    echo json_encode(array('success' => false, 'message' => 'Username and password must be at least 5 characters long.'));
} elseif ($password !== $confirm_password) {
    echo json_encode(array('success' => false, 'message' => 'Passwords do not match.'));
} else {
    // Sanitize
    $username = $mysqli->real_escape_string($username);

    // Hash the password
    $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    // Check if the username already exists in the database
    $stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result(); //this ensures that result is stored before preparing and executing the INSERT statement
    if ($stmt->num_rows() > 0) {
        echo json_encode(array('success' => false, 'message' => 'Username already exists. Please choose a different username.'));
    } else {

        //Add the new user to the database
        $stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        echo json_encode(array('success' => true, 'message' => 'User registration successful!'));
    }
}
  
  $mysqli->close();

?>