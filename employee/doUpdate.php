<?
// 編輯(更新)的功能

require_once("../conn.php");

// 避免不是透過後台，是直接輸入網址進入的人
if($_POST["em_full_name"] == ""){
    header("Location: https://www.google.com.tw/?hl=zh_TW");
    exit;
}

$emId = $_POST["em_id"];
$name = $_POST["em_full_name"];
$roleId = $_POST["role_id"];
$isValid = $_POST["is_valid"];



$sql = "UPDATE `employee` SET 
`em_full_name` = '$name', 
`role_id` = '$roleId', 
`is_valid` = '$isValid' 
WHERE `em_id` = $emId;";

$stmt = $conn->prepare($sql);

try{
    $stmt->execute();
    $conn = NULL;
}catch (PDOException $e) {
    echo "你的資料讀取失敗欸!因為:" . $e->getMessage();
    $conn = NULL;
    exit;
}

header("Location: ./index.php")

?>