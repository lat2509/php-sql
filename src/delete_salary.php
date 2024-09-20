<?php

session_start();
$id = $_GET['id'];
require_once ('connect.php');

$query = "DELETE FROM `luong_tbl` WHERE `luong_tbl`.`id_luong` = $id";
$result = $sql_connect->query($query);

header("Location: salary.php");
exit();

?>