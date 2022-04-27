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

<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo $HomeURL; ?>/"/>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CHẤM CÔNG</title>
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
		<!---Load dữ liệu-->
		<div class="card">
			<div class="card-header">
				<center><h3><b>BẢNG CHẤM CÔNG</b></h3></center>
			</div>
			<br>
			<div class="row g-3">
				<div class="col-md-2" style="padding-left: 30px;">
				<label>Ngày Công</label><br>
				<input type="date" class="form-control" name="NgayQT" id="NgayQT" >
				</div><br>
				<div class="col-md-9" style="padding-top: 21px;">
					<button type="button" class="btn btn-success" name="ThemNgay" id="ThemNgay">Tạo Ngày Công</button>
					<button type="button" class="btn btn-warning" name="ChamC" id="ChamC">Chấm công</button>
					<button type="button" class="btn btn-danger" name="XoaNgay" id="XoaNgay">Xóa Ngày</button>
				</div>
			</div>
			
			<div class="card-body" id="load_CC">				
			</div>
		</div>
	</div>

	<?php 
		include('../footer.html'); 
	?>

	<script type="text/javascript">
		$(document).ready(function(){		
			ToDay();
			LoadData();
			//Load bang cong theo ngay quet the
			$('#NgayQT').on('change',function(){
				LoadData();
			});
			//Lay ngay hien tai
			function ToDay(){
				var now = new Date();
			    var month = (now.getMonth() + 1);               
			    var day = now.getDate();
			    if (month < 10) 
			        month = "0" + month;
			    if (day < 10) 
			        day = "0" + day;
			    var today = now.getFullYear() + '-' + month + '-' + day;
			    $('#NgayQT').val(today);
			}
			//EditVao
			$(document).on('blur','.Vao',function(){
				var id = $(this).data('id1');
				var NgayE = $(this).data('id11');
				var text = $(this).text();
				var col = "Vao";
				$.ajax({
					url: "<?php echo $HomeURL; ?>/chamcong/ajax_xuly.php",
					method: "POST",
					data: {id:id,text:text,NgayE:NgayE,col:col},
					success:function(data){
						swal("Thông báo","Đã cập nhật","success");
						LoadData();
					}
				});
			});
			//EditRa
			$(document).on('blur','.Ra',function(){
				var id = $(this).data('id2');
				var NgayE = $(this).data('id22');
				var text = $(this).text();
				var col = "Ra";
				$.ajax({
					url: "<?php echo $HomeURL; ?>/chamcong/ajax_xuly.php",
					method: "POST",
					data: {id:id,text:text,NgayE:NgayE,col:col},
					success:function(data){
						swal("Thông báo","Đã cập nhật","success");
						LoadData();
					}
				});
			});
			//Load du lieu
			function LoadData(){
				var NgayQT = $('#NgayQT').val();
				$.ajax({
					url: "<?php echo $HomeURL; ?>/chamcong/ajax_xuly.php",
					method: "POST",
					data: {NgayQT:NgayQT},
					success:function(data){
						$('#load_CC').html(data);
						$('#tbl_loadCC tfoot th p').each(function(){
							var title = $(this).text();
							$(this).html('<input type="text" style="width: 90px"/>');
						});
						var table = $('#tbl_loadCC').DataTable({
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
                				});
            				});
        				}	
						});
					}
				});
			}
			//Chấm công ngày
			$('#ChamC').on('click',function(){
				var Ngay_ = $('#NgayQT').val();
				$.ajax({
						url: '<?php echo $HomeURL; ?>/chamcong/AddDay.php',
						type: 'post',
						data: {Ngay_:Ngay_},
						success: function (data) {
							if (data==0) {
								swal("Lỗi","Chấm Công Ngày "+Ngay_+" Thất Bại","error");
							}else{
								swal("Thông Báo","Đã Chấm Công Ngày "+Ngay_,"success");
								LoadData();
							}
						}
					});
			});
			//Thêm Ngày
			$('#ThemNgay').on('click',function(){
				var NgayThem = $('#NgayQT').val();
				$.ajax({
						url: '<?php echo $HomeURL; ?>/chamcong/AddDay.php',
						type: 'post',
						data: {NgayThem:NgayThem},
						success: function (data) {
							if (data==0) {
								swal("Lỗi","Ngày vừa thêm đã có dữ liệu","error");
							}else{
								swal("Thông báo","Thêm thành công","success");
								LoadData();
							}
						}
				});
			});		
			//Xóa Ngày
			$('#XoaNgay').on('click',function(){
				var NgayXoa = $('#NgayQT').val();
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
						url: "<?php echo $HomeURL; ?>/chamcong/ajax_xuly.php",
						method: "POST",
						data:{NgayXoa:NgayXoa},
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
		});
	</script>
<script src="res/BS5/dist/feather.min.js"></script>
<script src="res/BS5/dashboard/dashboard.js"></script>
</body>
</html>