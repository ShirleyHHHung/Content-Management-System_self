<?php
// 這也是員工清單資料的 index

require_once("../conn.php");

//設定分頁
$perPage = 10;
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$pageStart = ($page - 1) * $perPage;



// 設定是否已驗證，2是全部，1是已驗證，0是未驗證，6是封鎖
$cid = isset($_GET["cid"]) ? (int)$_GET["cid"] : "";
if ($cid == 0) {
  $cidSql = "`is_valid` = 0 AND ";
} elseif ($cid == 2) {
  $cidSql = "`role_id` = 2 AND `is_valid` = 1 AND ";
} elseif ($cid == 3) {
  $cidSql = "`role_id` = 3 AND `is_valid` = 1 AND ";
} elseif ($cid == 4) {
  $cidSql = "`role_id` = 4 AND `is_valid` = 1 AND ";
} elseif ($cid == 5) {
  $cidSql = "`role_id` = 5 AND `is_valid` = 1 AND ";
} else {
  $cidSql = "`is_valid` = 1 AND ";
}
// `role_id`

// 設定模糊搜尋
// $searchType = isset($_GET["stype"]) ? $_GET["stype"] : "";
// $searchText = isset($_GET["search"]) ? $_GET["search"] : "";
// $sqlSearch = ($searchType && $searchText) ? "`$searchType` LIKE '%$searchText%' AND " : "";



// SQL語法
$sql = "SELECT * FROM `employee` WHERE $cidSql `em_hire_date` < NOW()  LIMIT $pageStart, $perPage;";
$sqlCount = "SELECT COUNT(*) as total FROM employee  WHERE $cidSql `em_hire_date` < NOW();";
// 計算總數的SQL，AS total 為查詢結果中的計數欄位起了一個名稱 total
// $sqlCity = "SELECT * FROM `city`;";


// 連結資料庫
$stmt = $conn->prepare($sql);
$stmtCount = $conn->prepare($sqlCount);
// $stmtCity = $conn->prepare($sqlCity);


try {
  $stmtCount->execute();
  $totalCount = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
  $totalPage = ceil($totalCount / $perPage);

  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $conn = NULL;
} catch (PDOException $e) {
  echo "你的資料讀取失敗欸!因為:" . $e->getMessage();
  $conn = NULL;
  exit;
}

// echo "<pre>";
// var_dump($rows);
// echo "</pre>";
// exit

?>



<!DOCTYPE html>
<html lang="zh-hant-TW">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>員工資料表</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Castoro:ital@0;1&family=Noto+Sans+TC:wght@100..900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="../css/customBS.css" />
  <link rel="stylesheet" href="../css/pageDashboard3.css" />
  <style>
    .table-container {
      padding: 30px;
      border-radius: 20px;
      margin-bottom: 60px;
    }

    /* .top {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        } */
  </style>
</head>

