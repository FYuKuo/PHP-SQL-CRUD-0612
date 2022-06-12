<?php
$id = $_POST['id'];
include('connect.php');
$sql = "SELECT * FROM `students` WHERE `id`='$id'";
$data = $pdo->query($sql)->fetch();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>學生資訊查詢網-修改學生資訊</title>
</head>

<body>
    <button onclick="location.href='index.php'">返回</button>

    <form action="./update.php" method="post">

        <table>
            <tr>
                <td>學號</td>
                <td>
                    <input type="text" name="uni_id" value="<?= $data['uni_id'] ?>" required>
                </td>
            </tr>
            <tr>
                <td>班級座號</td>
                <td>
                    <input type="text" name="seat_num" value="<?= $data['seat_num'] ?>" required>
                </td>
            </tr>
            <tr>
                <td>姓名</td>
                <td>
                    <input type="text" name="name" value="<?= $data['name'] ?>" required>
                </td>
            </tr>
            <tr>
                <td>出生年月日</td>
                <td>
                    <input type="date" name="birthday" value="<?= $data['birthday'] ?>" required>
                </td>
            </tr>
            <tr>
                <td>身分證號碼</td>
                <td>
                    <input type="text" name="national_id" value="<?= $data['national_id'] ?>" required>
                </td>
            </tr>
            <tr>
                <td>住址</td>
                <td>
                    <input type="text" name="address" value="<?= $data['address'] ?>" required>
                </td>
            </tr>
            <tr>
                <td>家長</td>
                <td>
                    <input type="text" name="parent" value="<?= $data['parent'] ?>" required>
                </td>
            </tr>
            <tr>
                <td>電話</td>
                <td>
                    <input type="text" name="telphone" value="<?= $data['telphone'] ?>" required>
                </td>
            </tr>
            <tr>
                <td>科別</td>
                <td>
                    <input type="text" name="major" value="<?= $data['major'] ?>" required>
                </td>
            </tr>
            <tr>
                <td>畢業國中</td>
                <td>
                    <input type="text" name="secondary" value="<?= $data['secondary'] ?>" required>
                </td>
            </tr>
        </table>

        <input type="hidden" name="id" value="<?= $id ?>">
        <button type="submit">更新</button>
        <button type="reset">重置</button>
    </form>
</body>

</html>