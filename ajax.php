<?php
include 'dbconnect.php';
$keyword = $_GET["keyword"];
?>

			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>ID Order</th>
                      <th>Name</th>
                      <th>Order Date</th>
                      <th>Total</th>
                      <th>Status</th>
                    </tr>
                  </thead>
					<?php
							$no=1;
							$brgs=mysqli_query($conn,"SELECT * from vmm_cart c, vmm_sign l where c.userid=l.userid and status!='Cart' and status!='Completed' and username like '%$keyword%' order by idcart ASC");
							while($p=mysqli_fetch_array($brgs)){
							$orderids = $p['orderid'];
							?>	
                  <tbody>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $p['orderid'] ?></td>
                      <td><?php echo $p['username'] ?></td>
                      <td><?php echo $p['orderdate'] ?></td>
                      <td>								Rp<?php
										$ordid = $p['orderid'];
										$result1 = mysqli_query($conn,"SELECT SUM(qty*price)+SUM(qty*price*3/100) AS count FROM vmm_detailorder d, vmm_product p where d.orderid='$ordid' and p.idproduct=d.idproduct order by d.idproduct ASC");
										$cekrow = mysqli_num_rows($result1);
										$row1 = mysqli_fetch_assoc($result1);
										$count = $row1['count'];
										if($cekrow > 0){
											echo number_format($count);
											} else {
										echo 'No data';
									}?></td>
                      <td>								<?php 
										$orders = $p['orderid'];
										$cekkonfirmasi = mysqli_query($conn,"select * from vmm_confirmation where orderid='$orders'");
										$cekroww = mysqli_num_rows($cekkonfirmasi);
														
										if($cekroww > 0){
											echo 'Confirmed';
										} else {
										if($p['status']!='Sent'){
											echo "Waiting For Confirmation";
											} else {
												echo "Order Sent";
											};
										}
									?></td>
                    </tr>
                  </tbody>
				  	<?php 
							}
					?>
			</table>