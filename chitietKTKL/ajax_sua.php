<?php
	include('../dbconnect.php');
?>
<?php 
	$result = mysqli_query($con,"UPDATE KTKL SET MaNV='".$_POST['MaNVm']."',MaKTKL='".$_POST['MaKTKLm']."',MaCapKTKL='".$_POST['MaCapKTKLm']."',NgayQD='".$_POST['NgayQDm']."',NoiDung='".$_POST['NoiDungm']."' WHERE SoHieu='".$_POST['SoHieum']."'");
?>