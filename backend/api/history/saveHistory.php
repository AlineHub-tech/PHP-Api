<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

require_once "../db.php";
$data = json_decode(file_get_contents("php://input"), true);

$id = "h".bin2hex(random_bytes(4));
$memberId = $data['memberId'] ?? "";
$action = $data['action'] ?? "";
$dateTime = date("Y-m-d H:i:s");

try {
    $stmt = $pdo->prepare("INSERT INTO history (id, memberId, action, dateTime) VALUES (?, ?, ?, ?)");
    $stmt->execute([$id, $memberId, $action, $dateTime]);
    echo json_encode(["success"=>true, "id"=>$id]);
} catch(PDOException $e){
    echo json_encode(["error"=>$e->getMessage()]);
}
?>