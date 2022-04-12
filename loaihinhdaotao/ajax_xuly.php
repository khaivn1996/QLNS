<?php 
	include('../dbconnect.php');
	//Thêm dữ liệu
	if (isset($_POST['MaLHDT'])) {
		$MaLHDT = $_POST['MaLHDT'];
		$TenLHDT = $_POST['TenLHDT'];
		$result_INSERT = mysqli_query($con,"INSERT INTO LOAIHINHHDT(MaLHDT,TenLHDT) VALUES ('$MaLHDT','$TenLHDT')");
		if ($result_INSERT) {
			echo 1;
		}else {
			echo 0;
		}
	}
	
	//Xóa
	if (isset($_POST['idxoa'])) {
		$idxoa = $_POST['idxoa'];
		$resultS = mysqli_query($con,"DELETE FROM LOAIHINHHDT WHERE MaLHDT='$idxoa'");
	}

	//Load dữ liệu
	$output = '';
	$i=1;
	$sql = mysqli_query($con,"SELECT * FROM LOAIHINHHDT");
	$output.='
		<table class="table table-hover" id="tbl_loadLHDT" style="font-size:13px;text-align: center;">
			<thead class="table-dark">
				<tr>
					<th>STT</th>
					<th>Mã Loại Hình Đào Tạo</th>
					<th>Tên Loại Hình Đào Tạo</th>
					<th>Thao tác</th>
				</tr>
			</thead>
	';
	if (mysqli_num_rows($sql)>0) {
		while ($row = mysqli_fetch_array($sql)) {
			$output.='
					<tr>
						<td>'.$i++.'</td>
						<td >'.$row['MaLHDT'].'</td>
						<td class="TenLHDT" data-id1='.$row['MaLHDT'].' contenteditable>'.$row['TenLHDT'].'</td>
						<td><button data-id2='.$row['MaLHDT'].' class="btn btn-sm btn-warning edit_data" name="edit_data" >Sửa</button>	<button data-id3='.$row['MaLHDT'].' class="btn btn-sm btn-danger del_data" name="delete_data" >Xóa</button></td>
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