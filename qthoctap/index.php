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
$truyvanMaBC = "SELECT MaBC,TenBC FROM MABANGCAP ORDER BY MaBC";
$query_BC = mysqli_query($con,$truyvanMaBC);

//Load mã đơn vị
$truyvanMaLHDT = "SELECT MaLHDT,TenLHDT FROM LOAIHINHHDT ORDER BY MaLHDT";
$query_LHDT = mysqli_query($con,$truyvanMaLHDT);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<base href="http://localhost:8080/QLNS/"/>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>QUÁ TRÌNH HỌC TẬP</title>
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
						<form id="frmThemHT" method="POST" class="was-validated row g-3">
							<div class="col-md-2">
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
	      			<div class="col-md-3">
								<label>Từ Ngày</label>
								<input type="date" class="form-control" name="TuNgay" id="TuNgay" required>
								<div class="valid-feedback">Valid.</div>
		      			<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-md-3">
								<label>Đến Ngày</label>
								<input type="date" class="form-control" name="DenNgay" id="DenNgay" required>
								<div class="valid-feedback">Valid.</div>
		      			<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-md-4">
								<label>Năm Tốt Nghiệp</label>
								<input type="text" class="form-control" name="NamTN" id="NamTN" required>
								<div class="valid-feedback">Valid.</div>
		      			<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-md-6">
								<label for="browser">Bằng Cấp</label>
								<select class="form-control" name="MaBC" id="MaBC">
								<?php  
									if (mysqli_num_rows($query_BC)>0) {
										while($rowBC = mysqli_fetch_array($query_BC)){
											echo '<option value="'.$rowBC[0].'">'.$rowBC[1].'</option>';
										}
									}
								?>
								</select>
							</div>
							<div class="col-md-6">
								<label for="browser">Loại Hình Đào Tạo</label>
								<select class="form-control" name="MaLHDT" id="MaLHDT">
								<?php  
									if (mysqli_num_rows($query_LHDT)>0) {
										while($rowLHDT = mysqli_fetch_array($query_LHDT)){
											echo '<option value="'.$rowLHDT[0].'">'.$rowLHDT[1].'</option>';
										}
									}
								?>
								</select>
							</div>
							<div class="col-md-6">
								<label>Chuyên Ngành</label>
								<input type="text" class="form-control" name="ChuyenNganh" id="ChuyenNganh" placeholder="Nhập tên chuyên ngành.." required>
								<div class="valid-feedback">Valid.</div>
		      			<div class="invalid-feedback">Please fill out this field.</div>
							</div>	
							<div class="col-md-6">
								<label>Cơ Sở Đào Tạo</label>
								<input type="text" class="form-control" name="CoSoDT" id="CoSoDT" placeholder="Nhập tên cơ sở đào tạo.."  required></input>
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
						<center><h3><b>THÔNG TIN QUÁ TRÌNH HỌC TẬP</b></h3></center>
					</div>
					<div class="card-body" id="load_HT">				
					</div>
			</div>
	</div>

	<?php 
		include('../footer.html'); 
	?>

	<!-- Load bằng cấp và loại hình đào tạo cho modal -->
	<?php  
		$truyvanMaBCm = "SELECT MaBC,TenBC FROM MABANGCAP ORDER BY MaBC";
		$query_BCm = mysqli_query($con,$truyvanMaBCm);

		$truyvanMaLHDTm = "SELECT MaLHDT,TenLHDT FROM LOAIHINHHDT ORDER BY MaLHDT";
		$query_LHDTm = mysqli_query($con,$truyvanMaLHDTm);
	?>
	<!-- The Modal edit -->
	<div class="modal fade" id="edit_Modal">
	  <div class="modal-dialog">
	  	<form method="POST" id="edit_hoctap">
	    	<div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Chỉnh sửa thông tin quá trình học tập</h4>
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
			      	<label for="browser">Bằng Cấp</label>
							<select class="form-control" name="MaBCm" id="MaBCm">
								<?php  
									if (mysqli_num_rows($query_BCm)>0) {
										while($rowBCM = mysqli_fetch_array($query_BCm)){
											echo '<option value="'.$rowBCM[0].'">'.$rowBCM[1].'</option>';
										}
									}
								?>
							</select>
		      	</div>
		      	<div class="form-group">
			      	<label for="browser">Loại Hình Đào Tạo</label>
							<select class="form-control" name="MaLHDTm" id="MaLHDTm">
								<?php  
									if (mysqli_num_rows($query_LHDTm)>0) {
										while($rowLHDTM = mysqli_fetch_array($query_LHDTm)){
											echo '<option value="'.$rowLHDTM[0].'">'.$rowLHDTM[1].'</option>';
										}
									}
								?>
							</select>
		      	</div>
		      	<div class="form-group">
			      	<label>Chuyên Ngành</label>
							<input type="text" class="form-control" name="ChuyenNganhm" id="ChuyenNganhm">
		      	</div>
		      	<div class="form-group">
			      	<label>Cơ Sở Đào Tạo</label>
							<input type="text" class="form-control" name="CoSoDTm" id="CoSoDTm"></input>
		      	</div>
		      	<div class="form-group">
			      	<label>Năm Tốt Nghiệp</label>
							<input type="text" class="form-control" name="NamTNm" id="NamTNm"></input>
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
					url: "http://localhost:8080/QLNS/qthoctap/ajax_xuly.php",
					method: "POST",
					success:function(data){
						$('#load_HT').html(data);
						$('#tbl_loadHT').DataTable({
							"lengthMenu": [ 10, 15, 20, 25, 50, 75, 100, 1000 ]
						});
					}
				});
			}
			//Xóa 
			$(document).on('click','.del_data',function(){
				var idxoa = $(this).data('id8');
				var TuNgay = $(this).data('id10');
				var DenNgay = $(this).data('id11');
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
						url: "http://localhost:8080/QLNS/qthoctap/ajax_xuly.php",
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
				var MaNV = $(this).data("id9");
				$.ajax({
					url: "http://localhost:8080/QLNS/qthoctap/edit.php",
					method: "POST",
					dataType: "json",
					data:{MaNV:MaNV},
					success:function(data){
						$('#edit_Modal').modal('show');
						$('#MaNVm').val(MaNV);
						$('#TuNgaym').val(data.TuNgaym);
						$('#DenNgaym').val(data.DenNgaym);
						$('#MaBCm').val(data.MaBCm);
						$('#MaLHDTm').val(data.MaLHDTm);
						$('#ChuyenNganhm').val(data.ChuyenNganhm);
						$('#CoSoDTm').val(data.CoSoDTm);
						$('#NamTNm').val(data.NamTNm);
						console.log(data);
					}
				});
			});
			//Xu ly code update
			$('#edit_hoctap').on('submit',function(event){
				event.preventDefault();
				if ($('#MaNV').val()=='') {
					swal("Cảnh báo","Vui lòng điền thông tin nhập liệu","error");
				}else {
					$.ajax({
						url: "http://localhost:8080/QLNS/qthoctap/ajax_sua.php",
						method: "POST",
						data:$('#edit_hoctap').serialize(),
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
				var MaBC = $('#MaBC').val();
				var MaLHDT = $('#MaLHDT').val();
				var ChuyenNganh = $('#ChuyenNganh').val();
				var CoSoDT = $('#CoSoDT').val();
				var NamTN = $('#NamTN').val();

				if(MaNV =='' || TuNgay =='' || DenNgay =='' || ChuyenNganh =='' || CoSoDT =='' || NamTN ==''){
					swal("Cảnh báo","Dữ liệu không được bỏ trống","warning");
				}else{
					$.ajax({
						url: "http://localhost:8080/QLNS/qthoctap/ajax_xuly.php",
						method: "POST",
						data:{MaNV:MaNV,TuNgay:TuNgay,DenNgay:DenNgay,MaBC:MaBC,MaLHDT:MaLHDT,ChuyenNganh:ChuyenNganh,CoSoDT:CoSoDT,NamTN:NamTN},
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
                                    $('#frmThemHT')[0].reset();
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