<?php
//新增資料的功能

require_once("../conn.php");


// 避免直接透過網址進入，造成空資料
if($_POST["em_full_name"] == ""){
    header("Location: https://www.google.com.tw/?hl=zh_TW");
    exit;
}


// 變數設定
$emId = $_POST["em_id"];
$emFullName = $_POST["em_full_name"];
$emPassword = $_POST["em_password"];
$hashedPasswordToStore = password_hash($emPassword, PASSWORD_ARGON2I);
$emEmail = $_POST["em_email"];
$roleId = $_POST["role_id"];
$isValid = $_POST["is_valid"];


// 檢查Email(帳號)是否註冊過
$sqlEmailCount = "SELECT COUNT(*) as total FROM `employee` WHERE `em_email` = '$emEmail';";

$stmtEmailCount = $conn->prepare($sqlEmailCount);

try{
    $stmtEmailCount->execute();
    $totalEmailCount = $stmtEmailCount->fetch(PDO::FETCH_ASSOC)['total'];
}catch (PDOException $e) {
    echo "你的資料讀取失敗欸!因為:" . $e->getMessage();
    exit;
}

if ($totalEmailCount > 0){
    echo "<script type='text/javascript'>alert('這組帳號已經註冊過了');</script>";
    echo "<script type='text/javascript'>window.location.href = './index.php '; </script>";
}


// 資料庫語法
$sql = "INSERT INTO `employee` (`em_id`, `em_full_name`, `em_hire_date`, `em_password`, `em_email`, `role_id`, `is_valid`) 
VALUES (NULL, :emFullName, current_timestamp, :hashedPasswordToStore, :emEmail, $roleId, $isValid);";



$stmt = $conn->prepare($sql);

try{
    $stmt->execute([
        ":emFullName" => $emFullName,
        ":hashedPasswordToStore" => $hashedPasswordToStore,
        ":emEmail" => $emEmail
    ]);
    // $conn = NULL;
}catch (PDOException $e) {
    echo "你的資料讀取失敗欸!因為:" . $e->getMessage();
    $conn = NULL;
    exit;
}

header("Location: ./index.php");

?>
