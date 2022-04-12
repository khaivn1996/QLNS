<?php 
include('../dbconnect.php');
?>
<?php
	$query = mysqli_query($con,"SELECT * FROM DONVI WHERE MaDV='".$_POST['MaDV']."'");
	while ($row = mysqli_fetch_array($query)) {
	    $output['TenDVm'] = $row['TenDV'];
	    $output['SoDTm'] = $row['SoDT'];
	}
	echo json_encode($output);
?>