<?php
require __DIR__ . '/db_database.php';
header('Content-Type:application/json');

$output = [
    'success' => false,
    'errorMessage' => '',
    'postData' => $_POST
];



$sql = "UPDATE `orderreal_main` SET `PAY_methods`=?,`Shipping_methods`=?,`receiver`=?,`receiver_phone`=?,`Shipping_address`=? WHERE orderrealID=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['PAY_methods_ID'],
    $_POST['Shipping_methods_ID'],
    $_POST['receiver_ID'],
    $_POST['receiver_phone_ID'],
    $_POST['Shipping_address_ID'],

    $_POST['ordermain_ID'],
]);

if($stmt->rowCount() == 1){
    $output['success'] = true;
}else{
    $output['errorMessage'] = "修改失敗";
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>