<?php


if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
}

echo <<<NAVBAR
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
            <div>
                <p style="margin: 0 36px 0 0;">Logged in as </p>
                <p style="font-weight: 600; margin: 5px 0;">{$username}</p>
            </div>
            <a href="../logout.php">Logout</a>
        </div>
    </div>
NAVBAR;


?>