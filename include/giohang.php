<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
if (isset($_POST['themgiohang']))
{
    
	$tensanpham=$_POST['tensanpham'];
	$sanpham_id=$_POST['sanpham_id'];
	$gia=$_POST['giasanpham'];
	$soluong=$_POST['soluong'];
	$hinhanh=$_POST['hinhanh'];
	
	$sql_kiem_trung_giohang=mysqli_query($con,"SELECT * from tbl_giohang where sanpham_id='$sanpham_id'");
    $count=mysqli_num_rows($sql_kiem_trung_giohang);
    if($count>0)
    {
        $row_sanpham=mysqli_fetch_array($sql_kiem_trung_giohang);
        $soluong=$row_sanpham['soluong']+1;
        $sql_giohang="UPDATE tbl_giohang set soluong='$soluong' where sanpham_id='$sanpham_id'";
    }
    else{
        $soluong=$soluong;
        $sql_giohang=mysqli_query($con,"INSERT INTO tbl_giohang(tensanpham,sanpham_id,giasanpham,hinhanh,soluong) values ('$tensanpham','$sanpham_id','$gia','$hinhanh','$soluong')");
    }
    $insert_row=mysqli_query($con,$sql_giohang);
    // if($insert_row==0)
	// {
	// 	header('Location:index.php?quanly=chitietsp&id='.$sanpham_id);
	// }
}elseif(isset($_POST['capnhatsoluong'])){

    
    for($i=0;$i<count($_POST['product_id']);$i++){
        $sanpham_id=$_POST['product_id'][$i];
        $soluong=$_POST['soluong'][$i];
        if($soluong<=0)
        {
            $sql_detele=mysqli_query($con,"DELETE from tbl_giohang where sanpham_id='$sanpham_id'");
        }
        else{
            $sql_update=mysqli_query($con,"UPDATE tbl_giohang set soluong='$soluong' where sanpham_id='$sanpham_id'");

        }
    }
}elseif(isset($_GET['xoa']))
{
    $id=$_GET['xoa'];
    $sql_detele=mysqli_query($con,"DELETE from tbl_giohang where giohang_id='$id'");
    
}elseif(isset($_POST['thanhtoan']))
	{
		$name=$_POST['name'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$note=$_POST['note'];
		$address=$_POST['address'];
		$password=md5($_POST['password']);
		$giaohang=$_POST['giaohang'];
		
		$sql_khachhang=mysqli_query($con,"INSERT INTO tbl_khachhang(name,phone,address,email,giaohang,note,password) values ('$name','$phone','$address','$email','$giaohang','$note','$password')");
		// Thêm giỏ hàng
		if($sql_khachhang){
			$sql_select_khachhang=mysqli_query($con,"SELECT * from tbl_khachhang order by khachhang_id desc limit 1");
			$mahang=rand(0,999);
			$row_khachhang=mysqli_fetch_array($sql_select_khachhang);
			$khachhang_id=$row_khachhang['khachhang_id'];
			$_SESSION['dangnhap_home']=$row_khachhang['name'];
               
			$_SESSION['khachhang_id']=$khachhang_id;
			for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
				$sanpham_id=$_POST['thanhtoan_product_id'][$i];
				$soluong=$_POST['thanhtoan_soluong'][$i];
				
				$sql_donhang=mysqli_query($con,"INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang) values ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
				$sql_giaodich=mysqli_query($con,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
				
				$sql_detele_giohang=mysqli_query($con,"DELETE from tbl_giohang where sanpham_id='$sanpham_id'");
				
			}
		}
	}
	elseif(isset($_GET['dangxuat'])){
		session_destroy();
		// unset($_SESSION['dangnhap_home']);
		// unset($_SESSION['khachhang_id']);
		// header('Location: index.php');

	}
	elseif(isset($_POST['thanhtoan_dangnhap']))
	{
		
		$khachhang_id=$_SESSION['khachhang_id'];
		$mahang=rand(0,999);
		for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
			$sanpham_id=$_POST['thanhtoan_product_id'][$i];
			$soluong=$_POST['thanhtoan_soluong'][$i];
			$sql_donhang=mysqli_query($con,"INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang) values ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
			
			$sql_giaodich=mysqli_query($con,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
			
			$sql_detele_giohang=mysqli_query($con,"DELETE from tbl_giohang where sanpham_id='$sanpham_id'");
				
			}
	}
	

?>
<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>Giỏ hàng của bạn</span>
			</h3>
			<?php
					if(isset($_SESSION['dangnhap_home'])){
						echo '<p class="tenkhachhang">Chào bạn:'.$_SESSION['dangnhap_home'].'</p><a href="index.php?quanly=giohang&dangxuat=1">Đăng xuất</a>';
					}else
					{
						echo '';
					}
				?>
			<!-- //tittle heading -->
			<div class="checkout-right">
				
                <?php
                
                $sql_lay_giohang=mysqli_query($con,"SELECT * from tbl_giohang ORDER BY giohang_id desc");
                
                ?>
				<div class="table-responsive">
                    <form action="" method="POST">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Thứ tự</th>
								<th>Sản phẩm</th>
								<th>Số lượng</th>
								<th>Tên sản phẩm</th>

								<th>Giá</th>
								<th>Tổng giá</th>

								<th>Xoá</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                            $i=0;
                            $tong=0;
							
                            while($row_lay_giohang=mysqli_fetch_array($sql_lay_giohang)){
                                
                                $subtotal= $row_lay_giohang['soluong']*$row_lay_giohang['giasanpham'];
                                $tong+=$subtotal;
                                $i++;
                            ?>
							<tr class="rem1">
								<td class="invert"><?php echo $i ?></td>
								<td class="invert-image">
									<a href="single.php">
										<img src="images/<?php echo $row_lay_giohang['hinhanh'] ?>" alt=" " class="img-responsive">
									</a>
									
								</td>
								<td class="invert">
									<input id="soluong" type="number" min="1" name="soluong[]" value="<?php echo $row_lay_giohang['soluong'] ?>">
									<input type="hidden" name="product_id[]" value="<?php echo $row_lay_giohang['sanpham_id'] ?>">

                                </td>
								<td class="invert"><?php echo $row_lay_giohang['tensanpham'] ?></td>
								<td class="invert"><?php echo number_format($row_lay_giohang['giasanpham']) ." vnd" ?></td>
								<td class="invert"><?php echo number_format($subtotal) ." vnd" ?></td>
								
                                <td class="invert">
									<a href="?quanly=giohang&xoa=<?php echo $row_lay_giohang['giohang_id'] ?>">Xoá</a>
								</td>
							</tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="7">
                                    Tổng: <?php echo number_format($tong) ." vnd" ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <input type="submit" value="Cập nhật giỏ hàng" name="capnhatsoluong" class="btn btn-success">
                                
							
								<?php
									$sql_donhang_select=mysqli_query($con,"SELECT * from tbl_giohang");
									$count=mysqli_num_rows($sql_donhang_select);

									if(isset($_SESSION['dangnhap_home']) && $count>0)
									{
								
										while($row_select_giohang=mysqli_fetch_array($sql_donhang_select)){
								?>
									<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_select_giohang['sanpham_id'] ?>">
									<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_select_giohang['soluong'] ?>">
								<?php
								 }
								?>
									
                                    <input type="submit" value="Thanh toán" name="thanhtoan_dangnhap" class="btn btn-primary">
                                
								<?php
									}
								?>
								</td>
                            </tr>
						</tbody>
					</table>
                    </form>
				</div>
			</div>
			<?php
				if(!isset($_SESSION['dangnhap_home'])){
			?>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Thêm chi tiết giao hàng</h4>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Điền tên" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Số điện thoại" name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Địa chỉ" name="address" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Email" name="email" required="">
									</div>
									<div class="controls form-group">
										<input type="password" class="form-control" placeholder="Password" name="password" required="">
									</div>
									<div class="controls form-group">
									    <textarea style="resize: none;" class="form-control" placeholder="Note" name="note" required=""></textarea>
									</div>
									<div class="controls form-group">
										<select class="option-w3ls" name="giaohang">
											<option>Hình thức giao hàng</option>
											<option value="1">Thanh toán ATM</option>
											<option value="0">Thanh toán tại nhà</option>
																	</select>
									</div>
								</div>
								<?php
								$sql_lay_giohang=mysqli_query($con,"SELECT * from tbl_giohang order by giohang_id desc");
								while($row_thanhtoan=mysqli_fetch_array($sql_lay_giohang)){
								?>
									<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
									<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">

								
								<?php
								 }
								?>
								<input type="submit" value="Thanh toán" name="thanhtoan" class="btn btn-success">
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>
	<div class="test" id="test1"></div>

	<!-- <script>
		
		$(document).ready(function(){
			$('#soluong').change(function(){
				var price=$(this).val();
				$("#test1").text("Thanh cong");
				const test=new XMLHttpRequest();
				test.onload()=function(){

				}
				
			});
		});
	</script> -->
	