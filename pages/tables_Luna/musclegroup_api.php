<?php

require __DIR__ . '/connect_pdo.php';

header('Content-Type: application/json');

$musclegroupID = $_GET['musclegroupID'];

if ($musclegroupID) {
$sql = "SELECT muscleName FROM `muscle_group` WHERE musclegroupID = :musclegroupID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':musclegroupID', $musclegroupID);
$stmt->execute();
$row = $stmt->fetch();

if ($row) {
$response = ['muscleName' => $row['muscleName']];
echo json_encode($response, JSON_UNESCAPED_UNICODE);
} else {
$response = ['muscleName' => 'Unknown'];
echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
} else {
$sql = "SELECT * FROM `muscle_group`";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll();

echo json_encode($rows, JSON_UNESCAPED_UNICODE);
}
?>
