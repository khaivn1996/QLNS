<?php 
	include('../dbconnect.php');
	//Thêm dữ liệu
	if (isset($_POST['SoHieu'])) {
		$SoHieu = $_POST['SoHieu'];
		$MaNV = $_POST['MaNV'];
		$MaKTKL = $_POST['MaKTKL'];
		$MaCapKTKL =$_POST['MaCapKTKL'];
		$NgayQD = $_POST['NgayQD'];
		$NoiDung = $_POST['NoiDung'];

		$result_INSERT = mysqli_query($con,"INSERT INTO KTKL VALUES ('$SoHieu','$MaNV','$MaKTKL','$MaCapKTKL','$NgayQD','$NoiDung')");
		if ($result_INSERT) {
			echo 1;
		}else {
			echo 0;
		}
	}
	
	//Xóa
	if (isset($_POST['idxoa'])) {
		$idxoa = $_POST['idxoa'];
		$stringHT = "DELETE FROM KTKL WHERE SoHieu='$idxoa'";
		$resultS = mysqli_query($con,$stringHT);
	}

	//Load dữ liệu
	$output = '';
	$i=1;
	$sql = mysqli_query($con,"SELECT A.*,TenKTKL,TenCapKTKL FROM KTKL A INNER JOIN DMKTKL B ON A.MaKTKL=B.MaKTKL INNER JOIN CAPKTKL C ON A.MaCapKTKL=C.MaCapKTKL");
	$output.='
		<table class="table table-hover" id="tbl_loadKTKL" style="font-size:13px;text-align: center;">
			<thead class="table-dark">
				<tr>
					<th>STT</th>
					<th>Số Hiệu</th>
					<th>Mã số nhân viên</th>
					<th>Danh Mục KTKL</th>
					<th>Cấp KTKL</th>
					<th>Ngày Quyết Định</th>
					<th>Nội Dung</th>
					<th>Thao tác</th>
				</tr>
			</thead>
	';
	if (mysqli_num_rows($sql)>0) {
		while ($row = mysqli_fetch_array($sql)) {
			$output.='
					<tr>
						<td>'.$i++.'</td>
						<td >'.$row['SoHieu'].'</td>
						<td class="mnv" data-id1='.$row['SoHieu'].'>'.$row['MaNV'].'</td>
						<td class="tendm" data-id2='.$row['SoHieu'].'>'.$row['TenKTKL'].'</td>
						<td class="tencap" data-id3='.$row['SoHieu'].'>'.$row['TenCapKTKL'].'</td>
						<td class="nqd" data-id4='.$row['SoHieu'].'>'.$row['NgayQD'].'</td>
						<td class="nd" data-id5='.$row['SoHieu'].'>'.$row['NoiDung'].'</td>
						<td><button data-id6='.$row['SoHieu'].' class="btn btn-sm btn-warning edit_data" name="edit_data" >Sửa</button>	<button data-id7='.$row['SoHieu'].' class="btn btn-sm btn-danger del_data" name="delete_data" >Xóa</button></td>
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