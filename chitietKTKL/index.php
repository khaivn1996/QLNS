<?php
    session_start();
?>
<?php include('../dbconnect.php'); ?>
<?php include('../admin/permission.php'); ?>
<?php 
$Sothe = $_SESSION['UserN'];
//Load mã nhân viên
$laysotheNV = "SELECT A.*,B.avatarUser FROM NHANVIEN A INNER JOIN users B ON A.MaNV=B.MaNV WHERE A.MaNV='$Sothe'";
$truyvansotheNV = mysqli_query($con,$laysotheNV);
?>
<?php 
//Load mã nhân viên
$truyvanMaNV = "SELECT MaNV FROM NHANVIEN ORDER BY MaNV";
$querysql = mysqli_query($con,$truyvanMaNV);

//Load mã đơn vị
$truyvanMaDMKTKL = "SELECT MaKTKL,TenKTKL FROM DMKTKL ORDER BY MaKTKL";
$query_DMKTKL = mysqli_query($con,$truyvanMaDMKTKL);

//Load mã đơn vị
$truyvanMaCapKTKL = "SELECT MaCapKTKL,TenCapKTKL FROM CAPKTKL ORDER BY MaCapKTKL";
$query_MaCapKTKL = mysqli_query($con,$truyvanMaCapKTKL);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo $HomeURL; ?>/"/>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CHI TIẾT KHEN THƯỞNG - KỸ LUẬT</title>
	<link rel="icon" href="res/image/fav.ico" type="image/ico">
	<script src="res/BS5/jquery/jquery.min.js"></script>
	<link href="res/BS5/css/bootstrap.min.css" rel="stylesheet">
  <script src="res/BS5/js/bootstrap.bundle.min.js"></script>
  <script src="res/BS5/jquery/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="res/BS5/css/jquery.dataTables.css"> 
	<script type="text/javascript" charset="utf8" src="res/BS5/js/jquery.dataTables.js"></script>
 	<!-- Bootstrap core CSS -->
 	<link href="res/BS5/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="res/BS5/dashboard/dashboard.css" rel="stylesheet">
  <link href="res/font/quicksand.css" rel="stylesheet">
  <link href="res/BS5/dashboard/container.css" rel="stylesheet">
  <style>
