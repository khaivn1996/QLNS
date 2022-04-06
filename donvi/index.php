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
$truyvanMaDV = "
SELECT
CASE WHEN CHAR_LENGTH(CONVERT(CONVERT(RIGHT(MaDV,4),int)+1,CHAR))=1 
THEN 
	CONCAT('DV000',CONVERT(CONVERT(RIGHT(MaDV,4),int)+1,CHAR))
ELSE 
	CASE WHEN CHAR_LENGTH(CONVERT(CONVERT(RIGHT(MaDV,4),int)+1,CHAR))=2
    THEN
    	CONCAT('DV00',CONVERT(CONVERT(RIGHT(MaDV,4),int)+1,CHAR))
    ELSE
    	CASE WHEN CHAR_LENGTH(CONVERT(CONVERT(RIGHT(MaDV,4),int)+1,CHAR))=3
    	THEN
    		CONCAT('DV0',CONVERT(CONVERT(RIGHT(MaDV,4),int)+1,CHAR))
    	ELSE
    		CONCAT('DV',CONVERT(CONVERT(RIGHT(MaDV,4),int)+1,CHAR))
    	END
    END
END FROM DONVI ORDER BY MaDV DESC LIMIT 0,1 ";
$querysql = mysqli_query($con,$truyvanMaDV);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<base href="http://localhost:8080/QLNS/"/>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ĐƠN VỊ</title>
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
						<form id="frmThemDV" method="POST" class="was-validated">
							<div class="col-md-6">
								<label>Mã Đơn Vị</label>
								<input type="text" class="form-control" name="MaDV" id="MaDV" placeholder="Nhập mã đơn vị.." value="<?php  
									if (mysqli_num_rows($querysql)>0) {
									$rowL = mysqli_fetch_array($querysql);
									echo $rowL[0];
									}?>" readonly>
	      			</div>
	      			<div class="col-md-6">
								<label>Tên Đơn Vị</label>
								<input type="text" class="form-control" name="TenDV" id="TenDV" placeholder="Nhập tên đơn vị.." required>
								<div class="valid-feedback">Valid.</div>
		      			<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-md-6">
								<label>Số Điện Thoại</label>
								<input type="text" class="form-control" name="SoDT" id="SoDT" placeholder="Nhập số điện thoại.." required>
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
						<center><h3><b>THÔNG TIN ĐƠN VỊ</b></h3></center>
					</div>
					<div class="card-body" id="load_DV">				
					</div>
			</div>
	</div>

	<?php 
		include('../footer.html'); 
	?>
	<!-- The Modal edit -->
	<div class="modal fade" id="edit_Modal">
	  <div class="modal-dialog">
	  	<form method="POST" id="edit_donvi">
	    	<div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Chỉnh sửa thông tin đơn vị</h4>
		        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		      	<div class="form-group">
		      		<label>Tên Đơn Vị</label>
		      		<input type="text" name="TenDVm" id="TenDVm" class="form-control">
		      	</div>
		      	<div class="form-group">
		      		<label>Số Điện Thoại</label>
		      		<input type="text" name="SoDTm" id="SoDTm" class="form-control">
		      	</div>
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		      	<input type="hidden" name="MaDVm" id="MaDVm" value="">
		      	<input type="submit" name="submit" id="MaDVm" value="Cập nhật" class="btn btn-info">
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
					url: "http://localhost:8080/QLNS/donvi/ajax_xuly.php",
					method: "POST",
					success:function(data){
						$('#load_DV').html(data);

						
						$('#tbl_loadDV tfoot th p').each(function(){
							var title = $(this).text();
							$(this).html('<input type="text" placeholder="Nhập '+title+'" />');
						});
						var table = $('#tbl_loadDV').DataTable({
						initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            });
        		}	
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
						url: "http://localhost:8080/QLNS/donvi/ajax_xuly.php",
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
				var MaDV = $(this).data("id3");
				$.ajax({
					url: "http://localhost:8080/QLNS/donvi/edit.php",
					method: "POST",
					dataType: "json",
					data:{MaDV:MaDV},
					success:function(data){
						$('#edit_Modal').modal('show');
						$('#MaDVm').val(MaDV);
						$('#TenDVm').val(data.TenDVm);
						$('#SoDTm').val(data.SoDTm);
						console.log(data);
					}
				});
			});
			//Xu ly code update
			$('#edit_donvi').on('submit',function(event){
				event.preventDefault();
				if ($('#MaDV').val()=='') {
					swal("Cảnh báo","Vui lòng điền thông tin nhập liệu","error");
				}else {
					$.ajax({
						url: "http://localhost:8080/QLNS/donvi/ajax_sua.php",
						method: "POST",
						data:$('#edit_donvi').serialize(),
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
				var MaDV = $('#MaDV').val();
				var TenDV = $('#TenDV').val();
				var SoDT = $('#SoDT').val();
				if(MaDV =='' || TenDV =='' || SoDT ==''){
					swal("Cảnh báo","Dữ liệu không được bỏ trống","warning");
				}else{
					$.ajax({
						url: "http://localhost:8080/QLNS/donvi/ajax_xuly.php",
						method: "POST",
						data:{MaDV:MaDV,TenDV:TenDV,SoDT:SoDT},
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
                                    $('#frmThemDV')[0].reset();
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