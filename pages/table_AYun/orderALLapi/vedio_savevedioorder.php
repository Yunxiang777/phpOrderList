<?php
date_default_timezone_set('Asia/Taipei');
require __DIR__ . '/db_database.php';
header('Content-Type:application/json');

$output = [
    'success' => false,
    'errorMessage' => '',
    'postData' => $_POST
];


$sql = "INSERT INTO `ordervideo_main`(`ordervideomemberID`) VALUES (?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['memberID']
]);


if($stmt->rowCount() == 1){
    $output['success'] = true;
    $ordervideoID = $pdo->lastInsertId(); // 獲取最新生成的ordervideoID
    $output['ordervideoID'] = $ordervideoID; //將id存入輸出數據
}else{
    $output['errorMessage'] = "新增失敗";
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>