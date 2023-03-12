<?php
session_start();

require "../config.php";

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}

$input_data = json_decode(file_get_contents('php://input'));

$new_post = $input_data->new_post;

if(empty(trim($new_post))){
    echo json_encode(array('success' => false, 'message' => 'Please enter a message.'));
} elseif(strlen($new_post) < 5) {
    echo json_encode(array('success' => false, 'message' => 'Message must be at least 5 characters long.'));
} else {
    // Sanitize
    $new_post = $mysqli->real_escape_string($new_post);

    $timestamp = (new DateTime())->format('m/d/y h:i');

    $stmt = $mysqli->prepare("INSERT INTO posts (username, post, timestamp) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $new_post, $timestamp);
    $stmt->execute();
    echo json_encode(array('success' => true, 'message' => 'New post created!'));
}

$mysqli->close();

?>