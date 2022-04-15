<?php
    session_start();
    $fromdate='';
		$todate='';
		$now=getdate();

		//Ngày đầu tháng
		$fromdate=$now['year'];
		if($now['mon']<10)
		{
			$fromdate.='-0'.$now['mon'];
		}
		else
		{
			$fromdate.=$now['mon'];
		}
		$fromdate.='-01';

		//Ngày cuối tháng
		$todate=$now['year'];
		if($now['mon']<10)
		{
			$todate.='-0'.$now['mon'];
		}
		else
		{
			$todate.=$now['mon'];
		}
		$todate.='-'.cal_days_in_month(CAL_GREGORIAN, $now['mon'], $now['year']);  
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
	<title>SINH NHẬT</title>
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
	<!---Load dữ liệu-->
		<div class="card">
				<div class="card-header">
					<center><h3><b>THỐNG KÊ NGÀY SINH TRONG THÁNG</b></h3></center>
					<div class="row">
						<div class="col-md-3">
									<label>Từ Ngày</label>
									<input type="date" class="form-control" name="TNgay" id="TNgay" value="<?php echo $fromdate; ?>">
						</div>
						<div class="col-md-3">
									<label>Đến Ngày</label>
									<input type="date" class="form-control" name="DNgay" id="DNgay" value="<?php echo $todate; ?>">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
									<input type="button" class="btn btn-primary" name="loadSN" id="loadSN" value="Load dữ liệu">
									<input type="button" id="xuates" name="xuates" class="btn btn-success" value="Xuất Excel">
						</div>
					</div>
				</div>
				<div class="card-body" id="load_SN">				
				</div>
		</div>
	</div>

	<?php 
		include('../footer.html'); 
	?>
</script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$("#loadSN").on('click',function(){
				var TNgay = $('#TNgay').val();
				var DNgay = $('#DNgay').val();
				var d1 = new Date(TNgay);
				var d2 = new Date(DNgay);
				var TNgay = d1.getMonth()+1;
				var DNgay = d2.getMonth()+1;
				$.ajax({
					url: "<?php echo $HomeURL; ?>/nhanvien/ajax_sn.php",
					method: "POST",
					data: {TNgay:TNgay,DNgay:DNgay},
					success:function(response){
						console.log(response);
						$('#load_SN').html(response);
						$('#tbl_loadSN').DataTable({
							"lengthMenu": [ 5,10, 15, 20, 25, 50, 75, 100, 1000 ]
						});
					}
				});
			});

			//Load du lieu
			function LoadData(){
				$.ajax({
					url: "<?php echo $HomeURL; ?>/nhanvien/ajax_sn.php",
					method: "POST",
					success:function(data){
						$('#load_SN').html(data);
						$('#tbl_loadSN').DataTable({
							"lengthMenu": [ 10, 15, 20, 25, 50, 75, 100, 1000 ]
						});
					}
				});
			}
			//Xuất Excel
			$('#xuates').on('click',function(){
				$("#tbl_loadSN").table2excel({
			    exclude: ".btn",
			    name: "NHANVIEN",
			    filename: "SinhNhat_" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
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