<?php
date_default_timezone_set('Asia/Taipei');
require __DIR__ . '/db_database.php';
header('Content-Type:application/json');

$output = [
    'success' => false,
    'errorMessage' => '',
    'postData' => $_POST
];

$currentDateTime = date('Y-m-d H:i:s'); //現在時間
$futureTime = '0000-00-00 00:00:00';

$sql = "INSERT INTO `ordervideo_detail`(`ordervideoDetail_ordervideoID`,`Buysub_ornot`,`ordervideoDetail_VideoID`,`canview_startTime`,`canview_endTime`) VALUES (?,?,?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['ordervideoDetail_ordervideoID'],
    0,
    $_POST['ordervideoDetail_VideoID'],
    $currentDateTime,
    $futureTime
]);


if($stmt->rowCount() == 1){
    $output['success'] = true;
}else{
    $output['errorMessage'] = "新增失敗";
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>