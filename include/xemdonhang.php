<?php
    if(isset($_GET['trangthaidon'])=='2' && isset($_GET['magiaodich']))
    {
        $magiaodich=$_GET['magiaodich'];
        $status=$_GET['trangthaidon'];
        $sql_update_status_giaodich=mysqli_query($con,"UPDATE tbl_giaodich set status_giaodich='$status' where magiaodich='$magiaodich'");
        // $sql_update_status_mahang=mysqli_query($con,"UPDATE tbl_donhang set status='$status' where mahang='$magiaodich'");
        
    }
?>
<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">Xem đơn hàng</h3>
			<!-- //tittle heading -->
			<div class="row">
				
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-12">
					<div class="wrapper">
						<!-- first section -->
						
							
                             <h3 style="display: block;">
								<?php
                                if(isset($_SESSION['dangnhap_home']))
                                {
                                    echo "Đơn hàng của:".$_SESSION['dangnhap_home']; 
                                }
                                
                                ?>
                                </h3></div><br>  
                            <div  class="col-md-12">
                                <?php
                                if (isset($_GET['khachhang']))
                                {
                                    $id_khachhang=$_GET['khachhang'];
                                }
                                else{
                                    $id_khachhang='';
                                }
                                ?>
                            <h4>Liệt kê lịch sử đơn hàng</h4>
                            <table class="table table-bordered ">
                                <tr>
                                    <th>Thứ tự </th>
                                    <th>Mã giao dịch </th>
                                    
                                    <th>Ngày đặt</th>
                                    <th>Quản lý</th>
                                    <th>Tình trạng đơn</th>

                                    <th>Huỷ đơn hàng</th>



                                </tr>
                                <?php
                                $i=0;
                                if(isset($_GET['magiaodich']))
                                {
                                    $mahang_donhang=$_GET['magiaodich'];

                                }
                                else{
                                    $mahang_donhang='';
                                }
                                $sql_select_giaodich_donhang=mysqli_query($con,"SELECT * from tbl_donhang  where khachhang_id='$id_khachhang'  group by mahang order by donhang_id desc");
                                while($row_select_giaodich_donhang=mysqli_fetch_array($sql_select_giaodich_donhang)){
                                    $i++;

                                ?>
                                <tr >
                                    
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $row_select_giaodich_donhang['mahang'] ?></td>
                                    
                                    <td><?php echo $row_select_giaodich_donhang['ngaythang'] ?></td>
                                    <td>
                                        <a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id']?>&magiaodich=<?php echo $row_select_giaodich_donhang['mahang'] ?>">Xem chi tiết</a>
                                    </td>
                                    <td><?php
                                     
                                    if($row_select_giaodich_donhang['status_donhang']=='0'){echo "Đang xử lý";}
                                    elseif($row_select_giaodich_donhang['status_donhang']=='1'){echo "Đã xác nhận và gửi";}
                                    else{echo "Đã huỷ";}?></td>

                                    <td>
                                        <a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id']?>&magiaodich=<?php echo $row_select_giaodich_donhang['mahang'] ?>&trangthaidon=2">Huỷ đơn hàng</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </table>
                        <div  class="col-lg-12">
                            <p>Chi tiết đơn hàng</p>
                            <table class="table table-bordered ">
                                <tr>
                                    <th>Thứ tự </th>
                                    <th>Mã giao dịch </th>
                                    <th>Tên sản phẩm </th>
                                    <th>Số lượng </th>

                                    <th>Ngày đặt</th>

                                </tr>
                                <?php
                                if(isset($_GET['magiaodich']))
                                {
                                $i=0;
                                $magiaodich_khachhang=$_GET['magiaodich'];
                                $sql_select_giaodich=mysqli_query($con,"SELECT * from tbl_donhang as dh,tbl_sanpham as sp where sp.sanpham_id=dh.sanpham_id and dh.khachhang_id='$id_khachhang' and dh.mahang='$magiaodich_khachhang' order by dh.donhang_id desc");
                                while($row_select_giaodich=mysqli_fetch_array($sql_select_giaodich)){
                                    $i++;

                                ?>
                                <tr >
                                    
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $row_select_giaodich['mahang'] ?></td>
                                    <td><?php echo $row_select_giaodich['sanpham_name'] ?></td>
                                    <td><?php echo $row_select_giaodich['soluong'] ?></td>

                                    <td><?php echo $row_select_giaodich['ngaythang'] ?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </table>
                        </div>
                            
                        </div>
                        <!-- //fourth section -->
					</div>
				</div>
				
				<!-- //product left -->
				<!-- product right -->
				
			</div>
		</div>
	</div>