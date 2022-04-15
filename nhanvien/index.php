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
$truyvanMaNV = "
SELECT
CASE WHEN CHAR_LENGTH(CONVERT(CONVERT(RIGHT(MaNV,4),UNSIGNED)+1,CHAR))=1 
THEN 
	CONCAT('NV000',CONVERT(CONVERT(RIGHT(MaNV,4),UNSIGNED)+1,CHAR))
ELSE 
	CASE WHEN CHAR_LENGTH(CONVERT(CONVERT(RIGHT(MaNV,4),UNSIGNED)+1,CHAR))=2
    THEN
    	CONCAT('NV00',CONVERT(CONVERT(RIGHT(MaNV,4),UNSIGNED)+1,CHAR))
    ELSE
    	CASE WHEN CHAR_LENGTH(CONVERT(CONVERT(RIGHT(MaNV,4),UNSIGNED)+1,CHAR))=3
    	THEN
    		CONCAT('NV0',CONVERT(CONVERT(RIGHT(MaNV,4),UNSIGNED)+1,CHAR))
    	ELSE
    		CONCAT('NV',CONVERT(CONVERT(RIGHT(MaNV,4),UNSIGNED)+1,CHAR))
    	END
    END
END FROM NHANVIEN ORDER BY MaNV DESC LIMIT 0,1 ";
$querysql = mysqli_query($con,$truyvanMaNV);

