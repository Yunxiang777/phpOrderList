<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "project";

$connString = "mysql:host={$servername}; port=8080; dbname={$database}; charset=utf8";

$accessOptions = [
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    //echo "資料庫連線成功";

} catch (PDOException $e) {
    echo "資料庫連線失敗";
    echo "error: " . $e->getMessage();
}
?>