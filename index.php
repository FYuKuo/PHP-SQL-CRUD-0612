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

// 如果有搜尋條件
if (isset($_GET['like'])) {
    $where = $_GET['where'];
    $like = $_GET['like'];
    $sql = "SELECT * FROM `students` WHERE `$where` LIKE '%$like%'"; //抓取搜尋條件
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    $rowsNum = count($rows); //計算共有多少筆資料
    $pages = ceil($rowsNum / $limit); //計算會有多少頁

    if (isset($_GET['page'])) { //如果有選到頁數
        $page = $_GET['page'];
    } else { //如果沒選頁數就從一開始
        $page = 1;
    }
    $start = ($page - 1) * $limit; //開始的編號為頁數減1乘以每頁筆數

    $data = "SELECT * FROM `students` WHERE `$where` LIKE '%$like%' LIMIT $start,$limit"; //抓取條件的筆數
    $rows = $pdo->query($data)->fetchAll(PDO::FETCH_ASSOC); //把資料存到變數裡
} else { //如果沒有搜尋條件
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
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>學生資訊查詢網</title>

    <!-- fontawesome引入 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css檔案引入 -->
    <link rel="stylesheet" href="./style.css">

</head>

<body>

    <div class="header">
        <a href="./index.php">學生資訊查詢網</a>
    </div>

    <div class="content">

        <!-- 表格區 -->
        <table>
            <!-- 表格的nav區 -->
            <tr>
                <td colspan="12">

                    <div class="nav">
                        <!-- 總共有幾筆資料 -->
                        <div class="total">
                            共<span><?= $rowsNum ?></span>筆資料
                        </div>

                        <div class="nav_right">
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

                            <div class="nav_add">
                                <button onclick="location.href='add.php'"><i class="fa-solid fa-plus"></i> 新增</button>
                            </div>

                        </div>
                        <!-- 選擇每頁呈現筆數 -->
                    </div>
                </td>
            </tr>
            <!-- 表格的nav區結束 -->

            <!-- 表格的搜尋區 -->
            <tr>
                <td colspan="12">
                    <div class="td_search">

                        <form action="./index.php" method="get" id="search_form">
                            <input type="text" name="like" id="search_like" required>
                            <select name="where">
                                <option selected disabled>搜尋條件</option>
                                <option value="uni_id">學號</option>
                                <option value="seat_num">班級座號</option>
                                <option value="name">姓名</option>
                                <option value="birthday">出生年月日</option>
                                <option value="national_id">身分證號碼</option>
                                <option value="address">住址</option>
                                <option value="parent">家長</option>
                                <option value="telphone">電話</option>
                                <option value="major">科別</option>
                                <option value="secondary">畢業國中</option>
                            </select>
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> 查詢</button>
                        </form>

                        <?php
                        if (isset($_GET['like'])) {
                        ?>
                            <div class="searchText">
                                搜尋條件：
                            </div>
                            <div class="searchText_where">
                                <?php
                                $whereArr = ['uni_id' => '學號', 'seat_num' => '班級座號', 'name' => '姓名', 'birthday' => '出生年月日', 'national_id' => '身分證號碼', 'address' => '住址', 'parent' => '家長', 'telphone' => '電話', 'major' => '科別', 'secondary' => '畢業國中'];
                                echo $whereArr[$where];
                                ?>
                            </div>
                            <div class="searchText_like">
                                <?= $like ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <!-- 表格的搜尋區結束 -->

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
                <td>功能</td>
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
                    <td>
                        <!-- 資料功能區 -->
                        <div class="td_function">
                            <!-- 資料編輯按鈕 -->
                            <form action="./edit.php" method="post">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="submit" value="編輯" id="editBn" onclick="location.href='edit.php'">
                            </form>
                            <!-- 資料刪除按鈕 -->
                            <form action="./delete.php" method="post">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="submit" value="刪除" id="delBn" onclick="location.href='delete.php'">
                            </form>
                        </div>
                    </td>
                </tr>

            <?php
            }
            ?>
            <tr>
                <!-- 頁數呈現區 -->
                <td colspan="12" class='page_num'>
                    <?php
                    $pre = $page - 1;
                    $next = $page + 1;

                    // 如果有搜尋條件把條件帶進網址參數
                    if (isset($_GET['like'])) {
                        if ($page == 1) {
                            for ($i = 1; $i <= 5; $i++) {
                                $nowPage = '';
                                if ($page == $i) {
                                    $nowPage = 'nowPage';
                                }
                                echo "<a href='index.php?page=$i&limit=$limit&like=$like&where=$where' class='$nowPage'>$i</a>";
                                if($i == $pages) {
                                    break;
                                }
                            }
                            if($pages>$i){
                                echo "<a href='index.php?page=$next&limit=$limit&like=$like&where=$where'>></a>";
                            }
                        } elseif ($page == 2) {
                            echo "<a href='index.php?page=$pre&limit=$limit&like=$like&where=$where'><</a>";
                            for ($i = 1; $i <= 5; $i++) {
                                $nowPage = '';
                                if ($page == $i) {
                                    $nowPage = 'nowPage';
                                }
                                echo "<a href='index.php?page=$i&limit=$limit&like=$like&where=$where' class='$nowPage'>$i</a>";
                                if($i == $pages) {
                                    break;
                                }
                            }
                            if($pages>$i){
                                echo "<a href='index.php?page=$next&limit=$limit&like=$like&where=$where'>></a>";
                            }
                        } else {
                            echo "<a href='index.php?page=$pre&limit=$limit&like=$like&where=$where'><</a>";
                            for ($i = ($page - 2); $i <= ($page + 2); $i++) {
                                $nowPage = '';
                                if ($page == $i) {
                                    $nowPage = 'nowPage';
                                }
                                echo "<a href='index.php?page=$i&limit=$limit&like=$like&where=$where' class='$nowPage'>$i</a>";
                                if($i == $pages) {
                                    break;
                                }
                            }
                            if($pages<$i){
                                echo "<a href='index.php?page=$next&limit=$limit&like=$like&where=$where'>></a>";
                            }
                        }
                    } else { //如果沒有搜尋條件
                        if ($page == 1) {
                            for ($i = 1; $i <= 5; $i++) {
                                $nowPage = '';
                                if ($page == $i) {
                                    $nowPage = 'nowPage';
                                }
                                echo "<a href='index.php?page=$i&limit=$limit' class='$nowPage'>$i</a>";
                                if($i == $pages) {
                                    break;
                                }
                            }
                            if($pages>$i){
                                echo "<a href='index.php?page=$next&limit=$limit'>></a>";
                            }
                        } elseif ($page == 2) {
                            echo "<a href='index.php?page=$pre&limit=$limit'><</a>";
                            for ($i = 1; $i <= 5; $i++) {
                                $nowPage = '';
                                if ($page == $i) {
                                    $nowPage = 'nowPage';
                                }
                                echo "<a href='index.php?page=$i&limit=$limit' class='$nowPage'>$i</a>";
                                if($i == $pages) {
                                    break;
                                }
                            }
                            if($pages>$i){
                                echo "<a href='index.php?page=$next&limit=$limit'>></a>";
                            }
                        } else {
                            echo "<a href='index.php?page=$pre&limit=$limit'><</a>";
                            for ($i = ($page - 2); $i <= ($page + 2); $i++) {
                                $nowPage = '';
                                if ($page == $i) {
                                    $nowPage = 'nowPage';
                                }
                                echo "<a href='index.php?page=$i&limit=$limit' class='$nowPage'>$i</a>";
                                if($i == $pages) {
                                    break;
                                }
                            }
                            if($pages<$i){
                                echo "<a href='index.php?page=$next&limit=$limit'>></a>";
                            }
                        }
                    }
                    ?>
                </td>
            </tr>
        </table>
        <!-- 表格區結束 -->
    </div>

    <!-- 頁尾區 -->
    <div class="footer">
        &copy; <?= date('Y') ?> FY
    </div>
    <!-- 頁尾區結束 -->

    <!-- 送出select的js -->
    <script src="./limitSubmit.js"></script>
</body>

</html>