<?php
	include('../dbconnect.php');
?>
<?php 
	$result = mysqli_query($con,"UPDATE NHANVIEN SET HoNV='".$_POST['HoNVm']."',TenNV='".$_POST['TenNVm']."',GioiTinh='".$_POST['GioiTinhm']."',NgaySinh='".$_POST['NgaySinhm']."',DiaChi='".$_POST['DiaChim']."',DienThoai='".$_POST['DienThoaim']."',MaDV='".$_POST['MaDVm']."' WHERE MaNV='".$_POST['MaNVm']."'");
	
?>