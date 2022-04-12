<?php
if (isset($_SESSION['UserN']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: '.$HomeURL.'/admin/dangnhap.php?t=fail');
}else {
	if (isset($_SESSION['Admin']) == true) {
		// Ngược lại nếu đã đăng nhập
		$permission = $_SESSION['Admin'];
		// Kiểm tra quyền của người đó có phải là admin hay không
		if ($permission == '0') {
			// Nếu không phải admin thì xuất thông báo
			include('deny.php');
			session_destroy();
			exit();
		}
	}
}
?>