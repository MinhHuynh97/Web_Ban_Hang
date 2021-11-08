<?php
include_once('../db/connect.php');
?>

<?php

if(isset($_POST['capnhatdonhang']))
{
    $xuly=$_POST['xuly'];
    
    $mahang_capnhat=$_POST['mahang_xuly'];
    $sql_capnhat_donhang=mysqli_query($con,"UPDATE tbl_donhang set status_donhang='$xuly' where mahang='$mahang_capnhat'");
    $sql_capnhat_giaodich=mysqli_query($con,"UPDATE tbl_giaodich set status_giaodich='$xuly' where magiaodich='$mahang_capnhat'");

}

?>

<?php
if (isset($_GET['quanly']))
{
    if($_GET['quanly']=='dangxuat')
    {
        unset($_SESSION['dangnhap']);
        header('Location: login.php');
    }
}
if(isset($_GET['xoadonhang']))
{
    
    $ma_donhang_delete=$_GET['xoadonhang'];
    $sql_delete_donhang=mysqli_query($con,"DELETE from tbl_donhang where mahang='$ma_donhang_delete'");
    header('Location: xulydonhang.php');
}elseif(isset($_GET['huydonhang']))
{
    
    $mahang_huy=$_GET['huydonhang'];
    $sql_capnhat_donhang=mysqli_query($con,"UPDATE tbl_donhang set status_donhang='2' where mahang='$mahang_huy'");
    $sql_capnhat_giaodich=mysqli_query($con,"UPDATE tbl_giaodich set status_giaodich='2' where magiaodich='$mahang_huy'");
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
    <div class="container">
        <div style="text-align: center;" class="row">
            
            
            <div style="padding:0"  class="col-md-12">
                <h4>Liệt kê đơn hàng</h4>
                <table class="table table-bordered ">
                    <tr>
                        <th>Thứ tự </th>
                        <th>Tên khách hàng </th>
                        <th>Tình trạng đơn hàng </th>

                        <th>Mã hàng </th>
                        <th>Ngày đặt</th>
                        <th>Ghi chú</th>
                        <th>Yêu cầu huỷ</th>

                        <th>Quản lý</th>

                    </tr>
                    <?php
                    $i=0;
                    $sql_select_donhang=mysqli_query($con,"SELECT * from tbl_sanpham as sp,tbl_khachhang as kh,tbl_donhang as dh where dh.sanpham_id =sp.sanpham_id and dh.khachhang_id=kh.khachhang_id group by dh.mahang having count(dh.mahang)>1 order by dh.donhang_id desc");
                    while($row_select_donhang=mysqli_fetch_array($sql_select_donhang)){
                        $i++;

                    ?>
                    <tr >
                        
                        <td><?php echo $i ?></td>
                        <td><?php echo $row_select_donhang['name'] ?></td>
                        <td><?php
                            if($row_select_donhang['status_donhang']=='0')
                            {
                                echo "Chưa xử lý";
                            }elseif($row_select_donhang['status_donhang']=='2')
                            {
                                echo "Đã huỷ";
                            }else
                            {
                                echo "Đã xác nhận và gửi hàng";
                            }
                        ?></td>
                        
                        <td><?php echo $row_select_donhang['mahang'] ?></td>
                        <td><?php echo $row_select_donhang['ngaythang'] ?></td>
                        <td><?php echo $row_select_donhang['note'] ?></td>
                        <td>
                            
                            <?php
                                $mahang=$row_select_donhang['mahang'];
                                
                                $sql_select_huy_giaodich=mysqli_query($con,"SELECT * from tbl_giaodich as gd,tbl_donhang as dh where dh.mahang='$mahang' and dh.mahang=gd.magiaodich group by gd.magiaodich order by gd.giaodich_id limit 1  ");
                                $row_elect_huy_giaodich=mysqli_fetch_array($sql_select_huy_giaodich);
                                    if( $row_elect_huy_giaodich['status_giaodich']=='2' &&$row_elect_huy_giaodich['status_donhang']!='2'){
                                    
                                ?>
                                
                                    <a href="?huydonhang=<?php echo $row_elect_huy_giaodich['magiaodich'] ?>">Xác nhận yêu cầu huỷ</a>
                                <?php 
                                }elseif($row_elect_huy_giaodich['status_giaodich']=='2' &&$row_elect_huy_giaodich['status_donhang']=='2'){
                                ?>
                                    <p>Đã huỷ</p>
                                <?php 
                                    
                                }
                                ?>    
                               
                        </td>
                        <td >
                            <a href="?xoadonhang=<?php echo $row_select_donhang['mahang'] ?>" >Xoá</a>
                            <a href="xulydonhang.php?quanly=xemdonhang&mahang=<?php echo $row_select_donhang['mahang'] ?>" >Xem đơn hàng</a>

                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
            <?php
                if(isset($_GET['quanly'])=='xemdonhang')
                {
                    $mahang=$_GET['mahang'];
                    $sql_donhang=mysqli_query($con,"SELECT * from tbl_donhang as dh,tbl_sanpham as sp where dh.sanpham_id=sp.sanpham_id and dh.mahang='$mahang'");
                    
                    
            ?>
            <p>Xem chi tiết đơn hàng của <?php ?></p>
            <div style="padding:0;height:300px"  class="col-md-12">
                <form action="" method="POST">
                <table  class="table table-bordered ">
                    <tr>
                        <th>Thứ tự </th>
                        <th>Mã hàng</th>

                        <th>Tên sản phẩm </th>

                        <th>Tổng giá </th>
                        <th>Số lượng</th>

                        <th>Ngày đặt</th>

                    </tr>
                    <?php
                    $i=0;
                    while($row_donhang=mysqli_fetch_array($sql_donhang)){
                        $i++;
                    ?>
                    <tr >
                        
                        <td><?php echo $i ?></td>
                        <td><?php echo $row_donhang['mahang'] ?></td>

                        <td><?php echo $row_donhang['sanpham_name'] ?></td>
                        <td><?php echo number_format($row_donhang['sanpham_gia']* $row_donhang['soluong']) ." vnd"?></td>
                        
                        <td><?php echo $row_donhang['soluong'] ?></td>
                        <td><?php echo $row_donhang['ngaythang'] ?></td>
                        <input type="hidden" value="<?php echo $row_donhang['mahang'] ?> " name="mahang_xuly">
                        
                    </tr>
                    <?php
                        }
                    
            
                    ?>
                </table>
                <select style="max-width:30%;align-content:center;display:inline-flex" class="form-control" name="xuly" >
                   
                    <option value="1">Đã xử lý</option>
                    
                    <option value="0">Chưa xử lý</option>
                    
                </select>
                <input  type="submit" value="Cập nhật" class="btn btn-success" name="capnhatdonhang">
                </form>
                <?php
                }
                ?>
            </div>
            
        </div>
    </div>
</body>
</html>