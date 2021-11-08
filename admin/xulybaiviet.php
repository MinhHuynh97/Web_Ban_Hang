<?php
include_once('../db/connect.php');
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
    if(isset($_POST['thembaiviet']))
    {
        $tenbaiviet=$_POST['tenbaiviet'];
       
        $chitiet=$_POST['chitiet'];
        
        $mota=$_POST['mota'];
        
        $hinhanh=$_FILES['hinhanh']['name'];
        
        $hinhanh_tmp=$_FILES['hinhanh']['tmp_name'];
        
        $danhmuc=$_POST['danhmuctin'];

        $path='../uploads/';
        $sql_insert_baiviet=mysqli_query($con,"INSERT INTO tbl_baiviet(tenbaiviet,tomtat,noidung,baiviet_image,danhmuc_id) 
        values ('$tenbaiviet','$chitiet','$mota','$hinhanh','$danhmuc')");
        move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
        
    }elseif(isset($_GET['xoa']))
    {
        $id_sanpham_delete=$_GET['xoa'];
        $sql_delete_sanpham=mysqli_query($con,"DELETE FROM tbl_baiviet where baiviet_id='$id_sanpham_delete'");
    }
    elseif(isset($_POST['suabaiviet'])){
        
        $id_sanpham_update=$_POST['id_update'];
        $tenbaiviet=$_POST['tenbaiviet'];
       
        $chitiet=$_POST['chitiet'];
        
        $mota=$_POST['mota'];
        
        $hinhanh=$_FILES['hinhanh']['name'];
        
        $hinhanh_tmp=$_FILES['hinhanh']['tmp_name'];
        
       
        
        $danhmuc=$_POST['danhmuc'];
        
        $path='../uploads/';
        if($hinhanh=='')
        {
            $sql_update_sanpham="UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet',tomtat='$chitiet',noidung='$mota',danhmuc_id='$danhmuc' WHERE baiviet_id='$id_sanpham_update' "; 
            $update_1=mysqli_query($con,$sql_update_sanpham);  
            
        }else{
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
            $sql_update_sanpham="UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet',tomtat='$chitiet',baiviet_image='$hinhanh',noidung='$mota',danhmuc_id='$danhmuc' WHERE baiviet_id='$id_sanpham_update' "; 
            
            $update_2=mysqli_query($con,$sql_update_sanpham); 
            
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
    <div style="max-width: 95%;" class="container">
        <div class="row">
            <div class="col-md-4">
                <?php

                    if(isset($_GET['sua']))
                    {
                        $id_sua_sanpham=$_GET['sua'];
                        $sql_select_sua=mysqli_query($con,"SELECT * from tbl_baiviet where baiviet_id='$id_sua_sanpham'");
                        $row_sua_sanpham=mysqli_fetch_array($sql_select_sua);
                ?>
                <h4 style="font-size: 30px;">Sửa bài viết</h4>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Tên bài viết</label>
                    <input type="text" value="<?php echo $row_sua_sanpham['tenbaiviet']  ?>" class="form-control" name="tenbaiviet">
                    <input type="hidden" value="<?php echo $row_sua_sanpham['baiviet_id']  ?>" class="form-control" name="id_update">
                    
                    <label for="">Hình ảnh</label>
                    <input type="file" name="hinhanh" class="form-control">
                    <img src="../uploads/<?php echo $row_sua_sanpham['baiviet_image']?>" height="80" width="80"><br>
                    <label for="">Chi tiết</label>
                    <textarea rows="10" name="chitiet" class="form-control" ><?php echo $row_sua_sanpham['tomtat']  ?></textarea>
                    <label for="">Mô tả</label>
                    <textarea rows="10" name="mota" class="form-control" ><?php echo $row_sua_sanpham['noidung']  ?></textarea>
                    
                    
                    <label for="">Danh mục tin</label>
                    <select name="danhmuc" class="form-control">
                        <option value="">----Chọn danh mục tin-----</option>
                        <?php
                            $sql_select_danhmuc=mysqli_query($con,"SELECT * from tbl_danhmuctin order by danhmuctin_id desc");
                            while($row_select_danhmuc=mysqli_fetch_array($sql_select_danhmuc)){
                                if($row_select_danhmuc['danhmuctin_id']==$row_sua_sanpham['danhmuc_id'])
                                {
                        ?>
                        <option selected value="<?php echo $row_select_danhmuc['danhmuctin_id'] ?>"><?php echo $row_select_danhmuc['tendanhmuc'] ?></option>
                        <?php
                            }else{
                        ?>
                        <option  value="<?php echo $row_select_danhmuc['danhmuctin_id'] ?>"><?php echo $row_select_danhmuc['tendanhmuc'] ?></option>
                        <?php
                            }
                        }
                        ?>

                    </select><br>
                    <input  type="submit" class="btn btn-success" name="suabaiviet" value="Sửa bài viết">
                </form>
                <?php
                    }
                    else
                    {
                ?>
                <h4 style="font-size: 30px;">Thêm bài viết</h4>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Tên bài viết</label>
                    <input type="text" placeholder="Tên bài viết" class="form-control" name="tenbaiviet">
                    
                    <label for="">Chi tiết</label>
                    <textarea name="chitiet" class="form-control" placeholder="Chi tiết"></textarea>
                    <label for="">Mô tả</label>
                    <textarea name="mota" class="form-control" placeholder="Mô tả"></textarea>
                    <label for="">Hình ảnh</label>
                    <input type="file" placeholder="Thêm hình ảnh" name="hinhanh" class="form-control">
                    <label for="">Danh mục tin</label>
                    <select name="danhmuctin" class="form-control">
                        <option value="">----Chọn danh mục tin----</option>
                        <?php
                            $sql_select_danhmuc=mysqli_query($con,"SELECT * from tbl_danhmuctin order by danhmuctin_id desc");
                            while($row_select_danhmuc=mysqli_fetch_array($sql_select_danhmuc)){
                        ?>
                        <option value="<?php echo $row_select_danhmuc['danhmuctin_id'] ?>"><?php echo $row_select_danhmuc['tendanhmuc'] ?></option>
                        <?php
                            }
                        ?>
                    </select><br>
                    <input  type="submit" class="btn btn-success" name="thembaiviet" value="Thêm bài viết">
                </form>
                <?php
                    }
                ?>
                
                
            </div>
            <div class="col-md-8">
                <h4 style="font-size: 30px;">Liệt kê bài viết</h4>
                <table style="text-align: center;" class="table table-bordered ">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên bài viết </th>
                        
                        <th>Hình ảnh</th>
                        <th>Danh mục</th>
                        <th>Quản lý</th>
                    </tr>
                    <?php
                    $i=0;
                    $sql_view=mysqli_query($con,"SELECT * from tbl_baiviet as bv,tbl_danhmuctin as dmt where bv.danhmuc_id=dmt.danhmuctin_id order by bv.baiviet_id desc");
                    while($row_view=mysqli_fetch_array($sql_view)){
                        $i++;
                    ?>
                    <tr
                    <?php 
                            if(isset($_GET['sua'])){
                            if($_GET['sua']==$row_view['baiviet_id'])
                            {
                                
                                $a='style="background-color: antiquewhite;"';
                                echo $a;
                            } }
                        ?>
                    >
                        
                        <td><?php echo $i ?></td>
                        <td><?php echo $row_view['tenbaiviet'] ?></td>
                       

                        <td><img style="width: 100px; height:50;" src="../uploads/<?php echo $row_view['baiviet_image'] ?>" alt="chưa load"> </td>
                        
                        <td><?php echo $row_view['tendanhmuc'] ?></td>
                        <td>
                            <a href="?xoa=<?php echo $row_view['baiviet_id'] ?>" >Xoá</a>
                            <a href="xulybaiviet.php?quanly=baiviet&sua=<?php echo $row_view['baiviet_id'] ?>" >Sửa</a>
                        </td>

                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>