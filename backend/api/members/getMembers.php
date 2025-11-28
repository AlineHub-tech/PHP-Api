<?php
header("Content-Type: application/json");
include "../db.php";

$stmt = $pdo->prepare("SELECT * FROM members ORDER BY joinDate DESC");
$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($members);
?>