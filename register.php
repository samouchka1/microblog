<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/css/index.css">
    <link rel="stylesheet" type="text/css" href="/css/login-register.css">

    <title>Microblog - Register</title>
</head>

<body>
    <div class="register-container">
        <div class="register-wrapper">
            <h2>Register</h2>
            <p>Please fill in your credentials to register.</p>
            <form id="register-form" class="register-form-styles">
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
                <a style="text-decoration: none;" href="./index.php">Login</a>
            </div>
        </div>
    </div>
    <script src="/js/register.js"></script>
</body>
</html>