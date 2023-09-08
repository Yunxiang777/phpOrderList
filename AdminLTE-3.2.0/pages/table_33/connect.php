<?php
$hostname_conn = "localhost";
$database_conn = "project";
$username_conn = "root";
$password_conn = "";
try {
	$pdo = new PDO("mysql:host=localhost; port=3306; dbname=$database_conn; charset=utf8", $username_conn, $password_conn,
			array(PDO::ATTR_EMULATE_PREPARES=>false,
					PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_PERSISTENT => true
			)
	);
    //echo "連結資料庫成功!!!<br>";
}
catch(PDOException $ex){
	echo "存取資料庫時發生錯誤，訊息:" . $ex->getMessage() . "<br>";
	echo "行號:" . $ex->getLine() . "<br>";
	echo "堆疊:" . $ex->getTraceAsString() . "<br>";
}
