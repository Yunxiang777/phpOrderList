<?php
require __DIR__ . '/pdo-connect.php';

header('Content-Type:application/json');

$output=[
    'success' => false,
    'errorMessage' => '',
    'data' => $_POST
];

$sql="INSERT INTO `employee`( `name`,`avatarname`, `email`,`password`, `gender`,`birthday`,`role`) VALUES (?,?,?,?,?,?,?)";
$stmt=$pdo->prepare($sql); //備好上面的sql語法
$stmt->execute([
    $_POST['name'],
    $_POST['avatarname'],
    $_POST['email'],
    $_POST['password'],
    $_POST['gender'],
    $_POST['birthday'],
    $_POST['role'],
    ]);//執行

if($stmt->rowCount() ==1){
    $output['success']=true;
}
else{
    $output['errorMessage']= "新增失敗";
}


echo json_encode($output,JSON_UNESCAPED_UNICODE);
?>