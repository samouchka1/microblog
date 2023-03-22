<?php 

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}

// Select data from the "posts" table
$stmt = $mysqli->prepare("SELECT * FROM posts WHERE username = ? ORDER BY id DESC");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if any posts were found
if ($result->num_rows > 0) {
    // Loop through each row and display the data
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $username = $row["username"];
        $post = $row["post"];
        $timestamp = $row["timestamp"];

        // Get the comment count for the post
        $comment_count = $mysqli->query("SELECT COUNT(*) as count FROM comments WHERE post_id=$id")->fetch_assoc()['count'];

        //get the like count for the post
        $like_count = $mysqli->query("SELECT COUNT(*) as count FROM likes WHERE post_id=$id")->fetch_assoc()['count'];

        $post = json_encode($post);
        $post_id = $id;

        // Decode the JSON string and replace \n with line breaks
        $post = str_replace(array('\r\n', '\r', '\n'), '<br/>', $post);
        $post = str_replace('\\', '', $post);
        $post = trim($post, '"');

        echo <<<POSTS
            <div class="posts-styles">
                <p style="font-weight: 600;">$username</p>
                <a href="page-view-post.php?post_id=$post_id" style="text-decoration: none; color: #000;">
                    <div class="posts-content">
                        <p>$post</p>
                    </div>
                </a>
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <p style="font-size: 13px;">$timestamp</p>
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <a href="page-view-post.php?post_id=$post_id"><p class="like-count">Likes ($like_count)</p></a>
                        <a href="page-view-post.php?post_id=$post_id">comments ($comment_count)</a>
                    </div>
                </div>
            </div>
        POSTS;
    }

} else {

    echo <<<ERROR
        <div class="posts-styles">
            No posts found.
        </div>

    ERROR;
}

?>

<div>


</div>