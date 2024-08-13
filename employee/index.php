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
}elseif($cid == 2){
    $cidSql = "`role_id` = 2 AND `is_valid` = 1 AND ";
}elseif($cid == 3){
    $cidSql = "`role_id` = 3 AND `is_valid` = 1 AND ";
}elseif($cid == 4){
    $cidSql = "`role_id` = 4 AND `is_valid` = 1 AND ";
}elseif($cid == 5){
    $cidSql = "`role_id` = 5 AND `is_valid` = 1 AND ";
}else {
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
        <h1 class="title">員工名單</h1>
        <div class="top">
            <div class="top-left">
                <p>你正在第<?= $page ?>頁，每頁<?= $perPage ?>筆資料，總共有<?= $totalCount ?>筆資料</p>
            </div>

            <!-- 分類 -->
            <div class="tab">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link tag1 <?= $cid === 1 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=1<?= "&page=1" ?>">員工一覽</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link tag1 <?= $cid === 2 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=2<?= "&page=1" ?>">所有者</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link tag1 <?= $cid === 3 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=3<?= "&page=1" ?>">管理員</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tag1 <?= $cid === 4 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=4<?= "&page=1" ?>">編輯者</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tag1 <?= $cid === 5 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=5<?= "&page=1" ?>">工讀生</a>
                    </li>
                    <li class="nav-item ms-auto">
                        <a class="nav-link tag0 <?= $cid === 0 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=0<?= "&page=1" ?>">已離職</a>
                    </li>
                </ul>
            </div>

            <table class="table table-hover">
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
                            <td><? if($row["role_id"]==2){
                                echo "所有者";
                            }elseif($row["role_id"] == 3){
                                echo "管理者";
                            }elseif($row["role_id"] == 4){
                                echo "編輯者";
                            }else{
                                echo "工讀生";
                            } ?></td>
                            <td><?= ($row["is_valid"] == 1) ? "在職中" : "離職" ?></td>
                            <td>
                                <!-- <a class="delete-button" idn="<?= (int)$row["em_id"] ?>">
                                    <button class="btn btn-danger" idn="blockButtonText"></button>
                                </a> -->
                                <a href="./pageMsg.php?id=<?= (int)$row["em_id"] ?>">
                                    <button class="btn btn-warning">修改</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav aria-label="...">
                <ul class="pagination pagination-sm">
                    <? for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="./index.php?page=<?= $i ?>"><?= $i ?></a></li>
                    <? endfor; ?>
                </ul>
            </nav>

            <!-- <a href="./pageAdd.php?>">
                <button class="btn btn-warning">新增一筆</button>
            </a> -->

        </div>

        <script>

            // 在cid=0時按鈕文字顯示[回歸]
            let url = new URL(window.location.href);
            let cidNum = url.searchParams.get("cid");

            document.querySelectorAll("[idn=blockButtonText]").forEach( e => {
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