<body class="bg-three d-flex">

  <nav class="d-flex sticky-top h100vh rounded-end-4">
    <!-- 綠色欄位 -->
    <div class="w280px h-100 bg-one position-relative rounded-end-5">
      <div
        class="green-area-icon h-100 w80px d-flex flex-column align-items-center">
        <!-- 在自己的<div>上加2個class: bg-white shadow -->
        <!-- 將<i>上的原本的class: text-white 改成 text-one -->
        <!-- 會員 -->
        <div
          class="menu-btn mt-4 w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn1 ">
          <a href="../member/index.php"><i class="fa-solid fa-user-group text-white fs-4"></i></a>
        </div>
        <!-- 商品 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn2">
          <a href="../product/index.php"><i class="fa-solid fa-store text-white fs-4"></i></a>
        </div>
        <!-- 課程 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn3">
          <a href="../lesson/index.php"><i class="fa-regular fa-calendar text-white fs-4"></i></a>
        </div>
        <!-- 部落格 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn4">
          <a href="../blog/blogs.php"><i class="fa-brands fa-blogger text-white fs-4"></i></a>
        </div>
        <!-- 潛點地圖 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn5">
          <a href="../DSite/dsList.php"><i class="fa-regular fa-map text-white fs-4"></i></a>
        </div>
        <!-- 媒體庫 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn6">
          <a href="../media/mediaLibrary.php"><i class="fa-regular fa-image text-white fs-4"></i></a>
        </div>
        <!-- 員工 -->
        <div
          class="bg-white shadow menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-2 mt-auto btn7">
          <a href="../employee/index.php"><i class="fa-solid fa-address-card text-one fs-5"></i></a>
        </div>
        <div
          class="w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-4">
          <a href="#"><i class="fa-solid fa-right-from-bracket text-white fs-5"></i></a>
        </div>
      </div>
    </div>
    <!-- 白色欄位 -->
    <div
      class="w200px h-100 d-flex flex-column justify-content-center bg-white card rounded-4 position-absolute white-area">
      <!-- logo區 -->
      <div class="logobox container my-5 d-flex justify-content-center">
        <img
          src="../84901e5e1a173e3324e4ba59bf3b9b9f.png"
          alt=""
          class="logo" />
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
            <button class="accordion-button text-one ms-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span class="menu-icon"><i class="fa-solid fa-address-card text-one fs-5"></i></span><span class="menu-title">員工管理</span></button>
          </div>
          <div>
            <div class="accordion-body mt-3">
              <!-- 放上子項目名稱&連結 -->
              <li class="list-a"><a href="#######" class="ms-1">員工列表</a></li>
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
    <h1 class="my-5 text-one">員工名單</h1>
    <div class="d-flex justify-content-start mb-4">
      <div class="top-left me-2">
        <p>你正在第<?= $page ?>頁，每頁<?= $perPage ?>筆資料，總共有<?= $totalCount ?>筆資料</p>
      </div>
    </div>

      <!-- 分類 -->
      <div class="table-container bg-light">
      <div class="tab">
        <ul class="nav nav-tabs">
          <li class="nav-item me-2">
            <a class="border border-one border-bottom-0 border-1 text-one nav-link tag1 <?= $cid === 1 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=1<?= "&page=1" ?>">員工一覽</a>
          </li>

          <li class="nav-item me-2">
            <a class="border border-one border-bottom-0 border-1 text-one nav-link tag1 <?= $cid === 2 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=2<?= "&page=1" ?>">所有者</a>
          </li>

          <li class="nav-item me-2">
            <a class="border border-one border-bottom-0 border-1 text-one nav-link tag1 <?= $cid === 3 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=3<?= "&page=1" ?>">管理員</a>
          </li>
          <li class="nav-item me-2">
            <a class="border border-one border-bottom-0 border-1 text-one nav-link tag1 <?= $cid === 4 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=4<?= "&page=1" ?>">編輯者</a>
          </li>
          <li class="nav-item me-2">
            <a class="border border-one border-bottom-0 border-1 text-one nav-link tag1 <?= $cid === 5 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=5<?= "&page=1" ?>">工讀生</a>
          </li>
          <li class="nav-item ms-auto">
            <a class="border border-one border-bottom-0 border-1 text-one nav-link tag0 <?= $cid === 0 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=0<?= "&page=1" ?>">已離職</a>
          </li>
        </ul>
      </div>

      <table class="table table-hover text-center">
        <thead>
          <tr>
            <th scope="col">員工編號</th>
            <th scope="col">姓名</th>
            <th scope="col">到職日期</th>
            <th scope="col">Email</th>
            <th scope="col">權限角色</th>
            <th scope="col">是否還在職</th>
            <th scope="col" class="control">修改</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $index => $row) : ?>
            <tr>
              <!-- <td><?= $pageStart + $index + 1 ?></td> -->
              <td><?= $row["em_id"] ?></td>
              <td><?= $row["em_full_name"] ?></td>
              <td><?= $row["em_hire_date"] ?></td>
              <td><?= $row["em_email"] ?></td>
              <td><? if ($row["role_id"] == 2) {
                    echo "所有者";
                  } elseif ($row["role_id"] == 3) {
                    echo "管理者";
                  } elseif ($row["role_id"] == 4) {
                    echo "編輯者";
                  } else {
                    echo "工讀生";
                  } ?></td>
              <td><?= ($row["is_valid"] == 1) ? "在職中" : "離職" ?></td>
              <td>
                <!-- <a class="delete-button" idn="<?= (int)$row["em_id"] ?>">
                                    <button class="btn btn-danger" idn="blockButtonText"></button>
                                </a> -->
                <a href="./pageMsg.php?id=<?= (int)$row["em_id"] ?>">
                  <button class="btn btn-one">修改</button>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div aria-label="..." class="pages d-flex justify-content-center mt-5">
        <ul class="pagination pagination">
          <? for ($i = 1; $i <= $totalPage; $i++) : ?>
            <li class="page-item"><a class="page-link text-four" href="./index.php?page=<?= $i ?>"><?= $i ?></a></li>
          <? endfor; ?>
        </ul>
      </div>
      </div>
      

    </div>

    <script>
      // 在cid=0時按鈕文字顯示[回歸]
      let url = new URL(window.location.href);
      let cidNum = url.searchParams.get("cid");

      document.querySelectorAll("[idn=blockButtonText]").forEach(e => {
        if (cidNum == 0) {
          e.textContent = "回歸";
        } else {
          e.textContent = "離職";
        }
      })


      // 按下軟刪除按鈕；跳出通知及轉跳
      // let deleteButton = document.querySelectorAll(".delete-button");
      // deleteButton.forEach(function(btn) {
      //     btn.addEventListener("click", function(e) {
      //         if (confirm("確定要執行嗎?") == true) {
      //             window.location.href = "./doDelete.php?id=" + this.getAttribute("idn") +"&cid=" + cidNum;
      //         }
      //     })
      // })
    </script>
</body>

</html>