#navbarDropdown{
  position: relative;
  right: 60px;
}
</style>
</head>
<body>
	<?php 
		include('../header.php'); 
	?>
	<div class="col-md-9 ms-sm-auto col-lg-10"> 
		<!-- Webview -->
			<div class="card"> 
				<div class="card-header">
					<center><h3 data-bs-toggle="collapse" data-bs-target="#NhaplieuCollapse"><b>THÊM DỮ LIỆU</b></h3></center>
				</div>
				<div class="card-body collapse" id="NhaplieuCollapse">
						<form id="frmThemKTKL" method="POST" class="was-validated row g-3">
							<div class="col-md-6">
								<label>Số Hiệu</label>
								<input type="text" class="form-control" name="SoHieu" id="SoHieu" required>
								<div class="valid-feedback">Valid.</div>
		      			<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-md-6">
								<label>Mã Nhân Viên</label>
								<select class="form-control" name="MaNV" id="MaNV">
									<?php  
										if (mysqli_num_rows($querysql)>0) {
											while($rowL = mysqli_fetch_array($querysql)){
												echo '<option value="'.$rowL['MaNV'].'">'.$rowL['MaNV'].'</option>';
											}
										}
									?>
								</select>
	      			</div>
	      			<div class="col-md-4">
								<label for="browser">Danh Mục KTKL</label>
								<select class="form-control" name="MaKTKL" id="MaKTKL">
								<?php  
									if (mysqli_num_rows($query_DMKTKL)>0) {
										while($rowDMKTKL = mysqli_fetch_array($query_DMKTKL)){
											echo '<option value="'.$rowDMKTKL[0].'">'.$rowDMKTKL[1].'</option>';
										}
									}
								?>
								</select>
							</div>
							<div class="col-md-4">
								<label for="browser">Cấp KTKL</label>
								<select class="form-control" name="MaCapKTKL" id="MaCapKTKL">
								<?php  
									if (mysqli_num_rows($query_MaCapKTKL)>0) {
										while($rowCapKTKL = mysqli_fetch_array($query_MaCapKTKL)){
											echo '<option value="'.$rowCapKTKL[0].'">'.$rowCapKTKL[1].'</option>';
										}
									}
								?>
								</select>
							</div>
							<div class="col-md-4">
								<label>Ngày Quyết Định</label>
								<input type="date" class="form-control" name="NgayQD" id="NgayQD">
							</div>
							<div class="col-md-12">
								<label>Nội Dung</label>
								<textarea class="form-control" name="NoiDung" id="NoiDung" placeholder="Vui lòng nhập nội dung..." required></textarea>
								<div class="valid-feedback">Valid.</div>
		      			<div class="invalid-feedback">Please fill out this field.</div>
							</div>				
							<div class="col-12">
								<button type="button" class="btn btn-success" name="Them" id="Them">Thêm</button>
							</div>
						</form>
				</div>
			</div>
			<!---Load dữ liệu-->
			<div class="card">
					<div class="card-header">
						<center><h3><b>THÔNG TIN CHI TIẾT KHEN THƯỞNG - KỸ LUẬT</b></h3></center>
					</div>
					<div class="card-body" id="load_KTKL">				
					</div>
			</div>
	</div>

	<?php 
		include('../footer.html'); 
	?>

	<!-- Load bằng cấp và loại hình đào tạo cho modal -->
	<?php 

		$truyvanMaNVm = "SELECT MaNV FROM NHANVIEN ORDER BY MaNV";
		$query_MaNVm = mysqli_query($con,$truyvanMaNVm);

		$truyvanMaDMKTKLm = "SELECT MaKTKL,TenKTKL FROM DMKTKL ORDER BY MaKTKL";
		$query_DMKTKLm = mysqli_query($con,$truyvanMaDMKTKLm);

		$truyvanMaCapKTKLm = "SELECT MaCapKTKL,TenCapKTKL FROM CAPKTKL ORDER BY MaCapKTKL";
		$query_MaCapKTKLm = mysqli_query($con,$truyvanMaCapKTKLm);
	?>
	<!-- The Modal edit -->
	<div class="modal fade" id="edit_Modal">
	  <div class="modal-dialog">
	  	<form method="POST" id="edit_KTKL">
	    	<div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Chỉnh sửa thông tin khen thưởng kỷ luật</h4>
		        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">

		      	<div class="form-group">
			      	<label for="browser">Mã Nhân Viên</label>
							<select class="form-control" name="MaNVm" id="MaNVm">
								<?php  
									if (mysqli_num_rows($query_MaNVm)>0) {
										while($rowMaNVM = mysqli_fetch_array($query_MaNVm)){
											echo '<option value="'.$rowMaNVM[0].'">'.$rowMaNVM[0].'</option>';
										}
									}
								?>
							</select>
		      	</div>		      	<div class="form-group">
		      		<label>Ngày Quyết Định</label>
							<input type="date" name="NgayQDm" id="NgayQDm" class="form-control" style="width: 250px;">
		      	</div>
		      	
		      	<div class="form-group">
			      	<label for="browser">Danh Mục KTKL</label>
							<select class="form-control" name="MaKTKLm" id="MaKTKLm">
								<?php  
									if (mysqli_num_rows($query_DMKTKLm)>0) {
										while($rowKTKLM = mysqli_fetch_array($query_DMKTKLm)){
											echo '<option value="'.$rowKTKLM[0].'">'.$rowKTKLM[1].'</option>';
										}
									}
								?>
							</select>
		      	</div>
		      	<div class="form-group">
			      	<label for="browser">Cấp KTKL</label>
							<select class="form-control" name="MaCapKTKLm" id="MaCapKTKLm">
								<?php  
									if (mysqli_num_rows($query_MaCapKTKLm)>0) {
										while($rowCapKTKL = mysqli_fetch_array($query_MaCapKTKLm)){
											echo '<option value="'.$rowCapKTKL[0].'">'.$rowCapKTKL[1].'</option>';
										}
									}
								?>
							</select>
		      	</div>
		      	<div class="form-group">
			      	<label>Nội Dung</label>
							<input type="text" class="form-control" name="NoiDungm" id="NoiDungm"></input>
		      	</div>
		      </div>
		      <!-- Modal footer -->
		      <div class="modal-footer">
		      	<input type="hidden" name="SoHieum" id="SoHieum" value="">
		      	<input type="submit" name="submit" id="SoHieum" value="Cập nhật" class="btn btn-info">
		        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
		      </div>
	    	</div>
	    </form>
	  </div>
	</div>

