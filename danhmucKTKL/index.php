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
$truyvanMaDM = "
SELECT
CASE WHEN CHAR_LENGTH(CONVERT(CONVERT(RIGHT(MaKTKL,4),UNSIGNED)+1,CHAR))=1 
THEN 
	CONCAT('KK000',CONVERT(CONVERT(RIGHT(MaKTKL,4),UNSIGNED)+1,CHAR))
ELSE 
	CASE WHEN CHAR_LENGTH(CONVERT(CONVERT(RIGHT(MaKTKL,4),UNSIGNED)+1,CHAR))=2
    THEN
    	CONCAT('KK00',CONVERT(CONVERT(RIGHT(MaKTKL,4),UNSIGNED)+1,CHAR))
    ELSE
    	CASE WHEN CHAR_LENGTH(CONVERT(CONVERT(RIGHT(MaKTKL,4),UNSIGNED)+1,CHAR))=3
    	THEN
    		CONCAT('KK0',CONVERT(CONVERT(RIGHT(MaKTKL,4),UNSIGNED)+1,CHAR))
    	ELSE
    		CONCAT('KK',CONVERT(CONVERT(RIGHT(MaKTKL,4),UNSIGNED)+1,CHAR))
    	END
    END
END FROM DMKTKL ORDER BY MaKTKL DESC LIMIT 0,1 ";
$querysql = mysqli_query($con,$truyvanMaDM);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo $HomeURL; ?>/"/>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DANH MỤC KHEN THƯỞNG - KỶ LUẬT</title>
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
						<form id="frmThemDM" method="POST" class="was-validated">
							<div class="col-md-4">
								<label>Mã Khen Thưởng - Kỷ Luật</label>
								<input type="text" class="form-control" name="MaKTKL" id="MaKTKL" value="<?php  
									if (mysqli_num_rows($querysql)>0) {
									$rowL = mysqli_fetch_array($querysql);
									echo $rowL[0];
									} ?>">
	      			</div>
	      			<div class="col-md-4">
								<label>Tên Khen Thưởng - Kỷ Luật</label>
								<input type="text" class="form-control" name="TenKTKL" id="TenKTKL" placeholder="Nhập tên danh mục khen thưởng - kỷ luật.." required>
								<div class="valid-feedback">Valid.</div>
		      			<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-md-4">
								<label class="form-check-label" for="KTKL">Khen Thưởng (có check) - Kỷ Luật (không check) </label>
								<input class="form-check-input" type="checkbox" name="KTKL" id="KTKL">
							</div>
							<div style="height: 10px;"></div>
							<div class="col-12">
								<button type="button" class="btn btn-success" name="Them" id="Them">Thêm</button>
							</div>
						</form>
				</div>
			</div>
			<!---Load dữ liệu-->
			<div class="card">
					<div class="card-header">
						<center><h3><b>THÔNG TIN DANH MỤC KHEN THƯỞNG - KỶ LUẬT</b></h3></center>
					</div>
					<div class="card-body" id="load_DM">				
					</div>
			</div>
	</div>

	<?php 
		include('../footer.html'); 
	?>
	<!-- The Modal edit -->
	<div class="modal fade" id="edit_Modal">
	  <div class="modal-dialog">
	  	<form method="POST" id="edit_DM">
	    	<div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Chỉnh sửa thông tin danh mục khen thưởng kỷ luật</h4>
		        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		      	<div class="form-group">
		      		<label>Tên Danh Mục Khen Thưởng Kỷ Luật</label>
		      		<input type="text" name="TenKTKLm" id="TenKTKLm" class="form-control">
		      	</div>
		      	<div class="form-group">
		      			<label class="form-check-label" for="KTKL">Khen Thưởng (có check) - Kỷ Luật (không check) 
		      			</label>
								<input class="form-check-input" type="checkbox" name="KTKLm" id="KTKLm">
		      	</div>
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		      	<input type="hidden" name="MaKTKLm" id="MaKTKLm" value="">
		      	<input type="submit" name="submit" id="MaKTKLm" value="Cập nhật" class="btn btn-info">
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
					url: "<?php echo $HomeURL; ?>/danhmucKTKL/ajax_xuly.php",
					method: "POST",
					success:function(data){
						$('#load_DM').html(data);
						$('#tbl_loadDM').DataTable({
							"lengthMenu": [ 10, 15, 20, 25, 50, 75, 100, 1000 ]
						});
					}
				});
			}
			//Xóa 
			$(document).on('click','.del_data',function(){
				var idxoa = $(this).data('id4');
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
						url: "<?php echo $HomeURL; ?>/danhmucKTKL/ajax_xuly.php",
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
				var MaKTKL = $(this).data("id3");
				$.ajax({
					url: "<?php echo $HomeURL; ?>/danhmucKTKL/edit.php",
					method: "POST",
					dataType: "json",
					data:{MaKTKL:MaKTKL},
					success:function(data){
						$('#edit_Modal').modal('show');
						$('#MaKTKLm').val(MaKTKL);
						$('#TenKTKLm').val(data.TenKTKLm);
						$('#KTKLm').val(data.KTKLm);
						//console.log(data);
					}
				});
			});
			//Xu ly code update
			$('#edit_DM').on('submit',function(event){
				event.preventDefault();
				var MaKTKLs = $('#MaKTKLm').val();
				var TenKTKLs = $('#TenKTKLm').val();
				var KTKLs = $('#KTKLm').is(":checked");
				if ($('#MaKTKL').val()=='') {
					swal("Cảnh báo","Vui lòng điền thông tin nhập liệu","error");
				}else {
					$.ajax({
						url: "<?php echo $HomeURL; ?>/danhmucKTKL/ajax_sua.php",
						method: "POST",
						data:{MaKTKLs:MaKTKLs,TenKTKLs:TenKTKLs,KTKLs:KTKLs},
						//data:$('#edit_DM').serialize(),
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
				var MaKTKL = $('#MaKTKL').val();
				var TenKTKL = $('#TenKTKL').val();
				var KTKL = $('#KTKL').is(":checked");
				if(MaKTKL =='' || TenKTKL ==''){
					swal("Cảnh báo","Dữ liệu không được bỏ trống","warning");
				}else{
					$.ajax({
						url: "<?php echo $HomeURL; ?>/danhmucKTKL/ajax_xuly.php",
						method: "POST",
						data:{MaKTKL:MaKTKL,TenKTKL:TenKTKL,KTKL:KTKL},
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
                                    $('#frmThemDM')[0].reset();
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