<?php
$scon = mysqli_connect("localhost","root","","QLNS");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>
<?php 
  if (isset($_POST['userName'])) {
          $sUser = $_POST['userName'];
          $sPass = $_POST['userPassword'];
          $sUser = strip_tags($sUser);
          $sUser = addslashes($sUser);
          $sPass = strip_tags($sPass);
          $sPass = addslashes($sPass);
          $sqldn = "SELECT MaNV,TenNV,Email,Admin FROM users WHERE MaNV='$sUser' AND Password='$sPass'";
          $querydn = mysqli_query($scon,$sqldn);
          $num_row = mysqli_num_rows($querydn);
          if ($num_row==0) 
          {
              echo '';
          }
          else 
          {
            while ($rowdn = mysqli_fetch_array($querydn)) 
            {
              $_SESSION['UserN']= $rowdn['MaNV'];
              $_SESSION['HoTen']=$rowdn['TenNV'];
              $_SESSION['Email']=$rowdn['Email'];
              $_SESSION['Admin']=$rowdn['Admin'];
            }
            //echo $_SESSION['UserN'];
            //echo $_SESSION['HoTen'];
            //echo $_SESSION['Email'];
            //echo $_SESSION['Admin'];
          }
    }
?>