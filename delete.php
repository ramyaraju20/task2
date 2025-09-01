<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM posts WHERE id=$id";
if ($conn->query($sql)) {
    header("Location: dashboard.php");
} else {
    echo "Error deleting post!";
}
?>
