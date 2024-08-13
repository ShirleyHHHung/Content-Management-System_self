<?
// 軟刪除(封鎖)的功能
// 將user 資料表的'user_valid'欄位改為0 (正常狀態是1)

require_once("../conn.php");

// 避免不是透過後台，是直接輸入網址進入的人
if($_POST["user_full_name"] == ""){
    header("Location: https://www.google.com.tw/?hl=zh_TW");
    exit;
}

$userId = $_GET["id"];




$sql = "UPDATE `user` SET `user_valid` = '0' WHERE `user_id` = $userId";

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