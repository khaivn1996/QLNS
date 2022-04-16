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
$truyvanMaCV = "
SELECT
CASE WHEN CHAR_LENGTH(CONVERT(CONVERT(RIGHT(MaCV,4),UNSIGNED)+1,CHAR))=1 
THEN 
	CONCAT('CV000',CONVERT(CONVERT(RIGHT(MaCV,4),UNSIGNED)+1,CHAR))
ELSE 
	CASE WHEN CHAR_LENGTH(CONVERT(CONVERT(RIGHT(MaCV,4),UNSIGNED)+1,CHAR))=2
    THEN
    	CONCAT('CV00',CONVERT(CONVERT(RIGHT(MaCV,4),UNSIGNED)+1,CHAR))
    ELSE
    	CASE WHEN CHAR_LENGTH(CONVERT(CONVERT(RIGHT(MaCV,4),UNSIGNED)+1,CHAR))=3
    	THEN
    		CONCAT('CV0',CONVERT(CONVERT(RIGHT(MaCV,4),UNSIGNED)+1,CHAR))
    	ELSE
    		CONCAT('CV',CONVERT(CONVERT(RIGHT(MaCV,4),UNSIGNED)+1,CHAR))
    	END
    END
END FROM CHUCVU ORDER BY MaCV DESC LIMIT 0,1 ";
$querysqlCV = mysqli_query($con,$truyvanMaCV);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo $HomeURL; ?>/"/>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CHỨC VỤ</title>
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
						<form id="frmThemCV" method="POST" class="was-validated">
							<div class="col-md-6">
								<label>Mã Chức Vụ</label>
								<input type="text" class="form-control" name="MaCV" id="MaCV" placeholder="Nhập mã chức vụ.." value="<?php  
									if (mysqli_num_rows($querysqlCV)>0) {
									$rowCV = mysqli_fetch_array($querysqlCV);
									echo $rowCV[0];
									} else {
									echo 'CV0000';
									}?>" readonly>
	      			</div>
	      			<div class="col-md-6">
								<label>Tên Chức Vụ</label>
								<input type="text" class="form-control" name="TenCV" id="TenCV" placeholder="Nhập tên chức vụ.." required>
								<div class="valid-feedback">Valid.</div>
		      			<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-md-6">
								<label>Tiền 1 Giờ Làm Việc</label>
								<input type="text" class="form-control" name="Tien1Gio" id="Tien1Gio" placeholder="Nhập số tiền 1 giờ làm.." required>
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
						<center><h3><b>THÔNG TIN CHỨC VỤ</b></h3></center>
					</div>
					<div class="card-body" id="load_CV">				
					</div>
			</div>
	</div>

	<?php 
		include('../footer.html'); 
	?>
	<!-- The Modal edit -->
	<div class="modal fade" id="edit_Modal">
	  <div class="modal-dialog">
	  	<form method="POST" id="edit_CV">
	    	<div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Chỉnh sửa thông tin đơn vị</h4>
		        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		      	<div class="form-group">
		      		<label>Tên Chức Vụ</label>
		      		<input type="text" name="TenCVm" id="TenCVm" class="form-control">
		      	</div>
		      	<div class="form-group">
		      		<label>Tiền 1 Giờ Làm Việc</label>
		      		<input type="text" name="Tien1Giom" id="Tien1Giom" class="form-control">
		      	</div>
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		      	<input type="hidden" name="MaCVm" id="MaCVm" value="">
		      	<input type="submit" name="submit" id="MaCVm" value="Cập nhật" class="btn btn-info">
		        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
		      </div>
		    
	    	</div>
	    </form>
	  </div>
	</div>


	<script type="text/javascript">
		$(document).ready(function(){
			
			LoadData();
			

			//Load du lieu
			function LoadData(){
				$.ajax({
					url: "<?php echo $HomeURL; ?>/chucvu/ajax_xuly.php",
					method: "POST",
					success:function(data){
						$('#load_CV').html(data);
						$('#tbl_loadCV').DataTable({
							"lengthMenu": [ 10, 15, 20, 25, 50, 75, 100, 1000 ]
						});
					}
				});
			}
			//Xóa 
			$(document).on('click','.del_data',function(){
				var idxoa = $(this).data('id3');
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
						url: "<?php echo $HomeURL; ?>/chucvu/ajax_xuly.php",
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
				var MaCV = $(this).data("id2");
				$.ajax({
					url: "<?php echo $HomeURL; ?>/chucvu/edit.php",
					method: "POST",
					dataType: "json",
					data:{MaCV:MaCV},
					success:function(data){
						$('#edit_Modal').modal('show');
						$('#MaCVm').val(MaCV);
						$('#TenCVm').val(data.TenCVm);
						$('#Tien1Giom').val(data.Tien1Giom);
					}
				});
			});
			//Xu ly code update
			$('#edit_CV').on('submit',function(event){
				event.preventDefault();
				if ($('#MaCV').val()=='') {
					swal("Cảnh báo","Vui lòng điền thông tin nhập liệu","error");
				}else {
					$.ajax({
						url: "<?php echo $HomeURL; ?>/chucvu/ajax_sua.php",
						method: "POST",
						data:$('#edit_CV').serialize(),
						success:function(data){
							//console.log(data);
							$('#edit_Modal').modal('hide');
							LoadData();
							swal("Thông tin","Đã cập nhật thành công","success");
						}
					});
				}
			});
			//Thêm
			$('#Them').on('click',function(){
				var MaCV = $('#MaCV').val();
				var TenCV = $('#TenCV').val();
				var Tien1Gio = $('#Tien1Gio').val();
				if(MaCV =='' || TenCV =='' || Tien1Gio ==''){
					swal("Cảnh báo","Dữ liệu không được bỏ trống","warning");
				}else{
					$.ajax({
						url: "<?php echo $HomeURL; ?>/chucvu/ajax_xuly.php",
						method: "POST",
						data:{MaCV:MaCV,TenCV:TenCV,Tien1Gio:Tien1Gio},
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
                                    $('#frmThemCV')[0].reset();
                                    location.reload(true);
                                }
                                });
                            }else {
                                swal("Lỗi","Thêm mới dữ liệu không thành công!","error");
                            }
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