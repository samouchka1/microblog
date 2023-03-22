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
            // $post_id = $id;
    
            // Decode the JSON string and replace \n with line breaks
            $post = str_replace(array('\r\n', '\r', '\n'), '<br/>', $post);
            $post = str_replace('\\', '', $post);
            $post = trim($post, '"');
    
            echo <<<POST
                <div class="post-styles">
                    <p style="font-weight: 600;">$username</p>
                    <div style="padding: 15px;">
                        <p>$post</p>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <p style="font-size: 13px;">$timestamp</p>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div id="like-response" style="font-weight: 600; color: red;"></div>
                            <button class="like-button" id="liked-button" data-postid="$post_id">Like</button>
                            <input type="hidden" id="liking-user" value="$liking_user">
                            <span class="like-count">$like_count</span>
                        </div>
                    </div>
                    <div class="comment-form-area-styles">
                        <form id="comment-form" class="comment-form-styles">
                            <input type="hidden" name="post_id" value="$post_id">
                            <input type="hidden" name="commenting_user" value="$commenting_user">
                            <textarea style="height: 19px;" placeholder="Comment..." name="comment" rows="1" cols="42"></textarea>
                            <button type="submit" style="margin-top: 10px;">Submit Comment</button>
                        </form>
                        <div id="comment-response" class="response-styles"></div>
                        <div id="comment-response-success" class="response-success-styles"></div>
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