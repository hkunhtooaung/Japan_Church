<?php 
session_start();
require "../config/config.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM news WHERE id=$id");
$stmt->execute();

echo "<script>location.href='index.php';</script>";
?>