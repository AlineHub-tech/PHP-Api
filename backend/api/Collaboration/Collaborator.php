
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include "db.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {
    $sql = "SELECT * FROM collaborators ORDER BY id DESC";
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
    $name = $body["name"];
    $role = $body["role"];
    $responsibilities = $body["responsibilities"];

    $sql = "INSERT INTO collaborators (id, name, role, responsibilities)
            VALUES ('$id', '$name', '$role', '$responsibilities')";

    echo json_encode(["success" => $conn->query($sql)]);
    exit;
}

if ($method === "PUT") {
    $body = json_decode(file_get_contents("php://input"), true);

    $id = $body["id"];
    $name = $body["name"];
    $role = $body["role"];
    $responsibilities = $body["responsibilities"];

    $sql = "UPDATE collaborators
            SET name='$name', role='$role', responsibilities='$responsibilities'
            WHERE id='$id'";

    echo json_encode(["success" => $conn->query($sql)]);
    exit;
}

if ($method === "DELETE") {
    $id = $_GET["id"];

    $sql = "DELETE FROM collaborators WHERE id='$id'";

    echo json_encode(["success" => $conn->query($sql)]);
    exit;
}

echo json_encode(["error" => "Invalid Request"]);
?>

