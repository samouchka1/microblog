<?php


if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
}

echo <<<EOF
    <div style="
        display: flex;
        flex-direction: row; 
        align-items: center; 
        justify-content: space-between; 
        margin: 16px auto; 
        padding: 10px 25px;
        border: solid 1px black;
    ">
        <div>
            <h3>Microblog</h3>
        </div>
        <div style="
            display: flex;
            flex-direction: row;
            align-items: center;
        ">
            <p style="margin-right: 36px;">Logged in as {$username}.</p>
            <a href="../logout.php">Logout</a>
        </div>
    </div>
EOF;


?>