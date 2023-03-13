<?php
session_start();

require "../config.php";

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}

$input_data = json_decode(file_get_contents('php://input'));

$post_id = $input_data->post_id;
$comment = $input_data->comment;
var_dump($post_id);
var_dump($comment);

if(empty(trim($comment))){
    echo json_encode(array('success' => false, 'message' => 'Please enter a message.'));
} elseif(strlen($comment) < 5) {
    echo json_encode(array('success' => false, 'message' => 'Message must be at least 5 characters long.'));
} else {

    $timestamp = (new DateTime())->format('m/d/y h:i');

    $stmt = $mysqli->prepare("INSERT INTO comments (post_id, username, comment, timestamp) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('iss', $post_id, $username, $comment, $timestamp);
    $stmt->execute();
    echo json_encode(array('success' => true, 'message' => 'Comment added!'));

}

$mysqli->close();

?>
