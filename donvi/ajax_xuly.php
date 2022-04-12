<?php 
	include('../dbconnect.php');
	//Thêm dữ liệu
	if (isset($_POST['MaDV'])) {
		$MaDV = $_POST['MaDV'];
		$TenDV = $_POST['TenDV'];
		$SoDT = $_POST['SoDT'];
		$result_INSERT = mysqli_query($con,"INSERT INTO DONVI(MaDV,TenDV,SoDT) VALUES ('$MaDV','$TenDV','$SoDT')");
		if ($result_INSERT) {
			echo 1;
		}else {
			echo 0;
		}
	}
	
	//Xóa
	if (isset($_POST['idxoa'])) {
		$idxoa = $_POST['idxoa'];
		$resultS = mysqli_query($con,"DELETE FROM DONVI WHERE MaDV='$idxoa'");
	}

	//Load dữ liệu
	$output = '';
	$i=1;
	$sql = mysqli_query($con,"SELECT * FROM DONVI");
	$output.='
		<table class="table table-hover" id="tbl_loadDV" style="font-size:13px;text-align: center;">
			<thead class="table-dark">
				<tr>
					<th>STT</th>
					<th>Mã Đơn Vị</th>
					<th>Tên Đơn Vị</th>
					<th>Số Điện Thoại</th>
					<th>Thao tác</th>
				</tr>
			</thead><tbody>
	';
	if (mysqli_num_rows($sql)>0) {
		while ($row = mysqli_fetch_array($sql)) {
			$output.='
					<tr>
						<td>'.$i++.'</td>
						<td >'.$row['MaDV'].'</td>
						<td class="TenDV" data-id1='.$row['MaDV'].' contenteditable>'.$row['TenDV'].'</td>
						<td class="SoDT" data-id2='.$row['MaDV'].' contenteditable>'.$row['SoDT'].'</td>
						<td><button data-id3='.$row['MaDV'].' class="btn btn-sm btn-warning edit_data" name="edit_data" >Sửa</button>	<button data-id4='.$row['MaDV'].' class="btn btn-sm btn-danger del_data" name="delete_data" >Xóa</button></td>
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
	$output.='</tbody>		
			<tfoot>
				<tr>
					<th></th>
					<th><p>Mã Đơn Vị</p></th>
					<th><p>Tên Đơn Vị</p></th>
					<th><p>Số Điện Thoại</p></th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	';
	echo $output;
?>