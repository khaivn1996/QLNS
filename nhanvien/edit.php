<?php 
include('../dbconnect.php');
?>
<?php
	$query = mysqli_query($con,"SELECT * FROM NHANVIEN WHERE MaNV='".$_POST['MaNV']."'");
	while ($row = mysqli_fetch_array($query)) {
	    $output['HoNVm'] = $row['HoNV'];
	    $output['TenNVm'] = $row['TenNV'];
	    $output['GioiTinhm'] = $row['GioiTinh'];
	    $output['NgaySinhm'] = $row['NgaySinh'];
	    $output['DiaChim'] = $row['DiaChi'];
	    $output['DienThoaim'] = $row['DienThoai'];
	    $output['MaDVm'] = $row['MaDV'];
	}
	echo json_encode($output);
?>