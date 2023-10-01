<!DOCTYPE html>
<html>
    <head>
        <title>Signup</title>
        <link rel="stylesheet" href="/php/Sharethoughts/style.css">
    </head>
    <body>
        <div class = outer_form>
        <div class = inner_form>
            <div class = "form">
            <h2>Signup</h2><br>
                <form action="signup_process.php" method="POST">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id = "uname" required><br>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id = "email" required><br>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id = "pass" required><br>
                    <input type="submit" value="Signup">
                    <br>
                    <input type="checkbox" id="check">
                    <span>Remember me</span>
                    <br><br>
                    Forgot <a href="#">Password</a>
                </form>
            </div>
        </div>
        </div>
    </body>
</html>