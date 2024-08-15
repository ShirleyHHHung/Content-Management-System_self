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
    $stmt->execute([
        // ":userID" => $userID,
    ]);
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


?>



<!DOCTYPE html>
<html lang="zh-hant-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Castoro:ital@0;1&family=Noto+Sans+TC:wght@100..900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/customBS.css" />
    <link rel="stylesheet" href="../css/pageDashboard3.css" />
    <style>


        .info-box {
            display: flex;
            justify-content: space-around;
            border: 1px solid black;
            margin-bottom: 30px;
            padding: 15px 0 5px 0;
            width: 500px;
        }
    </style>
</head>

<body class="bg-three d-flex">
  
  <nav class="d-flex sticky-top h100vh rounded-end-4">
    <!-- 綠色欄位 -->
    <div class="w280px h-100 bg-one position-relative rounded-end-5">
      <div
      class="green-area-icon h-100 w80px d-flex flex-column align-items-center"
      >
      <!-- 在自己的<div>上加2個class: bg-white shadow -->
       <!-- 將<i>上的原本的class: text-white 改成 text-one -->
      <!-- 會員 -->
        <div
          class="bg-white shadow menu-btn mt-4 w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn1 "
        >
          <a href="../member/index.php"
            ><i class="fa-solid fa-user-group text-one fs-4"></i></a>
        </div>
        <!-- 商品 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn2"
        >
          <a href="../product/index.php"><i class="fa-solid fa-store text-white fs-4"></i></a>
        </div>
        <!-- 課程 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn3"
        >
          <a href="../lesson/index.php"
            ><i class="fa-regular fa-calendar text-white fs-4"></i
          ></a>
        </div>
        <!-- 部落格 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn4"
        >
          <a href="../blog/blogs.php"><i class="fa-brands fa-blogger text-white fs-4"></i></a>
        </div>
        <!-- 潛點地圖 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn5"
        >
          <a href="../DSite/dsList.php"><i class="fa-regular fa-map text-white fs-4"></i></a>
        </div>
        <!-- 媒體庫 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn6"
        >
          <a href="../media/mediaLibrary.php"><i class="fa-regular fa-image text-white fs-4"></i></a>
        </div>
        <!-- 員工 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-2 mt-auto btn7"
        >
          <a href="../employee/index.php"
            ><i class="fa-solid fa-address-card text-white fs-5"></i
          ></a>
        </div>
        <div
          class="w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-4"
        >
          <a href="#"
            ><i class="fa-solid fa-right-from-bracket text-white fs-5"></i
          ></a>
        </div>
      </div>
    </div>
    <!-- 白色欄位 -->
    <div
      class="w200px h-100 d-flex flex-column justify-content-center bg-white card rounded-4 position-absolute white-area"
    >
      <!-- logo區 -->
      <div class="logobox container my-5 d-flex justify-content-center">
        <img
          src="../84901e5e1a173e3324e4ba59bf3b9b9f.png"
          alt=""
          class="logo"
        />
      </div>
      <!-- 新增按鈕，在a上放自己新增一筆的連結 -->
      <div class="addBtnBox container text-center mb-5 mt-4">
        <a href="./pageAdd.php">
          <button class="btn btn-one"><i class="fa-solid fa-square-plus"></i><span class="px-3">create new</span>
          </button>
        </a>
      </div>
      <!-- 目錄區(手風琴) -->
      <div>
        <div cla>
          <div class="accordion-title">
            <!-- 放上icon跟分類名稱 -->
            <button class="accordion-button text-one ms-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span class="menu-icon"><i class="fa-solid fa-user-group text-one fs-5"></i></span><span class="menu-title">會員管理</span></button>
          </div>
          <div>
            <div class="accordion-body mt-3">
              <!-- 放上子項目名稱&連結 -->
              <li class="list-a"><a href="#######" class="ms-1">會員列表</a></li>
            </div>
          </div>
        </div>
      </div>
      <!-- 其他功能 -->
      <div class="container mb-3 mt-auto ms-4">
        <div class="ps-3 text-four">
          <i class="fa-solid fa-share-nodes"></i>
          <span class="ps-2">share</span>
        </div>
      </div>
      <div class="container mb-3 ms-4">
        <div class="ps-3 text-four">
          <i class="fa-solid fa-clock"></i>
          <span class="ps-2">recent</span>
        </div>
      </div>
      <div class="container mb-3 ms-4">
        <div class="ps-3 text-four">
          <i class="fa-solid fa-star"></i>
          <span class="ps-2">favorite</span>
        </div>
      </div>
      <div class="container mb-5 ms-4">
        <div class="ps-3 text-four">
          <i class="fa-solid fa-trash-can"></i>
          <span class="ps-2">delete</span>
        </div>
      </div>
    </div>
  </nav>

  
    <div class="container">
      <div class="d-flex justify-content-between ">
        <h1 class="my-5 text-one">編輯會員資料</h1>
        <div class="info info-box bg-one rounded-2 text-light align-self-end">
            <div class="mb-3 text-center">
                <label for="" class="form-label">user ID</label>
                <div name="user_id" id="" class="text-light" ><?= $row["user_id"] ?></div>
            </div>
            <div class="mb-3 text-center">
                <label for="user_email" class="form-label">Email</label>
                <div name="user_email" class="text-light"><?= $row["user_email"] ?></div>
            </div>
            <div class="mb-3 text-center">
                <label for="" class="form-label">註冊日期</label>
                <div id="text" class="text-light"><?= $row["user_created_at"] ?></div>
            </div>
        </div>
      </div>
        <form action="./doUpdate.php" method="POST">
            <div class="mb-3" hidden>
                <label for="userIdHidden" class="form-label">user ID</label>
                <input name="user_id" type="text" class="form-control" id="userIdHidden" value="<?= $row["user_id"] ?>">
            </div>
            <!-- <div class="mb-3 text-center" hidden>
                <label for="user_emailHidden" class="form-label">Email</label>
                <input name="user_email" type="text" class="form-control" id="user_emailHidden" value="<?= $row["user_email"] ?>">
            </div> -->

            <div class="input-group mb-3">
                <label for="user_full_name" class="input-group-text">姓名</label>
                <input name="user_full_name" type="text" class="form-control" id="user_full_name" value="<?= $row["user_full_name"] ?>">
                <span class="form-text text-danger" idn="nameErrorText"></span>
            </div>
            <div class="input-group mb-3">
                <label for="user_phone_number" class="input-group-text">手機</label>
                <input name="user_phone_number" type="text" class="form-control" id="user_phone_number" value="<?= $row["user_phone_number"] ?>">
                <span class="form-text text-danger" idn="phoneErrorText"></span>
            </div>
            <div class="input-group mb-3">
                <!-- 下拉選單 -->
                <label for="user_sex" class="input-group-text">性別</label>
                <select name="user_sex" id="user_sex" class="form-select">
                    <option value="1" <?= ($row["user_sex"] == 1) ? "selected" : "" ?>>男性</option>
                    <option value="2" <?= ($row["user_sex"] == 2) ? "selected" : "" ?>>女性</option>
                </select>
                <span class="form-text text-danger" idn="userSexErrorText"></span>
            </div>
            <div class="input-group mb-3">
                <label for="user_birthday" class="input-group-text">生日</label>
                <input name="user_birthday" type="date" class="form-control" id="user_birthday" value="<?= $row["user_birthday"] ?>">
                <span class="form-text text-danger" idn="userBirthdayErrorText"></span>
            </div>
            <div class="input-group mb-3">
                <!-- 下拉選單 -->
                <label for="cityId" class="input-group-text">居住縣市</label>
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
            <div class="input-group mb-3">
                <!-- 下拉選單 -->
                <label for="districtId" class="input-group-text">行政區域</label>
                <select name="district_id" id="districtId" class="form-select">
                    <option value="<?= $row["district_id"] ?>"> <?= $row["district_id"] ?> </option>
                </select>
                <span class="form-text text-danger" idn="districtIdErrorText"></span>
            </div>
            <div class="input-group mb-3">
                <label for="user_address" class="input-group-text">地址</label>
                <input name="user_address" class="form-control" id="user_address" value="<?= $row["user_address"] ?>">
                <span class="form-text text-danger" idn="userAddressErrorText"></span>
            </div>
            <div class="input-group mb-3 form-check">
                <!-- 單選 -->
                <span>是否為教練</span>
                <div class="form-check ">
                    <input type="radio" name="role_id" id="exampleCheck1" class="btn-check" value="1" <?= ($row["role_id"] == 1) ? "checked" : "" ?>>
                    <label class="btn btn-outline-two text-one" for="exampleCheck1">是</label>
                </div>
                <div class="form-check ">
                    <input type="radio" name="role_id" class="btn-check" id="exampleCheck2" value="0" <?= ($row["role_id"] == 0) ? "checked" : "" ?>>
                    <label class="btn btn-outline-two text-one" for="exampleCheck2">否</label>
                </div>
            </div>
            <div class="input-group mb-3 form-check">
                <!-- 單選 -->
                <span>Email驗證</span>
                <div class="form-check form-check-inline">
                    <input type="radio" class="btn-check" id="exampleCheck3" value="1" name="is_active" <?= ($row["is_active"] == 1) ? "checked" : "" ?>>
                    <label class="btn btn-outline-two text-one" for="exampleCheck3">已完成驗證</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="btn-check" id="exampleCheck4" value="0" name="is_active" <?= ($row["is_active"] == 0) ? "checked" : "" ?>>
                    <label class="btn btn-outline-two text-one" for="exampleCheck4">未通過驗證</label>
                </div>
            </div>
            <button type="submit" class="btn btn-one" id="modifyConfirmButton">送出</button>
        </form>
    </div>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        // 頁面載入時初始化樣式
        document.addEventListener("DOMContentLoaded", function() {
            const firstBtn = document.querySelector(".btn1");
            firstBtn.classList.add("shadow", "bg-white");
            const firstIcon = firstBtn.querySelector("i");
            firstIcon.classList.remove("text-white");
            firstIcon.classList.add("text-one");

            // 觸發第一個按鈕的 click 事件來更新內容
            firstBtn.click();
        });

        document.querySelectorAll(".menu-btn").forEach((menuDiv) => {
            menuDiv.addEventListener("click", function(event) {
                document.querySelectorAll(".menu-btn").forEach((div) => {
                    div.classList.remove("shadow", "bg-white");
                    const icon = div.querySelector("i");
                    icon.classList.remove("text-one");
                    icon.classList.add("text-white");
                });

                this.classList.add("shadow", "bg-white");
                const currentIcon = this.querySelector("i");
                currentIcon.classList.remove("text-white");
                currentIcon.classList.add("text-one");
            });
        });

        const btn1 = document.querySelector(".btn1");
        const btn2 = document.querySelector(".btn2");
        const btn3 = document.querySelector(".btn3");
        const btn4 = document.querySelector(".btn4");
        const btn5 = document.querySelector(".btn5");
        const btn6 = document.querySelector(".btn6");
        const btn7 = document.querySelector(".btn7");
        const accordionButton = document.querySelector(".accordion-button");
        const accordionBody = document.querySelector(".accordion-body");

        btn1.addEventListener("click", (e) => {
            // accordionButton.textContent = "會員管理";
            accordionButton.innerHTML =
                '<span class="menu-icon"><i class="fa-solid fa-user-group fs-5"></i></span><span class="menu-title">會員管理</span>';
            accordionBody.innerHTML = '<li><a href="">會員列表</a></li>';
        });
        btn2.addEventListener("click", (e) => {
            accordionButton.innerHTML =
                '<span class="menu-icon"><i class="fa-solid fa-store fs-5"></i></span><span class="menu-title">商品管理</span>';
            accordionBody.innerHTML = '<li><a href="#">商品列表</a></li>';
        });
        btn3.addEventListener("click", (e) => {
            accordionButton.innerHTML =
                '<span class="menu-icon"><i class="fa-regular fa-calendar fs-5"></i></span><span class="menu-title">課程管理</span>';
            accordionBody.innerHTML = '<li><a href="#">課程列表</a></li>';
        });
        btn4.addEventListener("click", (e) => {
            accordionButton.innerHTML =
                '<span class="menu-icon"><i class="fa-brands fa-blogger fs-5"></i></span><span class="menu-title">部落格</span>';
            accordionBody.innerHTML = '<li><a href="#">文章列表</a></li>';
        });
        btn5.addEventListener("click", (e) => {
            accordionButton.innerHTML =
                '<span class="menu-icon"><i class="fa-regular fa-map fs-5"></i></span><span class="menu-title">潛點地圖</span>';
            accordionBody.innerHTML = '<li><a href="#">景點列表</a></li>';
        });
        btn6.addEventListener("click", (e) => {
            accordionButton.innerHTML =
                '<span class="menu-icon"><i class="fa-regular fa-image fs-5"></i></span><span class="menu-title">媒體庫</span>';
            accordionBody.innerHTML = '<li><a href="#">圖片列表</a></li>';
        });
        btn7.addEventListener("click", (e) => {
            accordionButton.innerHTML =
                '<span class="menu-icon"><i class="fa-solid fa-address-card fs-5"></i></span><span class="menu-title">員工資料</span>';
            accordionBody.innerHTML = '<li><a href="#">員工列表</a></li>';
        });
    </script>
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
        // const userEmail = document.querySelector("#user_email");
        // const emailErrorText = document.querySelector("[idn=emailErrorText]");
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

        // userEmail.addEventListener("input", e => {
        //     emailErrorText.textContent = "";
        //     let emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
        //     if (!emailRule.test(userEmail.value) || userEmail.value == "") {
        //         e.preventDefault();
        //         emailErrorText.textContent = "請輸入正確的Email格式";
        //     }
        // })

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
            // emailErrorText.textContent = "";
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
            // if (!emailRule.test(userEmail.value) || userEmail.value == "") {
            //     e.preventDefault();
            //     emailErrorText.textContent = "請輸入正確的Email格式";
            // }
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
            if (confirm("確認要更新這筆會員資料?") == false) {
                e.preventDefault();
            }
        })
    </script>
</body>

</html>