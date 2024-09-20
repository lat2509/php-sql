<?php

session_start();
$id = $_POST['id'];
require_once ('connect.php');

$query = "UPDATE nghi_phep_tbl SET trang_thai = 1 WHERE id_nghi = $id";
$result = $sql_connect->query($query);

header("Location: leave.php");
exit();

?>