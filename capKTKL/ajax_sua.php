<?php
	include('../dbconnect.php');
?>
<?php 
	$result = mysqli_query($con,"UPDATE CAPKTKL SET TenCapKTKL='".$_POST['TenCapKTKLm']."' WHERE MaCapKTKL='".$_POST['MaCapKTKLm']."'");
?>