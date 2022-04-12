<?php
    session_start();
?>
<?php include('../dbconnect.php'); ?>
<?php  
  include('session.php');
?>
<?php include('permission.php'); ?>
<?php 
$Sothe = $_SESSION['UserN'];
//Load mã nhân viên
$laysothe = "SELECT A.*,B.avatarUser,B.Password FROM NHANVIEN A INNER JOIN users B ON A.MaNV=B.MaNV WHERE A.MaNV='$Sothe'";
$truyvansothe = mysqli_query($con,$laysothe);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Thông tin cá nhân</title>
  <link rel="icon" href="../res/image/fav.ico" type="image/ico">
    <link href="../res/BS5/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../res/BS5/js/bootstrap.min.js"></script>
    <script src="../res/BS5/jquery/jquery.min.js"></script>
    <link href="../res/BS5/dashboard/dashboard.css" rel="stylesheet">
    <link href="../res/font/quicksand.css" rel="stylesheet">
    <link href="../res/BS5/dashboard/container.css" rel="stylesheet">
    <script src="../res/BS5/jquery/sweetalert.min.js"></script>
    <style type="text/css">

      .main-body {
          padding: 15px;
      }
      .card {
          box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
      }

      .card {
          position: relative;
          display: flex;
          flex-direction: column;
          min-width: 0;
          word-wrap: break-word;
          background-color: #fff;
          background-clip: border-box;
          border: 0 solid rgba(0,0,0,.125);
          border-radius: .25rem;
      }

      .card-body {
          flex: 1 1 auto;
          min-height: 1px;
          padding: 1rem;
      }

      .gutters-sm {
          margin-right: -8px;
          margin-left: -8px;
      }

      .gutters-sm>.col, .gutters-sm>[class*=col-] {
          padding-right: 8px;
          padding-left: 8px;
      }
      .mb-3, .my-3 {
          margin-bottom: 1rem!important;
      }

      .bg-gray-300 {
          background-color: #e2e8f0;
      }
      .h-100 {
          height: 100%!important;
      }
      .shadow-none {
          box-shadow: none!important;
      }
      #navbarDropdown{
      position: relative;
      right: 60px;
      }
    </style>
