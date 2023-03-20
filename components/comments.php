<?php
    $sql = "SELECT * FROM comments WHERE post_id = " . $post_id . " ORDER BY timestamp ASC";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $username = $row["username"];
            $comment = $row["comment"];
            $timestamp = $row["timestamp"];

            $comment = json_encode($comment);

            // Decode the JSON string and replace \n with line breaks
            $comment = str_replace(array('\r\n', '\r', '\n'), '<br/>', $comment);
            $comment = str_replace('\\', '', $comment);
            $comment = trim($comment, '"');

            echo <<<COMMENT
                <div class="comment-styles">
                    <p style="font-weight: 600;">$username</p>
                    <div style="padding: 5px 15px;">
                        <p>$comment</p>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <p style="font-size: 13px;">$timestamp</p>
                    </div>
                </div>
            COMMENT;
        }
    } else {

        echo <<<ERROR
            <div class="comment-styles">
                No comments found.
            </div>
        ERROR;
    }
?>