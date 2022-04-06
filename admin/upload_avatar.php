<?php session_start(); ?>
<?php include("../dbconnect.php"); ?>
<?php
    if (isset($_FILES['file'])) {
        $duoi = explode('.', $_FILES['file']['name']);
        $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
        $sothe = $_SESSION['UserN'];
        $tenhinh = $_FILES['file']['name'];
        // Kiểm tra xem có phải file ảnh không
        if ($duoi === 'jpg' || $duoi === 'png' || $duoi === 'gif') {
            // tiến hành upload
            if (move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/' . $tenhinh))
            {
                $sql_hinh = "UPDATE users SET avatarUser='$tenhinh' where MaNV='$sothe'";
                if (mysqli_query($con,$sql_hinh)) {
                    echo 1;
                }else {
                    echo 0;
                }
            }else 
            { // nếu không thành công
                echo 0;
            }
        }else{ // nếu không phải file ảnh
            echo 0;
        }
        
    }
    if (isset($_POST['matkhaumoi'])) {
        $matkhaumoi = $_POST['matkhaumoi'];
        $sothe = $_POST['sothe'];
        $sql_matkhau = "UPDATE users SET matkhau='$matkhaumoi' where MaNV='$sothe'";
        if (mysqli_query($sql_matkhau,$con)) {
            echo 1;
        }else {
            echo 0;
        }
    }   
?>