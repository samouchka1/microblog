<?php 
    $post_id = $_GET['post_id'];

    // Retrieve the post from the database
    $stmt = $mysqli->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $username = $row["username"];
            $post = $row["post"];
            $timestamp = $row["timestamp"];

            //get the like count for the post
            $like_count = $mysqli->query("SELECT COUNT(*) as count FROM likes WHERE post_id=$id")->fetch_assoc()['count'];
    
            $post = json_encode($post);
            $post_id = $id;
    
            // Decode the JSON string and replace \n with line breaks
            $post = str_replace(array('\r\n', '\r', '\n'), '<br/>', $post);
            $post = str_replace('\\', '', $post);
            $post = trim($post, '"');
    
            echo <<<POST
                <div class="post-styles">
                    <p style="font-weight: 600;">$username</p>
                    <form id="edit-post-form" class="edit-post-form-area">
                        <textarea placeholder="Enter message..." rows="4" cols="42" name="edited_post">$post</textarea>
                        <input type="hidden" name="post_id" value="$post_id">
                        <input type="submit" value="Save" style="margin-top: 10px;">
                    </form>
                    <div id="response" class="response-styles"></div>
                    <div id="response-success" class="response-success-styles"></div>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <p style="font-size: 13px;">$timestamp</p>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <p>Likes:</p>
                            <span class="like-count">$like_count</span>
                        </div>
                    </div>
                </div>
            POST;
        }
    
    } else {
    
        echo <<<ERROR
            <div class="post-styles">
                No posts found.
            </div>
    
        ERROR;
    }
?>