<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";
    if ($conn->query($sql)) {
        header("Location: dashboard.php");
    } else {
        echo "Error updating post!";
    }
}

// Fetch existing post
$sql = "SELECT * FROM posts WHERE id=$id";
$result = $conn->query($sql);
$post = $result->fetch_assoc();
?>

<form method="POST">
    Title: <input type="text" name="title" value="<?= $post['title'] ?>"><br><br>
    Content: <textarea name="content"><?= $post['content'] ?></textarea><br><br>
    <input type="submit" value="Update">
</form>
