<?php include("../dbconnect.php"); ?>
<?php 
    if (isset($_POST['MaNV'])) {
        $MaNV = $_POST['MaNV'];
        $HoTenUser = $_POST['TenNVu'];
        $Password = $_POST['Password'];
        $Email = $_POST['Email'];
        $DanhMuc = $_POST['DanhMuc'];
        $Admin = $_POST['Admin'];
        if ($MaNV==''||$TenNVu=''||$Password==''||$Email=='') {
            swal("Cảnh báo","Dữ liệu không được bỏ trống","warning");
        }else{
            $sql = "INSERT INTO users VALUES('$MaNV','$HoTenUser','$Password','$Email','$DanhMuc',$Admin,'-')";
            $resultdky = mysqli_query($con,$sql);
            if($resultdky){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
?>