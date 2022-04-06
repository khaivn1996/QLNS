<?php include("../dbconnect.php"); ?>
<!------ Include the above in your HEAD tag ---------->
<!--author:starttemplate-->
<!--reference site : starttemplate.com-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng Ký</title>
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
            <h1 class='text-white'>Hệ Thống</br>Quản Lý Nhân Sự</h1>
            <form id="dangkyform" method="post">
                <div class="form-login"></br>
                    <h4>Đăng Ký</h4>
                    </br>
                    <input type="text" id="MaNV" name="MaNV" class="form-control input-sm chat-input" placeholder="Mã nhân viên"/>
                    </br></br>
                    <input type="text" id="TenNVu" name="TenNVu" class="form-control input-sm chat-input" placeholder="Tên nhân viên"/>
                    </br></br>
                    <input type="password" id="Password" name="Password" autocomplete="on" class="form-control input-sm chat-input" placeholder="Mật khẩu"/>
                    </br></br>
                    <input type="text" id="Email" name="Email" class="form-control input-sm chat-input" placeholder="Email"/>
                    </br></br>
                    <select id="DanhMuc" name="DanhMuc" class="form-control">
                        <option value="read">Read-only</option>
                        <option value="read_write">Read/Write</option>
                        <option value="full">Full Control</option>
                    </select>
                    </br></br>
                    <input class="form-check-input" type="checkbox" name="Admin" id="Admin">   Admin
                    </br></br>
                    <div class="wrapper">
                        <input type="button" id ='btn_submit' name="btn_submit" class="btn btn-danger" value="Đăng ký"/>
                        <a href="http://localhost:8080/QLNS/admin/dangnhap.php" class="btn btn-info btn-md">Đăng nhập</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </br></br></br>
    <!--footer-->
    <div class="footer text-white text-center">
        <center><p>© 2022 Đăng Ký. All rights reserved | Design by <a href="https://freecss.tech">Free Css</a></p></center>
    </div>
    <!--//footer-->
<script type="text/javascript">
    $(document).ready(function(){
        $('#btn_submit').on('click',function()
        {
            var MaNV = $('#MaNV').val();
            var TenNVu = $('#TenNVu').val();
            var Password = $('#Password').val();
            var Email = $('#Email').val();
            var DanhMuc = $('#DanhMuc').val();
            var Admin = $('#Admin').is(":checked");
            if (MaNV==''||TenNVu==''||Password==''||Email=='') 
            {
                swal("Cảnh báo","Vui lòng không được bỏ trống thông tin.","warning");
            }
            else 
            {
                $.ajax({
                    url: 'xuly.php',
                    method: 'post',
                    data: {MaNV:MaNV,TenNVu:TenNVu,Password:Password,Email:Email,DanhMuc:DanhMuc,Admin:Admin},
                    success:function(data){
                        if (data==1) 
                        {
                            swal({
                                  title: "Thông báo",
                                  text: "Thêm mới thành công",
                                  icon: "success",
                                  dangerMode: false,
                                })
                                .then((value) => 
                                {
                                    if (value) 
                                    {
                                        $('#dangkyform')[0].reset();
                                    }
                                });
                        }
                        else 
                        {
                            swal("Lỗi","Tài khoản đã tồn tại.","error");
                        }
                    }
                });
            }
        });
    });
</script>
</div>
</body>
</html>