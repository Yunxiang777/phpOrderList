<?php
require __DIR__ . '/db_database.php';
header('Content-Type:application/json');

$output = [
    'success' => false,
    'errorMessage' => '',
    'data' => $_GET
];

$sql = "SELECT * FROM `productall`";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(); 

echo json_encode($rows, JSON_UNESCAPED_UNICODE);

?>