<?php
header("Content-Type: application/json");
include "../db.php";

$stmt = $pdo->prepare("SELECT * FROM announcements ORDER BY createdAt DESC");
$stmt->execute();
$announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($announcements);
?>
