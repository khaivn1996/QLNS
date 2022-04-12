<?php 
	include('../dbconnect.php');
	//Thêm dữ liệu
	if (isset($_POST['MaCapKTKL'])) {
		$MaCapKTKL = $_POST['MaCapKTKL'];
		$TenCapKTKL = $_POST['TenCapKTKL'];
		$result_INSERT = mysqli_query($con,"INSERT INTO CAPKTKL(MaCapKTKL,TenCapKTKL) VALUES ('$MaCapKTKL','$TenCapKTKL')");
		if ($result_INSERT) {
			echo 1;
		}else {
			echo 0;
		}
	}
	
	//Xóa
	if (isset($_POST['idxoa'])) {
		$idxoa = $_POST['idxoa'];
		$resultS = mysqli_query($con,"DELETE FROM CAPKTKL WHERE MaCapKTKL='$idxoa'");
	}

	//Load dữ liệu
	$output = '';
	$i=1;
	$sql = mysqli_query($con,"SELECT * FROM CAPKTKL");
	$output.='
		<table class="table table-hover" id="tbl_loadCapKTKL" style="font-size:13px;text-align: center;">
			<thead class="table-dark">
				<tr>
					<th>STT</th>
					<th>Mã Cấp Khen Thưởng - Kỹ Luật</th>
					<th>Tên Cấp Khen Thưởng - Kỹ Luật</th>
					<th>Thao tác</th>
				</tr>
			</thead>
	';
	if (mysqli_num_rows($sql)>0) {
		while ($row = mysqli_fetch_array($sql)) {
			$output.='
					<tr>
						<td>'.$i++.'</td>
						<td >'.$row['MaCapKTKL'].'</td>
						<td class="TenCapKTKL" data-id1='.$row['MaCapKTKL'].' contenteditable>'.$row['TenCapKTKL'].'</td>
						<td><button data-id2='.$row['MaCapKTKL'].' class="btn btn-sm btn-warning edit_data" name="edit_data" >Sửa</button>	<button data-id3='.$row['MaCapKTKL'].' class="btn btn-sm btn-danger del_data" name="delete_data" >Xóa</button></td>
					</tr>
			';		    
		}

	}else {
		$output.='
			<tbody>
				<tr>
					<td colspan="4"><center>Dữ liệu chưa có</center></td>
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