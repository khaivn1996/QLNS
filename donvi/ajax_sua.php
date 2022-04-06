<?php
	include('../dbconnect.php');
?>
<?php 
	$result = mysqli_query($con,"UPDATE DONVI SET TenDV='".$_POST['TenDVm']."',SoDT='".$_POST['SoDTm']."' WHERE MaDV='".$_POST['MaDVm']."'");
?>