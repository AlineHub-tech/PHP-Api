<?php
header("Content-Type: application/json");
include "../db.php";

$stmt = $pdo->prepare("SELECT * FROM attendance ORDER BY date DESC, time DESC");
$stmt->execute();
$attendance = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($attendance);
?>