</head>
<body>
<!--Header-->
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" id="Home" href="<?php echo $HomeURL; ?>/index.php"><b>QUẢN LÝ NHÂN SỰ</b></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="navbar-nav">
    <div class="nav-item">
        <a class="nav-link" id="navbarDropdown" role="button" data-bs-toggle="collapse" data-bs-target="#menudrop">Xin chào.  <i style='color: red;font-weight: bold;'><?php  echo $_SESSION['HoTen'];  ?></i>
        </a>
        <div id="menudrop" class="collapse sticky-top bg-light">
            <a class="dropdown-item" href="<?php echo $HomeURL; ?>/admin/info.php">Đổi mật khẩu</a>
            <li><hr class="dropdown-divider"></li>
            <a class="dropdown-item" href="<?php echo $HomeURL; ?>/admin/dangxuat.php">Đăng xuất</a>
        </div>
    </div>
  </div>
  <?php  
    if (mysqli_num_rows($truyvansothe)>0) {
      $rowsothe = mysqli_fetch_array($truyvansothe);
  ?>
  <?php 
    if (strlen($rowsothe['avatarUser'])>0) {
      echo "<img style='position: absolute; right: 10px;' class='rounded-circle' height='40px;' width='40px' src='../uploads/".$rowsothe['avatarUser']."'>";
    }else {
      echo "<img style='position: absolute; right: 10px;' height='40px;' width='40px' src='../res/image/profile.svg'>";
    }
  ?>
  <!--<img style='position: absolute; right: 10px;' height='40px;' width='40px' src='../res/image/profile.svg'>-->
</header>
<!--Menu-->
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" id="nhanvien_page" aria-current="page" href="<?php echo $HomeURL; ?>/nhanvien/index.php">
              <span data-feather="users"></span>
              NHÂN VIÊN
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="donvi_page" href="<?php echo $HomeURL; ?>/donvi/index.php">
              <span data-feather="grid"></span>
              ĐƠN VỊ
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="bangcap_page" href="<?php echo $HomeURL; ?>/bangcap/index.php">
              <span data-feather="file-text"></span>
              MÃ BẰNG CẤP
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="daotao_page" href="<?php echo $HomeURL; ?>/loaihinhdaotao/index.php">
              <span data-feather="layers"></span>
              LOẠI HÌNH ĐÀO TẠO
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="hoctap_page" href="<?php echo $HomeURL; ?>/qthoctap/index.php">
              <span data-feather="activity"></span>
              QUÁ TRÌNH HỌC TẬP
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="congtac_page" href="<?php echo $HomeURL; ?>/qtcongtac/index.php">
              <span data-feather="briefcase"></span>
              QUÁ TRÌNH CÔNG TÁC
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>KHEN THƯỞNG - KỶ LUẬT</span>
          <a class="link-secondary" href="#">
            <span data-feather="filter"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" id="danhmuc_page" href="<?php echo $HomeURL; ?>/danhmucKTKL/index.php">
              <span data-feather="menu"></span>
              DANH MỤC
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="cap_page" href="<?php echo $HomeURL; ?>/capKTKL/index.php">
              <span data-feather="award"></span>
              CẤP
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chitiet_page" href="<?php echo $HomeURL; ?>/chitietKTKL/index.php">
              <span data-feather="file-text"></span>
              CHI TIẾT
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>
<!--Menu-->
<!--End Header-->
<!--Body-->
<div class="col-md-9 ms-sm-auto col-lg-9">
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <?php 
                      if (strlen($rowsothe['avatarUser'])>0) {
                        echo "<img src='../uploads/".$rowsothe['avatarUser']."' alt='Admin' width='150'>";
                      }else {
                        echo "<img src='../res/image/profile.svg' alt='Admin' class='rounded-circle' width='150'>";
                      }
                    ?>
                    <div class="mt-3">
                      <h4><?php  echo $_SESSION['HoTen'];  ?></h4>
                      <p class="text-secondary mb-1"><?php echo $rowsothe['NgaySinh']; ?></p>
                      <p class="text-muted font-size-sm"><?php echo $rowsothe['DiaChi']; }?></p>
                      <input type="file" name="file" id="file" /></br>
                      <button class="btn btn-info" id="uphinh" name="uphinh">OK</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <h4><center><b>Thông tin cá nhân</b></center></h4>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-group"><h6>Mật khẩu hiện tại</h6></label>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="password" name="pw" id="pw" value="<?php echo $rowsothe['Password']; ?>" class="form-control" readonly>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-group"><h6>Mật khẩu mới</h6></label>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="password" name="pwn" id="pwn" class="form-control">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-group"><h6>Xác nhận mật khẩu mới</h6></label>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="password" name="pwn2" id="pwn2" class="form-control">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="hidden" name="sothehid" id="sothehid" value="<?php echo $_SESSION['UserN']; ?>">
                      <button class="btn btn-success" id="doimk" name="doimk"> Đổi mật khẩu</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
<!--End Body-->
<?php include('../footer.html'); ?>
<script src="../res/BS5/dist/feather.min.js"></script>
<script src="../res/BS5/dashboard/dashboard.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#doimk').on('click',function(){
      var matkhaumoi = $('#pwn').val();
      var xacnhan = $('#pwn2').val();
      var sothe = $('#sothehid').val();
      if (matkhaumoi!=xacnhan) {
        swal("Cảnh báo","Mật khẩu xác nhận không khớp với mật khẩu mới.","warning");
      }else {
        if (matkhaumoi==''||xacnhan=='') {
          swal("Cảnh báo","Vui lòng không được bỏ trống thông tin.","warning");
        }else {
          $.ajax({
            url: 'upload_avatar.php',
            method: 'post',
            data: {matkhaumoi:matkhaumoi,sothe:sothe},
            success: function(data){
              alert(data);
              if (data==1) {
                swal("Thông báo","Đổi mật khẩu thành công","success");
              }else {
                swal("Thông báo","Đổi mật khẩu không thành công","error");
              }
            }
          });
        }
      }
    });

    $('#uphinh').on('click',function(){
      //Lấy ra files
      var file_data = $('#file').prop('files')[0];
      //lấy ra kiểu file
      var type = file_data.type;
      //Xét kiểu file được upload
      var match= ["image/gif","image/png","image/jpg","image/jpeg"];
      if (type == match[0] || type == match[1] || type == match[2]|| type == match[3]) {
        var form_data = new FormData();
        form_data.append('file',file_data);
        $.ajax({
          url: 'upload_avatar.php',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(res){
            alert(res);
            if (res==1) {
              swal("Thông báo","Upload thành công","success");
            }else {
              swal("Thông báo","Upload không thành công","error");
            }
          }
        });
      }else{
        swal("Thông báo","Định dạng ảnh không được hỗ trợ","error");
      }
    });
  });
</script>
</body>
</html>