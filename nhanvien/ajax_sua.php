<?php
	include('../dbconnect.php');
?>
<?php
	if ($_POST['ThoiViecs']=='true') {
		$chks=1;
	}else{
		$chks=0;
	}
	$slll = "UPDATE NHANVIEN SET HoNV='".$_POST['HoNVs']."',TenNV='".$_POST['TenNVs']."',GioiTinh='".$_POST['GioiTinhs']."',NgaySinh='".$_POST['NgaySinhs']."',DiaChi='".$_POST['DiaChis']."',DienThoai='".$_POST['DienThoais']."',ThoiViec=".$chks.",MaDV='".$_POST['MaDVs']."' WHERE MaNV='".$_POST['MaNVs']."'";
	$result = mysqli_query($con,$slll);
	echo $slll;
?>