
<?php
    session_start();
    require_once ("connect.php");
    
    
        
        $FoodID = $_GET['FoodID'];

                    
        $delete = "DELETE FROM `fooddata` " . " WHERE FoodID = :id" ;
        //e跟WHERE前面都要留空白
        $pdoStmt = $pdo->prepare($delete);
        $pdoStmt->bindValue(":id", $FoodID, PDO::PARAM_INT);


        $pdoStmt->execute();
        $num = $pdoStmt->rowCount();
        //echo "刪除紀錄的筆數=$num<br>";
        echo "<script>alert('刪除成功');</script>";
        echo "<script>setTimeout(function() { window.location.href = 'fooddata.php'; }, 300);</script>";
        //header("Location: test2.php");
        exit();
    
?>

