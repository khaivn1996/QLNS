<?php
	include('../dbconnect.php');
?>
<?php 
	$result = mysqli_query($con,"UPDATE LOAIHINHHDT SET TenLHDT='".$_POST['TenLHDTm']."' WHERE MaLHDT='".$_POST['MaLHDTm']."'");
?>