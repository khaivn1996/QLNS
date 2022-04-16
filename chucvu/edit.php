<?php 
include('../dbconnect.php');
?>
<?php
	$query = mysqli_query($con,"SELECT * FROM CHUCVU WHERE MaCV='".$_POST['MaCV']."'");
	while ($row = mysqli_fetch_array($query)) {
	    $output['TenCVm'] = $row['TenCV'];
	    $output['Tien1Giom'] = $row['Tien1Gio'];
	}
	echo json_encode($output);
?>