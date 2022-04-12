<?php 
	include('../dbconnect.php');
	//Thêm dữ liệu
	if (isset($_POST['MaKTKL'])) {
		$MaKTKL = $_POST['MaKTKL'];
		$TenKTKL = $_POST['TenKTKL'];
		$KTKL = $_POST['KTKL'];
		$result_INSERT = mysqli_query($con,"INSERT INTO DMKTKL(MaKTKL,TenKTKL,KTKL) VALUES ('$MaKTKL','$TenKTKL',$KTKL)");
		if ($result_INSERT) {
			echo 1;
		}else {
			echo 0;
		}
	}
	
	//Xóa
	if (isset($_POST['idxoa'])) {
		$idxoa = $_POST['idxoa'];
		$resultS = mysqli_query($con,"DELETE FROM DMKTKL WHERE MaKTKL='$idxoa'");
	}

	//Load dữ liệu
	$output = '';
	$i=1;
	$sql = mysqli_query($con,"SELECT * FROM DMKTKL");
	$output.='
		<table class="table table-hover" id="tbl_loadDM" style="font-size:13px;text-align: center;">
			<thead class="table-dark">
				<tr>
					<th>STT</th>
					<th>Mã Danh Mục</th>
					<th>Tên Danh Mục</th>
					<th>Khen Thưởng - Kỷ Luật</th>
					<th>Thao tác</th>
				</tr>
			</thead>
	';

	if (mysqli_num_rows($sql)>0) {
		while ($row = mysqli_fetch_array($sql)) {
			$output.='
					<tr>
						<td>'.$i++.'</td>
						<td >'.$row['MaKTKL'].'</td>
						<td class="TenKTKL" data-id1='.$row['MaKTKL'].'>'.$row['TenKTKL'].'</td>
						<td class="KTKL" data-id2='.$row['MaKTKL'].'>
							<input type="checkbox" '.($row['KTKL']==1 ? 'checked' : '').'>
						</td>
						<td><button data-id3='.$row['MaKTKL'].' class="btn btn-sm btn-warning edit_data" name="edit_data" >Sửa</button>	<button data-id4='.$row['MaKTKL'].' class="btn btn-sm btn-danger del_data" name="delete_data" >Xóa</button></td>
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