
	
	<!-- //banner-2 -->
	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
                <?php
					if(isset($_GET['id_tin']))
					{
						$id_tin=$_GET['id_tin'];

					}
					else{
						$id_tin='';
					}
           			$sql_chitiet_tin=mysqli_query($con,"SELECT * from tbl_baiviet where baiviet_id='$id_tin' ");
            		$row_chitiet_tin=mysqli_fetch_array($sql_chitiet_tin);
            	?>
					<li>
						<a href="index.php">Trang chủ</a>
						<i>|</i>
					</li>
					<li><?php echo $row_chitiet_tin['tenbaiviet'] ?></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- about -->
	<div class="welcome py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
            
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<?php echo $row_chitiet_tin['tenbaiviet'] ?></h3>
			<!-- //tittle heading -->
            <?php 
                $chitiet=mysqli_query($con,"SELECT * from tbl_baiviet where baiviet_id='$id_tin'");
                $row_chitiet=mysqli_fetch_array($chitiet)
            ?>
			<div class="row">
			<div class="col-lg-12 welcome-center mt-lg-0 mt-sm-5 mt-4">
					<img style="width:100%" src="images/<?php echo $row_chitiet['baiviet_image'] ?>" class="img-fluid" alt=" ">
				</div>	
            <div class="col-lg-12 ">
					
					<h3 class="my-sm-3 my-2"><?php echo $row_chitiet['tomtat'] ?></h3><br>
					<h4 class="my-sm-3 my-2"><?php echo $row_chitiet['noidung'] ?></h4><br>
					
					
				</div>
				
			</div><br>
            
            
		</div>
	</div>
	<!-- //about -->

