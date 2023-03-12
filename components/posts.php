<?php 

// Select data from the "posts" table
$sql = "SELECT * FROM posts ORDER BY id DESC";
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

        // Decode the JSON string and replace \n with line breaks
        $post = str_replace(array('\r\n', '\r', '\n'), '<br/>', $post);
        $post = str_replace('\\', '', $post);
        $post = trim($post, '"');

        echo <<<POSTS
            <div style="
                margin: 20px auto; 
                width: 100%; 
                max-width: 400px; 
                padding: 15px;
                border: solid 1px #000;
            ">
                <p style="font-weight: 600;">$username</p>
                <div style="padding: 15px;">
                    <p>$post</p>
                </div>
                <p style="font-size: 13px;">$timestamp</p>
            </div>
        POSTS;
    }

} else {

    echo <<<ERROR
        <div style="
            margin: 20px auto; 
            width: 100%; 
            max-width: 400px; 
            padding: 15px;
            border: solid 1px #000;
        ">
            No posts found.
        </div>

    ERROR;
}

?>

<div>


</div>