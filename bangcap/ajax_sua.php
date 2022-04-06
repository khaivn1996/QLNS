<?php
	include('../dbconnect.php');
?>
<?php 
	$result = mysqli_query($con,"UPDATE MABANGCAP SET TenBC='".$_POST['TenBCm']."' WHERE MaBC='".$_POST['MaBCm']."'");
?>