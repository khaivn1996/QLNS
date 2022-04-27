<?php 
	include('../dbconnect.php');

	//Xóa
	if (isset($_POST['NgayXoa'])) {
		$NgayXoa = $_POST['NgayXoa'];
		$resultS = mysqli_query($con,"DELETE FROM CHAMCONG WHERE NGAY='$NgayXoa'");
	}

	//EditCC
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$text = $_POST['text'];
		$NgayE = $_POST['NgayE'];
		$col = $_POST['col'];
		$sql_editcc ="UPDATE CHAMCONG SET $col='$text' WHERE MaNV='$id' and Ngay='$NgayE' ";
		$result_editcc = mysqli_query($con,$sql_editcc);
	}

	//Load dữ liệu
	$output = '';
	$NgayQT=$_POST['NgayQT'];
	$i=1;
	$sql = mysqli_query($con,"SELECT A.MaNV,CONCAT(A.HoNV,' ',A.TenNV) AS HOTEN,Ngay,Vao,Ra,GioCong,HeSo
FROM nhanvien A LEFT JOIN chamcong	B ON A.MaNV=B.MaNV
WHERE B.Ngay='$NgayQT'");
	$output.='
		<table class="table table-hover" id="tbl_loadCC" style="font-size:13px;text-align: center;">
			<thead class="table-dark">
				<tr>
					<th>STT</th>
					<th>Mã Nhân Viên</th>
					<th>Họ Tên</th>
					<th>Ngày Công</th>
					<th>Giờ Vào</th>
					<th>Giờ Ra</th>
					<th>Giờ Công</th>
					<th>Hệ Số Ngày Công</th>
				</tr>
			</thead><tbody>
	';
	if (mysqli_num_rows($sql)>0) {
		while ($row = mysqli_fetch_array($sql)) {
			$output.='
					<tr>
						<td>'.$i++.'</td>
						<td class="MaNV">'.$row[0].'</td>
						<td >'.$row[1].'</td>
						<td class="NgayQT">'.$row[2].'</td>
						<td class="Vao" data-id1='.$row[0].' data-id11='.$row[2].' contenteditable>'.$row[3].'</td>
						<td class="Ra" data-id2='.$row[0].'  data-id22='.$row[2].' contenteditable>'.$row[4].'</td>
						<td class="GioCong" data-id3='.$row[0].'  data-id33='.$row[2].'>'.$row[5].'</td>
						<td class="HeSo" data-id4='.$row[0].'  data-id44='.$row[2].' >'.$row[6].'</td>
					</tr>
			';		    
		}

	}
	$output.='</tbody>		
			<tfoot>
				<tr>
					<th></th>
					<th><p>Mã Nhân Viên</p></th>
					<th><p>Họ Tên</p></th>
					<th><p>Ngày Công</p></th>
					<th><p>Giờ Vào</p></th>
					<th><p>Giờ Ra</p></th>
					<th><p>Giờ Công</p></th>
					<th><p>Hệ Số Ngày Công</p></th>
				</tr>
			</tfoot>
		</table>
	';
	echo $output;
?>