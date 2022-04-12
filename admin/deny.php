<?php include_once('../dbconnect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng Nhập</title>
    <link rel="icon" href="../res/image/fav.ico" type="image/ico">
    <!-- Bootstrap core Library -->
    <link href="../res/BS3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Google font -->
    <link href="../res/font/dancing.css" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="../res/BS4/css/font-awesome.min.css" rel="stylesheet">
    <style type="text/css">
        /*author:starttemplate*/
        /*reference site : starttemplate.com*/
        body {
          /*background-image:url('https://i.redd.it/o8dlfk93azs31.jpg');*/
          background-image:url('../res/image/bg_login.jpg');
          background-position:center;
          background-size:cover;
          
          -webkit-font-smoothing: antialiased;
          font: normal 14px Roboto,arial,sans-serif;
          font-family: 'Dancing Script', cursive!important;
        }
        a{
            color: lightblue;
            font-weight: bold;
        }
        .container {
            padding: 40px;
        }
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #ffffff!important;
            opacity: 1; /* Firefox */
            font-size:18px!important;
        }
        .form-login {
            background-color: rgba(0,0,0,0.55);
            padding-top: 10px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
            border-radius: 15px;
            border-color:#d2d2d2;
            border-width: 5px;
            color:white;
            box-shadow:0 1px 0 #cfcfcf;
        }
        .form-control{
            background:transparent!important;
            color:white!important;
            font-size: 18px!important;
        }
        h1{
            color:white!important;
        }
        h4 { 
         border:0 solid #fff; 
         border-bottom-width:1px;
         padding-bottom:10px;
         text-align: center;
        }

        .form-control {
            border-radius: 10px;
        }
        .text-white{
            color: white!important;
        }
        .wrapper {
            text-align: center;
        }
        .footer p{
            font-size: 18px;
        }
    </style>
</head>
<body>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8 text-center">
            
            <div class="form-login">
                <p class='text-white' style="font-size: 38px">Hệ Thống Quản Lý Nhân Sự</p>
                <hr>
                </br>
                <p style="color: red;font-size: 28px">Thông báo</p><br><br><br>
                <center><p style="color: orange;font-size: 28px">Bạn không đủ quyền truy cập vào trang này</p></center><br>
                <br><br>
                <a href='<?php echo $HomeURL; ?>/admin/dangnhap.php'><p style="color:lightblue;font-size: 28px">Click để về lại trang đăng nhập</p></a>
                <br><br><br><br>
            </div>
        </div>
    </div>
    </br></br></br>
    <!--footer-->
    <div class="footer text-white text-center">
        <center><p>© 2022 Đăng Nhập. All rights reserved | Design by <a href="https://freecss.tech">Free Css</a></p></center>
    </div>
    <!--//footer-->
</div>
</body>
</html>
