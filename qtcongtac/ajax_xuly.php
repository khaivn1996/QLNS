<?php 
	include('../dbconnect.php');
	//Thêm dữ liệu
	if (isset($_POST['MaNV'])) {
		$MaNV = $_POST['MaNV'];
		$TuNgay = $_POST['TuNgay'];
		$DenNgay =$_POST['DenNgay'];
		$MaDV = $_POST['MaDV'];
		$CongViec = $_POST['CongViec'];
		$NoiLamViec = $_POST['NoiLamViec'];	

		$result_INSERT = mysqli_query($con,"INSERT INTO QTCONGTAC VALUES ('$MaNV','$TuNgay','$DenNgay','$CongViec','$NoiLamViec','$MaDV')");
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
		$stringHT = "DELETE FROM QTCONGTAC WHERE MaNV='$idxoa' AND TuNgay='$TuNgay' AND DenNgay='$DenNgay'";
		$resultS = mysqli_query($con,$stringHT);
		echo $stringHT;
	}

	//Load dữ liệu
	$output = '';
	$i=1;
	$sql = mysqli_query($con," SELECT A.*,TenDV FROM QTCONGTAC A INNER JOIN DONVI B ON A.MaDV=B.MaDV ");
	$output.='
		<table class="table table-hover" id="tbl_loadCT" style="font-size:13px;text-align: center;">
			<thead class="table-dark">
				<tr>
					<th>STT</th>
					<th>Mã số nhân viên</th>
					<th>Từ Ngày</th>
					<th>Đến Ngày</th>
					<th>Công Việc</th>
					<th>Nơi Làm Việc</th>
					<th>Đơn Vị</th>
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
						<td class="CV" data-id3='.$row['MaNV'].'>'.$row['CongViec'].'</td>
						<td class="NLV" data-id4='.$row['MaNV'].'>'.$row['NoiLamViec'].'</td>
						<td class="MDV" data-id5='.$row['MaDV'].'>'.$row['TenDV'].'</td>
						<td><button data-id6='.$row['MaNV'].' class="btn btn-sm btn-warning edit_data" name="edit_data" >Sửa</button>	<button data-id7='.$row['MaNV'].' data-id8='.$row['TuNgay'].' data-id9='.$row['DenNgay'].' class="btn btn-sm btn-danger del_data" name="delete_data" >Xóa</button></td>
					</tr>
			';		    
		}

	}else {
		$output.='
			<tbody>
				<tr>
					<td colspan="8"><center>Dữ liệu chưa có</center></td>
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