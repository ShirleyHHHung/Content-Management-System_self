<?
// 編輯員工資料頁

require_once("../conn.php");

$emID = $_GET["id"];


// SQL語法
$sql = "SELECT * FROM `employee` WHERE `em_id` = $emID";


// 連結資料庫
$stmt = $conn->prepare($sql);


try {
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $conn = NULL;
} catch (PDOException $e) {
    echo "你的資料讀取失敗欸!因為:" . $e->getMessage();
    $conn = NULL;
    exit;
}

?>



<!DOCTYPE html>
<html lang="zh-hant-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .container {
            width: 65%;
            padding: 50px 0;
        }

        .title {
            padding: 0 0 30px 0;
            text-align: center;
        }

        .info-box {
            display: flex;
            justify-content: space-around;
            border: 1px solid black;
            margin-bottom: 30px;
            padding: 15px 0 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">編輯員工資料</h1>
        <form action="./doUpdate.php" method="POST">
            <div class="info info-box">
                <div class="mb-3 text-center">
                    <label for="em_id" class="form-label">員工 ID</label>
                    <div name="em_id" id="em_id" class="form-text"><?= $row["em_id"] ?></div>
                </div>
                <div class="mb-3 text-center">
                    <label for="em_email" class="form-label">Email</label>
                    <div name="em_email" class="form-text"><?= $row["em_email"] ?></div>
                </div>
                <div class="mb-3 text-center">
                    <label for="em_hire_date" class="form-label">註冊日期</label>
                    <div id="em_hire_date" class="form-text"><?= $row["em_hire_date"] ?></div>
                </div>
            </div>
            <div class="mb-3" hidden>
                <label for="emIdHidden" class="form-label">員工 ID</label>
                <input name="em_id" type="text" class="form-control" id="emIdHidden" value="<?= $row["em_id"] ?>">
            </div>

            <div class="mb-3">
                <label for="em_full_name" class="form-label">姓名</label>
                <input name="em_full_name" type="text" class="form-control" id="em_full_name" value="<?= $row["em_full_name"] ?>">
                <span class="form-text text-danger" idn="nameErrorText"></span>
            </div>
            

            <div class="mb-3 form-check">
                <!-- 單選 -->
                <span>權限角色</span>
                <div class="form-check form-check-inline">
                    <input type="radio" name="role_id" class="btn-check" id="exampleCheck1"  value="2" <?= ($row["role_id"] == 2) ? "checked" : "" ?>>
                    <label class="btn btn-outline-danger" for="exampleCheck1">所有者</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="role_id" class="btn-check" id="exampleCheck2" value="3" <?= ($row["role_id"] == 3) ? "checked" : "" ?>>
                    <label class="btn btn-outline-danger" for="exampleCheck2">管理員</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="role_id" class="btn-check" id="exampleCheck3" value="4" <?= ($row["role_id"] == 4) ? "checked" : "" ?>>
                    <label class="btn btn-outline-danger" for="exampleCheck3">編輯者</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="role_id" class="btn-check" id="exampleCheck4" value="5" <?= ($row["role_id"] == 5) ? "checked" : "" ?>>
                    <label class="btn btn-outline-danger" for="exampleCheck4">工讀生</label>
                </div>
            </div>
            <div class="mb-3 form-check">
                <!-- 單選 -->
                <span>是否還在職</span>
                <div class="form-check form-check-inline">
                    <input type="radio" class="btn-check" id="exampleCheck5" value="1" name="is_valid" <?= ($row["is_valid"] == 1) ? "checked" : "" ?>>
                    <label class="btn btn-outline-danger" for="exampleCheck5">在職中</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="btn-check" id="exampleCheck6" value="0" name="is_valid" <?= ($row["is_valid"] == 0) ? "checked" : "" ?>>
                    <label class="btn btn-outline-danger" for="exampleCheck6">已離職</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="modifyConfirmButton">送出</button>
        </form>
    </div>

    <script>
        // 欄位判斷
        const form = document.querySelector("form");
        const emFullName = document.querySelector("#em_full_name");
        const nameErrorText = document.querySelector("[idn=nameErrorText]");



        // 動態的欄位判斷
            emFullName.addEventListener("input", e => {
            nameErrorText.textContent = "";
            let isChinese = /^[\u4e00-\u9fa5]+$/;
            if (!isChinese.test(emFullName.value) || emFullName.value == "") {
                e.preventDefault();
                nameErrorText.textContent = "請輸入中文姓名";
            }
        })



        // 提交表單後的欄位判斷
        form.addEventListener("submit", e => {
            let isChinese = /^[\u4e00-\u9fa5]+$/;

            nameErrorText.textContent = "";

            if (!isChinese.test(emFullName.value) || emFullName.value == "") {
                e.preventDefault();
                nameErrorText.textContent = "請輸入中文姓名";
            }

            // comfirm更新要新增的提示
            if (confirm("確認要更改這筆員工資料?") == false) {
                e.preventDefault();
            }
        })
    </script>
</body>

</html>