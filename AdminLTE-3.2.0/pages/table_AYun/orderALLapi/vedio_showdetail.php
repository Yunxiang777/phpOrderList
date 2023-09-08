<?php
require __DIR__ . '/db_database.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'errorMessage' => '',
    'data' => $_GET
];

$sql = "SELECT `name`, `avatarname`, `email`, `phone_number` FROM `member` WHERE `MemberID` = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_GET["id"]]);
$result = $stmt->fetch();


echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>
