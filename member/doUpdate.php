<?
// 編輯(更新)的功能

require_once("../conn.php");

// 避免不是透過後台，是直接輸入網址進入的人
if($_POST["user_full_name"] == ""){
    header("Location: https://www.google.com.tw/?hl=zh_TW");
    exit;
}


$userId = $_POST["user_id"];
$isActive = $_POST["is_active"];
$name = $_POST["user_full_name"];
$userSex = $_POST["user_sex"];
$userPhoneNumber = $_POST["user_phone_number"];
$userBirthday = $_POST["user_birthday"];
$cityId = $_POST["city_id"];
$districtId = $_POST["district_id"];
$userAddress = $_POST["user_address"];
$roleId = $_POST["role_id"];


$sql = "UPDATE `user` SET `is_active` = '$isActive', 
`user_full_name` = '$name', 
`user_sex` = '$userSex', 
`user_phone_number` = '$userPhoneNumber', 
`user_birthday` = '$userBirthday', 
`city_id` = '$cityId', 
`district_id` = '$districtId', 
`user_address` = '$userAddress',
`role_id` = '$roleId'
WHERE `user_id` = $userId;";

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