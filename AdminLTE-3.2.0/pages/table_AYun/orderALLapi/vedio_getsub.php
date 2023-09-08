<?php
require __DIR__ . '/db_database.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'errorMessage' => '',
    'data' => $_GET
];

$sql = "SELECT `ordervideoDetail_ID`, `sub_time`, `canview_startTime` ,`canview_endTime`FROM `ordervideo_detail` WHERE `ordervideoDetail_ordervideoID` = ? AND `Buysub_ornot` = 1 ";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_GET["id"]]);
$result = $stmt->fetch(); 

echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>
