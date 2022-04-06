<?php session_start(); 
 
if (isset($_SESSION['UserN'])){
    unset($_SESSION['UserN']); // xóa session login
    unset($_SESSION['HoTen']);
    unset($_SESSION['Email']); // xóa session login
    unset($_SESSION['Admin']);
}
header('Location: http://localhost:8080/QLNS/admin/dangnhap.php');
?>