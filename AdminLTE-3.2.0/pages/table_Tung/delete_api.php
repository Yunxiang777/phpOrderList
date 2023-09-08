<?php
require __DIR__ . "/db_database.php";
header('Content-Type:application/json');

$output = [
    'success' => false,
    'errorMessage' => '',
    'data' => $_GET
];


$sql = "DELETE FROM `productall` WHERE `p_id`=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_GET["p_id"]]);

//顯示成功:有回傳1代表異動成功
if($stmt->rowCount() == 1){
    $output['success'] = true;
}else{
    $output['errorMessage'] = "刪除失敗";
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>