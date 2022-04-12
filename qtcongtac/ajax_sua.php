<?php
	include('../dbconnect.php');
?>
<?php 
	$result = mysqli_query($con,"UPDATE QTCONGTAC SET TuNgay='".$_POST['TuNgaym']."',DenNgay='".$_POST['DenNgaym']."',MaDV='".$_POST['MaDVm']."',CongViec='".$_POST['CongViecm']."',NoiLamViec='".$_POST['NoiLamViecm']."' WHERE MaNV='".$_POST['MaNVm']."'");
?>