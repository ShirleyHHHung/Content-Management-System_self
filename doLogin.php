<!-- 登入功能 -->

<?php
session_start();
require_once("./conn.php");

function loginFailed(){
    if(!isset($_SESSION["error"]["times"])){
      $_SESSION["error"]["times"] = 1;
    }else{
      $_SESSION["error"]["times"]++;  
    }
    $_SESSION["error"]["timestamp"] = time();
    $_SESSION["error"]["message"] = "登入失敗，請確認帳號碼";
    unset($_SESSION["employee"]);
    echo "登入失敗，請確認帳號碼！";
  }


// if(!isset($_POST["em_email"])){
//     header("Location: https://www.google.com.tw/?hl=zh_TW");
//     exit;
// }


$emEmail = $_POST["em_email"];
$password = $_POST["em_password"];


$sqlEmail = "SELECT * FROM employee WHERE `em_email` = ?";

$stmt = $conn->prepare($sqlEmail);

try {
    $stmt->execute([$emEmail]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $conn = NULL;
    exit;
}


// 檢查是否找到這個Email
if ($row == true) {
    // 檢查密碼是否正確
    if (password_verify($password, $row["em_password"])) {
        $_SESSION["employee"] = [
            "em_id" => $row["em_id"],
            "em_full_name" => $row["em_full_name"],
            "em_email" => $row["em_email"],
        ];
        unset($_SESSION["error"]);
        header("Location: ./member/index.php");
        exit;
    } else {
        loginFailed();
        exit;
    }
} else {
    loginFailed();
    exit;
}




