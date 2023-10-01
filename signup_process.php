<?php
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
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password (always hash passwords before storing them)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Signup successful. <a href='signin.php'>Sign in</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>