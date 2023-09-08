<?php
require __DIR__ . '/connect_pdo.php';

$output = [
    'success' => false,
    'errorMessage' => '',
    'postData' => $_POST
];

$Sql = "UPDATE `fitvideos` SET `vidthumbnail`=?, `Title`=?, `ReleaseDate`=?, `Description`=?, `URL`=?, `musclegroupID`=? WHERE `VideoID` = ?";
$stmt = $conn->prepare($Sql);

$stmt->execute([
    $_POST['vidthumbnail'],
    $_POST['Title'],
    $_POST['ReleaseDate'],
    $_POST['Description'],
    $_POST['URL'],
    $_POST['musclegroupID'],
    $_POST['VideoID']
]);

if ($stmt->rowCount() == 1) {
    $output['success'] = true;
} else {
    $output['errorMessage'] = "修改失敗";
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>
