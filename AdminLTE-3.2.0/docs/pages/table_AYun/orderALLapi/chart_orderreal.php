<?php
    require __DIR__ . '/db_database.php';
    header('Content-Type:application/json');

    $output = [
        'success' => false,
        'errorMessage' => '',
        'data' => $_POST
    ];

    $sql = "SELECT COUNT(*) as count FROM `orderreal_main` WHERE orderreal_date = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['DateconutTHIS']]);
    $result = $stmt->fetch();
    
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>

