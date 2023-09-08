<?php
require __DIR__ . '/db_database.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'errorMessage' => '',
    'data' => $_GET
];

$sql = "SELECT `Title`, `vidthumbnail` FROM `fitvideos` WHERE `VideoID` = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_GET["id"]]);
$result = $stmt->fetchAll(); 

echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>
