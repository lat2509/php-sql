<?php

session_start();
$id = $_GET['id'];
require_once ('connect.php');

$query = "DELETE from nhan_vien_tbl WHERE id_chuc_vu = $id";
$result = $sql_connect->query($query);
$query1 = "DELETE from chuc_vu_tbl WHERE id_cv = $id";
$result1 = $sql_connect->query($query1);

header("Location: department.php");
exit();

?>