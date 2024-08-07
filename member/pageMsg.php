<?
// 編輯會員資料頁

require_once("../conn.php");

$userID = $_GET["id"];


// SQL語法
$sql = "SELECT * FROM `user` WHERE `user_id` = $userID";
$sqlCity = "SELECT * FROM `city`;";
$sqlDistrict = "SELECT * FROM `district`";


// 連結資料庫
$stmt = $conn->prepare($sql);
$stmtCity = $conn->prepare($sqlCity);
$stmtDistrict = $conn->prepare($sqlDistrict);


try{
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmtCity->execute();
    $rowsCity = $stmtCity->fetchAll(PDO::FETCH_ASSOC);
    
    $stmtDistrict->execute();
    $rowsDistrict = $stmtDistrict->fetchAll(PDO::FETCH_ASSOC);

    $conn = NULL;
}catch (PDOException $e) {
    echo "你的資料讀取失敗欸!因為:" . $e->getMessage();
    $conn = NULL;
    exit;
}


// 將行政區域數據按照 city_id 分組
$districtsByCity = [];
foreach ($rowsDistrict as $rowDistrict) {
    $districtsByCity[$rowDistrict['city_id']][] = $rowDistrict;
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
        .container{
            width: 65%;
            padding: 50px 0;
        }
        .title{
            padding: 0 0 30px 0;
            text-align: center;
        }
        .info-box{
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
        <h1 class="title">編輯會員資料</h1>
        <form action="./doUpdate.php" method="POST">
            <div class="info info-box">
                <div class="mb-3">
                    <label for="" class="form-label">user ID</label>
                    <div name="user_id" id="text" class="form-text"><?= $row["user_id"] ?></div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">註冊日期</label>
                    <div id="text" class="form-text"><?= $row["user_created_at"] ?></div>
                </div>
            </div>
            <div class="mb-3">
                    <label for="userIdHidden" class="form-label">user ID</label>
                    <input name="user_id" type="text" class="form-control" id="userIdHidden" value="<?= $row["user_id"] ?>" >
                </div>
            <div class="mb-3">
                <label for="user_full_name" class="form-label">姓名</label>
                <input name="user_full_name" type="text" class="form-control" id="user_full_name" value="<?= $row["user_full_name"] ?>" >
            </div>
            <div class="mb-3">
                <label for="user_phone_number" class="form-label">手機</label>
                <input name="user_phone_number" type="text" class="form-control" id="user_phone_number" value="<?= $row["user_phone_number"] ?>" >
            </div>
            <div class="mb-3">
                <label for="user_email" class="form-label">Email</label>
                <input name="user_email" type="email" class="form-control" id="user_email" value="<?= $row["user_email"] ?>" >
            </div>
            <div class="mb-3">
                <!-- 下拉選單 -->
                <label for="user_sex" class="form-label">性別</label>
                <select name="user_sex" id="user_sex" class="form-select">
                    <option value="1" <?= ($row["user_sex"]==1)? "selected": "" ?> >男性</option>
                    <option value="2" <?= ($row["user_sex"]==2)? "selected": "" ?> >女性</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">生日</label>
                <input name="user_birthday" type="date" class="form-control" id="" value="<?= $row["user_birthday"] ?>">
            </div>
            <div class="mb-3">
                <!-- 下拉選單 -->
                <label for="cityId" class="form-label">居住縣市</label>
                <select name="city_id" id="cityId" class="form-select">
                    <? foreach ($rowsCity as $rowCity): ?>
                    <option value="<?= $rowCity["city_id"]?>" <?= ($row["city_id"]== $rowCity["city_id"])? "selected": "" ?> ><?= $rowCity["city_name"]?></option>
                    <? endforeach;?>
                </select>
                
            </div>
            <div class="mb-3">
                <!-- 下拉選單 -->
                <label for="districtId" class="form-label">行政區域</label>
                <select name="district_id" id="districtId" class="form-select">
                    <? foreach ($rowsDistrict as $rowDistrict): ?>
                    <option value="<?= $rowDistrict["district_id"]?>" <?= ($row["district_id"] == $rowDistrict["district_id"])? "selected": "" ?>> <?= $rowDistrict["district_name"]?> </option>
                    <? endforeach;?>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">地址</label>
                <input name="user_address" class="form-control" id="" value="<?= $row["user_address"] ?>">
            </div>
            <div class="mb-3 form-check">
                <!-- 單選 -->
                <span>是否為教練</span>
                <div>
                    <input type="radio" name="role_id" id="exampleCheck1" class="form-check-input" value="1" <?= ($row["role_id"]==1)?"checked":"" ?> >
                    <label class="form-check-label" for="exampleCheck1" >是</label>
                </div>
                <div>
                    <input type="radio" name="role_id" class="form-check-input" id="exampleCheck2" value="0" <?= ($row["role_id"]==0)?"checked":"" ?> >
                    <label class="form-check-label" for="exampleCheck2" >否</label>
                </div>
            </div>
            <div class="mb-3 form-check">
                <!-- 單選 -->
                <span>Email驗證</span>
                <div>
                    <input type="radio" class="form-check-input" id="exampleCheck3" value="1" name="is_active"  <?= ($row["is_active"]==1)?"checked":"" ?>>
                    <label class="form-check-label" for="exampleCheck3">已完成驗證</label>
                </div>
                <div>
                    <input type="radio" class="form-check-input" id="exampleCheck4" value="0" name="is_active"  <?= ($row["is_active"]==0)?"checked":"" ?>>
                    <label class="form-check-label" for="exampleCheck4">未通過驗證</label>
                </div>
            </div>
            <a href="">
                <button type="submit" class="btn btn-primary" >送出</button>
            </a>
        </form>
    </div>
    <SCript>
        let cityId = document.querySelector("#cityId");
        let districtId = document.querySelector("#districtId");
        console.log(cityId);
        console.log(districtId);

        cityId.addEventListener("change" , function(){
            console.log(this.value);
            
            districtId.innerHTML
        })



    </SCript>
</body>

</html>