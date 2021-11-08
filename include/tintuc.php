
	</div>
	<!-- //banner-2 -->
	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
                <?php
            $id_tin=$_GET['id_tin'];
			
            $sql_danhmuc_tin=mysqli_query($con,"SELECT * from tbl_danhmuctin where danhmuctin_id='$id_tin' ");
            $row_danhmuc_tin=mysqli_fetch_array($sql_danhmuc_tin);
            ?>
					<li>
						<a href="index.php">Trang chủ</a>
						<i>|</i>
					</li>
					<li><?php echo $row_danhmuc_tin['tendanhmuc'] ?></li>
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
				<?php echo $row_danhmuc_tin['tendanhmuc'] ?></h3>
			<!-- //tittle heading -->
            <?php 
			
                $baiviet=mysqli_query($con,"SELECT * from tbl_baiviet where danhmuc_id='$id_tin'");
                
				while($row_baiviet=mysqli_fetch_array($baiviet)){
					
            ?>
			<div class="row">
			<div class="col-lg-4 welcome-right-top mt-lg-0 mt-sm-5 mt-4">
					<img src="images/<?php echo $row_baiviet['baiviet_image'] ?>" class="img-fluid" alt=" ">
				</div>	
            <div class="col-lg-8 welcome-left">
					<h5><a href="index.php?quanly=chitiettin&id_tin=<?php echo $row_baiviet['baiviet_id'] ?>"> <?php echo $row_baiviet['tenbaiviet'] ?></a></h5>
					<h4 class="my-sm-3 my-2"><?php echo $row_baiviet['tomtat'] ?></h4><br>
					
					
				</div>
				
			</div><br>
            <?php
                }
            ?>
            
		</div>
	</div>
	<!-- //about -->

