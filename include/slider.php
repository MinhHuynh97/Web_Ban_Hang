<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<!-- Indicators-->
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			
		</ol>
		<div class="carousel-inner">
			<?php
				$i=1;
				$sql_slider=mysqli_query($con,"SELECT * from tbl_slider where slider_active='1' order by slider_id ");
				while($row_slider=mysqli_fetch_array($sql_slider)){
					
			?>
			<div class="carousel-item item1 
			<?php if($i==1){
				echo "active";
			
				}else{
					echo '';
				}
			?>">
				<div class="container">
					<div class="w3l-space-banner">
						<div class="carousel-caption p-lg-5 p-sm-4 p-3">
							<p><?php echo $row_slider['slider_caption']; $i=0; ?></p>
						</div>
					</div>
				</div>
			</div>
			<?php
				}
			?>
			
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>