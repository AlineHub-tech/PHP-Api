<?php
header("Content-Type: application/json");
include "../db.php";

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['id']) && !empty($data['id'])){
    $stmt = $pdo->prepare("UPDATE attendance SET memberId=?, date=?, status=?, time=? WHERE id=?");
    $stmt->execute([$data['memberId'], $data['date'], $data['status'], $data['time'], $data['id']]);
} else {
    $data['id'] = uniqid("a");
    $stmt = $pdo->prepare("INSERT INTO attendance(id, memberId, date, status, time) VALUES(?,?,?,?,?)");
    $stmt->execute([$data['id'], $data['memberId'], $data['date'], $data['status'], $data['time']]);
}

echo json_encode(["attendance"=>$data]);
?>