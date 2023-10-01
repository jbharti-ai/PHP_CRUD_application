<!DOCTYPE html>
<html>
    <head>
        <title>Sign In</title>
        <link rel="stylesheet" href="/php/Sharethoughts/style.css">
    </head>
    <body>
        <div class = "outer_border">
            <div class = "inner_form">
            <div class = "form">
            <h2>Sign In</h2>
                <form action="signin_process.php" method="POST">
                    <label for="username">Username:</label>
                    <input type="text" name="username" required><br>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id = "pass" required><br>
                    <input type="submit" value="Sign In">
                </form>
            </div>
            </div>
        </div>
    </body>
</html>
