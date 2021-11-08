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
    if(isset($_POST['themdanhmuctin']))
    {
        $tendanhmuctin=$_POST['danhmuctin'];
        $sql_insert_muctin=mysqli_query($con,"INSERT INTO tbl_danhmuctin(tendanhmuc) values ('$tendanhmuctin')");
    }
    if(isset($_GET['xoa']))
    {   
        $xoa_danhmuctin_id=$_GET['xoa'];
        $sql_delete_danhmuctin=mysqli_query($con,"DELETE from tbl_danhmuctin where danhmuctin_id='$xoa_danhmuctin_id' ");
    }
    elseif(isset($_POST['suadanhmuctin']))
    {
        $id_sua_danhmuctin=$_GET['sua'];
        $tendanhmuctin=$_POST['danhmuctin'];
        $sql_insert_sua=mysqli_query($con,"UPDATE tbl_danhmuctin set tendanhmuc='$tendanhmuctin' where danhmuctin_id='$id_sua_danhmuctin'");
        header('Location: xulymuctin.php');
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
                 if (isset($_GET['sua'])){
                ?>
                <h4 style="font-size: 30px;">Sửa danh mục</h4>
                <label for="">Tên danh mục tin</label>
                <form action="" method="post">
                    
                    <input type="text" value="<?php
                    $name_danhmuctin=$_GET['sua'];
                    $sql_name_sua_danhmuctin=mysqli_query($con,"SELECT * from tbl_danhmuctin where danhmuctin_id='$name_danhmuctin'"); 
                    $row_name_sua_danhmuctin=mysqli_fetch_array($sql_name_sua_danhmuctin);
                    echo $row_name_sua_danhmuctin['tendanhmuc'];
                    ?>" class="form-control" name="danhmuctin"><br>
                    <input type="submit" value="Sửa danh mục tin" name="suadanhmuctin" style="margin-top: 10px;" class="btn btn-success">

                </form>
                
                <?php
                 }
                 
                 else{
                ?>
                <h4 style="font-size: 30px;">Thêm danh mục</h4>
                <label for="">Tên danh mục tin</label>
                <form action="" method="post">
                    <input type="text" placeholder="Tên danh mục tin" class="form-control" name="danhmuctin">
                    <input type="submit" value="Thêm danh mục tin" name="themdanhmuctin" style="margin-top: 10px;" class="btn btn-success">

                </form>
                <?php
                 }
                 
                ?>
                
            </div>
            <div class="col-md-8">
                <h4 style="font-size: 30px;">Liệt kê danh mục tin</h4>
                <table class="table table-bordered ">
                    <tr>
                        <th>Thứ tự </th>
                        <th>Tên danh mục tin </th>
                        <th>Quản lý</th>
                    </tr>
                    <?php
                    $i=0;
                    $sql_select_danhmuctin=mysqli_query($con,"SELECT * from tbl_danhmuctin order by danhmuctin_id desc");
                    while($row_select_danhmuctin=mysqli_fetch_array($sql_select_danhmuctin)){
                        $i++;
                    ?>
                    <tr <?php 
                            if(isset($_GET['sua'])){
                            if($_GET['sua']==$row_select_danhmuctin['danhmuctin_id'])
                            {
                                
                                $a='style="background-color: antiquewhite;"';
                                echo $a;
                            } }
                        ?>>
                        
                        <td><?php echo $i ?></td>
                        <td><?php echo $row_select_danhmuctin['tendanhmuc'] ?></td>
                        <td >
                            <a href="?xoa=<?php echo $row_select_danhmuctin['danhmuctin_id'] ?>" >Xoá</a>
                            <a href="?sua=<?php echo $row_select_danhmuctin['danhmuctin_id'] ?>" >Sửa</a>

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