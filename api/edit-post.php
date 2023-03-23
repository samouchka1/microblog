<?php
session_start();

require "../config.php";

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}

$input_data = json_decode(file_get_contents('php://input'));
$edited_post = $input_data->edited_post;
$post_id = $input_data->post_id;

$timestamp = (new DateTime())->format('m/d/y h:i');

if(empty(trim($edited_post))){
    echo json_encode(array('success' => false, 'message' => 'Please enter a message.'));
} elseif(strlen($edited_post) < 5) {
    echo json_encode(array('success' => false, 'message' => 'Message must be at least 5 characters long.'));

    // limit to 280 characters

} else {
    // Sanitize
    $edited_post = $mysqli->real_escape_string($edited_post);

    $stmt = $mysqli->prepare("UPDATE posts SET post = ? WHERE username = ? AND id = ?");
    $stmt->bind_param("ssi", $edited_post, $username, $post_id);
    $stmt->execute();
    echo json_encode(array('success' => true, 'message' => 'Post edited!'));
}

$mysqli->close();

?>