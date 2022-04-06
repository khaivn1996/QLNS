<?php 
	include('../dbconnect.php');
	//Thêm dữ liệu
	if (isset($_POST['MaNV'])) {
		$MaNV = $_POST['MaNV'];
		$TuNgay = $_POST['TuNgay'];
		$DenNgay =$_POST['DenNgay'];
		$MaBC = $_POST['MaBC'];
		$MaLHDT = $_POST['MaLHDT'];
		$ChuyenNganh = $_POST['ChuyenNganh'];
		$CoSoDT = $_POST['CoSoDT'];	
		$NamTN = $_POST['NamTN'];
		$result_INSERT = mysqli_query($con,"INSERT INTO QTHOCTAP VALUES ('$MaNV','$TuNgay','$DenNgay','$MaBC','$MaLHDT','$ChuyenNganh','$CoSoDT',$NamTN)");
		if ($result_INSERT) {
			echo 1;
		}else {
			echo 0;
		}
	}
	
	//Xóa
	if (isset($_POST['idxoa'])) {
		$idxoa = $_POST['idxoa'];
		$TuNgay = $_POST['TuNgay'];
		$DenNgay = $_POST['DenNgay'];
		$stringHT = "DELETE FROM QTHOCTAP WHERE MaNV='$idxoa' AND TuNgay='$TuNgay' AND DenNgay='$DenNgay'";
		$resultS = mysqli_query($con,$stringHT);
		echo $stringHT;
	}

	//Load dữ liệu
	$output = '';
	$i=1;
	$sql = mysqli_query($con,"SELECT A.*,TenBC,TenLHDT FROM QTHOCTAP A INNER JOIN mabangcap B ON A.MaBC=B.MaBC INNER JOIN loaihinhhdt C ON A.MaLHDT=C.MaLHDT");
	$output.='
		<table class="table table-hover" id="tbl_loadHT" style="font-size:13px;text-align: center;">
			<thead class="table-dark">
				<tr>
					<th>STT</th>
					<th>Mã số nhân viên</th>
					<th>Từ Ngày</th>
					<th>Đến Ngày</th>
					<th>Bằng Cấp</th>
					<th>Loại Hình Đào Tạo</th>
					<th>Chuyên Ngành</th>
					<th>Cơ Sở Đào Tào</th>
					<th>Năm Tốt Nghiệp</th>
					<th>Thao tác</th>
				</tr>
			</thead>
	';
	if (mysqli_num_rows($sql)>0) {
		while ($row = mysqli_fetch_array($sql)) {
			$output.='
					<tr>
						<td>'.$i++.'</td>
						<td >'.$row['MaNV'].'</td>
						<td class="TNgay" data-id1='.$row['MaNV'].'>'.$row['TuNgay'].'</td>
						<td class="DNgay" data-id2='.$row['MaNV'].'>'.$row['DenNgay'].'</td>
						<td class="MBC" data-id3='.$row['MaNV'].'>'.$row['TenBC'].'</td>
						<td class="LHDT" data-id4='.$row['MaNV'].'>'.$row['TenLHDT'].'</td>
						<td class="CN" data-id5='.$row['MaNV'].'>'.$row['ChuyenNganh'].'</td>
						<td class="CS" data-id6='.$row['MaNV'].'>'.$row['CoSoDT'].'</td>
						<td class="NTN" data-id7='.$row['NamTN'].'>'.$row['NamTN'].'</td>
						<td><button data-id9='.$row['MaNV'].' class="btn btn-sm btn-warning edit_data" name="edit_data" >Sửa</button>	<button data-id8='.$row['MaNV'].' data-id10='.$row['TuNgay'].' data-id11='.$row['DenNgay'].' class="btn btn-sm btn-danger del_data" name="delete_data" >Xóa</button></td>
					</tr>
			';		    
		}

	}else {
		$output.='
			<tbody>
				<tr>
					<td colspan="6"><center>Dữ liệu chưa có</center></td>
				</tr>
			</tbody>
		';
	}
	$output.='		
			<tbody>
			</tbody>
		</table>
	';
	echo $output;
?>