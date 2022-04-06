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
$truyvanMaDV = "SELECT MaDV,TenDV FROM DONVI ORDER BY MaDV";
$query_DV = mysqli_query($con,$truyvanMaDV);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<base href="http://localhost:8080/QLNS/"/>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>QUÁ TRÌNH CÔNG TÁC</title>
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
						<form id="frmThemCT" method="POST" class="was-validated row g-3">			
							<div class="col-md-2">
								<label>Mã Nhân Viên</label>
								<select class="form-control" name="MaNV" id="MaNV">
									<?php  
										if (mysqli_num_rows($querysql)>0) {
											while($rowNV = mysqli_fetch_array($querysql)){
												echo '<option value="'.$rowNV['MaNV'].'">'.$rowNV['MaNV'].'</option>';
											}
										}
									?>
								</select>
	      			</div>
	      			<div class="col-md-3">
								<label>Từ Ngày</label>
								<input type="date" class="form-control" name="TuNgay" id="TuNgay" required>
							</div>
							<div class="col-md-3">
								<label>Đến Ngày</label>
								<input type="date" class="form-control" name="DenNgay" id="DenNgay" required>
							</div>
							<div class="col-md-4">
								<label for="browser">ĐƠN VỊ</label>
								<select class="form-control" name="MaDV" id="MaDV">
								<?php  
									if (mysqli_num_rows($query_DV)>0) {
										while($rowDV = mysqli_fetch_array($query_DV)){
											echo '<option value="'.$rowDV[0].'">'.$rowDV[1].'</option>';
										}
									}
								?>
								</select>
							</div>
							<div class="col-md-6">
								<label>Công Việc</label>
								<input type="text" class="form-control" name="CongViec" id="CongViec" placeholder="Nhập tên công việc.." required>
								<div class="valid-feedback">Valid.</div>
		      			<div class="invalid-feedback">Please fill out this field.</div>
							</div>	
							<div class="col-md-6">
								<label>Nơi Làm Việc</label>
								<input type="text" class="form-control" name="NoiLamViec" id="NoiLamViec" placeholder="Nhập tên nơi làm.."  required></input>
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
						<center><h3><b>THÔNG TIN QUÁ TRÌNH CÔNG TÁC</b></h3></center>
					</div>
					<div class="card-body" id="load_CT">				
					</div>
			</div>
	</div>

	<?php 
		include('../footer.html'); 
	?>

	<!-- Load bằng cấp và loại hình đào tạo cho modal -->
	<?php  
		$truyvanMaDVm = "SELECT MaDV,TenDV FROM DONVI ORDER BY MaDV";
		$query_DVm = mysqli_query($con,$truyvanMaDVm);
	?>
	<!-- The Modal edit -->
	<div class="modal fade" id="edit_Modal">
	  <div class="modal-dialog">
	  	<form method="POST" id="edit_congtac">
	    	<div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Chỉnh sửa thông tin quá trình công tác</h4>
		        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		      	<div class="form-group">
		      		<label>Từ Ngày</label>
		      		<input type="date" name="TuNgaym" id="TuNgaym" class="form-control" style="width: 250px;">
		      	</div>
		      	<div class="form-group">
		      		<label>Đến Ngày</label>
							<input type="date" name="DenNgaym" id="DenNgaym" class="form-control" style="width: 250px;">
		      	</div>
		      	
		      	<div class="form-group">
			      	<label for="browser">Đơn Vị</label>
							<select class="form-control" name="MaDVm" id="MaDVm">
								<?php  
									if (mysqli_num_rows($query_DVm)>0) {
										while($rowDVM = mysqli_fetch_array($query_DVm)){
											echo '<option value="'.$rowDVM[0].'">'.$rowDVM[1].'</option>';
										}
									}
								?>
							</select>
		      	</div>
		      	<div class="form-group">
			      	<label>Công Việc</label>
							<input type="text" class="form-control" name="CongViecm" id="CongViecm">
		      	</div>
		      	<div class="form-group">
			      	<label>Nơi Làm Việc</label>
							<input type="text" class="form-control" name="NoiLamViecm" id="NoiLamViecm"></input>
		      	</div>
		      </div>
		      <!-- Modal footer -->
		      <div class="modal-footer">
		      	<input type="hidden" name="MaNVm" id="MaNVm" value="">
		      	<input type="submit" name="submit" id="MaNVm" value="Cập nhật" class="btn btn-info">
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
					url: "http://localhost:8080/QLNS/qtcongtac/ajax_xuly.php",
					method: "POST",
					success:function(data){
						$('#load_CT').html(data);
						$('#tbl_loadCT').DataTable({
							"lengthMenu": [ 10, 15, 20, 25, 50, 75, 100, 1000 ]
						});
					}
				});
			}
			//Xóa 
			$(document).on('click','.del_data',function(){
				var idxoa = $(this).data('id7');
				var TuNgay = $(this).data('id8');
				var DenNgay = $(this).data('id9');
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
						url: "http://localhost:8080/QLNS/qtcongtac/ajax_xuly.php",
						method: "POST",
						data:{idxoa:idxoa,TuNgay:TuNgay,DenNgay:DenNgay},
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
				var MaNV = $(this).data("id6");
				$.ajax({
					url: "http://localhost:8080/QLNS/qtcongtac/edit.php",
					method: "POST",
					dataType: "json",
					data:{MaNV:MaNV},
					success:function(data){
						$('#edit_Modal').modal('show');
						$('#MaNVm').val(MaNV);
						$('#TuNgaym').val(data.TuNgaym);
						$('#DenNgaym').val(data.DenNgaym);
						$('#MaDVm').val(data.MaDVm);
						$('#CongViecm').val(data.CongViecm);
						$('#NoiLamViecm').val(data.NoiLamViecm);
						console.log(data);
					}
				});
			});
			//Xu ly code update
			$('#edit_congtac').on('submit',function(event){
				event.preventDefault();
				if ($('#MaNV').val()=='') {
					swal("Cảnh báo","Vui lòng điền thông tin nhập liệu","error");
				}else {
					$.ajax({
						url: "http://localhost:8080/QLNS/qtcongtac/ajax_sua.php",
						method: "POST",
						data:$('#edit_congtac').serialize(),
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
				var TuNgay = $('#TuNgay').val();
				var DenNgay = $('#DenNgay').val();
				var MaDV = $('#MaDV').val();
				var CongViec = $('#CongViec').val();
				var NoiLamViec = $('#NoiLamViec').val();

				if(MaNV =='' || TuNgay =='' || DenNgay =='' || CongViec =='' || NoiLamViec ==''){
					swal("Cảnh báo","Dữ liệu không được bỏ trống","warning");
				}else{
					$.ajax({
						url: "http://localhost:8080/QLNS/qtcongtac/ajax_xuly.php",
						method: "POST",
						data:{MaNV:MaNV,TuNgay:TuNgay,DenNgay:DenNgay,MaDV:MaDV,CongViec:CongViec,NoiLamViec:NoiLamViec},
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
                                    $('#frmThemCT')[0].reset();
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