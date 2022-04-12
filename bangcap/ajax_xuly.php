<?php 
	include('../dbconnect.php');
	//Thêm dữ liệu
	if (isset($_POST['MaBC'])) {
		$MaBC = $_POST['MaBC'];
		$TenBC = $_POST['TenBC'];
		$result_INSERT = mysqli_query($con,"INSERT INTO MABANGCAP(MaBC,TenBC) VALUES ('$MaBC','$TenBC')");
		if ($result_INSERT) {
			echo 1;
		}else {
			echo 0;
		}
	}
	
	//Xóa
	if (isset($_POST['idxoa'])) {
		$idxoa = $_POST['idxoa'];
		$resultS = mysqli_query($con,"DELETE FROM MABANGCAP WHERE MaBC='$idxoa'");
	}

	//Load dữ liệu
	$output = '';
	$i=1;
	$sql = mysqli_query($con,"SELECT * FROM MABANGCAP");
	$output.='
		<table class="table table-hover" id="tbl_loadBC" style="font-size:13px;text-align: center;">
			<thead class="table-dark">
				<tr>
					<th>STT</th>
					<th>Mã Bằng Cấp</th>
					<th>Tên Bằng Cấp</th>
					<th class="noExl">Thao tác</th>
				</tr>
			</thead>
	';
	if (mysqli_num_rows($sql)>0) {
		while ($row = mysqli_fetch_array($sql)) {
			$output.='
					<tr>
						<td>'.$i++.'</td>
						<td >'.$row['MaBC'].'</td>
						<td class="TenBC" data-id1='.$row['MaBC'].' contenteditable>'.$row['TenBC'].'</td>
						<td class="noExl"><button data-id2='.$row['MaBC'].' class="btn btn-sm btn-warning edit_data" name="edit_data" >Sửa</button>	<button data-id3='.$row['MaBC'].' class="btn btn-sm btn-danger del_data" name="delete_data" >Xóa</button></td>
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