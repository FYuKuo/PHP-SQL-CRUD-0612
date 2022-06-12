<?php
include('connect.php');
$sql = "INSERT INTO `students` 
(`uni_id`, `seat_num`, `name`, `birthday`, `national_id`, `address`, `parent`, `telphone`, `major`, `secondary`)
VALUES ('{$_POST['uni_id']}', '{$_POST['seat_num']}', '{$_POST['name']}', '{$_POST['birthday']}', '{$_POST['national_id']}', '{$_POST['address']}', '{$_POST['parent']}', '{$_POST['telphone']}', '{$_POST['major']}', '{$_POST['secondary']}')";

$pdo->exec($sql);

header("location:index.php");

?>