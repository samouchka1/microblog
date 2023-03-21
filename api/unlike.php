<?php
session_start();

require "../config.php";

$data = json_decode(file_get_contents('php://input'));
$post_id = $data->post_id;
$username = $data->username;

// check if user has already liked post
$stmt = $mysqli->prepare("SELECT * FROM likes WHERE post_id= ? AND username= ?");
$stmt->bind_param("is", $post_id, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // if user liked post, delete like
    $mysqli->query("DELETE FROM likes WHERE post_id=$post_id AND username='$username'");

    // update
    $like_count = $mysqli->query("SELECT COUNT(*) as count FROM likes WHERE post_id=$post_id")->fetch_assoc()['count'];

    // return the updated count
    echo json_encode(['success' => true, 'like_count' => $like_count]);
} else {
    echo json_encode(['success' => false, 'error' => 'User has not liked the post']);
}
?>
