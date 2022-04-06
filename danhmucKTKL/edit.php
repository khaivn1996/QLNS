<?php 
include('../dbconnect.php');
?>
<?php
	$query = mysqli_query($con,"SELECT * FROM DMKTKL WHERE MaKTKL='".$_POST['MaKTKL']."'");
	while ($row = mysqli_fetch_array($query)) {
	    $output['TenKTKLm'] = $row['TenKTKL'];
	    $output['KTKLm'] = $row['KTKL'];
	}
	echo json_encode($output);
?>