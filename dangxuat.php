<?php session_start();
if (isset($_SESSION['taikhoanadmin'])){
unset($_SESSION['taikhoanadmin']); // xóa session login
session_destroy();
header("Location: dangnhap.php");
}
?>