<?php
	include('../dbconnect.php');
?>
<?php 
	$result = mysqli_query($con,"UPDATE DMKTKL SET TenKTKL='".$_POST['TenKTKLm']."',KTKL='".$_POST['KTKLm']."' WHERE MaKTKL='".$_POST['MaKTKLm']."'");
?>