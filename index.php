<?php
include("connect.php");
$sql = "SELECT * FROM `students`";
$rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($rows);
echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>學生資訊查詢網</title>
</head>

<body>

</body>

</html>