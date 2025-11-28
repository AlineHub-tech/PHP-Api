<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include "db.php";
$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {
    $sql = "SELECT * FROM entertainment ORDER BY id DESC";
    $res = $conn->query($sql);
    
    $data = [];
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
    exit;
}

if ($method === "POST") {
    $body = json_decode(file_get_contents("php://input"), true);

    $id = $body["id"];
    $title = $body["title"];
    $description = $body["description"];
    $imageUrl = $body["imageUrl"];

    $sql = "INSERT INTO entertainment (id, title, description, imageUrl)  
            VALUES ('$id', '$title', '$description', '$imageUrl')";

    echo json_encode(["success" => $conn->query($sql)]);
    exit;
}

if ($method === "PUT") {
    $body = json_decode(file_get_contents("php://input"), true);

    $id = $body["id"];
    $title = $body["title"];
    $description = $body["description"];
    $imageUrl = $body["imageUrl"];

    $sql = "UPDATE entertainment  
            SET title='$title', description='$description', imageUrl='$imageUrl'
            WHERE id='$id'";

    echo json_encode(["success" => $conn->query($sql)]);
    exit;
}

if ($method === "DELETE") {
    $id = $_GET["id"];

    $sql = "DELETE FROM entertainment WHERE id='$id'";

    echo json_encode(["success" => $conn->query($sql)]);
    exit;
}

echo json_encode(["error" => "Invalid Request"]);
