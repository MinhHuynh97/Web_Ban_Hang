<?php
    if(isset($_POST['dangnhap_home']))
    {
        $taikhoan=$_POST['email_login'];
        $matkhau=md5($_POST['password_login']);
        if($matkhau =='' || $taikhoan=='')
        {
            echo '<script> alert("Nhập tên") </script>';
        }
        else{
            $sql_select_admin=mysqli_query($con,"SELECT * from tbl_khachhang where email='$taikhoan' AND password = '$matkhau' limit 1");
            $row_dangnhap=mysqli_fetch_array($sql_select_admin);
            $count=mysqli_num_rows($sql_select_admin);  
            if($count>0){
                $_SESSION["dangnhap_home"]=$row_dangnhap['name'];
                $_SESSION["khachhang_id"]=$row_dangnhap['khachhang_id'];
                
				header('Location:  index.php?quanly=giohang' );
            }else{
                echo '<script> alert("Tài khoản mật khẩu bị sai") </script>';
            }
        }
    }
?>

<?php
	if(isset($_POST['dangky_home']))
	{
		
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$note=$_POST['note'];
	$address=$_POST['address'];
	$password=md5($_POST['password']);
	$sql_khachhang=mysqli_query($con,"INSERT INTO tbl_khachhang(name,phone,address,email,note,password) values ('$name','$phone','$address','$email','$note','$password')");
	$sql_khachang_id=mysqli_query($con,"SELECT * from tbl_khachhang order by khachhang_id desc limit 1 ");
	$row_khachhang_id=mysqli_fetch_array($sql_khachang_id);
	$_SESSION["dangky_home"]=$name;
    $_SESSION["khachhang_dangky_id"]=$row_khachhang_id['khachhang_id'];
	
	header('Location: index.php?quanly=giohang');
	}
?>



	<div class="agile-main-top">
		<div class="container-fluid">
			<div class="row main-top-w3l py-2">
				<div class="col-lg-4 header-most-top">
					
				</div>
				<div class="col-lg-12 header-right mt-lg-0 mt-2">
					<!-- header lists -->
					<ul>
					<?php
						if(isset($_SESSION["dangnhap_home"]) ||  isset($_SESSION["dangky_home"]))
						{
					
					?>
						<li class="text-center border-right text-white">
							<a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>"  class="text-white">
								<i class="fas fa-truck mr-2"></i>Xem đơn hàng: <?php echo $_SESSION["dangnhap_home"]?></a>
						</li>
						
						<li class="text-center border-right text-white">
							<i class="fas fa-phone mr-2">
								<?php
									if(isset($_SESSION["khachhang_id"]))
									{
										$id_khachhang_check=$_SESSION["khachhang_id"];
									}elseif(isset($_SESSION["khachhang_dangky_id"]))
									{
										$id_khachhang_check=$_SESSION["khachhang_dangky_id"];
									}
									else{
										$id_khachhang_check='';
									}
									$sql_select_id_khachhang_check=mysqli_query($con,"SELECT * from tbl_khachhang where khachhang_id='$id_khachhang_check'");
									$row_id_khachhang_check=mysqli_fetch_array($sql_select_id_khachhang_check);
									echo $row_id_khachhang_check['phone'];
								?>
							</i> 
						</li>
						<li class="text-center border-right text-white">
							<i class="fas fa-map-marker-alt mr-2">
								<?php
									echo $row_id_khachhang_check['address'];
								?>
							</i> 
						</li>
						<?php
							if(isset($_SESSION["dangnhap_home"]) ||  isset($_SESSION["dangky_home"])){
						?>
							<li class="text-center border-right text-white">
							<a href="index.php?quanly=giohang"  class="text-white">
								<i class="fas fa-shopping-cart mr-2"></i> Giỏ hàng </a>
							</li>
							<li class="text-center  text-white">
							<a href="index.php?quanly=giohang&dangxuat=1"  class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i> Đăng xuất </a>
							</li>
						<?php 
							}}else{
						?>
						<li class="text-center border-right text-white">
							<a href="#" data-toggle="modal" data-target="#dangnhap" class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i> Đăng nhập </a>
						</li>
						<li class="text-center text-white">
							<a href="#" data-toggle="modal" data-target="#dangky" class="text-white">
								<i class="fas fa-sign-out-alt mr-2"></i>Đăng ký </a>
						</li>
						<?php } ?>
					</ul>
					<!-- //header lists -->
				</div>
			</div>
		</div>
	</div>
   
	<!-- log in -->
	<div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center">Đăng nhập</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="text" class="form-control" placeholder=" " name="email_login" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="password_login" required="">
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" value="Đăng nhập" name="dangnhap_home">
						</div>
					
						<p class="text-center dont-do mt-3">Chưa có tài khoản
							<a href="#" data-toggle="modal" data-target="#dangky">
								Đăng ký</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- register -->
	<div class="modal fade" id="dangky" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Đăng ký</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label class="col-form-label">Tênn khách hàng</label>
							<input type="text" class="form-control" placeholder=" " name="name" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder=" " name="email" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Số điện thoại</label>
							<input type="text" class="form-control" placeholder=" " name="phone" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="password" id="password1" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Địa chỉ</label>
							<input type="text" class="form-control" placeholder=" " name="address"  required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Ghi chú</label>
							<textarea type="text" class="form-control" placeholder=" " name="note" required=""></textarea>
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" name="dangky_home" value="Register">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
    <div class="header-bot">
		<div class="container">
			<div class="row header-bot_inner_wthreeinfo_header_mid">
				<!-- logo -->
				<div class="col-md-3 logo_agile">
					<h1 class="text-center">
						<a href="index.php" class="font-weight-bold font-italic">
							<img src="images/logo2.png" alt=" " class="img-fluid">Electro Store
						</a>
					</h1>
				</div>
				<!-- //logo -->
				<!-- header-bot -->
				<div class="col-md-9 header mt-4 mb-md-0 mb-4">
					<div class="row">
						<!-- search -->
						<div class="col-10 agileits_search">
							<form class="form-inline" action="index.php?quanly=timkiem" method="post">
								<input name="search_product" class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="Search" required>
								<button class="btn my-2 my-sm-0" name="search_btn" type="submit">Tìm kiếm</button>
							</form>
						</div>
						<!-- //search -->
						<!-- cart details -->
						<div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
							<div class="wthreecartaits wthreecartaits2 cart cart box_1">
								<form action="" method="post" class="last">
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="display" value="1">
									<button class="btn w3view-cart" type="submit" name="submit" value="">
										<i class="fas fa-cart-arrow-down"></i>
									</button>
								</form>
							</div>
						</div>
						<!-- //cart details -->
					</div>
				</div>
			</div>
		</div>
	</div>