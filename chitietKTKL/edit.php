<?php 
include('../dbconnect.php');
?>
<?php
	$query = mysqli_query($con,"SELECT * FROM KTKL WHERE SoHieu='".$_POST['SoHieu']."'");
	while ($row = mysqli_fetch_array($query)) {
	    $output['MaNVm'] = $row['MaNV'];
	    $output['MaKTKLm'] = $row['MaKTKL'];
	    $output['MaCapKTKLm'] = $row['MaCapKTKL'];
	    $output['NgayQDm'] = $row['NgayQD'];
	    $output['NoiDungm'] = $row['NoiDung'];
	}
	echo json_encode($output);
?>