
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once "../db.php";

try {
    $stmt = $pdo->prepare("SELECT h.id, h.memberId, h.action, h.dateTime, m.fullName 
                           FROM history h 
                           LEFT JOIN members m ON h.memberId = m.id 
                           ORDER BY h.dateTime DESC");
    $stmt->execute();
    $history = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($history);
} catch(PDOException $e){
    echo json_encode(["error"=>$e->getMessage()]);
}
?>