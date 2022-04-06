<!--Header-->
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" id="Home" href="http://localhost:8080/QLNS/index.php"><b>QUẢN LÝ NHÂN SỰ</b></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="navbar-nav">
    <div class="nav-item">
        <a class="nav-link" id="navbarDropdown" role="button" data-bs-toggle="collapse" data-bs-target="#menudrop">Xin chào.  <i style='color: red;font-weight: bold;'><?php  echo $_SESSION['HoTen'];  ?></i>
        </a>
        <div id="menudrop" class="collapse sticky-top bg-light">
            <a class="dropdown-item" href="http://localhost:8080/QLNS/admin/info.php">Đổi mật khẩu</a>
            <li><hr class="dropdown-divider"></li>
            <a class="dropdown-item" href="http://localhost:8080/QLNS/admin/dangxuat.php">Đăng xuất</a>
        </div>
    </div>
  </div>
  <?php  
  $rowsotheNV = mysqli_fetch_array($truyvansotheNV);
  ?>
  <?php 
    if (strlen($rowsotheNV['avatarUser'])>0) {
      echo "<img style='position: absolute; right: 10px;' class='rounded-circle' height='40px;' width='40px' src='uploads/".$rowsotheNV['avatarUser']."'>";
    }else {
      echo "<img style='position: absolute; right: 10px;' height='40px;' width='40px' src='../res/image/profile.svg'>";
    }
  ?>
</header>
<!--Menu-->
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" id="nhanvien_page" aria-current="page" href="nhanvien/index.php">
              <span data-feather="users"></span>
              NHÂN VIÊN
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="donvi_page" href="donvi/index.php">
              <span data-feather="grid"></span>
              ĐƠN VỊ
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="bangcap_page" href="bangcap/index.php">
              <span data-feather="file-text"></span>
              MÃ BẰNG CẤP
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="daotao_page" href="loaihinhdaotao/index.php">
              <span data-feather="layers"></span>
              LOẠI HÌNH ĐÀO TẠO
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="hoctap_page" href="qthoctap/index.php">
              <span data-feather="activity"></span>
              QUÁ TRÌNH HỌC TẬP
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="congtac_page" href="qtcongtac/index.php">
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
            <a class="nav-link" id="danhmuc_page" href="danhmucKTKL/index.php">
              <span data-feather="menu"></span>
              DANH MỤC
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="cap_page" href="capKTKL/index.php">
              <span data-feather="award"></span>
              CẤP
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chitiet_page" href="chitietKTKL/index.php">
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