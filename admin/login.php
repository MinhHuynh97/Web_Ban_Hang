<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
session_start();
include('../db/connect.php');
?>
<?php
    if(isset($_POST['dangnhap']))
    {
        $taikhoan=$_POST['taikhoan'];
        $matkhau=md5($_POST['matkhau']);
        if($matkhau =='' || $taikhoan=='')
        {
            echo '<p>Xin nhập đủ<p>';
        }
        else{
            $sql_select_admin=mysqli_query($con,"SELECT * from tbl_admin where email='$taikhoan' AND password = '$matkhau' limit 1");
            $row_dangnhap=mysqli_fetch_array($sql_select_admin);
            $count=mysqli_num_rows($sql_select_admin);  
            if($count>0){
                $_SESSION["dangnhap"]=$row_dangnhap['admin_name'];
               
                $_SESSION["admin_id"]=$row_dangnhap['admin_id'];
                header('Location:  dashboard.php' );
            }else{
                echo "Tài khoản mật khẩu sai";
            }
        }
    }
?>
<!DOCTYPE html>
<head>
<title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Login :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="../css/backend/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="../css/backend/style.css" rel='stylesheet' type='text/css' />
<link href="../css/backend/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="../css/backend/font.css" type="text/css"/>
<link href="../css/backend/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="../js/backend/jquery2.0.3.min.js"></script>
<style>
    html{
        background-color: rgba(171, 119, 157, 0.27);
    }
</style>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Sign In Now</h2>
		<form action="" method="post">
			<input type="text" class="ggg" name="taikhoan" placeholder="Điền email/tên đăng nhập" required="">
			<input type="password" class="ggg" name="matkhau" placeholder="Điền mật khẩu" required="">
			<input type="submit" value="Đăng nhập admin" name="dangnhap">
		</form>
		
</div>
</div>
<script src="../js/backend/bootstrap.js"></script>
<script src="../js/backend/jquery.dcjqaccordion.2.7.js"></script>
<script src="../js/backend/scripts.js"></script>
<script src="../js/backend/jquery.slimscroll.js"></script>
<script src="../js/backend/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="../js/backend/jquery.scrollTo.js"></script>
</body>
</html>
