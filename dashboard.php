<?php
session_start();
include 'config.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all posts
$sql = "SELECT p.id, p.title, p.content, p.created_at, u.username 
        FROM posts p 
        JOIN user u ON p.user_id = u.id
        ORDER BY p.created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
<h2>Welcome to Dashboard</h2>
<a href="logout.php">Logout</a> | 
<a href="create.php">Add New Post</a>
<hr>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['content'] . "</p>";
        echo "<small>By " . $row['username'] . " on " . $row['created_at'] . "</small><br>";
        echo "<a href='edit.php?id=" . $row['id'] . "'>Edit</a> | ";
        echo "<a href='delete.php?id=" . $row['id'] . "'>Delete</a>";
        echo "<hr>";
    }
} else {
    echo "No posts found.";
}
?>
</body>
</html>
