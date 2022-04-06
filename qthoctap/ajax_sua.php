<?php
	include('../dbconnect.php');
?>
<?php 
	$result = mysqli_query($con,"UPDATE QTHOCTAP SET TuNgay='".$_POST['TuNgaym']."',DenNgay='".$_POST['DenNgaym']."',MaBC='".$_POST['MaBCm']."',MaLHDT='".$_POST['MaLHDTm']."',ChuyenNganh='".$_POST['ChuyenNganhm']."',CoSoDT='".$_POST['CoSoDTm']."',NamTN='".$_POST['NamTNm']."' WHERE MaNV='".$_POST['MaNVm']."'");
?>