</script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			LoadData();
			//Load du lieu
			function LoadData(){
				$.ajax({
					url: "<?php echo $HomeURL; ?>/chitietKTKL/ajax_xuly.php",
					method: "POST",
					success:function(data){
						$('#load_KTKL').html(data);
						$('#tbl_loadKTKL').DataTable({
							"lengthMenu": [ 10, 15, 20, 25, 50, 75, 100, 1000 ]
						});
					}
				});
			}
			//Xóa 
			$(document).on('click','.del_data',function(){
				var idxoa = $(this).data('id7');
				swal({
				  title: "Thông báo",
				  text: "Bạn có chắc chắn muốn xóa không?",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
					  	$.ajax({
						url: "<?php echo $HomeURL; ?>/chitietKTKL/ajax_xuly.php",
						method: "POST",
						data:{idxoa:idxoa},
						success:function(data){
							swal({
                    title: "Thông báo",
                    text: "Đã xóa file hoàn tất!",
                    icon: "success",
                    dangerMode: false,
                    }).then((value) => 
                    {
                      if (value) {
                        LoadData();
                        location.reload(true);
                      }
                  });
						}
					});
				  }
				});
			});			
			//Click sửa
			$(document).on('click','.edit_data',function(){
				var SoHieu = $(this).data("id6");
				$.ajax({
					url: "<?php echo $HomeURL; ?>/chitietKTKL/edit.php",
					method: "POST",
					dataType: "json",
					data:{SoHieu:SoHieu},
					success:function(data){
						$('#edit_Modal').modal('show');
						$('#SoHieum').val(SoHieu);
						$('#MaNVm').val(data.MaNVm);
						$('#MaKTKLm').val(data.MaKTKLm);
						$('#MaCapKTKLm').val(data.MaCapKTKLm);
						$('#NgayQDm').val(data.NgayQDm);
						$('#NoiDungm').val(data.NoiDungm);
						console.log(data);
					}
				});
			});
			//Xu ly code update
			$('#edit_KTKL').on('submit',function(event){
				event.preventDefault();
				if ($('#MaNV').val()=='') {
					swal("Cảnh báo","Vui lòng điền thông tin nhập liệu","error");
				}else {
					$.ajax({
						url: "<?php echo $HomeURL; ?>/chitietKTKL/ajax_sua.php",
						method: "POST",
						data:$('#edit_KTKL').serialize(),
						success:function(data){
							console.log(data);
							$('#edit_Modal').modal('hide');
							LoadData();
							swal("Thông tin","Đã cập nhật thành công","success");
						}
					});
				}
			});
			//Thêm
			$('#Them').on('click',function(){
				var MaNV = $('#MaNV').val();
				var SoHieu = $('#SoHieu').val();
				var NgayQD = $('#NgayQD').val();
				var MaKTKL = $('#MaKTKL').val();
				var MaCapKTKL = $('#MaCapKTKL').val();
				var NoiDung = $('#NoiDung').val();

				if(MaNV =='' || SoHieu =='' || NgayQD =='' || NoiDung ==''){
					swal("Cảnh báo","Dữ liệu không được bỏ trống","warning");
				}else{
					$.ajax({
						url: "<?php echo $HomeURL; ?>/chitietKTKL/ajax_xuly.php",
						method: "POST",
						data:{MaNV:MaNV,SoHieu:SoHieu,NgayQD:NgayQD,MaKTKL:MaKTKL,MaCapKTKL:MaCapKTKL,NoiDung:NoiDung},
						success:function(data){
							if (data=1) {
                                swal({
                                  title: "Thông báo",
                                  text: "Thêm mới thành công",
                                  icon: "success",
                                  dangerMode: false,
                                })
                                .then((value) => {
                                  if (value) {
                                    $('#frmThemKTKL')[0].reset();
                                    location.reload(true);
                                }
                                });
                            }else {
                                swal("Lỗi","Thêm mới dữ liệu không thành công!","error");
                            }
                            console.log(data);
						}
					});
				}
			});
		});
	</script>
<script src="res/BS5/dist/feather.min.js"></script>
<script src="res/BS5/dashboard/dashboard.js"></script>
</body>
</html>