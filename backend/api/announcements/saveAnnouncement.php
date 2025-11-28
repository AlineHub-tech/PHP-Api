<?php
header("Content-Type: application/json");
include "../db.php";

$data = json_decode(file_get_contents("php://input"), true);
$data['id'] = isset($data['id']) ? $data['id'] : uniqid("an");
$data['createdAt'] = $data['createdAt'] ?? date("Y-m-d H:i:s");

if(isset($data['id'])){
    $stmt = $pdo->prepare("INSERT INTO announcements(id,title,message,createdAt) VALUES(?,?,?,?) ON DUPLICATE KEY UPDATE title=?, message=?");
    $stmt->execute([$data['id'],$data['title'],$data['message'],$data['createdAt'],$data['title'],$data['message']]);
}

echo json_encode(["announcement"=>$data]);
?>