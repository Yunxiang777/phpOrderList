<?php
require __DIR__ . "/db_database.php";
header('Content-Type:application/json');

$output = [
    'success' => false,
    'errorMessage' => '',
    'data' => $_POST
];

$sql = "UPDATE `productall` SET `p_name`=?,`p_description`=?,`p_specification`=?,`p_size`=?,`p_category`=?,`p_price`=?,`p_quantity`=?,`p_image`=? WHERE `p_id`=?";
$stmt = $conn->prepare($sql);
$stmt->execute([
    $_POST['p_name'],
    $_POST['p_description'],
    $_POST['p_specification'],
    $_POST['p_size'],
    $_POST['p_category'],
    $_POST['p_price'],
    $_POST['p_quantity'],
    $_POST['p_image'],
    $_POST['p_id'],
]);

if($stmt->rowCount() == 1){
    $output['success'] = true;
}else{
    $output['errorMessage'] = "修改失敗";
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>