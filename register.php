<?php

function getRegister() {

    $html = <<<EOF
        <div class="login-container">
            <div class="login-wrapper">
                <h2>Register</h2>
                <p>Please fill in your credentials to register.</p>
                <form id="login-form" class="login-form-styles">
                    <div class="input-area-styles">
                        <label>Username</label>
                        <input id="username" type="text" name="username" required>
                    </div>
                    <div class="input-area-styles">
                        <label>Password</label>
                        <input id="password" type="password" name="password" required>
                    </div>
                    <div class="input-area-styles">
                        <label>Confirm Password</label>
                        <input id="confirm_password" type="password" name="confirm_password" required>
                    </div>
                    <div class="input-area-styles">
                        <input type="submit" value="Register">
                    </div>
                    <div id="response"></div>
                </form>
                <div style="margin: 10px;">
                <p style="margin: 0;"> Already a member?</p>
                <a style="text-decoration: none;" href="../components/login.php">Login</a>
                </div>
            </div>
        </div>
    EOF;

    return $html;

}

?>