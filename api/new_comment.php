<?php
session_start();

require "../config.php";

$input_data = json_decode(file_get_contents('php://input'));

$post_id = $input_data->post_id;
$commenting_user = $input_data->commenting_user;
$comment = $input_data->comment;

$timestamp = (new DateTime())->format('m/d/y h:i');

if(empty(trim($comment))){
    echo json_encode(array('success' => false, 'message' => 'Please enter a message.'));
} elseif(strlen($comment) < 5) {
    echo json_encode(array('success' => false, 'message' => 'Message must be at least 5 characters long.'));
} else {
    // Sanitize
    $comment = $mysqli->real_escape_string($comment);

    $stmt = $mysqli->prepare("INSERT INTO comments (post_id, username, comment, timestamp) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('isss', $post_id, $commenting_user, $comment, $timestamp);
    $stmt->execute();
    echo json_encode(array('success' => true, 'message' => 'Comment added!'));
}

$mysqli->close();

?>
