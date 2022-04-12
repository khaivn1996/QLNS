<?php
	include('../dbconnect.php');
?>
<?php
	$mas = $_POST['MaKTKLs'];
	$tens= $_POST['TenKTKLs'];
	if ($_POST['KTKLs']=='true') {
		$chks=1;
	}else{
		$chks=0;
	}
	$kup= "UPDATE DMKTKL SET TenKTKL='".$tens."',KTKL='".$chks."' WHERE MaKTKL='".$mas."'";
	$result = mysqli_query($con,$kup);
?>