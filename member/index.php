<?php
// 這也是會員資料的 index

require_once("../conn.php");

// 設定分頁
$perPage = 25;
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$pageStart = ($page - 1) * $perPage;

// 設定是否已驗證，2是全部，1是已驗證，0是未驗證
$cid = isset($_GET["cid"]) ? (int)$_GET["cid"] : 2;
if ($cid === 2) {
    $cidSql = "";
} else {
    $cidSql = "WHERE `is_active` = $cid";
}

// SQL語法
$sql = "SELECT * FROM `user` $cidSql LIMIT $pageStart, $perPage";
$sqlAll = "SELECT * FROM `user`";
$sqlCity = "SELECT * FROM `city`";

// 連結資料庫
$stmt = $conn->prepare($sql);
$stmtAll = $conn->prepare($sqlAll);
$stmtCity = $conn->prepare($sqlCity);

try {
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = count($rows);
    $totalPage = ceil($count / $perPage);
    
    $stmtAll->execute();
    $rowsAll = $stmtAll->fetchAll(PDO::FETCH_ASSOC);
    $countAll = count($rowsAll);
    $totalPageAll = ceil($countAll / $perPage);
    
    $stmtCity->execute();
    $rowsCity = $stmtCity->fetchAll(PDO::FETCH_ASSOC);
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
            width: 95%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>會員名單</h1>
        <p>你正在第<?= $page ?>頁，每頁<?= $perPage ?>筆資料，總共有<?= $countAll ?>筆資料</p>
        <div class="tab">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?= $cid === 2 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=2<?= ($page >= 1) ? "&page=$page" : "" ?>">全部</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $cid === 1 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=1<?= ($page >= 1) ? "&page=$page" : "" ?>">完成身分驗證</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $cid === 0 ? 'active' : '' ?>" aria-current="page" href="./index.php?cid=0<?= ($page >= 1) ? "&page=$page" : "" ?>">未驗證</a>
                </li>
            </ul>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">會員編號</th>
                    <th scope="col">姓名</th>
                    <th scope="col">註冊日期</th>
                    <th scope="col">Email</th>
                    <th scope="col">電話號碼</th>
                    <th scope="col">生日</th>
                    <th scope="col">居住縣市</th>
                    <th scope="col" class="control">修改/刪除</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?= $row["user_id"] ?></td>
                        <td><?= $row["user_full_name"] ?></td>
                        <td><?= $row["user_created_at"] ?></td>
                        <td><?= $row["user_email"] ?></td>
                        <td><?= $row["user_phone_number"] ?></td>
                        <td><?= $row["user_birthday"] ?></td>
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
                            <button class="btn btn-danger">刪除</button>
                            <button class="btn btn-warning">修改</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="page-number">
            <nav aria-label="...">
                <ul class="pagination pagination-sm">
                    <? for( $i=1; $i <= $totalPage; $i++): ?>
                    <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="./index.php?page=<?=$i?><?=($cid>=0)?"&cid=$cid":""?>"> <?= $i ?> </a>
                    </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>

</body>

</html>
