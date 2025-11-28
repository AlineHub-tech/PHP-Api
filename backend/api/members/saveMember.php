<?php
header("Content-Type: application/json");
include "../db.php";

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['id']) && !empty($data['id'])){
    $stmt = $pdo->prepare("UPDATE members SET fullName=?, gender=?, age=?, phone=?, email=?, talent=?, level=?, role=?, joinDate=?, address=?, profileUrl=? WHERE id=?");
    $stmt->execute([
        $data['fullName'], $data['gender'], $data['age'], $data['phone'], $data['email'], 
        $data['talent'], $data['level'], $data['role'], $data['joinDate'], $data['address'], $data['profileUrl'], 
        $data['id']
    ]);
} else {
    $data['id'] = uniqid("m");
    $stmt = $pdo->prepare("INSERT INTO members(id, fullName, gender, age, phone, email, talent, level, role, joinDate, address, profileUrl) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->execute([
        $data['id'], $data['fullName'], $data['gender'], $data['age'], $data['phone'], $data['email'],
        $data['talent'], $data['level'], $data['role'], $data['joinDate'], $data['address'], $data['profileUrl']
    ]);
}

echo json_encode(["member"=>$data]);
?>
