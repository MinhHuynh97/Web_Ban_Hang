<footer>
		<div class="footer-top-first">
			<div class="container py-md-5 py-sm-4 py-3">
				<!-- footer first section -->
				<h2 class="footer-top-head-w3l font-weight-bold mb-2">Giới thiệu về chúng tôi:</h2>
				<p class="footer-main mb-4">
					If you're considering a new laptop, looking for a powerful new car stereo or shopping for a new HDTV, we make it easy to
					find exactly what you need at a price you can afford. We offer Every Day Low Prices on TVs, laptops, cell phones, tablets
					and iPads, video games, desktop computers, cameras and camcorders, audio, video and more.</p>
				<!-- //footer first section -->
				<!-- footer second section -->
				<div class="row w3l-grids-footer border-top border-bottom py-sm-4 py-3">
					<div class="col-md-4 offer-footer">
						<div class="row">
							<div class="col-4 icon-fot">
								<i class="fas fa-dolly"></i>
							</div>
							<div class="col-8 text-form-footer">
								<h3>Miễn phí vận chuyển</h3>
								<p>đơn hàng trên 1000000 vnd</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 offer-footer my-md-0 my-4">
						<div class="row">
							<div class="col-4 icon-fot">
								<i class="fas fa-shipping-fast"></i>
							</div>
							<div class="col-8 text-form-footer">
								<h3>Vận chuyển nhanh</h3>
								<p>Toàn quốc</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 offer-footer">
						<div class="row">
							<div class="col-4 icon-fot">
								<i class="far fa-thumbs-up"></i>
							</div>
							<div class="col-8 text-form-footer">
								<h3>Sự lựa chọn tin cậy</h3>
								<p>về sản phẩm</p>
							</div>
						</div>
					</div>
				</div>
				<!-- //footer second section -->
			</div>
			<div style="display: flex;justify-content: center;">
				<p>Số lượt khách truy cập:</p>
				<p>
				<?php
				$sql_view_count=mysqli_query($con,"SELECT * from tbl_views");
				$row_view_count=mysqli_fetch_array($sql_view_count);
				echo isset($_SESSION['count']);
				if(!isset($_SESSION['count']))
				{
					echo 1;
					$view_increase=$row_view_count['view']+1;
					$sql_view_update=mysqli_query($con,"UPDATE tbl_views set view=$view_increase where view_id=1");
					$_SESSION['count']=1;
				}
				else{
					echo "co session";
				}
				
				$number=$row_view_count['view'];
				$number=sprintf('%04d',$number);
			 	echo $number;
				
				 ?>
				</p>
			</div>
		</div>
		<!-- footer third section -->
		
		<!-- //footer fourth section (text) -->
	</footer>
	<!-- //footer -->
	<!-- copyright -->
	<div class="copy-right py-3">
		<div class="container">
			<p class="text-center text-white">© 2018 Electro Store. All rights reserved | Design by
				<a href="http://w3layouts.com"> W3layouts.</a>
			</p>
		</div>
	</div>