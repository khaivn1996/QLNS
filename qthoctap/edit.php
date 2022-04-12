<?php 
include('../dbconnect.php');
?>
<?php
	$query = mysqli_query($con,"SELECT * FROM QTHOCTAP WHERE MaNV='".$_POST['MaNV']."'");
	while ($row = mysqli_fetch_array($query)) {
	    $output['TuNgaym'] = $row['TuNgay'];
	    $output['DenNgaym'] = $row['DenNgay'];
	    $output['MaBCm'] = $row['MaBC'];
	    $output['MaLHDTm'] = $row['MaLHDT'];
	    $output['ChuyenNganhm'] = $row['ChuyenNganh'];
	    $output['CoSoDTm'] = $row['CoSoDT'];
	    $output['NamTNm'] = $row['NamTN'];
	}
	echo json_encode($output);
?>