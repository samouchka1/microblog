<?php
session_start();

require "../config.php";

$data = json_decode(file_get_contents('php://input'));
$postId = $data->post_id;

$mysqli->query("INSERT INTO likes (post_id) VALUES ($postId)");

$likeCount = $mysqli->query("SELECT COUNT(*) as count FROM likes WHERE post_id=$postId")->fetch_assoc()['count'];

$mysqli->query("UPDATE posts SET like_count=$likeCount WHERE id=$postId");

echo json_encode([
  'like_count' => $likeCount
]);

?>
