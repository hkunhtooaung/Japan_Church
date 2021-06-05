<?php 
session_start();
require "../config/config.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM user_contact WHERE id=$id");
$stmt->execute();

echo "<script>location.href='user_contact_list.php';</script>";
?>