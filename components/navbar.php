<?php


if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
}

echo <<<NAVBAR
    <div class="navbar-styles">
        <div>
            <a href="/page.php" style="text-decoration: none; color: #000;"><h3>Microblog</h3></a>
        </div>
        <div class="navbar-right-panel">
            <div>
                <a style="font-weight: 600; margin: 5px 0; text-decoration: none; color:#000;" href="page-profile.php">Profile</a>
            </div>
            <div>
                <p style="font-weight: 600; margin: 5px 0;">{$username}</p>
                <div style="display: flex; align-items: center;">
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

