<?
// 編輯(更新)的api

require_once("../conn.php");

$userId = $_POST["user_id"];
$isActive = $_POST["is_active"];
$name = $_POST["user_full_name"];
$userEmail = $_POST["user_email"];
$userSex = $_POST["user_sex"];
$userPhoneNumber = $_POST["user_phone_number"];
$userBirthday = $_POST["user_birthday"];
$cityId = $_POST["city_id"];
$districtId = $_POST["district_id"];
$userAddress = $_POST["user_address"];
$roleId = $_POST["role_id"];



$sql = "UPDATE `user` SET `is_active` = '$isActive', 
`user_full_name` = '$name', 
`user_email` = '$userEmail', 
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


?>