<?php


if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
}

echo <<<NAVBAR
    <div class="navbar-styles">
        <div>
            <h3>Microblog</h3>
        </div>
        <div class="navbar-right-panel">
            <div>
                <p style="font-weight: 600; margin: 5px 0;">{$username}</p>
                <div style="display: flex; align-items: center; margin-right: 32px;">
                    <p style="font-size: 12px; margin: 0;">Logged in</p>
                    <span class="login-status-span"></span>
                </div>
            </div>
            <div class="center">
                <a href="../logout.php">
                    <img src="../images/logout.png" width="25px" alt="logout" />
                </a>
                <div class="logout-tooltip">Logout</div>
            </div>
        </div>
    </div>
NAVBAR;


?>

