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

$ordervideoID = $pdo->lastInsertId(); //抓取ordervideo_main最新產生的ordervideoID

$currentDateTime = date('Y-m-d H:i:s'); //現在時間
$futureDateTime = date('Y-m-d H:i:s', strtotime('+' . $_POST['subscription'] . ' days')); //未來幾天後的時間

$sq2 = "INSERT INTO `ordervideo_detail`(`ordervideoDetail_ordervideoID`,`Buysub_ornot`,`sub_time`,`canview_startTime`,`canview_endTime`) VALUES (?,?,?,?,?)";
$stm2 = $pdo->prepare($sq2);
$stm2->execute([
    $ordervideoID,
    1,
    $_POST['subscription'],
    $currentDateTime,
    $futureDateTime
]);

if($stmt->rowCount() == 1){
    $output['success'] = true;
}else{
    $output['errorMessage'] = "新增失敗";
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>