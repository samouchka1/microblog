<?php 

    if(isset($_SESSION['username'])){
        $user = $_SESSION['username'];
    }

    // get post id from URL
    $post_id = $_GET['post_id'];

    if(isset($_GET['set_edit'])){
        $set_edit = $_GET['set_edit'];
    } else {
        $set_edit = null;
    }

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
            $edited_timestamp = $row["edited_at"];
            // $set_edit = $row["set_edit"];

            //get the like count for the post
            $like_count = $mysqli->query("SELECT COUNT(*) as count FROM likes WHERE post_id=$id")->fetch_assoc()['count'];
    
            $post = json_encode($post);
    
            // Decode the JSON string and replace \n with line breaks
            $post = str_replace(array('\r\n', '\r', '\n'), '<br/>', $post);
            $post = str_replace('\\', '', $post);
            $post = trim($post, '"');

            //show edited timestamp if post was edited
            if($edited_timestamp === ''){
                $edited_timestamp = null;
            } else {
                $edited_timestamp = 'Last edited: '. $edited_timestamp;
            }

            //if user is creator of post, allow edit, delete button
            if($user === $username){
                $edit_button = <<<EDITBTN
                    <form id="edit-form">
                        <input type="hidden" name="post_id" value="$post_id">
                        <input type="hidden" name="set_edit" value="true">
                        <input type="submit" value="Edit">
                    </form>
                EDITBTN;
                $delete_button = <<<DELBTN
                    <form id="delete-form">
                        <input type="hidden" name="post_id" value="$post_id">
                        <input type="submit" value="Delete">
                    </form>
                DELBTN;
            } else {
                $edit_button = null;
                $delete_button = null;
            }

            // if user selects to edit, show textarea
            if($set_edit === 'true' && $user === $username) {
                $text_or_input = <<<EDIT
                    <form id="edit-post-form" class="edit-post-form-area">
                        <textarea placeholder="Enter message..." rows="4" cols="42" name="edited_post">$post</textarea>
                        <input type="hidden" name="post_id" value="$post_id">
                        <input type="hidden" name="set_edit" value="false">
                        <input type="submit" value="Save" style="margin-top: 10px;">
                    </form>
                    <div id="response" class="response-styles"></div>
                    <div id="response-success" class="response-success-styles"></div>
                EDIT;
            } else {
                $text_or_input  = <<<CONTENT
                    <div style="padding: 15px;">
                        <p>$post</p>
                    </div>
                CONTENT;
            }

            echo <<<POST
                <div class="post-styles">

                    <div style="display: flex; justify-content: space-between;">
                        <p style="font-weight: 600;">$username</p>
                        <div style="display: flex; align-items: center; gap: 10px; font-size: 13px;">
                            $edited_timestamp
                            $edit_button
                            $delete_button
                        </div>
                    </div>
                    $text_or_input 
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