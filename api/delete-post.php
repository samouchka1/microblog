<?php
session_start();

require "../config.php";

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}

$input_data = json_decode(file_get_contents('php://input'));
$post_id = $input_data->post_id;

// Delete the post from the database
$stmt = $mysqli->prepare("DELETE FROM posts WHERE id = ? AND username = ?");
$stmt->bind_param('is', $post_id, $username);
$stmt->execute();
echo json_encode(['success' => true]);

$stmt->close();