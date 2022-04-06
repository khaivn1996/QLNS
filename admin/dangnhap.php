<?php session_start(); ?>
<?php 
    require("../dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng Nhập</title>
    <link rel="icon" href="../res/image/fav.ico" type="image/ico">
    <!-- Bootstrap core Library -->
    <script src="../res/BS5/jquery/jquery.min.js"></script>
    <script src="../res/BS5/js/bootstrap.bundle.min.js"></script>
    <link href="../res/BS3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../res/BS5/jquery/sweetalert.min.js"></script>
    <!-- Google font -->
    <link href="../res/font/dancing.css" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="../res/BS4/css/font-awesome.min.css" rel="stylesheet">
    <link href="../res/BS5/dashboard/login.css" rel="stylesheet">
    <style type="text/css">
        body {
          /*background-image:url('https://i.redd.it/o8dlfk93azs31.jpg');*/
          background-image:url('http://localhost:8080/QLNS/res/image/bg_login.jpg');
          background-position:center;
          background-size:cover;
          
          -webkit-font-smoothing: antialiased;
          font: normal 14px Roboto,arial,sans-serif;
          font-family: 'Dancing Script', cursive!important;
        }
    </style>
</head>
<body>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-offset-4 col-md-4 text-center">
            <h1 class='text-white'>Hệ Thống<br>Quản Lý Nhân Sự</h1>
            <form action="../index.php" id="dangnhapform" method="post">
                <div class="form-login"></br>
                    <h4>Đăng Nhập</h4>
                    </br>
                    <input type="text" id="userName" name="userName" class="form-control input-sm chat-input" placeholder="Mã nhân viên"/>
                    </br></br>
                    <input type="password" id="userPassword" name="userPassword" autocomplete="on" class="form-control input-sm chat-input" placeholder="Mật khẩu"/>
                    </br></br>
                    <div class="wrapper">
                        <span class="group-btn">
                            <input type="submit" id="btn_dn" name="btn_dn" class="btn btn-success btn-md"value="Đăng nhập" /a>
                        </span>  
                    </div>
                    </br>
                    <i><a href="http://localhost:8080/QLNS/admin/dangky.php">Bạn chưa có tài khoản? Vui lòng đăng ký tại đây.</a></i>
                </div>
            </form>
        </div>
    </div>
    </br></br></br>
    <!--footer-->
    <div class="footer text-white text-center">
        <center><p>© 2022 Đăng Nhập. All rights reserved | Design by <a href="https://freecss.tech">Free Css</a></p></center>
    </div>
    <!--//footer-->
</div>
<?php 
 if (isset($_GET['t'])) {
        echo '<script type="text/javascript">swal("Thông báo","Đăng nhập thất bại, Vui lòng kiểm tra lại.","info");</script>';
    }
?>
</body>
</html>
