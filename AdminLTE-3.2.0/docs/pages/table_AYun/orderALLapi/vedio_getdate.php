<?php
    require __DIR__ . '/db_database.php';
    header('Content-Type:application/json');

    $output = [
        'success' => false,
        'errorMessage' => '',
        'postData' => $_POST
    ];

    
    $sql = "SELECT * FROM `ordervideo_main` WHERE ordervideodDate >=? and ordervideodDate <=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['startDate'],
        $_POST['endDate']
    ]);
    $rows = $stmt->fetchAll(); 
    
    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
?>