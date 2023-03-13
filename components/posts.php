<?php 

// Select data from the "posts" table
$sql = "SELECT * FROM posts WHERE username != '$username' ORDER BY id DESC";
$result = $mysqli->query($sql);

// Check if any posts were found
if ($result->num_rows > 0) {
    // Loop through each row and display the data
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $username = $row["username"];
        $post = $row["post"];
        $timestamp = $row["timestamp"];

        $post = json_encode($post);
        $post_id = $id;

        // Decode the JSON string and replace \n with line breaks
        $post = str_replace(array('\r\n', '\r', '\n'), '<br/>', $post);
        $post = str_replace('\\', '', $post);
        $post = trim($post, '"');

        echo <<<POSTS
            <div class="post-styles">
                <p style="font-weight: 600;">$username</p>
                <div style="padding: 15px;">
                    <p>$post</p>
                </div>
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <p style="font-size: 13px;">$timestamp</p>
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <p>Like</p>
                        <a href="post.php?post_id=$post_id">comments</a>
                    </div>
                </div>
            </div>
        POSTS;
    }

} else {

    echo <<<ERROR
        <div class="post-styles">
            No posts found.
        </div>

    ERROR;
}

?>