//Load mã đơn vị
$truyvanMaDV = "SELECT MaDV,TenDV FROM DONVI ORDER BY MaDV";
$query_donvi = mysqli_query($con,$truyvanMaDV);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo $HomeURL; ?>/"/>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NHÂN VIÊN</title>
	<link rel="icon" href="res/image/fav.ico" type="image/ico">
	<script src="res/BS5/jquery/jquery.min.js"></script>
	<link href="res/BS5/css/bootstrap.min.css" rel="stylesheet">
  <script src="res/BS5/js/bootstrap.bundle.min.js"></script>
  <script src="res/BS5/jquery/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="res/BS5/css/jquery.dataTables.css"> 
	<script type="text/javascript" charset="utf8" src="res/BS5/js/jquery.dataTables.js"></script>
	<script src="res/BS5/jquery/jquery.table2excel.min.js"></script>
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
						<form id="frmThemNV" method="POST" class="was-validated row g-3">
							<div class="col-md-2">
								<label>Mã Nhân Viên</label>
								<input type="text" class="form-control" name="MaNV" id="MaNV" placeholder="Nhập mã nhân viên.." value="<?php  
									if (mysqli_num_rows($querysql)>0) {
									$rowL = mysqli_fetch_array($querysql);
									echo $rowL[0];
									}?>" readonly>
	      			</div>
	      			<div class="col-md-5">
								<label>Họ Nhân Viên</label>
								<input type="text" class="form-control" name="HoNV" id="HoNV" placeholder="Nhập họ nhân viên.." required>
								<div class="valid-feedback">Valid.</div>
		      					<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-md-5">
								<label>Tên Nhân Viên</label>
								<input type="text" class="form-control" name="TenNV" id="TenNV" placeholder="Nhập tên nhân viên.." required>
								<div class="valid-feedback">Valid.</div>
		      					<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-md-3">
								<label for="browser">Giới tính</label>
								<select class="form-control" name="GioiTinh" id="GioiTinh" required>
									<option value="Nam">Nam</option>
									<option value="Nữ">Nữ</option>
								</select>
								<div class="valid-feedback">Valid.</div>
		      			<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-md-3">
								<label>Ngày Sinh</label>
								<input type="date" class="form-control" name="NgaySinh" id="NgaySinh" required>
								<div class="valid-feedback">Valid.</div>
		      					<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-md-3">
								<label>Điện Thoại</label>
								<input type="text" class="form-control" name="DienThoai" id="DienThoai" placeholder="Nhập số điện thoại.." required>
								<div class="valid-feedback">Valid.</div>
		      					<div class="invalid-feedback">Please fill out this field.</div>
							</div>

							<div class="col-md-3">
								<label for="browser">Đơn Vị</label>
								<select class="form-control" name="MaDV" id="MaDV">
								<?php  
									if (mysqli_num_rows($query_donvi)>0) {
										while($rowDV = mysqli_fetch_array($query_donvi)){
											echo '<option value="'.$rowDV[0].'">'.$rowDV[1].'</option>';
										}
									}
								?>
								</select>
							</div>
							<div class="col-12">
								<label>Địa Chỉ</label>
								<textarea class="form-control" name="DiaChi" id="DiaChi" placeholder="Nhập địa chỉ.."></textarea>
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
						<center><h3><b>THÔNG TIN NHÂN VIÊN</b></h3></center>
						<input type="button" id="xuate" name="xuate" class="btn btn-success" value="Xuất Excel">
					</div>
					<div class="card-body" id="load_NV">				
					</div>
			</div>
	</div>

	<?php 
		include('../footer.html'); 
	?>

	<!-- Load đơn vị cho modal -->
	<?php  
		$truyvanMaDVm = "SELECT MaDV,TenDV FROM DONVI ORDER BY MaDV";
		$query_donvim = mysqli_query($con,$truyvanMaDVm);
	?>
	<!-- The Modal edit -->
	<div class="modal fade" id="edit_Modal">
	  <div class="modal-dialog">
	  	<form method="POST" id="edit_nhanvien">
	    	<div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Chỉnh sửa thông tin nhân viên</h4>
		        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		      	<div class="form-group">
		      		<label>Họ nhân viên</label>
		      		<input type="text" name="HoNVm" id="HoNVm" class="form-control">
		      	</div>
		      	<div class="form-group">
		      		<label>Tên nhân viên</label>
		      		<input type="text" name="TenNVm" id="TenNVm" class="form-control">
		      	</div>
		      	<div class="form-group">
		      		<label for="browser">Giới tính</label>
					<select class="form-control" name="GioiTinhm" id="GioiTinhm" style="width: 100px;">
						<option value="Nam">Nam</option>
						<option value="Nữ">Nữ</option>
					</select>
		      	</div>
		      	<div class="form-group">
		      		<label>Ngày Sinh</label>
					<input type="date" class="form-control" name="NgaySinhm" id="NgaySinhm" style="width: 250px;">
		      	</div>
		      	<div class="form-group">
			      	<label>Địa Chỉ</label>
					<textarea class="form-control" name="DiaChim" id="DiaChim"></textarea>
		      	</div>
		      	<div class="form-group">
			      	<label>Điện Thoại</label>
					<input type="text" class="form-control" name="DienThoaim" id="DienThoaim">
		      	</div>

		      	<div class="form-group">
					<label>Thôi Việc (có check) - Đang làm việc (không check)</label>
					<input class="form-check-input" type="checkbox" name="ThoiViecm" id="ThoiViecm">
				</div>

		      	<div class="form-group">
			      	<label for="browser">Đơn Vị</label>
					<select class="form-control" name="MaDVm" id="MaDVm">
					<?php  
						if (mysqli_num_rows($query_donvim)>0) {
							while($rowDVM = mysqli_fetch_array($query_donvim)){
								echo '<option value="'.$rowDVM[0].'">'.$rowDVM[1].'</option>';
							}
						}
					?>
					</select>
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
					url: "<?php echo $HomeURL; ?>/nhanvien/ajax_xuly.php",
					method: "POST",
					success:function(data){
						$('#load_NV').html(data);
						
						$('#tbl_loadNV tfoot th p').each(function(){
							var title = $(this).text();
							$(this).html('<input type="text" style="width: 60px;" />');
						});
						var table = $('#tbl_loadNV').DataTable({
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
				var idxoa = $(this).data('id8');
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
						url: "<?php echo $HomeURL; ?>/nhanvien/ajax_xuly.php",
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
				var MaNV = $(this).data("id9");
				$.ajax({
					url: "<?php echo $HomeURL; ?>/nhanvien/edit.php",
					method: "POST",
					dataType: "json",
					data:{MaNV:MaNV},
					success:function(data){
						$('#edit_Modal').modal('show');
						$('#MaNVm').val(MaNV);
						$('#HoNVm').val(data.HoNVm);
						$('#TenNVm').val(data.TenNVm);
						$('#GioiTinhm').val(data.GioiTinhm);
						$('#NgaySinhm').val(data.NgaySinhm);
						$('#DiaChim').val(data.DiaChim);
						$('#DienThoaim').val(data.DienThoaim);
						$('#ThoiViecm').val(data.ThoiViecm);
						$('#MaDVm').val(data.MaDVm);
						console.log($('#ThoiViecm').val(data.ThoiViecm));
					}
				});
			});
			//Xu ly code update
			$('#edit_nhanvien').on('submit',function(event){
				event.preventDefault();
				var MaNVs = $('#MaNVm').val();
				var HoNVs = $('#HoNVm').val();
				var TenNVs = $('#TenNVm').val();
				var GioiTinhs = $('#GioiTinhm').val();
				var NgaySinhs = $('#NgaySinhm').val();
				var DiaChis = $('#DiaChim').val();
				var DienThoais = $('#DienThoaim').val();
				var ThoiViecs = $('#ThoiViecm').is(":checked");	
				var MaDVs = $('#MaDVm').val();
				if ($('#MaNV').val()=='') {
					swal("Cảnh báo","Vui lòng điền thông tin nhập liệu","error");
				}else {
					$.ajax({
						url: "<?php echo $HomeURL; ?>/nhanvien/ajax_sua.php",
						method: "POST",
						data:{MaNVs:MaNVs,HoNVs:HoNVs,TenNVs:TenNVs,GioiTinhs:GioiTinhs,NgaySinhs:NgaySinhs,DiaChis:DiaChis,DienThoais:DienThoais,ThoiViecs:ThoiViecs,MaDVs:MaDVs},
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
				var HoNV = $('#HoNV').val();
				var TenNV = $('#TenNV').val();
				var GioiTinh = $('#GioiTinh').val();
				var NgaySinh = $('#NgaySinh').val();
				var DiaChi = $('#DiaChi').val();
				var DienThoai = $('#DienThoai').val();	
				var MaDV = $('#MaDV').val();
				if(MaNV =='' || HoNV =='' || TenNV =='' || GioiTinh =='' || NgaySinh =='' || DiaChi =='' || DienThoai =='' || MaDV ==''){
					swal("Cảnh báo","Dữ liệu không được bỏ trống","warning");
				}else{
					$.ajax({
						url: "<?php echo $HomeURL; ?>/nhanvien/ajax_xuly.php",
						method: "POST",
						data:{MaNV:MaNV,HoNV:HoNV,TenNV:TenNV,GioiTinh:GioiTinh,NgaySinh:NgaySinh,DiaChi:DiaChi,DienThoai:DienThoai,MaDV:MaDV},
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
                                    $('#frmThemNV')[0].reset();
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
			//Xuất Excel
			$('#xuate').on('click',function(){
				$("#tbl_loadNV").table2excel({
			    exclude: "#btn",
			    name: "NHANVIEN",
			    filename: "NhanVien_" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
			    fileext: ".xls",
					preserveColors: true
			  });
			});
		});
	</script>
<script src="res/BS5/dist/feather.min.js"></script>
<script src="res/BS5/dashboard/dashboard.js"></script>
</body>
</html>