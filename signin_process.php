<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "bharti";
    $db = "sharethoughts";
    $port = "3306";
    $conn = mysqli_connect($servername,$username,$password,$db,$port); 

    // Check connection
    if(!$conn)
    {
        die("Sorry we are failed to connect" . mysqli_connect_error());
    }

    // Get user input
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Retrieve user data from the database
    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    echo $sql;
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // User authenticated, store user data in session
            echo  $row["password"];
            echo $row["id"];
            echo $row["username"];
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            header("Location: index.php"); // Redirect to a dashboard or protected page
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

    $conn->close();
}
?>