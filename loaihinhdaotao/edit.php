<?php 
include('../dbconnect.php');
?>
<?php
	$query = mysqli_query($con,"SELECT * FROM LOAIHINHHDT WHERE MaLHDT='".$_POST['MaLHDT']."'");
	while ($row = mysqli_fetch_array($query)) {
	    $output['TenLHDTm'] = $row['TenLHDT'];
	}
	echo json_encode($output);
?>