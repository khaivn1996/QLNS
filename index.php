<?php
    session_start();
?>
<?php include('dbconnect.php'); ?>
<?php  
  include('admin/session.php');
?>
<?php include('admin/permission.php'); ?>
<?php 
$Sothe = $_SESSION['UserN'];
//Load mã nhân viên
$laysotheNV = "SELECT A.*,B.avatarUser FROM NHANVIEN A INNER JOIN users B ON A.MaNV=B.MaNV WHERE A.MaNV='$Sothe'";
$truyvansotheNV = mysqli_query($con,$laysotheNV);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QUẢN LÝ NHÂN SỰ</title>
    <link rel="icon" href="res/image/fav.ico" type="image/ico">
    <!-- Bootstrap core CSS -->
    <link href="res/BS5/css/bootstrap.min.css" rel="stylesheet"> 
    <script src="res/BS5/jquery/jquery.min.js"></script>
    <script src="res/BS5/js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="res/BS5/dashboard/dashboard.css" rel="stylesheet">
    <link href="res/font/quicksand.css" rel="stylesheet">
    <link href="res/BS5/dashboard/container.css" rel="stylesheet">
    <style>
#navbarDropdown{
  position: relative;
  right: 60px;
}
</style>
  </head>
  <body>
      <?php include('header.php'); ?>
      <div class="col-md-9 ms-sm-auto col-lg-9">  
        <br><br>
        <h1><b>HỆ THỐNG QUẢN LÝ NHÂN SỰ</b></h1>
        <hr>
        <ul><p style="font-style: italic;"> Là hệ thống chuyên quản lý dữ liệu thông tin nhân sự bao gồm ...</p></ul>
        <li>Quản lý Nhân Viên</li>
        <li>Quản lý Đơn Vị</li>
        <li>Quản lý Bằng Cấp</li>
        <li>Quản lý Loại Hình Đào Tạo</li>
        <li>Quản lý Quá Trình Học Tập</li>
        <li>Quản lý Quá Trình Công Tác</li>
        <li>Quản lý Danh Mục Khen Thưởng - Kỷ Luật</li>
        <li>Quản lý Cấp Khen Thưởng - Kỷ Luật</li>
        <li>Quản lý Chi Tiết Khen Thưởng - Kỷ Luật</li>
        <li>Quản lý Chấm Công - Tính Lương Hằng Tháng</li>
      </div>
      <?php include('footer.html'); ?>
<script src="res/BS5/dist/feather.min.js"></script>
<script src="res/BS5/dashboard/dashboard.js"></script>
</body>
</html>