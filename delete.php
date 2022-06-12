<?php
$id = $_POST['id'];
include('connect.php');
$sql = "DELETE FROM `students` WHERE `id`='$id'";

$pdo->exec($sql);

header("location:index.php");

?>