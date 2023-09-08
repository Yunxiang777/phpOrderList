<?php
require __DIR__ . '/pdo-connect.php';

header('Content-Type:application/json');

$output=[
    'success' => false,
    'errorMessage' => '',
    'Data' => $_POST
];



$sql="UPDATE `employee` SET `name`=?,`avatarname`=?,`email`=?,`password`=?,`gender`=?,`birthday`=?,`role`=? WHERE e_id=?";
//?的話順序很重要
$stmt=$pdo->prepare($sql); //備好上面的sql語法
$stmt->execute([
    $_POST['name'],
    $_POST['avatarname'],
    $_POST['email'],
    $_POST['password'],
    $_POST['gender'],
    $_POST['birthday'],
    $_POST['role'],
    $_POST['id'],
    ]);//執行

if($stmt->rowCount() ==1){
    $output['success']=true;
}
else{
    $output['errorMessage']= "修改失敗";
}

echo json_encode($output,JSON_UNESCAPED_UNICODE);



?>