<?php
	include('../dbconnect.php');
	//Thêm dữ liệu
	if (isset($_POST['NgayThem'])) {
		$NgayThem = $_POST['NgayThem'];
		$string_themngay= "INSERT INTO CHAMCONG(MaNV,NGAY,Vao,Ra) SELECT MaNV,'$NgayThem','08:00:00','17:00:00' AS NGAY FROM nhanvien WHERE ThoiViec=0";
		$result_INSERT = mysqli_query($con,$string_themngay);
		if (!$result_INSERT) {
			echo 0;
		}else {
			echo 1;
		}	
	}
	if (isset($_POST['Ngay_'])) {
		$Ngay_ = $_POST['Ngay_'];
		$rcc = mysqli_query($con,"CALL ChamCongAll('$Ngay_')");
		if (!$rcc) {
			echo 0;
		}else {
			echo 1;
		}
	}
?>