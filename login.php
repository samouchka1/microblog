<div class="login-container">
    <div class="login-wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
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
                <input type="submit" value="Login">
            </div>
            <div id="response"></div>
        </form>
        <div style="margin: 10px;">
            <p style="margin: 0;"> Not a member?</p>
            <a style="text-decoration: none;" href="../components/register.php">Register</a>
        </div>
    </div>
</div>