<?php
session_start();
require_once("settings.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_SESSION["username"];
    $newEmail = trim($_POST["email"] ?? '');


    $newEmail = mysqli_real_escape_string($conn, $newEmail);


    $query = "UPDATE user SET email = '$newEmail' WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: profile.php");
        exit();
    } else {
        echo "<p>❌ Update failed. Please try again.</p>";
    }
}
?>