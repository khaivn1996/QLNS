<?php 
	include('../dbconnect.php');
	//Thêm dữ liệu
	if (isset($_POST['MaCV'])) {
		$MaCV = $_POST['MaCV'];
		$TenCV = $_POST['TenCV'];
		$Tien1Gio = $_POST['Tien1Gio'];
		$result_INSERT = mysqli_query($con,"INSERT INTO CHUCVU(MaCV,TenCV,Tien1Gio) VALUES ('$MaCV','$TenCV',$Tien1Gio)");
		if ($result_INSERT) {
			echo 1;
		}else {
			echo 0;
		}
	}
	
	//Xóa
	if (isset($_POST['idxoa'])) {
		$idxoa = $_POST['idxoa'];
		$resultS = mysqli_query($con,"DELETE FROM CHUCVU WHERE MaCV='$idxoa'");
	}

	//Load dữ liệu
	$output = '';
	$i=1;
	$sql = mysqli_query($con,"SELECT * FROM CHUCVU");
	$output.='
		<table class="table table-hover" id="tbl_loadCV" style="font-size:13px;text-align: center;">
			<thead class="table-dark">
				<tr>
					<th>STT</th>
					<th>Mã Chức Vụ</th>
					<th>Tên Chức Vụ</th>
					<th>Tiền 1 Giờ Làm Việc</th>
					<th>Thao tác</th>
				</tr>
			</thead>
	';
	if (mysqli_num_rows($sql)>0) {
		while ($row = mysqli_fetch_array($sql)) {
			$output.='
					<tr>
						<td>'.$i++.'</td>
						<td >'.$row['MaCV'].'</td>
						<td class="TenCV" data-id1='.$row['MaCV'].'>'.$row['TenCV'].'</td>
						<td class="Tien1Gio" data-id4='.$row['MaCV'].'>'.$row['Tien1Gio'].'</td>
						<td><button data-id2='.$row['MaCV'].' class="btn btn-sm btn-warning edit_data" name="edit_data" >Sửa</button>	<button data-id3='.$row['MaCV'].' class="btn btn-sm btn-danger del_data" name="delete_data" >Xóa</button></td>
					</tr>
			';		    
		}

	}else {
		$output.='
			<tbody>
				<tr>
					<td colspan="5"><center>Dữ liệu chưa có</center></td>
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