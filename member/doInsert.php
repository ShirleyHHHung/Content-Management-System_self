<?php
//新增資料的功能

require_once("../conn.php");


// 避免直接透過網址進入，造成空資料
if($_POST["user_full_name"] == ""){
    header("Location: https://www.google.com.tw/?hl=zh_TW");
    exit;
}


// 變數設定
$name = $_POST["user_full_name"];
$password = $_POST["user_password"];
$userEmail = $_POST["user_email"];
$userSex = $_POST["user_sex"];
$userPhoneNumber = $_POST["user_phone_number"];
$userBirthday = $_POST["user_birthday"];
$cityId = $_POST["city_id"];
$districtId = $_POST["district_id"];
$userAddress = $_POST["user_address"];




// 資料庫語法
$sql = "INSERT INTO `user` (`user_id`, `user_created_at`, `user_full_name`, `user_email`, `user_password`, `user_sex`, `user_phone_number`, `user_birthday`, `city_id`, `district_id`, `user_address`) 
VALUES (NULL, current_timestamp(), '$name', '$userEmail', '$password', '$userSex', '$userPhoneNumber', '$userBirthday', '$cityId', '$districtId', '$userAddress');";



$stmt = $conn->prepare($sql);

try{
    $stmt->execute();
    $conn = NULL;
}catch (PDOException $e) {
    echo "你的資料讀取失敗欸!因為:" . $e->getMessage();
    $conn = NULL;
    exit;
}

header("Location: ./index.php");

?>
