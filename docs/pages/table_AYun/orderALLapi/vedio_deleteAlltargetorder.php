<?php
    require __DIR__ . '/db_database.php';
    header('Content-Type:application/json');

    $output = [
        'success' => false,
        'errorMessage' => '',
        'postData' => $_POST
    ];

    $sql = "DELETE FROM `ordervideo_main` WHERE ordervideoID=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST["deleteTarget"]]);

    $sq2 = "DELETE FROM `ordervideo_detail` WHERE ordervideoDetail_ordervideoID=?";
    $stmt2 = $pdo->prepare($sq2);
    $stmt2->execute([$_POST["deleteTarget"]]);


    if($stmt->rowCount() >= 1 ){
        $output['success'] = true;
    }else{
        $output['errorMessage'] = "刪除失敗";
    }

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    
   
?>