<?php
require __DIR__ . '/db_database.php';
header('Content-Type:application/json');

$output = [
    'success' => false,
    'errorMessage' => '',
    'postData' => $_POST
];


$sql = "INSERT INTO `orderreal_main`(`orderrealmemberID`, `PAY_methods`, `Shipping_methods`,`receiver`,`receiver_phone`,`Shipping_address`,`Shipping_code`) VALUES (?,?,?,?,?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['memberID'],
    $_POST['paymentMethod'],
    $_POST['shippingMethod'],
    $_POST['receiver'],
    $_POST['contactNumber'],
    $_POST['shippingAddress'],
    $_POST['shippingCode']
]);

if($stmt->rowCount() == 1){
    $output['success'] = true;
    $orderID = $pdo->lastInsertId(); // 获取最新插入的自动生成的 ID
    $output['orderID'] = $orderID; // 将 ID 存储在输出数组中
}else{
    $output['errorMessage'] = "新增失敗";
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>