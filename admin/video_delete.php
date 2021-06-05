<?php 
require '../config/config.php';

$stmt = $pdo->prepare("DELETE FROM videos WHERE id=".$_GET['id']);
$result = $stmt->execute();

header("Location: videos_list.php");
?>