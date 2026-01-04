<?php
    require __DIR__ . '/db_database.php';
    header('Content-Type:application/json');

    $output = [
        'success' => false,
        'errorMessage' => '',
        'data' => $_GET
    ];

    //主訂單部分
    $sql = "SELECT * FROM `orderreal_main`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(); 
    $rows = $stmt->fetchAll(); 
    
    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
?>