<?php
// 這也是會員清單資料的 index

require_once("../conn.php");

// 設定分頁
$perPage = 25;
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$pageStart = ($page - 1) * $perPage;



// 設定是否已驗證，2是全部，1是已驗證，0是未驗證，6是封鎖
$cid = isset($_GET["cid"]) ? (int)$_GET["cid"] : 2;
if ($cid == 2){
    $cidSql = "`user_valid` = 1 AND";
} elseif($cid == 3){
    $cidSql = "`user_valid` = 0 AND";
}else{
    $cidSql = "`is_active` = $cid AND `user_valid` = 1 AND " ;
}


// 設定模糊搜尋
$searchType = isset($_GET["stype"]) ? $_GET["stype"] : "";
$searchText = isset($_GET["search"]) ? $_GET["search"] : "";
$sqlSearch = ($searchType && $searchText) ? "`$searchType` LIKE '%$searchText%' AND " : "";

// 封鎖名單


// SQL語法
$sql = "SELECT * FROM `user` where $cidSql $sqlSearch `user_created_at` < NOW() LIMIT $pageStart, $perPage;";
$sqlCity = "SELECT * FROM `city`;";
$sqlCount = "SELECT COUNT(*) as total FROM user WHERE $cidSql $sqlSearch `user_created_at` < NOW();";
// 計算總數的SQL，AS total 為查詢結果中的計數欄位起了一個名稱 total


// 連結資料庫
$stmt = $conn->prepare($sql);
$stmtCity = $conn->prepare($sqlCity);
$stmtCount = $conn->prepare($sqlCount);


try {
    $stmtCount->execute();
    $totalCount = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPage = ceil($totalCount / $perPage);

    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmtCity->execute();
    $rowsCity = $stmtCity->fetchAll(PDO::FETCH_ASSOC);
    $conn = NULL;
} catch (PDOException $e) {
    echo "你的資料讀取失敗欸!因為:" . $e->getMessage();
    $conn = NULL;
    exit;
}

echo "<pre>";
var_dump($sql);
echo "</pre>";

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
            width: 95%;
        }

        .title {
            text-align: center;
            padding: 20px;
        }

        /* .top {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        } */
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">會員名單</h1>
        <div class="top">
            <div class="top-left">
                <p>你正在第<?= $page ?>頁，每頁<?= $perPage ?>筆資料，總共有<?= $totalCount ?>筆資料</p>
            </div>
            <div class="top-right me-1">
                <div class="input-group input-group-sm">
                    <div class="input-group-text">
                        <input type="radio" name="searchType" id="searchType1" value="user_full_name">
                        <label for="searchType1">姓名</label>
                        <input type="radio" name="searchType" id="searchType2" value="user_phone_number">
                        <label for="searchType2" class="">電話</label>
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="輸入關鍵字">
                        <div class="btn btn-primary btn-sm btn-search">搜尋</div>
                    </div>
                </div>
            </div>
            <div class="tab">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link tag2 <?= $cid === 2 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=2<?= "&page=1" ?>">全部</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tag1 <?= $cid === 1 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=1<?= "&page=1" ?>">完成身分驗證</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tag0 <?= $cid === 0 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=0<?= "&page=1" ?>">未驗證</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tag0 <?= $cid === 3 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=3<?= "&page=1" ?>">封鎖</a>
                    </li>
                </ul>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <!-- <th scope="col">序</th> -->
                        <th scope="col">會員編號</th>
                        <th scope="col">姓名</th>
                        <th scope="col">註冊日期</th>
                        <th scope="col">Email</th>
                        <th scope="col">電話號碼</th>
                        <!-- <th scope="col">生日</th> -->
                        <th scope="col">驗證身分</th>
                        <th scope="col">居住縣市</th>
                        <th scope="col" class="control">修改/刪除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $index => $row) : ?>
                        <tr>
                            <!-- <td><?= $pageStart + $index + 1 ?></td> -->
                            <td><?= $row["user_id"] ?></td>
                            <td><?= $row["user_full_name"] ?></td>
                            <td><?= $row["user_created_at"] ?></td>
                            <td><?= $row["user_email"] ?></td>
                            <td><?= $row["user_phone_number"] ?></td>
                            <!-- <td><?= $row["user_birthday"] ?></td> -->
                            <td><?= $row["is_active"] ?></td>
                            <td>
                                <?php
                                $cityName = "";
                                foreach ($rowsCity as $rowCity) {
                                    if ($row["city_id"] == $rowCity["city_id"]) {
                                        $cityName = $rowCity["city_name"];
                                        break;
                                    }
                                }
                                echo $cityName;
                                ?>
                            </td>
                            <td>
                                <a class="delete-button" idn="<?= (int)$row["user_id"]?>">
                                    <button class="btn btn-danger">封鎖</button>
                                </a>
                                <a href="./pageMsg.php?id=<?= (int)$row["user_id"] ?>">
                                    <button class="btn btn-warning" >修改</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav aria-label="...">
                <ul class="pagination pagination-sm">
                    <? for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="./index.php?page=<?= $i ?><?= "&cid=$cid" ?><?= ($searchType != "" && $searchText != "") ? "&stype=$searchType&search=$searchText" : ""  ?>"><?= $i ?></a></li>
                    <? endfor; ?>
                </ul>
            </nav>
        </div>

        <script>
            let btnSearch = document.querySelector(".btn-search");
            btnSearch.addEventListener("click", e => {
                let searchType = document.querySelector("input[name=searchType]:checked").value;
                let searchText = document.querySelector("input[name=search]").value;
                // 找網址中參數，要記得打''
                let currentCid = new URLSearchParams(window.location.search).get('cid');

                if (searchType) {
                    window.location.href = `./index.php?stype=${searchType}&search=${searchText}&page=1&cid=${currentCid}`;
                } else {
                    alert("請選擇搜索類型");
                    // 這行不知道為什麼沒有作用
                }
            })

            let deleteButton = document.querySelectorAll(".delete-button");
            deleteButton.forEach(function(btn){
                btn.addEventListener("click", function(e){
                if(confirm("確定要封鎖?") == true){
                    window.location.href = "./doDelete.php?id="+this.getAttribute("idn");
                }
            })
            })

            
        </script>
</body>

</html>