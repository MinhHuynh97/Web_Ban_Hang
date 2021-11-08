<?php
    session_start();
?>
<?php
    
    if(!isset($_SESSION['dangnhap']))
    {
        header('Location: index.php' );
    }
?>
<?php
    if(isset($_GET['login']))
    {
        $dangxuat=$_GET['login'];

    }else
    {
        $dangxuat='';
    }
    if($dangxuat=='dangxuat')
    {
        unset($_SESSION['dangnhap']);
        header('Location: index.php');

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin  </title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="xulydonhang.php">Đơn hàng</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="xulydanhmuc.php">Danh mục sản phẩm</a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="xulymuctin.php">Danh mục tin</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="login.php"><?php unset($_SESSION['dangnhap']); ?>Đăng xuất</a>
                </li>
                
            </ul>
            </div>
        </div>
    </nav>
</body>
</html>