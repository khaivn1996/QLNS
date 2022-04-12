<?php 
	include('../dbconnect.php');
	require "../Classes/PHPExcel.php";
?>
<?php 
	$qe = "SELECT MaDV,TenDV,SoDT FROM DONVI ORDER BY MaDV";
	$qex = mysqli_query($con,$qe);
	//Khởi tạo đối tượng
	$excel = new PHPExcel();
	//Chọn trang cần ghi (là số từ 0->n)
	$excel->setActiveSheetIndex(0);
	//Tạo tiêu đề cho trang. (có thể không cần)
	$excel->getActiveSheet()->setTitle('DANH SÁCH MÃ BẰNG CẤP');

	//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
	$excel->getActiveSheet()->getColumnDimension('A')->setWidth(80);
	$excel->getActiveSheet()->getColumnDimension('B')->setWidth(80);
	$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);

	//Xét in đậm cho khoảng cột
	$excel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
	//Tạo tiêu đề cho từng cột
	$excel->getActiveSheet()->setCellValue('A1', 'Mã Bằng Cấp');
	$excel->getActiveSheet()->setCellValue('B1', 'Tên Bằng Cấp');
	$excel->getActiveSheet()->setCellValue('C1', 'Số Điện Thoại');
	// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
	// dòng bắt đầu = 2
	$i = 2;
	while($rowe = mysqli_fetch_array($qex)){
		$excel->getActiveSheet()->setCellValue('A' . $i, $rowe[0]);
	    $excel->getActiveSheet()->setCellValue('B' . $i, $rowe[1]);
	    $excel->getActiveSheet()->setCellValue('C' . $i, $rowe[2]);
	    $i++;
	}
	header('Content-type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="data.xls"');
	if (PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output')) {
		echo 1;
	}else {
		echo 0;
	}
?>