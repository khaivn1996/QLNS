<?php 
//Load sinh nhật
		include('../dbconnect.php');
		$TNgay = $_POST['TNgay'];
		$DNgay = $_POST['DNgay'];
		
		$outputSN = '';
		$j=1;
		$tempsql = "SELECT A.*,TenDV FROM NHANVIEN A INNER JOIN DONVI B ON A.MaDV=B.MaDV WHERE MONTH(NgaySinh)=$TNgay OR MONTH(NgaySinh)=$DNgay";
		$sqlSN = mysqli_query($con,$tempsql);
		$outputSN.='
			<table class="table table-hover" id="tbl_loadSN" style="font-size:13px;text-align: center;">
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
					</tr>
				</thead>
		';
		if (mysqli_num_rows($sqlSN)>0) {
			while ($rowSN = mysqli_fetch_array($sqlSN)) {
				$outputSN.='
						<tr>
							<td>'.$j++.'</td>
							<td>'.$rowSN['MaNV'].'</td>
							<td class="Ho" data-id1='.$rowSN['MaNV'].'>'.$rowSN['HoNV'].'</td>
							<td class="TenNV" data-id2='.$rowSN['MaNV'].'>'.$rowSN['TenNV'].'</td>
							<td class="GT" data-id3='.$rowSN['MaNV'].'>'.$rowSN['GioiTinh'].'</td>
							<td class="NS" data-id4='.$rowSN['MaNV'].'>'.$rowSN['NgaySinh'].'</td>
							<td class="DC" data-id5='.$rowSN['MaNV'].'>'.$rowSN['DiaChi'].'</td>
							<td class="DT" data-id6='.$rowSN['MaNV'].'>'.$rowSN['DienThoai'].'</td>
							<td class="MDV" data-id7='.$rowSN['MaNV'].'>'.$rowSN['TenDV'].'</td>
						</tr>
				';		    
			}

		}else {
			$outputSN.='
				<tbody>
					<tr>
						<td colspan="9"><center>Dữ liệu chưa có</center></td>
					</tr>
				</tbody>
			';
		}
		$outputSN.='		
				<tbody>
				</tbody>
			</table>
		';
		echo $outputSN;
?>