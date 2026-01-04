<?php

require __DIR__ . '/connect_pdo.php';
header('Content-Type:application/json');

$output = [
    'success' => false,
    'errorMessage' => '',
    'data' => $_POST
];

$sql = "INSERT INTO `fitvideos`(`vidthumbnail`,`Title`,`ReleaseDate`,`Description`,`URL`,`musclegroupID`) VALUES (?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->execute([
    // $_POST['VideoID'],
    $_POST['vidthumbnail'],
    $_POST['Title'],
    $_POST['ReleaseDate'],
    $_POST['Description'],
    $_POST['URL'],
    $_POST['musclegroupID'],
]);

if($stmt->rowCount() == 1){
    $output['success'] = true;
}else{
    $output['errorMessage'] = "新增失敗";
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>