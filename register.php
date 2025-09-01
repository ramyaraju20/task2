<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hashed

    $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Register</h2>
<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" required><br><br>
    
    <label>Password:</label>
    <input type="password" name="password" required><br><br>
    
    <button type="submit">Register</button>
</form>
