<?php   
session_start();
require_once("settings.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1){
        $_SESSION["username"] = $username;
        header("Location: profile.php");
        exit();
    } else {
        echo "<p>Invalid username or password</p>";
    }
}
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login Form</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="login">
    </form>
</body>
</html>