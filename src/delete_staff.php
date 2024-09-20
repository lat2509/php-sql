<?php
session_start();
$id = $_GET['id'];
require_once ('connect.php');

$query1 = "DELETE FROM luong_tbl WHERE id_nv = $id";
$query2 = "DELETE FROM nghi_phep_tbl WHERE id_nv = $id";
$query3 = "DELETE FROM tra_luong_tbl WHERE id_nv = $id";

if ($sql_connect->query($query1) === TRUE && $sql_connect->query($query2) === TRUE && $sql_connect->query($query3) === TRUE) {
    $query4 = "DELETE FROM nhan_vien_tbl WHERE id_nv = $id";
    if ($sql_connect->query($query4) === TRUE) {
        header("Location: staff.php");
        exit();
    } else {
        echo "Lỗi: " . $sql_connect->error;
    }
} else {
    echo "Lỗi: " . $sql_connect->error;
}
?>