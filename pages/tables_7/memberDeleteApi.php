<?php
require __DIR__ . '/pdo-connect.php';

header('Content-Type:application/json');

$output=[
    'success' => false,
    'errorMessage' => '',
    'Data' => $_GET
];



$sql="DELETE FROM `member` WHERE MemberID=?";
$stmt=$pdo->prepare($sql); //備好上面的sql語法
$stmt->execute([$_GET["id"]]);//執行

if($stmt->rowCount() ==1){
    $output['success']=true;
}
else{
    $output['errorMessage']= "刪除失敗";
}

echo json_encode($output,JSON_UNESCAPED_UNICODE);



?>