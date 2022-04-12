<?php 
include('../dbconnect.php');
?>
<?php
	$query = mysqli_query($con,"SELECT * FROM CAPKTKL WHERE MaCapKTKL='".$_POST['MaCapKTKL']."'");
	while ($row = mysqli_fetch_array($query)) {
	    $output['TenCapKTKLm'] = $row['TenCapKTKL'];
	}
	echo json_encode($output);
?>