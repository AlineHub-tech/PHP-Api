<?php
header("Content-Type: application/json");
include "../db.php";

$data = json_decode(file_get_contents("php://input"), true);
$stmt = $pdo->prepare("DELETE FROM attendance WHERE id=?");
$stmt->execute([$data['id']]);

echo json_encode(["status"=>"success"]);
?>