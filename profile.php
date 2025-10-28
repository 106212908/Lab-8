<?php
session_start();
require_once("settings.php");

if (!isset($_SESSION["username"])) {
    header("location: login.html");
    exit();
}

$username = $_SESSION["username"];

// Look up the email from the database
$query = "SELECT email FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $query);



if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $email = $row["email"];
} 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>

    <h3>Edit Profile:</h3>
    <form action="update_profile.php" method="post">
        <label for="email">New Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        <input type="submit" value="Update">
    </form>
</body>
</html>