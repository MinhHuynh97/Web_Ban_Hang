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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    
    <title>Đăng nhập Admin</title>
</head>
<body>
    <h5 align="center" >Đăng nhập admin</h5>
    <div class="col-md-6">
        <div class="form-group">
            <form action="" method="post">
                <label for="">Tài khoản</label>
                <input type="text" name="taikhoan" placeholder="Điền email/tên đăng nhập" class="form-control">
                <label for="">Mật khẩu</label>
                <input type="password" name="matkhau" placeholder="Điền mật khẩu" class="form-control">
                <input style="margin-top: 10px;" type="submit" name="dangnhap" class="btn btn-primary" value="Đăng nhập admin">
            </form>
        </div>
    </div>
</body>
</html>