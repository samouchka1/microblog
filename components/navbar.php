<?php


if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
}

echo <<<NAVBAR
    <div class="navbar-styles">
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