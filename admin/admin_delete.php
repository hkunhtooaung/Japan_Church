<?php 
session_start();
require "../config/config.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM admin WHERE id=$id");
$stmt->execute();

echo "<script>location.href='admins_list.php';</script>";
?>