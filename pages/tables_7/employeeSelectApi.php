<?php
require __DIR__ . '/pdo-connect.php';

header('Content-Type:application/json'); //告訴瀏覽器這是JSON格式

$output = [
    'success' => false,
    'errorMessage' => '',
    'data' => $_GET
];

$sql = "SELECT * FROM employee";

$stmt = $pdo->prepare($sql);
$stmt->execute();

//妃
$rows = $stmt->fetchAll(); 

echo json_encode($rows, JSON_UNESCAPED_UNICODE);




//翔
// $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// // 遍历每个结果进行转换
// foreach ($results as &$result) {
//     // 将 BLOB 转换为 Base64 字符串
//     $avatarBase64 = base64_encode($result['avatar']);
//     $result['avatar'] = $avatarBase64;
// }

// echo json_encode($results, JSON_UNESCAPED_UNICODE);
?>