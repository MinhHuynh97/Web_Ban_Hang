<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">Danh mục sản phẩm</h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						<?php
							$sql_cate_home=mysqli_query($con,"SELECT * from tbl_category order by category_id desc ");
							while($row_cate_home=mysqli_fetch_array($sql_cate_home)){
								$id_category=$row_cate_home['category_id'];
						?>
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<h3 class="heading-tittle text-center font-italic"><?php echo $row_cate_home['category_name'] ?></h3>
							<div class="row">
								<?php
									$sql_product=mysqli_query($con,"SELECT * from tbl_sanpham order by sanpham_id desc");
									while($row_sanpham=mysqli_fetch_array($sql_product)){
										if($row_sanpham['category_id']==$id_category){
								?>

								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img style="<?php if($row_sanpham['category_id']==4){
												echo "width: 127px;height:159px";
												
											}else{
												echo "width: 100%;height:159px";
												
											}
											  ?>" src="images/<?php echo $row_sanpham['sanpham_image'] ?>" alt="">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>>" class="link-product-add-cart">Xem sản phẩm</a>
												</div>
											</div>
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>"><?php echo $row_sanpham['sanpham_name'] ?></a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price"><?php echo number_format($row_sanpham['sp_khuyenmai']) ." đồng" ?></span>
												<del><?php echo number_format($row_sanpham['sanpham_gia']) ." đồng" ?></del>
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
											<form action="?quanly=giohang" method="post">
											
													<fieldset>
														<input type="hidden" name="tensanpham" value="<?php echo $row_sanpham['sanpham_name'] ?>" />
														<input type="hidden" name="sanpham_id" value="<?php echo $row_sanpham['sanpham_id'] ?>" />
														<input type="hidden" name="giasanpham" value="<?php echo $row_sanpham['sanpham_gia'] ?>" />
														<input type="hidden" name="hinhanh" value="<?php echo $row_sanpham['sanpham_image'] ?>" />
														<input type="hidden" name="soluong" value="1" />
														
														<input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="button" />
													</fieldset>
							
												</form>
											</div>
										</div>
									</div>
								</div>
								<?php
									}
								}
								?>
							</div>
						</div>
						<?php
							}

						?>
						<!-- Hình ảnh -->
						<div class="product-sec1 product-sec2 px-sm-5 px-3">
							<div class="row">
								<h3 class="col-md-4 effect-bg">Summer Carnival</h3>
								<p class="w3l-nut-middle">Get Extra 10% Off</p>
								<div class="col-md-8 bg-right-nut">
									<img src="images/image1.png" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- //product left -->

				<!-- product right -->
				<?php
				include('product_right.php');
				 ?>
				
			</div>
		</div>
	</div>