<?php 
	include('../dbconnect.php');
	//Thêm dữ liệu
	if (isset($_POST['MaNV'])) {
		$MaNV = $_POST['MaNV'];
		$HoNV = $_POST['HoNV'];
		$TenNV =$_POST['TenNV'];
		$GioiTinh = $_POST['GioiTinh'];
		$NgaySinh = $_POST['NgaySinh'];
		$DiaChi = $_POST['DiaChi'];
		$DienThoai = $_POST['DienThoai'];	
		$MaDV = $_POST['MaDV'];
		$result_INSERT = mysqli_query($con,"INSERT INTO NHANVIEN(MaNV,HoNV,TenNV,GioiTinh,NgaySinh,DiaChi,DienThoai,MaDV) VALUES ('$MaNV','$HoNV','$TenNV','$GioiTinh','$NgaySinh','$DiaChi',$DienThoai,'$MaDV')");
		if ($result_INSERT) {
			echo 1;
		}else {
			echo 0;
		}
	}
	
	//Xóa
	if (isset($_POST['idxoa'])) {
		$idxoa = $_POST['idxoa'];
		$resultS = mysqli_query($con,"DELETE FROM NHANVIEN WHERE MaNV='$idxoa'");
	}

	//Load dữ liệu
	$output = '';
	$i=1;
	$sql = mysqli_query($con,"SELECT A.*,TenDV FROM NHANVIEN A INNER JOIN DONVI B ON A.MaDV=B.MaDV");
	$output.='
		<table class="table table-hover" id="tbl_loadNV" style="font-size:13px;text-align: center;">
			<thead class="table-dark">
				<tr>
					<th>STT</th>
					<th>Mã số nhân viên</th>
					<th>Họ nhân viên</th>
					<th>Tên nhân viên</th>
					<th>Giới tính</th>
					<th>Ngày sinh</th>
					<th>Địa chỉ</th>
					<th>Điện thoại</th>
					<th>Đơn vị</th>
					<th class="btn">Thao tác</th>
				</tr>
			</thead>
	';
	if (mysqli_num_rows($sql)>0) {
		while ($row = mysqli_fetch_array($sql)) {
			$output.='
					<tr>
						<td>'.$i++.'</td>
						<td>'.$row['MaNV'].'</td>
						<td class="Ho" data-id1='.$row['MaNV'].'>'.$row['HoNV'].'</td>
						<td class="TenNV" data-id2='.$row['MaNV'].'>'.$row['TenNV'].'</td>
						<td class="GT" data-id3='.$row['MaNV'].'>'.$row['GioiTinh'].'</td>
						<td class="NS" data-id4='.$row['MaNV'].'>'.$row['NgaySinh'].'</td>
						<td class="DC" data-id5='.$row['MaNV'].'>'.$row['DiaChi'].'</td>
						<td class="DT" data-id6='.$row['MaNV'].'>'.$row['DienThoai'].'</td>
						<td class="MDV" data-id7='.$row['MaNV'].'>'.$row['TenDV'].'</td>
						<td class="btn"><button data-id9='.$row['MaNV'].' class="btn btn-sm btn-warning edit_data" name="edit_data" >Sửa</button>	<button data-id8='.$row['MaNV'].' class="btn btn-sm btn-danger del_data" name="delete_data" >Xóa</button></td>
					</tr>
			';		    
		}

	}else {
		$output.='
			<tbody>
				<tr>
					<td colspan="10"><center>Dữ liệu chưa có</center></td>
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