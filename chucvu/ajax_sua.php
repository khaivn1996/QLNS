<?php
	include('../dbconnect.php');
?>
<?php 
	$result = mysqli_query($con,"UPDATE CHUCVU SET TenCV='".$_POST['TenCVm']."',Tien1Gio=".$_POST['Tien1Giom']." WHERE MaCV='".$_POST['MaCVm']."'");
?>