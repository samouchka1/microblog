<?php
session_start();

require "../config.php";

$data = json_decode(file_get_contents('php://input'));
$post_id = $data->post_id;
$username = $data->username;

// check if the user has already liked the post
$stmt = $mysqli->prepare("SELECT * FROM likes WHERE post_id = ? AND username = ?");
$stmt->bind_param("is", $post_id, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  echo json_encode(['success' => false, 'message' => '!']);
} else {
  $stmt = $mysqli->prepare("INSERT INTO likes (post_id, username) VALUES (?, ?)");
  $stmt->bind_param("is", $post_id, $username);
  $stmt->execute();

  // update like count
  $like_count = $mysqli->query("SELECT COUNT(*) as count FROM likes WHERE post_id=$post_id")->fetch_assoc()['count'];

  echo json_encode(['success' => true, 'like_count' => $like_count]);
}

?>
