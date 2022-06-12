<?php
//連接資料庫
include("connect.php");
//選取所有students裡的資料
$sql = "SELECT * FROM `students`";
//把資料存在變數裡
$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($rows);
// echo "</pre>";

//如果有選擇每頁顯示筆數
if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else { //如果沒選就是預設
    $limit = 12;
}

$rowsNum = count($rows); //計算共有多少筆資料
$pages = ceil($rowsNum / $limit); //計算會有多少頁

if (isset($_GET['page'])) { //如果有選到頁數
    $page = $_GET['page'];
} else { //如果沒選頁數就從一開始
    $page = 1;
}

$start = ($page - 1) * $limit; //開始的編號為頁數減1乘以每頁筆數
$data = "SELECT * FROM `students` LIMIT $start,$limit"; //抓取條件的筆數
$rows = $pdo->query($data)->fetchAll(PDO::FETCH_ASSOC); //把資料存到變數裡

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>學生資訊查詢網</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <!-- 表格區 -->
    <table>
        <tr>

            <!-- 表格的nav區 -->
            <td colspan="11">
                <div class="nav">

                    <!-- 總共有幾筆資料 -->
                    <div class="total">
                        共<?= $rowsNum ?>筆資料
                    </div>

                    <!-- 選擇每頁呈現筆數 -->
                    <div class="nav_limit">
                        <form action="./index.php" method="get" id="limit_form">
                            <select name="limit" id="limit">
                                <option value="12" <?= ($limit) == "12" ? "selected" : "" ?>>每頁顯示12筆</option>
                                <option value="25" <?= ($limit) == "25" ? "selected" : "" ?>>每頁顯示25筆</option>
                                <option value="50" <?= ($limit) == "50" ? "selected" : "" ?>>每頁顯示50筆</option>
                                <option value="100" <?= ($limit) == "100" ? "selected" : "" ?>>每頁顯示100筆</option>
                            </select>
                        </form>
                    </div>
                </div>
            </td>
        </tr>

        <!-- 資料的抬頭 -->
        <tr>
            <td>編號</td>
            <td>學號</td>
            <td>班級座號</td>
            <td>姓名</td>
            <td>姓名</td>
            <td>身分證號碼</td>
            <td>住址</td>
            <td>家長</td>
            <td>電話</td>
            <td>科別</td>
            <td>畢業國中</td>
        </tr>

        <!-- 用foreach取出二微陣列中第一層的索引值 -->
        <?php
        foreach ($rows as $row) {
        ?>
            <tr>
                <!-- 用foreach取出二微陣列中第二層的值 -->
                <?php
                foreach ($row as $value) {
                    echo "<td>";
                    echo $value;
                    echo "</td>";
                }
                ?>
            </tr>

        <?php
        }
        ?>
        <tr>
            <!-- 頁數呈現區 -->
            <td colspan="11" class='page_num'>
                <?php
                for ($i = 1; $i <= $pages; $i++) {
                    echo "<a href='index.php?page=$i&limit=$limit'>$i</a>";
                }
                ?>
            </td>
        </tr>
    </table>

    <!-- 送出select的js -->
    <script src="./limitSubmit.js"></script>
</body>

</html>