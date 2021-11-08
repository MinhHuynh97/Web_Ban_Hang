<?php
include_once('../db/connect.php');
if (isset($_GET['quanly']))
    {
        if($_GET['quanly']=='dangxuat')
        {
            unset($_SESSION['dangnhap']);
            header('Location: login.php');
        }
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
                <a class="nav-link" href="xulybaiviet.php">Bài viết</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="?quanly=dangxuat">Đăng xuất</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div style="max-width: 95%;"  class="container">
        <div class="row">
            
            <div  class="col-md-12">
                <h4 style="font-size: 30px;">Liệt kê danh mục</h4>
                <table style="text-align: center;" class="table table-bordered ">
                    <tr>
                        <th>Thứ tự </th>
                        <th>Tên khách hàng </th>
                        <th>Số điện thoại </th>

                        <th>Địa chỉ </th>
                        <th>Email</th>
                        <th>Giao Note</th>

                        <th>Quản lý</th>

                    </tr>
                    <?php
                    $i=0;
                    $sql_select_khachhang=mysqli_query($con,"SELECT * from tbl_khachhang as kh,tbl_giaodich as gd where kh.khachhang_id=gd.khachhang_id group by kh.khachhang_id having count(kh.khachhang_id)>1 order by kh.khachhang_id desc");
                    while($row_select_khachhang=mysqli_fetch_array($sql_select_khachhang)){
                        $i++;

                    ?>
                    <tr >
                        
                        <td><?php echo $i ?></td>
                        <td><?php echo $row_select_khachhang['name'] ?></td>
                        <td><?php echo $row_select_khachhang['phone'] ?></td>
                        <td><?php echo $row_select_khachhang['address'] ?></td>
                        <td><?php echo $row_select_khachhang['email'] ?></td>
                        <td><?php echo $row_select_khachhang['note'] ?></td>
                        <td>
                            <a href="?quanly=xemdonhang&khachhang=<?php echo $row_select_khachhang['magiaodich'] ?>">Xem giao dịch</a>
                        </td>

                        
                        
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
            <?php
                if(isset($_GET['khachhang']))
                {
            ?>
            <div class="col-md-12">
                <h4 style="font-size: 30px;">Liệt kê lịch sử đơn hàng</h4>
                <table style="text-align: center;" class="table table-bordered ">
                    <tr>
                        <th>Thứ tự </th>
                        <th>Mã giao dịch </th>
                        <th>Tên sản phẩm </th>
                        <th>Ngày đặt</th>

                    </tr>
                    <?php
                    $i=0;
                    $sql_select_giaodich=mysqli_query($con,"SELECT * from tbl_khachhang as kh,tbl_giaodich as gd,tbl_sanpham as sp where sp.sanpham_id=gd.sanpham_id and kh.khachhang_id=gd.khachhang_id order by gd.giaodich_id desc");
                    while($row_select_giaodich=mysqli_fetch_array($sql_select_giaodich)){
                        $i++;

                    ?>
                    <tr >
                        
                        <td><?php echo $i ?></td>
                        <td><?php echo $row_select_giaodich['magiaodich'] ?></td>
                        <td><?php echo $row_select_giaodich['sanpham_name'] ?></td>
                        <td><?php echo $row_select_giaodich['ngaythang'] ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>