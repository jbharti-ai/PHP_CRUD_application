<?php
session_start();

// Destroy the session and redirect to the sign-in page
session_destroy();
header("Location: signin.php");
?>