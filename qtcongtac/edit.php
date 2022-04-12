<?php 
include('../dbconnect.php');
?>
<?php
	$query = mysqli_query($con,"SELECT * FROM QTCONGTAC WHERE MaNV='".$_POST['MaNV']."'");
	while ($row = mysqli_fetch_array($query)) {
	    $output['TuNgaym'] = $row['TuNgay'];
	    $output['DenNgaym'] = $row['DenNgay'];
	    $output['MaDVm'] = $row['MaDV'];
	    $output['CongViecm'] = $row['CongViec'];
	    $output['NoiLamViecm'] = $row['NoiLamViec'];
	}
	echo json_encode($output);
?>