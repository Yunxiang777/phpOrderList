<?php
    require __DIR__ . '/db_database.php';
    header('Content-Type:application/json');

    $output = [
        'success' => false,
        'errorMessage' => '',
        'data' => $_GET
    ];


    $sql = "SELECT `p_name`,`p_specification`,`p_size`,`p_price`, `p_image`FROM `productall` WHERE `p_id` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET["id"]]);
    $sku = $stmt->fetchAll(); 
        
    echo json_encode($sku, JSON_UNESCAPED_UNICODE);
?>
