<?php
require __DIR__ . '/connect_pdo.php';

header('Content-Type:application/json');

$output = [
    'success' => false,
    'errorMessage' => '',
    'data' => $_GET
];


$sql = "SELECT * FROM `fitvideos`";
$stmt = $conn->prepare($sql);
$stmt->execute(); 
$rows = $stmt->fetchAll(); 

echo json_encode($rows, JSON_UNESCAPED_UNICODE);

?>