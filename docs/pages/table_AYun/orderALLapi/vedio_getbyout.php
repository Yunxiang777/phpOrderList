<?php
require __DIR__ . '/db_database.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'errorMessage' => '',
    'data' => $_GET
];

$sql = "SELECT `ordervideoDetail_ID`, `ordervideoDetail_VideoID`, `canview_startTime` FROM `ordervideo_detail` WHERE `ordervideoDetail_ordervideoID` = ? AND `Buysub_ornot` = 0 ";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_GET["id"]]);
$result = $stmt->fetchAll(); 

echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>
