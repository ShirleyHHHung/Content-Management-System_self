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


try {
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmtCity->execute();
    $rowsCity = $stmtCity->fetchAll(PDO::FETCH_ASSOC);

    $stmtDistrict->execute();
    $rowsDistrict = $stmtDistrict->fetchAll(PDO::FETCH_ASSOC);

    $conn = NULL;
} catch (PDOException $e) {
    echo "你的資料讀取失敗欸!因為:" . $e->getMessage();
    $conn = NULL;
    exit;
}


// 將行政區域數據按照 city_id 分組
// $districtsByCity = [];
// foreach ($rowsDistrict as $rowDistrict) {
//     $districtsByCity[$rowDistrict['city_id']][] = $rowDistrict;
// }

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
        <h1 class="title">編輯會員資料</h1>
        <form action="./doUpdate.php" method="POST">
            <div class="info info-box">
                <div class="mb-3 text-center">
                    <label for="" class="form-label">user ID</label>
                    <div name="user_id" id="" class="form-text"><?= $row["user_id"] ?></div>
                </div>
                <div class="mb-3 text-center">
                    <label for="user_email" class="form-label">Email</label>
                    <div name="user_email" class="form-text"><?= $row["user_email"] ?></div>
                </div>
                <div class="mb-3 text-center">
                    <label for="" class="form-label">註冊日期</label>
                    <div id="text" class="form-text"><?= $row["user_created_at"] ?></div>
                </div>
            </div>
            <div class="mb-3" hidden>
                <label for="userIdHidden" class="form-label">user ID</label>
                <input name="user_id" type="text" class="form-control" id="userIdHidden" value="<?= $row["user_id"] ?>">
            </div>

            <div class="mb-3">
                <label for="user_full_name" class="form-label">姓名</label>
                <input name="user_full_name" type="text" class="form-control" id="user_full_name" value="<?= $row["user_full_name"] ?>">
                <span class="form-text text-danger" idn="nameErrorText"></span>
            </div>
            <div class="mb-3">
                <label for="user_phone_number" class="form-label">手機</label>
                <input name="user_phone_number" type="text" class="form-control" id="user_phone_number" value="<?= $row["user_phone_number"] ?>">
                <span class="form-text text-danger" idn="phoneErrorText">     </span>
            </div>
            <div class="mb-3">
                <!-- 下拉選單 -->
                <label for="user_sex" class="form-label">性別</label>
                <select name="user_sex" id="user_sex" class="form-select">
                    <option value="1" <?= ($row["user_sex"] == 1) ? "selected" : "" ?>>男性</option>
                    <option value="2" <?= ($row["user_sex"] == 2) ? "selected" : "" ?>>女性</option>
                </select>
                <span class="form-text text-danger" idn="userSexErrorText"></span>
            </div>
            <div class="mb-3">
                <label for="user_birthday" class="form-label">生日</label>
                <input name="user_birthday" type="date" class="form-control" id="user_birthday" value="<?= $row["user_birthday"] ?>">
                <span class="form-text text-danger" idn="userBirthdayErrorText"></span>
            </div>
            <div class="mb-3">
                <!-- 下拉選單 -->
                <label for="cityId" class="form-label">居住縣市</label>
                <select name="city_id" id="cityId" class="form-select">
                    <option value="" disabled> 請選擇 </option>
                    <option value="臺北市" <?= ($row["city_id"] == "臺北市") ? "selected" : "" ?>>臺北市</option>
                    <option value="新北市" <?= ($row["city_id"] == "新北市") ? "selected" : "" ?>>新北市</option>
                    <option value="桃園市" <?= ($row["city_id"] == "桃園市") ? "selected" : "" ?>>桃園市</option>
                    <option value="臺中市" <?= ($row["city_id"] == "臺中市") ? "selected" : "" ?>>臺中市</option>
                    <option value="臺南市" <?= ($row["city_id"] == "臺南市") ? "selected" : "" ?>>臺南市</option>
                    <option value="高雄市" <?= ($row["city_id"] == "高雄市") ? "selected" : "" ?>>高雄市</option>
                    <option value="宜蘭縣" <?= ($row["city_id"] == "宜蘭縣") ? "selected" : "" ?>>宜蘭縣</option>
                    <option value="新竹縣" <?= ($row["city_id"] == "新竹縣") ? "selected" : "" ?>>新竹縣</option>
                    <option value="苗栗縣" <?= ($row["city_id"] == "苗栗縣") ? "selected" : "" ?>>苗栗縣</option>
                    <option value="彰化縣" <?= ($row["city_id"] == "彰化縣") ? "selected" : "" ?>>彰化縣</option>
                    <option value="南投縣" <?= ($row["city_id"] == "南投縣") ? "selected" : "" ?>>南投縣</option>
                    <option value="雲林縣" <?= ($row["city_id"] == "雲林縣") ? "selected" : "" ?>>雲林縣</option>
                    <option value="嘉義縣" <?= ($row["city_id"] == "嘉義縣") ? "selected" : "" ?>>嘉義縣</option>
                    <option value="屏東縣" <?= ($row["city_id"] == "屏東縣") ? "selected" : "" ?>>屏東縣</option>
                    <option value="花蓮縣" <?= ($row["city_id"] == "花蓮縣") ? "selected" : "" ?>>花蓮縣</option>
                    <option value="臺東縣" <?= ($row["city_id"] == "臺東縣") ? "selected" : "" ?>>臺東縣</option>
                    <option value="澎湖縣" <?= ($row["city_id"] == "澎湖縣") ? "selected" : "" ?>>澎湖縣</option>
                    <option value="基隆市" <?= ($row["city_id"] == "基隆市") ? "selected" : "" ?>>基隆市</option>
                    <option value="嘉義市" <?= ($row["city_id"] == "臺北市") ? "selected" : "" ?>>嘉義市</option>
                    <option value="新竹市" <?= ($row["city_id"] == "嘉義市") ? "selected" : "" ?>>新竹市</option>
                    <option value="金門縣" <?= ($row["city_id"] == "金門縣") ? "selected" : "" ?>>金門縣</option>
                    <option value="連江縣" <?= ($row["city_id"] == "連江縣") ? "selected" : "" ?>>連江縣</option>
                </select>
                <span class="form-text text-danger" idn="cityIdErrorText"></span>
            </div>
            <div class="mb-3">
                <!-- 下拉選單 -->
                <label for="districtId" class="form-label">行政區域</label>
                <select name="district_id" id="districtId" class="form-select">
                    <option value="<?= $row["district_id"] ?>"> <?= $row["district_id"] ?> </option>
                </select>
                <span class="form-text text-danger" idn="districtIdErrorText"></span>
            </div>
            <div class="mb-3">
                <label for="user_address" class="form-label">地址</label>
                <input name="user_address" class="form-control" id="user_address" value="<?= $row["user_address"] ?>">
                <span class="form-text text-danger" idn="userAddressErrorText"></span>
            </div>
            <div class="mb-3 form-check">
                <!-- 單選 -->
                <span>是否為教練</span>
                <div>
                    <input type="radio" name="role_id" id="exampleCheck1" class="form-check-input" value="1" <?= ($row["role_id"] == 1) ? "checked" : "" ?>>
                    <label class="form-check-label" for="exampleCheck1">是</label>
                </div>
                <div>
                    <input type="radio" name="role_id" class="form-check-input" id="exampleCheck2" value="0" <?= ($row["role_id"] == 0) ? "checked" : "" ?>>
                    <label class="form-check-label" for="exampleCheck2">否</label>
                </div>
            </div>
            <div class="mb-3 form-check">
                <!-- 單選 -->
                <span>Email驗證</span>
                <div>
                    <input type="radio" class="form-check-input" id="exampleCheck3" value="1" name="is_active" <?= ($row["is_active"] == 1) ? "checked" : "" ?>>
                    <label class="form-check-label" for="exampleCheck3">已完成驗證</label>
                </div>
                <div>
                    <input type="radio" class="form-check-input" id="exampleCheck4" value="0" name="is_active" <?= ($row["is_active"] == 0) ? "checked" : "" ?>>
                    <label class="form-check-label" for="exampleCheck4">未通過驗證</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="modifyConfirmButton">送出</button>
        </form>
    </div>

    <script>
        const selectCity = document.querySelector("#cityId");
        const selectDistrict = document.querySelector("[name=district_id]")
        const arrayDistrict = [
            [],
            ['中正區', '大同區', '中山區', '萬華區', '信義區', '松山區', '大安區', '南港區', '北投區', '內湖區', '士林區', '文山區'],
            ['板橋區', '新莊區', '泰山區', '林口區', '淡水區', '金山區', '八里區', '萬里區', '石門區', '三芝區', '瑞芳區', '汐止區', '平溪區', '貢寮區', '雙溪區', '深坑區', '石碇區', '新店區', '坪林區', '烏來區', '中和區', '永和區', '土城區', '三峽區', '樹林區', '鶯歌區', '三重區', '蘆洲區', '五股區'],
            ['桃園區', '中壢區', '平鎮區', '八德區', '楊梅區', '蘆竹區', '龜山區', '龍潭區', '大溪區', '大園區', '觀音區', '新屋區', '復興區'],
            ['中區', '東區', '南區', '西區', '北區', '北屯區', '西屯區', '南屯區', '太平區', '大里區', '霧峰區', '烏日區', '豐原區', '后里區', '東勢區', '石岡區', '新社區', '和平區', '神岡區', '潭子區', '大雅區', '大肚區', '龍井區', '沙鹿區', '梧棲區', '清水區', '大甲區', '外埔區', '大安區'],
            ['中西區', '東區', '南區', '北區', '安平區', '安南區', '永康區', '歸仁區', '新化區', '左鎮區', '玉井區', '楠西區', '南化區', '仁德區', '關廟區', '龍崎區', '官田區', '麻豆區', '佳里區', '西港區', '七股區', '將軍區', '學甲區', '北門區', '新營區', '後壁區', '白河區', '東山區', '六甲區', '下營區', '柳營區', '鹽水區', '善化區', '大內區', '山上區', '新市區', '安定區'],
            ['楠梓區', '左營區', '鼓山區', '三民區', '鹽埕區', '前金區', '新興區', '苓雅區', '前鎮區', '小港區', '旗津區', '鳳山區', '大寮區', '鳥松區', '林園區', '仁武區', '大樹區', '大社區', '岡山區', '路竹區', '橋頭區', '梓官區', '彌陀區', '永安區', '燕巢區', '田寮區', '阿蓮區', '茄萣區', '湖內區', '旗山區', '美濃區', '內門區', '杉林區', '甲仙區', '六龜區', '茂林區', '桃源區', '那瑪夏區'],
            ['宜蘭市', '羅東鎮', '蘇澳鎮', '頭城鎮', '礁溪鄉', '壯圍鄉', '員山鄉', '冬山鄉', '五結鄉', '三星鄉', '大同鄉', '南澳鄉'],
            ['竹北市', '竹東鎮', '新埔鎮', '關西鎮', '峨眉鄉', '寶山鄉', '北埔鄉', '橫山鄉', '芎林鄉', '湖口鄉', '新豐鄉', '尖石鄉', '五峰鄉'],
            ['苗栗市', '通霄鎮', '苑裡鎮', '竹南鎮', '頭份鎮', '後龍鎮', '卓蘭鎮', '西湖鄉', '頭屋鄉', '公館鄉', '銅鑼鄉', '三義鄉', '造橋鄉', '三灣鄉', '南庄鄉', '大湖鄉', '獅潭鄉', '泰安鄉'],
            ['彰化市', '員林鎮', '和美鎮', '鹿港鎮', '溪湖鎮', '二林鎮', '田中鎮', '北斗鎮', '花壇鄉', '芬園鄉', '大村鄉', '永靖鄉', '伸港鄉', '線西鄉', '福興鄉', '秀水鄉', '埔心鄉', '埔鹽鄉', '大城鄉', '芳苑鄉', '竹塘鄉', '社頭鄉', '二水鄉', '田尾鄉', '埤頭鄉', '溪州鄉'],
            ['南投市', '埔里鎮', '草屯鎮', '竹山鎮', '集集鎮', '名間鄉', '鹿谷鄉', '中寮鄉', '魚池鄉', '國姓鄉', '水里鄉', '信義鄉', '仁愛鄉'],
            ['斗六市', '斗南鎮', '虎尾鎮', '西螺鎮', '土庫鎮', '北港鎮', '莿桐鄉', '林內鄉', '古坑鄉', '大埤鄉', '崙背鄉', '二崙鄉', '麥寮鄉', '臺西鄉', '東勢鄉', '褒忠鄉', '四湖鄉', '口湖鄉', '水林鄉', '元長鄉'],
            ['太保市', '朴子市', '布袋鎮', '大林鎮', '民雄鄉', '溪口鄉', '新港鄉', '六腳鄉', '東石鄉', '義竹鄉', '鹿草鄉', '水上鄉', '中埔鄉', '竹崎鄉', '梅山鄉', '番路鄉', '大埔鄉', '阿里山鄉'],
            ['屏東市', '潮州鎮', '東港鎮', '恆春鎮', '萬丹鄉', '長治鄉', '麟洛鄉', '九如鄉', '里港鄉', '鹽埔鄉', '高樹鄉', '萬巒鄉', '內埔鄉', '竹田鄉', '新埤鄉', '枋寮鄉', '新園鄉', '崁頂鄉', '林邊鄉', '南州鄉', '佳冬鄉', '琉球鄉', '車城鄉', '滿州鄉', '枋山鄉', '霧台鄉', '瑪家鄉', '泰武鄉', '來義鄉', '春日鄉', '獅子鄉', '牡丹鄉', '三地門鄉'],
            ['花蓮市', '鳳林鎮', '玉里鎮', '新城鄉', '吉安鄉', '壽豐鄉', '秀林鄉', '光復鄉', '豐濱鄉', '瑞穗鄉', '萬榮鄉', '富里鄉', '卓溪鄉'],
            ['臺東市', '成功鎮', '關山鎮', '長濱鄉', '海端鄉', '池上鄉', '東河鄉', '鹿野鄉', '延平鄉', '卑南鄉', '金峰鄉', '大武鄉', '達仁鄉', '綠島鄉', '蘭嶼鄉', '太麻里鄉'],
            ['馬公市', '湖西鄉', '白沙鄉', '西嶼鄉', '望安鄉', '七美鄉'],
            ['仁愛區', '中正區', '信義區', '中山區', '安樂區', '暖暖區', '七堵區'],
            ['東區', '西區'],
            ['東區', '北區', '香山區'],
            ['金城鎮', '金湖鎮', '金沙鎮', '金寧鄉', '烈嶼鄉', '烏坵鄉'],
            ['南竿鄉', '北竿鄉', '莒光鄉', '東引鄉']
        ];

        selectCity.addEventListener("change", function() {
            console.log(arrayDistrict[selectCity.selectedIndex])
            selectDistrict.innerHTML = "";
            arrayDistrict[selectCity.selectedIndex].forEach(v => {
                const node = document.createElement("option")
                node.innerHTML = v;
                selectDistrict.append(node);
            })
        });


        // 欄位判斷
        const form = document.querySelector("form");
        const userFullNameInput = document.querySelector("#user_full_name");
        const nameErrorText = document.querySelector("[idn=nameErrorText]")
        const userEmail = document.querySelector("#user_email");
        const emailErrorText = document.querySelector("[idn=emailErrorText]");
        const userPhoneNumber = document.querySelector("#user_phone_number");
        const phoneErrorText = document.querySelector("[idn=phoneErrorText]")
        const userSex = document.querySelector("#user_sex");
        const userSexErrorText = document.querySelector("[idn=userSexErrorText]");
        const userBirthday = document.querySelector("#user_birthday");
        const userBirthdayErrorText = document.querySelector("[idn=userBirthdayErrorText]");
        const cityId = document.querySelector("#cityId");
        const cityIdErrorText = document.querySelector("[idn=cityIdErrorText]");
        const districtId = document.querySelector("#districtId");
        const districtIdErrorText = document.querySelector("[idn=districtIdErrorText]");
        const userAddress = document.querySelector("#user_address");
        const userAddressErrorText = document.querySelector("[idn=userAddressErrorText]");


        // 動態的欄位判斷
        userFullNameInput.addEventListener("input", e => {
            nameErrorText.textContent = "";
            let isChinese = /^[\u4e00-\u9fa5]+$/;
            if (!isChinese.test(userFullNameInput.value) || userFullNameInput.value == "") {
                e.preventDefault();
                nameErrorText.textContent = "請輸入中文姓名";
            }
        })

        userEmail.addEventListener("input", e => {
            emailErrorText.textContent = "";
            let emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
            if (!emailRule.test(userEmail.value) || userEmail.value == "") {
                e.preventDefault();
                emailErrorText.textContent = "請輸入正確的Email格式";
            }
        })

        userPhoneNumber.addEventListener("input", e => {
            phoneErrorText.textContent = "";
            let MobileReg = /^(09)[0-9]{8}$/;
            if (!MobileReg.test(userPhoneNumber.value) || userPhoneNumber.value == "") {
                e.preventDefault();
                phoneErrorText.textContent = "請輸入正確的手機格式，為 09 開頭的 10 碼數字";
            }
        })
        userAddress.addEventListener("input", e => {
            userAddressErrorText.textContent = "";
            let addressPattern = /^(?=.*\d)[\u4e00-\u9fa5\d()（）]+$/;
            if (!addressPattern.test(userAddress.value) || userAddress.value == "") {
                e.preventDefault();
                userAddressErrorText.textContent = "請輸入完整地址";
            }
        })
        userSex.addEventListener("change", e => {
            userSexErrorText.textContent = "";
            if (userSex.value == "") {
                e.preventDefault();
                userSexErrorText.textContent = "請選擇生理性別";
            }
        })
        userBirthday.addEventListener("input", e => {
            userBirthdayErrorText.textContent = "";
            if (userBirthday.value == "") {
                e.preventDefault();
                userBirthdayErrorText.textContent = "請選擇您的生日";
            }
        })
        cityId.addEventListener("change", e => {
            cityIdErrorText.textContent = "";
            if (cityId.value == "") {
                e.preventDefault();
                cityIdErrorText.textContent = "請選擇居住縣市";
            }
        })
        districtId.addEventListener("change", e => {
            districtIdErrorText.textContent = "";
            if (districtId.value == "") {
                e.preventDefault();
                districtIdErrorText.textContent = "請選擇行政區域";
            }
        })


        // 提交表單後的欄位判斷
        form.addEventListener("submit", e => {
            let isChinese = /^[\u4e00-\u9fa5]+$/;
            let emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
            let minLength = 6;
            let MobileReg = /^(09)[0-9]{8}$/;
            let addressPattern = /^(?=.*\d)[\u4e00-\u9fa5\d()（）]+$/;

            nameErrorText.textContent = "";
            emailErrorText.textContent = "";
            phoneErrorText.textContent = "";
            userSexErrorText.textContent = "";
            userBirthdayErrorText.textContent = "";
            cityIdErrorText.textContent = "";
            districtIdErrorText.textContent = "";
            userAddressErrorText.textContent = "";

            if (!isChinese.test(userFullNameInput.value) || userFullNameInput.value == "") {
                e.preventDefault();
                nameErrorText.textContent = "請輸入中文姓名";
            }
            if (!emailRule.test(userEmail.value) || userEmail.value == "") {
                e.preventDefault();
                emailErrorText.textContent = "請輸入正確的Email格式";
            }
            if (!MobileReg.test(userPhoneNumber.value) || userPhoneNumber.value == "") {
                e.preventDefault();
                phoneErrorText.textContent = "請輸入正確的手機格式，為 09 開頭的 10 碼數字";
            }
            if (userSex.value == "") {
                e.preventDefault();
                userSexErrorText.textContent = "請選擇生理性別";
            }
            if (userBirthday.value == "") {
                e.preventDefault();
                userBirthdayErrorText.textContent = "請選擇您的生日";
            }
            if (cityId.value == "") {
                e.preventDefault();
                cityIdErrorText.textContent = "請選擇居住縣市";
            }
            if (districtId.value == "") {
                e.preventDefault();
                districtIdErrorText.textContent = "請選擇行政區域";
            }
            if (!addressPattern.test(userAddress.value) || userAddress.value == "") {
                e.preventDefault();
                userAddressErrorText.textContent = "請輸入完整地址";
            }
            // comfirm確定要新增的提示
            if (confirm("確認要新增這筆會員資料?") == false) {
                e.preventDefault();
            }
        })
    </script>
</body>

</html>