<?php 
include('../dbconnect.php');
?>
<?php
	$query = mysqli_query($con,"SELECT * FROM MABANGCAP WHERE MaBC='".$_POST['MaBC']."'");
	while ($row = mysqli_fetch_array($query)) {
	    $output['TenBCm'] = $row['TenBC'];
	}
	echo json_encode($output);
?>